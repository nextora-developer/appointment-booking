<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\Staff;
use App\Services\TimeSlotService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $appointments = Appointment::with(['service', 'staff.user'])
            ->where('customer_id', $request->user()->id)
            ->latest()
            ->get();

        return view('appointments.index', compact('appointments'));
    }

    public function create(Request $request, TimeSlotService $timeSlotService)
    {
        $services = Service::where('is_active', true)->orderBy('name')->get();
        $staff = Staff::with('user')->where('is_active', true)->get();

        $selectedDate = $request->get('appointment_date');
        $selectedStaffId = $request->get('staff_id');

        $availableSlots = [];

        if ($selectedDate) {
            $availableSlots = $timeSlotService->getAvailableSlots($selectedDate, $selectedStaffId ? (int) $selectedStaffId : null);
        }

        return view('appointments.create', compact(
            'services',
            'staff',
            'availableSlots',
            'selectedDate',
            'selectedStaffId'
        ));
    }

    public function store(Request $request, TimeSlotService $timeSlotService)
    {
        $validated = $request->validate([
            'service_id' => ['required', 'exists:services,id'],
            'staff_id' => ['nullable', 'exists:staff,id'],
            'appointment_date' => ['required', 'date'],
            'appointment_time' => ['required'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $staffId = $validated['staff_id'] ?? null;

        /*
    |--------------------------------------------------------------------------
    | 1️⃣ Slot availability check (service layer)
    |--------------------------------------------------------------------------
    */

        if (! $timeSlotService->isSlotAvailable(
            $validated['appointment_date'],
            $validated['appointment_time'],
            $staffId ? (int) $staffId : null
        )) {
            return back()
                ->withErrors([
                    'appointment_time' => 'This time slot is no longer available.',
                ])
                ->withInput();
        }

        /*
    |--------------------------------------------------------------------------
    | 2️⃣ Extra safety check (database)
    |--------------------------------------------------------------------------
    */

        $exists = Appointment::query()
            ->where('appointment_date', $validated['appointment_date'])
            ->where('appointment_time', $validated['appointment_time'])
            ->where('staff_id', $staffId)
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();

        if ($exists) {
            return back()
                ->withErrors([
                    'appointment_time' => 'The selected time slot has already been taken.',
                ])
                ->withInput();
        }

        /*
    |--------------------------------------------------------------------------
    | 3️⃣ Create appointment
    |--------------------------------------------------------------------------
    */

        Appointment::create([
            'booking_reference' => 'BK-' . strtoupper(Str::random(8)),
            'customer_id' => auth()->id(),
            'service_id' => $validated['service_id'],
            'staff_id' => $staffId,
            'appointment_date' => $validated['appointment_date'],
            'appointment_time' => $validated['appointment_time'],
            'status' => 'pending',
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()
            ->route('appointments.index')
            ->with('success', 'Appointment booked successfully.');
    }

    public function show(Request $request, Appointment $appointment)
    {
        abort_unless($appointment->customer_id === $request->user()->id, 403);

        $appointment->load(['service', 'staff.user']);

        return view('appointments.show', compact('appointment'));
    }
}
