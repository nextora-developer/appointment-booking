@extends('layouts.admin')

@section('title', 'Appointment Calendar')
@section('page_title', 'Calendar View')
@section('page_description', 'Weekly schedule and time slot availability')

@section('content')
    @php
        $days = [];
        for ($i = 0; $i < 7; $i++) {
            $days[] = $start->copy()->addDays($i);
        }

        $times = [];
        $time = \Carbon\Carbon::createFromTime(9, 0);
        for ($i = 0; $i < 18; $i++) {
            $times[] = $time->format('H:i');
            $time->addMinutes(30);
        }
    @endphp

    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex flex-wrap items-center gap-2">
            <h3 class="text-lg font-bold text-slate-900">
                {{ $start->format('M Y') }}
            </h3>
            <span class="px-2 py-1 bg-indigo-50 text-indigo-700 text-[10px] font-bold uppercase rounded-md tracking-wider">
                Weekly View
            </span>
        </div>

        <div
            class="flex items-center justify-between sm:justify-start bg-white border border-slate-200 rounded-xl p-1 shadow-sm w-full sm:w-auto">
            <a href="?start={{ $start->copy()->subWeek()->toDateString() }}"
                class="p-2 hover:bg-slate-50 rounded-lg text-slate-600 transition-colors">
                <i data-lucide="chevron-left" class="w-5 h-5"></i>
            </a>

            <a href="?start={{ now()->startOfWeek()->toDateString() }}"
                class="px-4 py-2 text-sm font-bold text-slate-700 hover:bg-slate-50 rounded-lg transition-colors border-x border-slate-100">
                Today
            </a>

            <a href="?start={{ $start->copy()->addWeek()->toDateString() }}"
                class="p-2 hover:bg-slate-50 rounded-lg text-slate-600 transition-colors">
                <i data-lucide="chevron-right" class="w-5 h-5"></i>
            </a>
        </div>
    </div>

    {{-- Desktop Calendar --}}
    <div class="hidden lg:block bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse table-fixed min-w-[800px]">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="w-24 p-4 border-b border-slate-100"></th>
                        @foreach ($days as $day)
                            @php $isToday = $day->isToday(); @endphp
                            <th class="p-4 border-b border-slate-100 {{ $isToday ? 'bg-indigo-50/30' : '' }}">
                                <div
                                    class="text-[10px] uppercase tracking-widest font-bold {{ $isToday ? 'text-indigo-600' : 'text-slate-400' }}">
                                    {{ $day->format('D') }}
                                </div>
                                <div class="mt-1 text-lg font-black {{ $isToday ? 'text-indigo-600' : 'text-slate-900' }}">
                                    {{ $day->format('d') }}
                                </div>
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($times as $slot)
                        <tr class="group">
                            <td class="p-4 text-center align-middle border-r border-slate-50 bg-slate-50/30">
                                <span
                                    class="text-xs font-bold text-slate-500 group-hover:text-indigo-600 transition-colors">
                                    {{ \Carbon\Carbon::createFromFormat('H:i', $slot)->format('g:i A') }}
                                </span>
                            </td>

                            @foreach ($days as $day)
                                @php
                                    $isToday = $day->isToday();
                                    $slotAppointments = $appointments
                                        ->where('appointment_date', $day->toDateString())
                                        ->filter(
                                            fn($item) => \Carbon\Carbon::parse($item->appointment_time)->format(
                                                'H:i',
                                            ) === $slot,
                                        );
                                @endphp

                                <td
                                    class="p-2 align-top h-24 border-r border-slate-50 relative {{ $isToday ? 'bg-indigo-50/10' : '' }} hover:bg-slate-50/80 transition-colors">
                                    @if ($slotAppointments->count())
                                        <div class="space-y-1.5 relative z-10">
                                            @foreach ($slotAppointments as $appointment)
                                                <a href="{{ route('admin.appointments.show', $appointment) }}"
                                                    class="block rounded-xl border border-indigo-100 bg-white p-2 shadow-sm hover:shadow-md hover:border-indigo-300 transition-all group/card">

                                                    <div class="flex items-center gap-1.5 mb-1">
                                                        <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span>
                                                        <div class="text-[10px] font-bold text-slate-900 truncate">
                                                            {{ $appointment->customer->name }}
                                                        </div>
                                                    </div>

                                                    <div class="text-[9px] font-medium text-slate-500 line-clamp-1">
                                                        {{ $appointment->service->name }}
                                                    </div>

                                                    <div
                                                        class="mt-1 flex items-center gap-1 text-[9px] font-bold text-indigo-600 opacity-0 group-hover/card:opacity-100 transition-opacity">
                                                        <i data-lucide="user" class="w-2.5 h-2.5"></i>
                                                        {{ $appointment->staff?->user?->name ?? 'Unassigned' }}
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Mobile Calendar --}}
    <div class="lg:hidden space-y-4">
        @foreach ($days as $day)
            @php
                $isToday = $day->isToday();
                $dayAppointments = $appointments
                    ->where('appointment_date', $day->toDateString())
                    ->sortBy('appointment_time');
            @endphp

            <div class="bg-white border border-slate-200 rounded-[1.5rem] shadow-sm overflow-hidden">
                <div class="px-4 py-4 border-b border-slate-100 {{ $isToday ? 'bg-indigo-50/50' : 'bg-slate-50/50' }}">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <div
                                class="text-[10px] uppercase tracking-widest font-bold {{ $isToday ? 'text-indigo-600' : 'text-slate-400' }}">
                                {{ $day->format('l') }}
                            </div>
                            <div class="mt-1 text-base font-black {{ $isToday ? 'text-indigo-600' : 'text-slate-900' }}">
                                {{ $day->format('d M Y') }}
                            </div>
                        </div>

                        @if ($isToday)
                            <span
                                class="inline-flex items-center rounded-full bg-indigo-600 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-white">
                                Today
                            </span>
                        @endif
                    </div>
                </div>

                <div class="p-4">
                    @if ($dayAppointments->count())
                        <div class="space-y-3">
                            @foreach ($dayAppointments as $appointment)
                                @php
                                    $statusClasses = match ($appointment->status) {
                                        'pending' => 'bg-amber-50 text-amber-700 border-amber-100',
                                        'confirmed' => 'bg-indigo-50 text-indigo-700 border-indigo-100',
                                        'completed' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                        'cancelled' => 'bg-rose-50 text-rose-700 border-rose-100',
                                        default => 'bg-slate-50 text-slate-700 border-slate-100',
                                    };
                                @endphp

                                <a href="{{ route('admin.appointments.show', $appointment) }}"
                                    class="block rounded-2xl border border-slate-200 bg-white p-4 shadow-sm hover:border-indigo-200 hover:shadow-md transition-all">
                                    <div class="flex items-start justify-between gap-3">
                                        <div class="min-w-0 flex-1">
                                            <div class="flex items-center gap-2 mb-1">
                                                <i data-lucide="clock-3" class="w-4 h-4 text-indigo-500 shrink-0"></i>
                                                <span class="text-sm font-bold text-slate-900">
                                                    {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}
                                                </span>
                                            </div>

                                            <div class="text-sm font-bold text-slate-900 truncate">
                                                {{ $appointment->customer->name ?? 'Guest Customer' }}
                                            </div>

                                            <div class="mt-1 text-xs text-slate-500 line-clamp-1">
                                                {{ $appointment->service->name ?? 'N/A' }}
                                            </div>

                                            <div class="mt-2 flex items-center gap-1 text-xs text-slate-500">
                                                <i data-lucide="user-circle" class="w-3.5 h-3.5 text-indigo-400"></i>
                                                {{ $appointment->staff?->user?->name ?? 'Unassigned' }}
                                            </div>
                                        </div>

                                        <span
                                            class="inline-flex items-center gap-1 rounded-lg border px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider whitespace-nowrap {{ $statusClasses }}">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="rounded-2xl border border-dashed border-slate-200 bg-slate-50/70 px-4 py-8 text-center">
                            <div
                                class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-white text-slate-300 shadow-sm">
                                <i data-lucide="calendar-x-2" class="w-6 h-6"></i>
                            </div>
                            <p class="text-sm font-semibold text-slate-500">No appointments</p>
                            <p class="mt-1 text-xs text-slate-400">This day has no scheduled bookings.</p>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
