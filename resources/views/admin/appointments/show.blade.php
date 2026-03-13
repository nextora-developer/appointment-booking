@extends('layouts.admin')

@section('title', 'Appointment Details')
@section('page_title', 'Appointment View')
@section('page_description', 'Detailed breakdown of the booking and customer requirements')

@section('content')
    <div class="max-w-5xl space-y-6">

        <div
            class="flex flex-wrap items-center justify-between gap-4 bg-white border border-slate-200 p-4 rounded-3xl shadow-sm">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.appointments.index') }}"
                    class="p-2 hover:bg-slate-50 rounded-xl text-slate-400 hover:text-slate-600 transition-colors">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i>
                </a>
                <div class="h-8 w-px bg-slate-100 mx-2"></div>
                <span class="text-sm font-bold text-slate-500 uppercase tracking-widest">Ref:
                    {{ $appointment->booking_reference ?? 'N/A' }}</span>
            </div>

            <div class="flex items-center gap-3">
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
                    class="inline-flex items-center gap-2 rounded-xl border px-4 py-2 text-xs font-black uppercase tracking-wider {{ $statusClasses }}">
                    <span class="h-2 w-2 rounded-full bg-current"></span>
                    {{ $appointment->status }}
                </span>
                <a href="{{ route('admin.appointments.edit', $appointment) }}"
                    class="inline-flex items-center gap-2 bg-slate-900 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-slate-800 transition-all shadow-sm">
                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                    Edit
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-2 space-y-6">

                <div class="bg-white border border-slate-200 rounded-3xl p-8 shadow-sm">
                    <div class="flex items-start justify-between">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-indigo-600">Selected
                                Service</span>
                            <h2 class="text-3xl font-black text-slate-900 mt-1">
                                {{ $appointment->service->name ?? 'Service Details' }}
                            </h2>
                        </div>
                        <div class="p-4 bg-indigo-50 rounded-2xl text-indigo-600">
                            <i data-lucide="briefcase" class="w-8 h-8"></i>
                        </div>
                    </div>

                    <hr class="my-8 border-slate-100">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="flex items-start gap-4">
                            <div class="mt-1 bg-slate-50 p-2 rounded-lg text-slate-400">
                                <i data-lucide="calendar" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <div class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Date</div>
                                <div class="text-lg font-bold text-slate-900">
                                    {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') }}
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="mt-1 bg-slate-50 p-2 rounded-lg text-slate-400">
                                <i data-lucide="clock" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <div class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Time</div>
                                <div class="text-lg font-bold text-slate-900">
                                    {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="mt-1 bg-slate-50 p-2 rounded-lg text-slate-400">
                                <i data-lucide="user-check" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <div class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Assigned Staff
                                </div>
                                <div class="text-lg font-bold text-slate-900">
                                    {{ $appointment->staff?->user?->name ?? 'Pending Assignment' }}
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="mt-1 bg-slate-50 p-2 rounded-lg text-slate-400">
                                <i data-lucide="wallet" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <div class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Price</div>
                                <div class="text-lg font-bold text-slate-900">
                                    ${{ number_format($appointment->service->price ?? 0, 2) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-3xl p-8 shadow-sm">
                    <div class="flex items-center gap-2 mb-4">
                        <i data-lucide="sticky-note" class="w-5 h-5 text-slate-400"></i>
                        <h3 class="font-bold text-slate-900">Appointment Notes</h3>
                    </div>
                    <div
                        class="rounded-2xl bg-slate-50 p-6 text-slate-600 text-sm leading-relaxed border border-slate-100 italic">
                        {{ $appointment->notes ?: 'No specific instructions or notes provided by the customer.' }}
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white border border-slate-200 rounded-3xl p-6 shadow-sm">
                    <h3 class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-6">Customer Profile</h3>

                    <div class="flex flex-col items-center text-center">
                        <div
                            class="h-20 w-20 rounded-full bg-gradient-to-tr from-slate-200 to-slate-100 flex items-center justify-center text-2xl font-black text-slate-400 border-4 border-white shadow-md mb-4">
                            {{ strtoupper(substr($appointment->customer->name ?? '?', 0, 1)) }}
                        </div>
                        <h4 class="text-xl font-bold text-slate-900">{{ $appointment->customer->name ?? 'Guest' }}</h4>
                        <p class="text-sm text-slate-500 mt-1">{{ $appointment->customer->email ?? 'No email provided' }}
                        </p>
                    </div>

                    <div class="mt-8 space-y-4">
                        <button
                            class="w-full flex items-center justify-center gap-2 rounded-xl border border-slate-200 px-4 py-3 text-sm font-bold text-slate-700 hover:bg-slate-50 transition-all">
                            <i data-lucide="mail" class="w-4 h-4 text-slate-400"></i>
                            Send Message
                        </button>
                        <button
                            class="w-full flex items-center justify-center gap-2 rounded-xl border border-slate-200 px-4 py-3 text-sm font-bold text-slate-700 hover:bg-slate-50 transition-all">
                            <i data-lucide="history" class="w-4 h-4 text-slate-400"></i>
                            Booking History
                        </button>
                    </div>
                </div>

                <div class="p-6 text-center">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">
                        Created on {{ \Carbon\Carbon::parse($appointment->created_at)->format('M d, Y at g:i A') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
