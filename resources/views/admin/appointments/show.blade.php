@extends('layouts.admin')

@section('title', 'Appointment Details')
@section('page_title', 'Appointment View')
@section('page_description', 'Detailed breakdown of the booking and customer requirements')

@section('content')
    <div class="max-w-5xl space-y-4 sm:space-y-6">

        <div
            class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white border border-slate-200 p-4 sm:p-5 rounded-[1.75rem] sm:rounded-3xl shadow-sm">
            <div class="flex items-center gap-3 min-w-0">
                <a href="{{ route('admin.appointments.index') }}"
                    class="shrink-0 p-2 hover:bg-slate-50 rounded-xl text-slate-400 hover:text-slate-600 transition-colors">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i>
                </a>

                <div class="h-8 w-px bg-slate-100 shrink-0"></div>

                <div class="min-w-0">
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Reference</div>
                    <div class="text-sm sm:text-base font-bold text-slate-700 truncate">
                        {{ $appointment->booking_reference ?? 'N/A' }}
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center gap-3">
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
                    class="inline-flex items-center justify-center gap-2 rounded-xl border px-4 py-2 text-[11px] sm:text-xs font-black uppercase tracking-wider {{ $statusClasses }}">
                    <span class="h-2 w-2 rounded-full bg-current"></span>
                    {{ $appointment->status }}
                </span>

                <a href="{{ route('admin.appointments.edit', $appointment) }}"
                    class="inline-flex items-center justify-center gap-2 bg-slate-900 text-white px-4 py-2.5 rounded-xl text-sm sm:text-xs font-bold hover:bg-slate-800 transition-all shadow-sm">
                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                    Edit
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">

            <div class="lg:col-span-2 space-y-4 sm:space-y-6">

                <div class="bg-white border border-slate-200 rounded-[1.75rem] sm:rounded-3xl p-5 sm:p-8 shadow-sm">
                    <div class="flex items-start justify-between gap-4">
                        <div class="min-w-0">
                            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-indigo-600">Selected
                                Service</span>
                            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1 leading-tight">
                                {{ $appointment->service->name ?? 'Service Details' }}
                            </h2>
                        </div>

                        <div class="p-3 sm:p-4 bg-indigo-50 rounded-2xl text-indigo-600 shrink-0">
                            <i data-lucide="briefcase" class="w-6 h-6 sm:w-8 sm:h-8"></i>
                        </div>
                    </div>

                    <hr class="my-6 sm:my-8 border-slate-100">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 sm:gap-8">
                        <div class="flex items-start gap-4">
                            <div class="mt-1 bg-slate-50 p-2 rounded-lg text-slate-400 shrink-0">
                                <i data-lucide="calendar" class="w-5 h-5"></i>
                            </div>
                            <div class="min-w-0">
                                <div class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Date</div>
                                <div class="text-base sm:text-lg font-bold text-slate-900">
                                    {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') }}
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="mt-1 bg-slate-50 p-2 rounded-lg text-slate-400 shrink-0">
                                <i data-lucide="clock" class="w-5 h-5"></i>
                            </div>
                            <div class="min-w-0">
                                <div class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Time</div>
                                <div class="text-base sm:text-lg font-bold text-slate-900">
                                    {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="mt-1 bg-slate-50 p-2 rounded-lg text-slate-400 shrink-0">
                                <i data-lucide="user-check" class="w-5 h-5"></i>
                            </div>
                            <div class="min-w-0">
                                <div class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Assigned Staff
                                </div>
                                <div class="text-base sm:text-lg font-bold text-slate-900">
                                    {{ $appointment->staff?->user?->name ?? 'Pending Assignment' }}
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="mt-1 bg-slate-50 p-2 rounded-lg text-slate-400 shrink-0">
                                <i data-lucide="wallet" class="w-5 h-5"></i>
                            </div>
                            <div class="min-w-0">
                                <div class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Price</div>
                                <div class="text-base sm:text-lg font-bold text-slate-900">
                                    ${{ number_format($appointment->service->price ?? 0, 2) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-[1.75rem] sm:rounded-3xl p-5 sm:p-8 shadow-sm">
                    <div class="flex items-center gap-2 mb-4">
                        <i data-lucide="sticky-note" class="w-5 h-5 text-slate-400"></i>
                        <h3 class="font-bold text-slate-900">Appointment Notes</h3>
                    </div>

                    <div
                        class="rounded-2xl bg-slate-50 p-4 sm:p-6 text-slate-600 text-sm leading-relaxed border border-slate-100 italic break-words">
                        {{ $appointment->notes ?: 'No specific instructions or notes provided by the customer.' }}
                    </div>
                </div>
            </div>

            <div class="space-y-4 sm:space-y-6">
                <div class="bg-white border border-slate-200 rounded-[1.75rem] sm:rounded-3xl p-5 sm:p-6 shadow-sm">
                    <h3 class="text-[10px] sm:text-xs font-bold uppercase tracking-widest text-slate-400 mb-5 sm:mb-6">
                        Customer Profile
                    </h3>

                    <div class="flex flex-col items-center text-center">
                        <div
                            class="h-16 w-16 sm:h-20 sm:w-20 rounded-full bg-gradient-to-tr from-slate-200 to-slate-100 flex items-center justify-center text-xl sm:text-2xl font-black text-slate-400 border-4 border-white shadow-md mb-4">
                            {{ strtoupper(substr($appointment->customer->name ?? '?', 0, 1)) }}
                        </div>
                        <h4 class="text-lg sm:text-xl font-bold text-slate-900">
                            {{ $appointment->customer->name ?? 'Guest' }}
                        </h4>
                        <p class="text-sm text-slate-500 mt-1 break-all">
                            {{ $appointment->customer->email ?? 'No email provided' }}
                        </p>
                    </div>

                    <div class="mt-6 sm:mt-8 space-y-3 sm:space-y-4">
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

                <div class="px-2 sm:p-6 text-center">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] leading-relaxed">
                        Created on {{ \Carbon\Carbon::parse($appointment->created_at)->format('M d, Y \a\t g:i A') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection