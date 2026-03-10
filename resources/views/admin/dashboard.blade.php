@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page_title', 'Dashboard')
@section('page_description', 'Overview of your appointment booking system')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
        <div class="rounded-3xl bg-white border border-slate-200 p-6 shadow-sm">
            <div class="text-sm font-bold uppercase tracking-[0.2em] text-slate-400">Services</div>
            <div class="mt-3 text-4xl font-black text-slate-900">{{ $totalServices }}</div>
        </div>

        <div class="rounded-3xl bg-white border border-slate-200 p-6 shadow-sm">
            <div class="text-sm font-bold uppercase tracking-[0.2em] text-slate-400">Staff</div>
            <div class="mt-3 text-4xl font-black text-slate-900">{{ $totalStaff }}</div>
        </div>

        <div class="rounded-3xl bg-white border border-slate-200 p-6 shadow-sm">
            <div class="text-sm font-bold uppercase tracking-[0.2em] text-slate-400">Customers</div>
            <div class="mt-3 text-4xl font-black text-slate-900">{{ $totalCustomers }}</div>
        </div>

        <div class="rounded-3xl bg-white border border-slate-200 p-6 shadow-sm">
            <div class="text-sm font-bold uppercase tracking-[0.2em] text-slate-400">Appointments</div>
            <div class="mt-3 text-4xl font-black text-slate-900">{{ $totalAppointments }}</div>
        </div>
    </div>

    <div class="mt-8 rounded-3xl bg-white border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200 flex items-center justify-between">
            <h2 class="text-lg font-black text-slate-900">Recent Appointments</h2>

            <a href="{{ route('admin.appointments.index') }}"
                class="inline-flex items-center rounded-xl border border-slate-200 px-4 py-2 text-sm font-bold text-slate-700 hover:bg-slate-50">
                View All
            </a>
        </div>

        <div class="divide-y divide-slate-100">
            @forelse($recentAppointments as $appointment)
                <div class="px-6 py-5 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <div>
                        <div class="font-black text-slate-900">
                            {{ $appointment->service->name ?? 'N/A' }}
                        </div>
                        <div class="mt-1 text-sm text-slate-500">
                            Customer: {{ $appointment->customer->name ?? 'N/A' }}
                        </div>
                        <div class="mt-1 text-sm text-slate-500">
                            Date: {{ $appointment->appointment_date }} | Time: {{ $appointment->appointment_time }}
                        </div>
                    </div>

                    <span class="inline-flex rounded-full bg-sky-100 px-3 py-1 text-xs font-bold text-sky-700">
                        {{ ucfirst($appointment->status) }}
                    </span>
                </div>
            @empty
                <div class="px-6 py-8 text-center text-slate-500">
                    No appointments found.
                </div>
            @endforelse
        </div>
    </div>
@endsection
