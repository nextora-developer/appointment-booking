@extends('layouts.customer')

@section('title', 'Dashboard')

@section('content')
    <section class="bg-[#f8faf7] py-16 lg:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- HERO CARD --}}
            <div class="rounded-[2rem] border border-slate-200 bg-white p-8 lg:p-10 shadow-sm">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">

                    <div class="max-w-2xl">
                        <div class="text-xs sm:text-sm font-semibold uppercase tracking-[0.25em] text-[#8bc34a]">
                            Customer Dashboard
                        </div>

                        <h1 class="mt-3 text-3xl sm:text-4xl lg:text-5xl font-serif text-slate-900 leading-tight">
                            Welcome back, {{ auth()->user()->name }}
                        </h1>

                        <p class="mt-4 text-slate-600 text-base leading-relaxed">
                            Manage your appointments, check your booking history, and schedule your next salon visit
                            with ease.
                        </p>

                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="{{ route('appointments.create') }}"
                                class="inline-flex items-center justify-center rounded-xl bg-[#8bc34a] px-6 py-3 text-sm font-semibold text-white hover:bg-[#7cb342] transition duration-300 shadow-sm">
                                Book Appointment
                            </a>

                            <a href="{{ route('appointments.index') }}"
                                class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition duration-300">
                                My Appointments
                            </a>
                        </div>
                    </div>

                    {{-- DECORATIVE SIDE --}}
                    <div class="lg:w-[280px]">
                        <div
                            class="rounded-[2rem] bg-[#8bc34a]/10 border border-[#8bc34a]/20 p-6 lg:p-7 h-full flex flex-col justify-center">
                            <div class="w-14 h-14 rounded-2xl bg-[#8bc34a] text-white flex items-center justify-center shadow-sm">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />
                                </svg>
                            </div>

                            <h3 class="mt-5 text-xl font-serif text-slate-900">
                                Your Beauty Schedule
                            </h3>

                            <p class="mt-2 text-sm leading-relaxed text-slate-600">
                                Keep track of your salon appointments and enjoy a smooth booking experience anytime.
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            {{-- STATS --}}
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">

                <div
                    class="rounded-[2rem] border border-slate-200 bg-white p-6 lg:p-7 shadow-sm hover:shadow-md transition duration-300">
                    <div class="flex items-center justify-between">
                        <div class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-400">
                            Upcoming
                        </div>
                        <div class="w-11 h-11 rounded-2xl bg-[#8bc34a]/10 text-[#8bc34a] flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>

                    <div class="mt-5 text-4xl font-serif text-slate-900">0</div>

                    <p class="mt-2 text-sm text-slate-500 leading-relaxed">
                        Your upcoming appointments.
                    </p>
                </div>

                <div
                    class="rounded-[2rem] border border-slate-200 bg-white p-6 lg:p-7 shadow-sm hover:shadow-md transition duration-300">
                    <div class="flex items-center justify-between">
                        <div class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-400">
                            Completed
                        </div>
                        <div class="w-11 h-11 rounded-2xl bg-[#8bc34a]/10 text-[#8bc34a] flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>

                    <div class="mt-5 text-4xl font-serif text-slate-900">0</div>

                    <p class="mt-2 text-sm text-slate-500 leading-relaxed">
                        Completed appointment history.
                    </p>
                </div>

                <div
                    class="rounded-[2rem] border border-slate-200 bg-white p-6 lg:p-7 shadow-sm hover:shadow-md transition duration-300">
                    <div class="flex items-center justify-between">
                        <div class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-400">
                            Cancelled
                        </div>
                        <div class="w-11 h-11 rounded-2xl bg-red-50 text-red-500 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                    </div>

                    <div class="mt-5 text-4xl font-serif text-slate-900">0</div>

                    <p class="mt-2 text-sm text-slate-500 leading-relaxed">
                        Cancelled booking records.
                    </p>
                </div>

            </div>

            {{-- QUICK LINKS / EXTRA SECTION --}}
            <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">

                <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
                    <div class="text-xs font-semibold uppercase tracking-[0.22em] text-[#8bc34a]">
                        Quick Access
                    </div>

                    <h2 class="mt-3 text-2xl font-serif text-slate-900">
                        Manage your bookings
                    </h2>

                    <p class="mt-3 text-slate-600 leading-relaxed">
                        View your appointment details, monitor booking status, and make your next reservation in just a
                        few clicks.
                    </p>

                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="{{ route('appointments.index') }}"
                            class="inline-flex items-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                            View Appointments
                        </a>

                        <a href="{{ route('profile.edit') }}"
                            class="inline-flex items-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                            Edit Profile
                        </a>
                    </div>
                </div>

                <div
                    class="rounded-[2rem] border border-[#8bc34a]/20 bg-gradient-to-br from-[#8bc34a]/10 to-white p-8 shadow-sm">
                    <div class="text-xs font-semibold uppercase tracking-[0.22em] text-[#8bc34a]">
                        Next Visit
                    </div>

                    <h2 class="mt-3 text-2xl font-serif text-slate-900">
                        Ready for your next appointment?
                    </h2>

                    <p class="mt-3 text-slate-600 leading-relaxed">
                        Choose your preferred service, date, and staff member to book your next salon session with
                        ease.
                    </p>

                    <div class="mt-6">
                        <a href="{{ route('appointments.create') }}"
                            class="inline-flex items-center rounded-xl bg-[#8bc34a] px-6 py-3 text-sm font-semibold text-white hover:bg-[#7cb342] transition duration-300 shadow-sm">
                            Book Now
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection