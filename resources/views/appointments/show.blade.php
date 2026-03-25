@extends('layouts.customer')

@section('title', 'Appointment Details')

@section('content')
    <section class="bg-[#f8faf7] py-16 lg:py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            @php
                $status = $appointment->status;

                $statusClass = match ($status) {
                    'pending' => 'bg-amber-100 text-amber-700',
                    'confirmed' => 'bg-blue-100 text-blue-700',
                    'completed' => 'bg-emerald-100 text-emerald-700',
                    'cancelled' => 'bg-red-100 text-red-600',
                    default => 'bg-slate-100 text-slate-600',
                };
            @endphp

            <div class="rounded-[2rem] border border-slate-200 bg-white p-8 lg:p-10 shadow-sm">

                {{-- HEADER --}}
                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">
                    <div>
                        <div class="text-xs font-semibold uppercase tracking-[0.25em] text-[#8bc34a]">
                            Booking Overview
                        </div>

                        <h1 class="mt-2 text-3xl lg:text-4xl font-serif text-slate-900">
                            Appointment Details
                        </h1>

                        <p class="mt-3 text-slate-600 leading-relaxed">
                            Review the full details of your appointment booking below.
                        </p>
                    </div>

                    <span
                        class="inline-flex items-center self-start rounded-full px-4 py-2 text-sm font-semibold {{ $statusClass }}">
                        {{ ucfirst($appointment->status) }}
                    </span>
                </div>

                {{-- INFO GRID --}}
                <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="rounded-[1.5rem] border border-slate-200 bg-[#f8faf7] p-5">
                        <div class="text-xs uppercase tracking-[0.22em] font-semibold text-slate-400">
                            Service
                        </div>
                        <div class="mt-3 text-xl font-serif text-slate-900">
                            {{ $appointment->service->name }}
                        </div>
                    </div>

                    <div class="rounded-[1.5rem] border border-slate-200 bg-[#f8faf7] p-5">
                        <div class="text-xs uppercase tracking-[0.22em] font-semibold text-slate-400">
                            Staff
                        </div>
                        <div class="mt-3 text-lg font-semibold text-slate-900">
                            {{ $appointment->staff?->user?->name ?? 'Not assigned yet' }}
                        </div>
                    </div>

                    <div class="rounded-[1.5rem] border border-slate-200 bg-[#f8faf7] p-5">
                        <div class="text-xs uppercase tracking-[0.22em] font-semibold text-slate-400">
                            Date
                        </div>
                        <div class="mt-3 text-lg font-semibold text-slate-900">
                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}
                        </div>
                    </div>

                    <div class="rounded-[1.5rem] border border-slate-200 bg-[#f8faf7] p-5">
                        <div class="text-xs uppercase tracking-[0.22em] font-semibold text-slate-400">
                            Time
                        </div>
                        <div class="mt-3 text-lg font-semibold text-slate-900">
                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}
                        </div>
                    </div>

                </div>

                {{-- NOTES --}}
                <div class="mt-6 rounded-[1.5rem] border border-slate-200 bg-white p-6">
                    <div class="text-xs uppercase tracking-[0.22em] font-semibold text-[#8bc34a]">
                        Notes
                    </div>

                    <div class="mt-3 text-sm leading-7 text-slate-600">
                        {{ $appointment->notes ?: 'No additional notes provided.' }}
                    </div>
                </div>

                {{-- ACTION --}}
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('appointments.index') }}"
                        class="inline-flex items-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition duration-300">
                        Back to My Appointments
                    </a>

                    <a href="{{ route('appointments.create') }}"
                        class="inline-flex items-center rounded-xl bg-[#8bc34a] px-5 py-3 text-sm font-semibold text-white hover:bg-[#7cb342] transition duration-300 shadow-sm">
                        Book Another Appointment
                    </a>
                </div>

            </div>
        </div>
    </section>
@endsection