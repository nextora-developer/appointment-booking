@extends('layouts.admin')

@section('title', 'Business Hours')
@section('page_title', 'Business Hours')
@section('page_description', 'Define when your services are available for booking')

@section('content')
    <div class="max-w-4xl mx-auto">
        <form method="POST" action="{{ route('admin.business-hours.update') }}"
            class="bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden">
            @csrf

            <div class="p-8">
                <div class="flex items-center gap-4 mb-8">
                    <div class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl">
                        <i data-lucide="clock-4" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-black text-slate-900">Operation Schedule</h3>
                        <p class="text-xs text-slate-500 font-medium">Set your weekly opening and closing times</p>
                    </div>
                </div>

                <div class="space-y-2">
                    <div
                        class="hidden md:grid grid-cols-12 gap-4 px-6 py-3 text-[10px] font-bold uppercase tracking-widest text-slate-400">
                        <div class="col-span-3">Day of Week</div>
                        <div class="col-span-3">Opening Time</div>
                        <div class="col-span-3">Closing Time</div>
                        <div class="col-span-3 text-center">Mark as Closed</div>
                    </div>

                    @foreach ($hours as $hour)
                        <div
                            class="grid grid-cols-1 md:grid-cols-12 items-center gap-4 p-4 md:px-6 md:py-4 rounded-2xl border border-slate-100 hover:bg-slate-50 transition-colors group">

                            <div class="col-span-3">
                                <span class="text-sm font-black text-slate-900 capitalize flex items-center gap-2">
                                    <span
                                        class="h-1.5 w-1.5 rounded-full bg-slate-200 group-hover:bg-indigo-500 transition-colors"></span>
                                    {{ $hour->day }}
                                </span>
                            </div>

                            <div class="col-span-3">
                                <input type="time" name="hours[{{ $hour->id }}][open_time]"
                                    value="{{ \Carbon\Carbon::parse($hour->open_time)->format('H:i') }}"
                                    class="w-full rounded-xl border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all disabled:opacity-40 disabled:bg-slate-50"
                                    {{ $hour->is_closed ? 'disabled' : '' }}>
                            </div>

                            <div class="col-span-3">
                                <input type="time" name="hours[{{ $hour->id }}][close_time]"
                                    value="{{ \Carbon\Carbon::parse($hour->close_time)->format('H:i') }}"
                                    class="w-full rounded-xl border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all disabled:opacity-40 disabled:bg-slate-50"
                                    {{ $hour->is_closed ? 'disabled' : '' }}>
                            </div>

                            <div class="col-span-3 flex justify-center">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="hours[{{ $hour->id }}][is_closed]" class="sr-only peer"
                                        {{ $hour->is_closed ? 'checked' : '' }}
                                        onchange="this.closest('.grid').querySelectorAll('input[type=time]').forEach(el => el.disabled = this.checked)">
                                    <div
                                        class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-rose-500">
                                    </div>
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-slate-50 border-t border-slate-100 px-8 py-6 flex items-center justify-between">
                <p class="text-xs text-slate-400 flex items-center gap-2">
                    <i data-lucide="info" class="w-4 h-4"></i>
                    Changes affect all future available slots.
                </p>
                <button type="submit"
                    class="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-8 py-3 text-sm font-bold text-white hover:bg-slate-800 transition-all shadow-lg shadow-slate-200">
                    <i data-lucide="save" class="w-4 h-4 text-slate-400"></i>
                    Save Schedule
                </button>
            </div>
        </form>
    </div>
@endsection
