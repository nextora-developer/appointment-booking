@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page_title', 'Dashboard')
@section('page_description', 'Real-time overview of your booking activities')

@section('content')
    <div class="grid grid-cols-2 xl:grid-cols-4 gap-4 sm:gap-6">
        @php
            $stats = [
                [
                    'label' => 'Services',
                    'value' => $totalServices,
                    'icon' => 'package',
                    'color' => 'text-blue-600',
                    'bg' => 'bg-blue-50',
                ],
                [
                    'label' => 'Staff',
                    'value' => $totalStaff,
                    'icon' => 'users',
                    'color' => 'text-indigo-600',
                    'bg' => 'bg-indigo-50',
                ],
                [
                    'label' => 'Customers',
                    'value' => $totalCustomers,
                    'icon' => 'user-check',
                    'color' => 'text-emerald-600',
                    'bg' => 'bg-emerald-50',
                ],
                [
                    'label' => 'Appointments',
                    'value' => $totalAppointments,
                    'icon' => 'calendar-check',
                    'color' => 'text-violet-600',
                    'bg' => 'bg-violet-50',
                ],
            ];
        @endphp

        @foreach ($stats as $stat)
            <div
                class="group relative overflow-hidden rounded-[1.75rem] bg-white border border-slate-200 p-5 sm:p-6 shadow-sm hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between gap-4">
                    <div class="min-w-0">
                        <p class="text-[10px] sm:text-xs font-bold uppercase tracking-widest text-slate-400">
                            {{ $stat['label'] }}
                        </p>
                        <h3 class="mt-2 text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                            {{ $stat['value'] }}
                        </h3>
                    </div>
                    <div
                        class="shrink-0 p-3 {{ $stat['bg'] }} {{ $stat['color'] }} rounded-2xl group-hover:scale-110 transition-transform">
                        <i data-lucide="{{ $stat['icon'] }}" class="w-5 h-5 sm:w-6 sm:h-6"></i>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 h-1 w-full bg-slate-50">
                    <div class="h-full bg-indigo-500/10 w-1/3"></div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8 sm:mt-10">
        <div class="mb-5 sm:mb-6 flex items-start sm:items-center justify-between gap-3">
            <h2 class="text-lg sm:text-xl font-bold text-slate-900 flex items-center gap-2">
                <i data-lucide="clock-3" class="w-5 h-5 text-indigo-500"></i>
                Recent Appointments
            </h2>

            <a href="{{ route('admin.appointments.index') }}"
                class="group inline-flex items-center gap-2 text-xs sm:text-sm font-bold text-indigo-600 hover:text-indigo-700 transition-colors shrink-0">
                View all
                <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        {{-- Desktop Table --}}
        <div class="hidden lg:block rounded-3xl bg-white border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">
                                Service & Customer
                            </th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">
                                Schedule
                            </th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">
                                Status
                            </th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400 text-right">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($recentAppointments as $appointment)
                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="h-10 w-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-500">
                                            <i data-lucide="briefcase" class="w-5 h-5"></i>
                                        </div>
                                        <div>
                                            <div class="font-bold text-slate-900 leading-none mb-1">
                                                {{ $appointment->service->name ?? 'Service Removed' }}
                                            </div>
                                            <div class="text-xs text-slate-500 flex items-center gap-1">
                                                <i data-lucide="user" class="w-3 h-3"></i>
                                                {{ $appointment->customer->name ?? 'Guest' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="text-sm font-medium text-slate-700">
                                        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}
                                    </div>
                                    <div class="text-xs text-slate-400 mt-0.5">
                                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    @php
                                        $statusClasses = match ($appointment->status) {
                                            'confirmed' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                            'pending' => 'bg-amber-50 text-amber-700 border-amber-100',
                                            'cancelled' => 'bg-rose-50 text-rose-700 border-rose-100',
                                            default => 'bg-slate-50 text-slate-700 border-slate-100',
                                        };
                                    @endphp
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-lg border px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider {{ $statusClasses }}">
                                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                        {{ $appointment->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <a href="{{ route('admin.appointments.show', $appointment) }}"
                                        class="inline-flex items-center justify-center p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all">
                                        <i data-lucide="eye" class="w-5 h-5"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="p-4 bg-slate-50 rounded-full mb-3 text-slate-300">
                                            <i data-lucide="calendar-x" class="w-8 h-8"></i>
                                        </div>
                                        <p class="text-slate-500 font-medium">No appointments scheduled for today.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Mobile / Tablet Cards --}}
        <div class="lg:hidden space-y-4">
            @forelse($recentAppointments as $appointment)
                @php
                    $statusClasses = match ($appointment->status) {
                        'confirmed' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                        'pending' => 'bg-amber-50 text-amber-700 border-amber-100',
                        'cancelled' => 'bg-rose-50 text-rose-700 border-rose-100',
                        default => 'bg-slate-50 text-slate-700 border-slate-100',
                    };
                @endphp

                <div class="rounded-[1.5rem] bg-white border border-slate-200 shadow-sm p-4 sm:p-5">
                    <div class="flex items-start gap-3">
                        <div
                            class="h-11 w-11 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-500 shrink-0">
                            <i data-lucide="briefcase" class="w-5 h-5"></i>
                        </div>

                        <div class="min-w-0 flex-1">
                            <div class="flex items-start justify-between gap-3">
                                <div class="min-w-0">
                                    <h3 class="text-sm sm:text-base font-bold text-slate-900 leading-tight truncate">
                                        {{ $appointment->service->name ?? 'Service Removed' }}
                                    </h3>
                                    <p class="mt-1 text-xs sm:text-sm text-slate-500 flex items-center gap-1 truncate">
                                        <i data-lucide="user" class="w-3.5 h-3.5 shrink-0"></i>
                                        {{ $appointment->customer->name ?? 'Guest' }}
                                    </p>
                                </div>

                                <span
                                    class="inline-flex items-center gap-1.5 rounded-lg border px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider whitespace-nowrap {{ $statusClasses }}">
                                    <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                    {{ $appointment->status }}
                                </span>
                            </div>

                            <div class="mt-4 grid grid-cols-2 gap-3">
                                <div class="rounded-xl bg-slate-50 px-3 py-2">
                                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Date</p>
                                    <p class="mt-1 text-sm font-semibold text-slate-700">
                                        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}
                                    </p>
                                </div>

                                <div class="rounded-xl bg-slate-50 px-3 py-2">
                                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Time</p>
                                    <p class="mt-1 text-sm font-semibold text-slate-700">
                                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-4 flex justify-end">
                                <a href="{{ route('admin.appointments.show', $appointment) }}"
                                    class="inline-flex items-center gap-2 rounded-xl bg-indigo-50 px-4 py-2 text-sm font-bold text-indigo-600 hover:bg-indigo-100 transition-colors">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="rounded-[1.5rem] bg-white border border-slate-200 shadow-sm px-6 py-10 text-center">
                    <div class="flex flex-col items-center">
                        <div class="p-4 bg-slate-50 rounded-full mb-3 text-slate-300">
                            <i data-lucide="calendar-x" class="w-8 h-8"></i>
                        </div>
                        <p class="text-slate-500 font-medium">No appointments scheduled for today.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
