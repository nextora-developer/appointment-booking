@extends('layouts.customer')

@section('title', 'Home - Appointment Booking System')

@section('content')
    <section class="relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-24">
            <div class="max-w-3xl">
                <span
                    class="inline-flex items-center rounded-full bg-sky-50 px-4 py-1 text-sm font-semibold text-sky-700 border border-sky-100">
                    Simple & Fast Appointment Booking
                </span>

                <h1 class="mt-6 text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight text-slate-900">
                    Book your appointment online in just a few clicks
                </h1>

                <p class="mt-6 text-lg text-slate-600 leading-8">
                    Manage your bookings, choose services, pick your preferred date and time, and track your appointments
                    through one simple customer portal.
                </p>

                <div class="mt-8 flex flex-wrap items-center gap-4">
                    @auth
                        <a href="{{ route('appointments.create') }}"
                            class="inline-flex items-center rounded-2xl bg-slate-900 px-6 py-3 text-sm font-bold text-white hover:bg-slate-800">
                            Book Appointment
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center rounded-2xl bg-slate-900 px-6 py-3 text-sm font-bold text-white hover:bg-slate-800">
                            Book Appointment
                        </a>
                    @endauth

                    <a href="{{ route('services.index') }}"
                        class="inline-flex items-center rounded-2xl border border-slate-200 bg-white px-6 py-3 text-sm font-bold text-slate-700 hover:bg-slate-50">
                        View Services
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="text-lg font-black text-slate-900">Choose a Service</div>
                    <p class="mt-2 text-sm text-slate-600">Browse available services and select the one that fits your
                        needs.</p>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="text-lg font-black text-slate-900">Pick Date & Time</div>
                    <p class="mt-2 text-sm text-slate-600">Choose your preferred appointment date and available time slot.
                    </p>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="text-lg font-black text-slate-900">Confirm Booking</div>
                    <p class="mt-2 text-sm text-slate-600">Track and manage your bookings through your customer dashboard.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
