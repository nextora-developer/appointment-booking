<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Staff;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['customer', 'service', 'staff.user'])
            ->latest()
            ->paginate(10);

        return view('admin.appointments.index', compact('appointments'));
    }

    public function show(Appointment $appointment)
    {
        $appointment->load(['customer', 'service', 'staff.user']);

        return view('admin.appointments.show', compact('appointment'));
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
}
