<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\BusinessHour;
use App\Models\Service;
use App\Models\Staff;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointment::with(['customer', 'service', 'staff.user']);

        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('booking_reference', 'like', "%{$search}%")
                    ->orWhere('appointment_date', 'like', "%{$search}%")
                    ->orWhereHas('customer', function ($customerQuery) use ($search) {
                        $customerQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    })
                    ->orWhereHas('service', function ($serviceQuery) use ($search) {
                        $serviceQuery->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('staff.user', function ($staffQuery) use ($search) {
                        $staffQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date')) {
            $query->whereDate('appointment_date', $request->date);
        }

        if ($request->filled('staff_id')) {
            $query->where('staff_id', $request->staff_id);
        }

        $appointments = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $staffMembers = \App\Models\Staff::with('user')
            ->where('is_active', true)
            ->get()
            ->sortBy(fn($staff) => $staff->user->name)
            ->values();

        return view('admin.appointments.index', compact('appointments', 'staffMembers'));
    }

    public function show(Appointment $appointment)
    {
        $appointment->load(['customer', 'service', 'staff.user']);

        return view('admin.appointments.show', compact('appointment'));
    }

    public function create(Request $request)
    {
        $customers = User::query()
            ->where('role', 'customer')
            ->orderBy('name')
            ->get();

        $services = Service::query()
            ->orderBy('name')
            ->get();

        $staffMembers = Staff::with('user')
            ->where('is_active', true)
            ->get()
            ->sortBy(fn($staff) => $staff->user->name)
            ->values();

        $availableSlots = [];

        if (
            $request->filled('service_id') &&
            $request->filled('appointment_date')
        ) {
            $availableSlots = $this->getAvailableSlots(
                $request->appointment_date,
                $request->staff_id
            );
        }

        return view('admin.appointments.create', compact(
            'customers',
            'services',
            'staffMembers',
            'availableSlots'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => ['required', 'exists:users,id'],
            'service_id' => ['required', 'exists:services,id'],
            'staff_id' => ['nullable', 'exists:staff,id'],
            'appointment_date' => ['required', 'date', 'after_or_equal:today'],
            'appointment_time' => ['required', 'date_format:H:i'],
            'notes' => ['nullable', 'string'],
        ]);

        if (!empty($validated['staff_id'])) {
            $exists = Appointment::query()
                ->where('appointment_date', $validated['appointment_date'])
                ->where('appointment_time', $validated['appointment_time'])
                ->where('staff_id', $validated['staff_id'])
                ->whereIn('status', ['pending', 'confirmed'])
                ->exists();

            if ($exists) {
                return back()
                    ->withErrors([
                        'appointment_time' => 'This time slot is already booked for the selected staff.',
                    ])
                    ->withInput();
            }
        }

        Appointment::create([
            'customer_id' => $validated['customer_id'],
            'service_id' => $validated['service_id'],
            'staff_id' => $validated['staff_id'] ?? null,
            'appointment_date' => $validated['appointment_date'],
            'appointment_time' => $validated['appointment_time'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'confirmed',
        ]);

        return redirect()
            ->route('admin.appointments.index')
            ->with('success', 'Appointment created successfully.');
    }

    public function edit(Appointment $appointment)
    {
        $appointment->load(['customer', 'service', 'staff.user']);

        $staffMembers = Staff::with('user')
            ->where('is_active', true)
            ->get();

        $statuses = ['pending', 'confirmed', 'completed', 'cancelled'];

        return view('admin.appointments.edit', compact('appointment', 'staffMembers', 'statuses'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'staff_id' => ['nullable', 'exists:staff,id'],
            'status' => ['required', 'in:pending,confirmed,completed,cancelled'],
            'notes' => ['nullable', 'string'],
        ]);

        $appointment->update([
            'staff_id' => $validated['staff_id'] ?? null,
            'status' => $validated['status'],
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()
            ->route('admin.appointments.index')
            ->with('success', 'Appointment updated successfully.');
    }

    public function calendar(Request $request)
    {
        $start = now()->startOfWeek();
        $end = now()->endOfWeek();

        if ($request->start) {
            $start = \Carbon\Carbon::parse($request->start)->startOfWeek();
            $end = $start->copy()->endOfWeek();
        }

        $appointments = \App\Models\Appointment::with(['customer', 'service', 'staff.user'])
            ->whereBetween('appointment_date', [$start->toDateString(), $end->toDateString()])
            ->whereIn('status', ['pending', 'confirmed', 'completed'])
            ->get();

        return view('admin.appointments.calendar', compact(
            'appointments',
            'start',
            'end'
        ));
    }

    private function getAvailableSlots(string $date, ?string $staffId = null): array
    {
        $dateCarbon = Carbon::parse($date);
        $dayName = strtolower($dateCarbon->format('l'));

        $businessHour = BusinessHour::query()
            ->where('day', $dayName)
            ->first();

        if (!$businessHour || !$businessHour->open_time || !$businessHour->close_time) {
            return [];
        }

        $start = Carbon::createFromFormat('H:i:s', $businessHour->open_time);
        $end = Carbon::createFromFormat('H:i:s', $businessHour->close_time);

        $slots = [];

        while ($start < $end) {
            $slot = $start->format('H:i');

            $query = Appointment::query()
                ->where('appointment_date', $dateCarbon->toDateString())
                ->where('appointment_time', $slot)
                ->whereIn('status', ['pending', 'confirmed']);

            if ($staffId) {
                $query->where('staff_id', $staffId);
            }

            $isBooked = $query->exists();

            if (!$isBooked) {
                $slots[] = $slot;
            }

            $start->addMinutes(30);
        }

        return $slots;
    }
}
