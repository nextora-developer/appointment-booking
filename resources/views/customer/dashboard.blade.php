@extends('layouts.customer')

@section('title', 'Dashboard')

@section('content')
    <section class="py-16 lg:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div>
                        <div class="text-sm font-bold uppercase tracking-[0.2em] text-slate-400">Customer Dashboard</div>
                        <h1 class="mt-2 text-3xl lg:text-4xl font-black tracking-tight text-slate-900">
                            Welcome back, {{ auth()->user()->name }}
                        </h1>
                        <p class="mt-3 text-slate-600">
                            Manage your appointments, view booking history, and schedule your next service easily.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('appointments.create') }}"
                            class="inline-flex items-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-bold text-white hover:bg-slate-800">
                            Book Appointment
                        </a>

                        <a href="{{ route('appointments.index') }}"
                            class="inline-flex items-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-slate-700 hover:bg-slate-50">
                            My Appointments
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="text-sm font-bold uppercase tracking-[0.2em] text-slate-400">Upcoming</div>
                    <div class="mt-3 text-4xl font-black text-slate-900">0</div>
                    <p class="mt-2 text-sm text-slate-500">Your upcoming appointments.</p>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="text-sm font-bold uppercase tracking-[0.2em] text-slate-400">Completed</div>
                    <div class="mt-3 text-4xl font-black text-slate-900">0</div>
                    <p class="mt-2 text-sm text-slate-500">Completed appointment history.</p>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="text-sm font-bold uppercase tracking-[0.2em] text-slate-400">Cancelled</div>
                    <div class="mt-3 text-4xl font-black text-slate-900">0</div>
                    <p class="mt-2 text-sm text-slate-500">Cancelled booking records.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
