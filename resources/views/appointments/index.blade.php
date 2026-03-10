@extends('layouts.customer')

@section('title', 'My Appointments')

@section('content')
    <section class="py-16 lg:py-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-black tracking-tight text-slate-900">My Appointments</h1>
                    <p class="mt-2 text-slate-600">View your booking history and upcoming appointments.</p>
                </div>

                <a href="{{ route('appointments.create') }}"
                    class="inline-flex items-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-bold text-white hover:bg-slate-800">
                    Book New Appointment
                </a>
            </div>

            @if (session('success'))
                <div class="mt-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mt-8 rounded-3xl border border-slate-200 bg-white shadow-sm overflow-hidden">
                <div class="divide-y divide-slate-100">
                    @forelse($appointments as $appointment)
                        <a href="{{ route('appointments.show', $appointment) }}"
                            class="block p-5 hover:bg-slate-50 transition">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div>
                                    <div class="text-lg font-black text-slate-900">
                                        {{ $appointment->service->name }}
                                    </div>

                                    <div class="mt-2 text-sm text-slate-500">
                                        Date: {{ $appointment->appointment_date }}
                                    </div>

                                    <div class="mt-1 text-sm text-slate-500">
                                        Time: {{ $appointment->appointment_time }}
                                    </div>

                                    <div class="mt-1 text-sm text-slate-500">
                                        Staff: {{ $appointment->staff?->user?->name ?? 'Not assigned yet' }}
                                    </div>
                                </div>

                                <div>
                                    <span
                                        class="inline-flex rounded-full bg-sky-100 px-3 py-1 text-xs font-bold text-sky-700">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="p-8 text-center text-slate-500">
                            No appointments found.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection
