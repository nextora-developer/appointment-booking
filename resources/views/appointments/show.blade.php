@extends('layouts.customer')

@section('title', 'Appointment Details')

@section('content')
    <section class="py-16 lg:py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl border border-slate-200 bg-white p-8 lg:p-10 shadow-sm">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-6">
                    <div>
                        <h1 class="text-3xl font-black tracking-tight text-slate-900">
                            Appointment Details
                        </h1>
                        <p class="mt-3 text-slate-600">
                            Review the full details of your appointment booking below.
                        </p>
                    </div>

                    <span class="inline-flex rounded-full bg-sky-100 px-4 py-2 text-sm font-bold text-sky-700">
                        {{ ucfirst($appointment->status) }}
                    </span>
                </div>

                <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <div class="text-xs uppercase tracking-[0.2em] font-bold text-slate-400">Service</div>
                        <div class="mt-2 text-lg font-black text-slate-900">{{ $appointment->service->name }}</div>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <div class="text-xs uppercase tracking-[0.2em] font-bold text-slate-400">Staff</div>
                        <div class="mt-2 text-lg font-black text-slate-900">
                            {{ $appointment->staff?->user?->name ?? 'Not assigned yet' }}
                        </div>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <div class="text-xs uppercase tracking-[0.2em] font-bold text-slate-400">Date</div>
                        <div class="mt-2 text-lg font-black text-slate-900">{{ $appointment->appointment_date }}</div>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <div class="text-xs uppercase tracking-[0.2em] font-bold text-slate-400">Time</div>
                        <div class="mt-2 text-lg font-black text-slate-900">{{ $appointment->appointment_time }}</div>
                    </div>
                </div>

                <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-5">
                    <div class="text-xs uppercase tracking-[0.2em] font-bold text-slate-400">Notes</div>
                    <div class="mt-2 text-sm leading-7 text-slate-600">
                        {{ $appointment->notes ?: 'No additional notes provided.' }}
                    </div>
                </div>

                <div class="mt-8">
                    <a href="{{ route('appointments.index') }}"
                        class="inline-flex items-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-slate-700 hover:bg-slate-50">
                        Back to My Appointments
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
