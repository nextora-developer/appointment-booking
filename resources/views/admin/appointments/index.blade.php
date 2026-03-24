@extends('layouts.admin')

@section('title', 'Manage Appointments')
@section('page_title', 'Appointments')
@section('page_description', 'View and manage all customer bookings and schedules')

@section('content')
    <form method="GET" action="{{ route('admin.appointments.index') }}" class="mb-6 flex flex-col gap-4">

        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">

            <div class="relative w-full lg:max-w-sm">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                    <i data-lucide="search" class="w-4 h-4"></i>
                </span>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search customer, service, staff, ref..."
                    class="w-full rounded-xl border-slate-200 pl-10 pr-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
            </div>

            

            <div class="grid grid-cols-2 sm:flex items-center gap-3 w-full lg:w-auto">
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-bold text-slate-700 hover:bg-slate-50 transition-all shadow-sm">
                    <i data-lucide="filter" class="w-4 h-4 text-slate-400"></i>
                    Apply Filters
                </button>

                <a href="{{ route('admin.appointments.create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-bold text-white hover:bg-indigo-700 transition-all shadow-md shadow-indigo-200">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    New Booking
                </a>
            </div>
        </div>

        {{-- Desktop Table --}}
        <div class="hidden lg:block rounded-3xl bg-white border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">Customer
                            </th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">
                                Service & Staff
                            </th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">Schedule
                            </th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">Status</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400 text-right">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($appointments as $appointment)
                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="h-9 w-9 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-xs font-bold text-slate-600 shadow-sm">
                                            {{ strtoupper(substr($appointment->customer->name ?? '?', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-slate-900 line-clamp-1">
                                                {{ $appointment->customer->name ?? 'Guest Customer' }}
                                            </div>
                                            <div class="text-[11px] font-medium text-slate-400 flex items-center gap-1">
                                                <i data-lucide="hash" class="w-3 h-3"></i>
                                                {{ $appointment->booking_reference ?? 'REF-NONE' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="text-slate-700 font-semibold">
                                        {{ $appointment->service->name ?? 'N/A' }}
                                    </div>
                                    <div class="mt-0.5 text-xs text-slate-500 flex items-center gap-1">
                                        <i data-lucide="user-circle" class="w-3.5 h-3.5 text-indigo-400"></i>
                                        {{ $appointment->staff?->user?->name ?? 'Unassigned' }}
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-slate-700">
                                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M, Y') }}
                                        </span>
                                        <span class="text-xs text-slate-400 font-medium">
                                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}
                                        </span>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    @php
                                        $statusClasses = match ($appointment->status) {
                                            'pending' => 'bg-amber-50 text-amber-700 border-amber-100',
                                            'confirmed' => 'bg-indigo-50 text-indigo-700 border-indigo-100',
                                            'completed' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                            'cancelled' => 'bg-rose-50 text-rose-700 border-rose-100',
                                            default => 'bg-slate-50 text-slate-700 border-slate-100',
                                        };
                                    @endphp
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-lg border px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider {{ $statusClasses }}">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('admin.appointments.show', $appointment) }}"
                                            class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all"
                                            title="View Details">
                                            <i data-lucide="eye" class="w-4 h-4"></i>
                                        </a>

                                        <a href="{{ route('admin.appointments.edit', $appointment) }}"
                                            class="p-2 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-all"
                                            title="Edit Booking">
                                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <div class="max-w-xs mx-auto">
                                        <div
                                            class="mb-4 inline-flex h-16 w-16 items-center justify-center rounded-full bg-slate-50 text-slate-200">
                                            <i data-lucide="calendar-x-2" class="w-8 h-8"></i>
                                        </div>
                                        <h3 class="text-sm font-bold text-slate-900">No bookings found</h3>
                                        <p class="mt-1 text-xs text-slate-500">Try adjusting your filters or create a new
                                            appointment manually.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($appointments->hasPages())
                <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/30">
                    {{ $appointments->links() }}
                </div>
            @endif
        </div>

        {{-- Mobile / Tablet Cards --}}
        <div class="lg:hidden space-y-4">
            @forelse($appointments as $appointment)
                @php
                    $statusClasses = match ($appointment->status) {
                        'pending' => 'bg-amber-50 text-amber-700 border-amber-100',
                        'confirmed' => 'bg-indigo-50 text-indigo-700 border-indigo-100',
                        'completed' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                        'cancelled' => 'bg-rose-50 text-rose-700 border-rose-100',
                        default => 'bg-slate-50 text-slate-700 border-slate-100',
                    };
                @endphp

                <div class="rounded-[1.5rem] bg-white border border-slate-200 shadow-sm p-4 sm:p-5">
                    <div class="flex items-start gap-3">
                        <div
                            class="h-11 w-11 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-sm font-bold text-slate-600 shadow-sm shrink-0">
                            {{ strtoupper(substr($appointment->customer->name ?? '?', 0, 1)) }}
                        </div>

                        <div class="min-w-0 flex-1">
                            <div class="flex items-start justify-between gap-3">
                                <div class="min-w-0">
                                    <h3 class="text-sm sm:text-base font-bold text-slate-900 truncate">
                                        {{ $appointment->customer->name ?? 'Guest Customer' }}
                                    </h3>
                                    <p class="mt-1 text-[11px] text-slate-400 flex items-center gap-1 truncate">
                                        <i data-lucide="hash" class="w-3 h-3 shrink-0"></i>
                                        {{ $appointment->booking_reference ?? 'REF-NONE' }}
                                    </p>
                                </div>

                                <span
                                    class="inline-flex items-center gap-1.5 rounded-lg border px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider whitespace-nowrap {{ $statusClasses }}">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </div>

                            <div class="mt-4 space-y-3">
                                <div class="rounded-xl bg-slate-50 px-3 py-3">
                                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">
                                        Service
                                    </p>
                                    <p class="mt-1 text-sm font-semibold text-slate-800">
                                        {{ $appointment->service->name ?? 'N/A' }}
                                    </p>
                                </div>

                                <div class="grid grid-cols-2 gap-3">
                                    <div class="rounded-xl bg-slate-50 px-3 py-3">
                                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">
                                            Staff
                                        </p>
                                        <p class="mt-1 text-sm font-semibold text-slate-700 line-clamp-1">
                                            {{ $appointment->staff?->user?->name ?? 'Unassigned' }}
                                        </p>
                                    </div>

                                    <div class="rounded-xl bg-slate-50 px-3 py-3">
                                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">
                                            Time
                                        </p>
                                        <p class="mt-1 text-sm font-semibold text-slate-700">
                                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="rounded-xl bg-slate-50 px-3 py-3">
                                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">
                                        Date
                                    </p>
                                    <p class="mt-1 text-sm font-semibold text-slate-700">
                                        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M, Y') }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-4 grid grid-cols-2 gap-3">
                                <a href="{{ route('admin.appointments.show', $appointment) }}"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-50 px-4 py-2.5 text-sm font-bold text-indigo-600 hover:bg-indigo-100 transition-colors">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                    View
                                </a>

                                <a href="{{ route('admin.appointments.edit', $appointment) }}"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-amber-50 px-4 py-2.5 text-sm font-bold text-amber-600 hover:bg-amber-100 transition-colors">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                    Edit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="rounded-[1.5rem] bg-white border border-slate-200 shadow-sm px-6 py-10 text-center">
                    <div class="max-w-xs mx-auto">
                        <div
                            class="mb-4 inline-flex h-16 w-16 items-center justify-center rounded-full bg-slate-50 text-slate-200">
                            <i data-lucide="calendar-x-2" class="w-8 h-8"></i>
                        </div>
                        <h3 class="text-sm font-bold text-slate-900">No bookings found</h3>
                        <p class="mt-1 text-xs text-slate-500">Try adjusting your filters or create a new appointment
                            manually.
                        </p>
                    </div>
                </div>
            @endforelse

            @if ($appointments->hasPages())
                <div class="rounded-2xl bg-white border border-slate-200 shadow-sm px-4 py-4">
                    {{ $appointments->links() }}
                </div>
            @endif
        </div>
    @endsection
