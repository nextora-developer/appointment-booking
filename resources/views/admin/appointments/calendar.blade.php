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
        <div class="flex items-center gap-2">
            <h3 class="text-lg font-bold text-slate-900">
                {{ $start->format('M Y') }}
            </h3>
            <span class="px-2 py-1 bg-indigo-50 text-indigo-700 text-[10px] font-bold uppercase rounded-md tracking-wider">
                Weekly View
            </span>
        </div>
        
        <div class="flex items-center bg-white border border-slate-200 rounded-xl p-1 shadow-sm">
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

    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse table-fixed min-w-[800px]">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="w-24 p-4 border-b border-slate-100"></th>
                        @foreach ($days as $day)
                            @php $isToday = $day->isToday(); @endphp
                            <th class="p-4 border-b border-slate-100 {{ $isToday ? 'bg-indigo-50/30' : '' }}">
                                <div class="text-[10px] uppercase tracking-widest font-bold {{ $isToday ? 'text-indigo-600' : 'text-slate-400' }}">
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
                                <span class="text-xs font-bold text-slate-500 group-hover:text-indigo-600 transition-colors">
                                    {{ \Carbon\Carbon::createFromFormat('H:i', $slot)->format('g:i A') }}
                                </span>
                            </td>

                            @foreach ($days as $day)
                                @php
                                    $isToday = $day->isToday();
                                    $slotAppointments = $appointments
                                        ->where('appointment_date', $day->toDateString())
                                        ->filter(fn($item) => \Carbon\Carbon::parse($item->appointment_time)->format('H:i') === $slot);
                                @endphp

                                <td class="p-2 align-top h-24 border-r border-slate-50 relative {{ $isToday ? 'bg-indigo-50/10' : '' }} hover:bg-slate-50/80 transition-colors">
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

                                                    <div class="mt-1 flex items-center gap-1 text-[9px] font-bold text-indigo-600 opacity-0 group-hover/card:opacity-100 transition-opacity">
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
@endsection