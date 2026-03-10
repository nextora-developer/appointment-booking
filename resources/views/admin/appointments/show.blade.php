@extends('layouts.admin')

@section('title', 'Appointment Details')
@section('page_title', 'Appointment Details')
@section('page_description', 'View full appointment information')

@section('content')
    <div class="max-w-5xl rounded-3xl bg-white border border-slate-200 p-8 shadow-sm">
        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-6">
            <div>
                <h2 class="text-2xl font-black text-slate-900">
                    {{ $appointment->service->name ?? 'Appointment' }}
                </h2>
                <p class="mt-2 text-slate-500">
                    Customer booking details and assignment information.
                </p>
            </div>

            @php
                $statusClasses = match ($appointment->status) {
                    'pending' => 'bg-amber-100 text-amber-700',
                    'confirmed' => 'bg-sky-100 text-sky-700',
                    'completed' => 'bg-emerald-100 text-emerald-700',
                    'cancelled' => 'bg-rose-100 text-rose-700',
                    default => 'bg-slate-100 text-slate-700',
                };
            @endphp

            <span class="inline-flex rounded-full px-4 py-2 text-sm font-bold {{ $statusClasses }}">
                {{ ucfirst($appointment->status) }}
            </span>
        </div>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                <div class="text-xs uppercase tracking-[0.2em] font-bold text-slate-400">Customer Name</div>
                <div class="mt-2 text-lg font-black text-slate-900">{{ $appointment->customer->name ?? 'N/A' }}</div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                <div class="text-xs uppercase tracking-[0.2em] font-bold text-slate-400">Customer Email</div>
                <div class="mt-2 text-lg font-black text-slate-900">{{ $appointment->customer->email ?? 'N/A' }}</div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                <div class="text-xs uppercase tracking-[0.2em] font-bold text-slate-400">Service</div>
                <div class="mt-2 text-lg font-black text-slate-900">{{ $appointment->service->name ?? 'N/A' }}</div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                <div class="text-xs uppercase tracking-[0.2em] font-bold text-slate-400">Assigned Staff</div>
                <div class="mt-2 text-lg font-black text-slate-900">
                    {{ $appointment->staff?->user?->name ?? 'Not assigned' }}</div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                <div class="text-xs uppercase tracking-[0.2em] font-bold text-slate-400">Appointment Date</div>
                <div class="mt-2 text-lg font-black text-slate-900">{{ $appointment->appointment_date }}</div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                <div class="text-xs uppercase tracking-[0.2em] font-bold text-slate-400">Appointment Time</div>
                <div class="mt-2 text-lg font-black text-slate-900">{{ $appointment->appointment_time }}</div>
            </div>
        </div>

        <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-5">
            <div class="text-xs uppercase tracking-[0.2em] font-bold text-slate-400">Notes</div>
            <div class="mt-2 text-sm leading-7 text-slate-600">
                {{ $appointment->notes ?: 'No notes provided.' }}
            </div>
        </div>

        <div class="mt-8 flex flex-wrap gap-3">
            <a href="{{ route('admin.appointments.edit', $appointment) }}"
                class="inline-flex items-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-bold text-white hover:bg-slate-800">
                Edit Appointment
            </a>

            <a href="{{ route('admin.appointments.index') }}"
                class="inline-flex items-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-slate-700 hover:bg-slate-50">
                Back
            </a>
        </div>
    </div>
@endsection
