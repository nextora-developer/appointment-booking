<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\Staff;
use Illuminate\Http\Request;

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

    public function create()
    {
        $services = Service::where('is_active', true)->orderBy('name')->get();
        $staff = Staff::with('user')->where('is_active', true)->get();

        return view('appointments.create', compact('services', 'staff'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => ['required', 'exists:services,id'],
            'staff_id' => ['nullable', 'exists:staff,id'],
            'appointment_date' => ['required', 'date', 'after_or_equal:today'],
            'appointment_time' => ['required'],
            'notes' => ['nullable', 'string'],
        ]);

        Appointment::create([
            'customer_id' => $request->user()->id,
            'service_id' => $validated['service_id'],
            'staff_id' => $validated['staff_id'] ?? null,
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
