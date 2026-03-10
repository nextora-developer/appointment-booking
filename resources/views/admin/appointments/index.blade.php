@extends('layouts.admin')

@section('title', 'Manage Appointments')
@section('page_title', 'Appointments')
@section('page_description', 'Manage all customer appointment bookings')

@section('content')
    <div class="rounded-3xl bg-white border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left font-bold text-slate-500">Customer</th>
                        <th class="px-6 py-4 text-left font-bold text-slate-500">Service</th>
                        <th class="px-6 py-4 text-left font-bold text-slate-500">Date</th>
                        <th class="px-6 py-4 text-left font-bold text-slate-500">Time</th>
                        <th class="px-6 py-4 text-left font-bold text-slate-500">Staff</th>
                        <th class="px-6 py-4 text-left font-bold text-slate-500">Status</th>
                        <th class="px-6 py-4 text-right font-bold text-slate-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($appointments as $appointment)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-900">
                                    {{ $appointment->customer->name ?? 'N/A' }}
                                </div>
                                <div class="mt-1 text-xs text-slate-500">
                                    {{ $appointment->customer->email ?? '' }}
                                </div>
                            </td>

                            <td class="px-6 py-4 text-slate-700">
                                {{ $appointment->service->name ?? 'N/A' }}
                            </td>

                            <td class="px-6 py-4 text-slate-700">
                                {{ $appointment->appointment_date }}
                            </td>

                            <td class="px-6 py-4 text-slate-700">
                                {{ $appointment->appointment_time }}
                            </td>

                            <td class="px-6 py-4 text-slate-700">
                                {{ $appointment->staff?->user?->name ?? 'Not assigned' }}
                            </td>

                            <td class="px-6 py-4">
                                @php
                                    $statusClasses = match($appointment->status) {
                                        'pending' => 'bg-amber-100 text-amber-700',
                                        'confirmed' => 'bg-sky-100 text-sky-700',
                                        'completed' => 'bg-emerald-100 text-emerald-700',
                                        'cancelled' => 'bg-rose-100 text-rose-700',
                                        default => 'bg-slate-100 text-slate-700',
                                    };
                                @endphp

                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold {{ $statusClasses }}">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.appointments.show', $appointment) }}"
                                       class="rounded-xl border border-slate-200 px-3 py-2 text-xs font-bold text-slate-700 hover:bg-slate-50">
                                        View
                                    </a>

                                    <a href="{{ route('admin.appointments.edit', $appointment) }}"
                                       class="rounded-xl border border-slate-200 px-3 py-2 text-xs font-bold text-slate-700 hover:bg-slate-50">
                                        Edit
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-slate-500">
                                No appointments found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-slate-200">
            {{ $appointments->links() }}
        </div>
    </div>
@endsection