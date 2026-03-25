@extends('layouts.customer')

@section('title', 'My Appointments')

@section('content')
    <section class="bg-[#f8faf7] py-16 lg:py-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- HEADER --}}
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                <div>
                    {{-- <div class="text-xs font-semibold uppercase tracking-[0.25em] text-[#8bc34a]">
                        Appointment History
                    </div> --}}

                    <h1 class="mt-2 text-3xl lg:text-4xl font-serif text-slate-900">
                        My Appointments
                    </h1>

                    <p class="mt-3 text-slate-600">
                        View your upcoming bookings and past salon visits.
                    </p>
                </div>

                <a href="{{ route('appointments.create') }}"
                    class="inline-flex items-center justify-center bg-[#8bc34a] px-6 py-3 text-sm font-semibold text-white hover:bg-[#7cb342] transition duration-300 shadow-sm">
                    Book New Appointment
                </a>

            </div>

            {{-- SUCCESS --}}
            @if (session('success'))
                <div class="mt-6 border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            {{-- LIST --}}
            <div class="mt-10 space-y-5">

                @forelse($appointments as $appointment)
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

                    <a href="{{ route('appointments.show', $appointment) }}"
                        class="block border border-slate-200 bg-white p-6 lg:p-7 shadow-sm hover:shadow-md hover:border-[#8bc34a]/30 transition duration-300">

                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                            {{-- LEFT --}}
                            <div>

                                <h2 class="text-xl font-serif text-slate-900">
                                    {{ $appointment->service->name }}
                                </h2>

                                <div class="mt-3 space-y-1 text-sm text-slate-500">

                                    <div>
                                        <span class="font-semibold text-slate-700">Date:</span>
                                        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}
                                    </div>

                                    <div>
                                        <span class="font-semibold text-slate-700">Time:</span>
                                        {{ \Carbon\Carbon::createFromFormat('H:i:s', $appointment->appointment_time)->format('g:i A') }}
                                    </div>

                                    <div>
                                        <span class="font-semibold text-slate-700">Staff:</span>
                                        {{ $appointment->staff?->user?->name ?? 'Not assigned yet' }}
                                    </div>

                                </div>
                            </div>

                            {{-- RIGHT --}}
                            <div class="flex items-center justify-between lg:flex-col lg:items-end gap-3">

                                {{-- STATUS --}}
                                <span
                                    class="inline-flex items-center px-4 py-1.5 text-xs font-semibold {{ $statusClass }}">
                                    {{ ucfirst($status) }}
                                </span>

                                {{-- VIEW --}}
                                <span class="text-sm text-[#8bc34a] font-semibold">
                                    View Details →
                                </span>

                            </div>

                        </div>

                    </a>

                @empty

                    <div class="border border-slate-200 bg-white p-10 text-center shadow-sm">

                        <div
                            class="w-16 h-16 mx-auto bg-[#8bc34a]/10 text-[#8bc34a] flex items-center justify-center">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />
                            </svg>
                        </div>

                        <h3 class="mt-5 text-xl font-serif text-slate-900">
                            No appointments yet
                        </h3>

                        <p class="mt-2 text-slate-500 text-sm">
                            You haven’t made any bookings yet. Start by scheduling your first appointment.
                        </p>

                        <a href="{{ route('appointments.create') }}"
                            class="mt-6 inline-flex items-center bg-[#8bc34a] px-6 py-3 text-sm font-semibold text-white hover:bg-[#7cb342] transition duration-300">
                            Book Now
                        </a>

                    </div>
                @endforelse

            </div>

        </div>
    </section>
@endsection
