@extends('layouts.admin')

@section('title', 'Business Hours')
@section('page_title', 'Business Hours')
@section('page_description', 'Define when your services are available for booking')

@section('content')
    <div class="max-w-4xl mx-auto">
        <form method="POST" action="{{ route('admin.business-hours.update') }}"
            class="bg-white rounded-[1.75rem] sm:rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden">
            @csrf

            <div class="p-5 sm:p-8">
                <div class="flex items-start sm:items-center gap-4 mb-6 sm:mb-8">
                    <div class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl shrink-0">
                        <i data-lucide="clock-4" class="w-6 h-6"></i>
                    </div>
                    <div class="min-w-0">
                        <h3 class="text-base sm:text-lg font-black text-slate-900">Operation Schedule</h3>
                        <p class="text-xs text-slate-500 font-medium">Set your weekly opening and closing times</p>
                    </div>
                </div>

                <div class="space-y-3 sm:space-y-2">
                    <div
                        class="hidden md:grid grid-cols-12 gap-4 px-6 py-3 text-[10px] font-bold uppercase tracking-widest text-slate-400">
                        <div class="col-span-3">Day of Week</div>
                        <div class="col-span-3">Opening Time</div>
                        <div class="col-span-3">Closing Time</div>
                        <div class="col-span-3 text-center">Mark as Closed</div>
                    </div>

                    @foreach ($hours as $hour)
                        <div
                            class="grid grid-cols-1 md:grid-cols-12 items-start md:items-center gap-4 p-4 md:px-6 md:py-4 rounded-2xl border border-slate-100 hover:bg-slate-50 transition-colors group">

                            {{-- Day --}}
                            <div class="col-span-3">
                                <span class="text-sm font-black text-slate-900 capitalize flex items-center gap-2">
                                    <span
                                        class="h-1.5 w-1.5 rounded-full bg-slate-200 group-hover:bg-indigo-500 transition-colors"></span>
                                    {{ $hour->day }}
                                </span>
                            </div>

                            {{-- Mobile labels --}}
                            <div class="md:hidden grid grid-cols-1 sm:grid-cols-2 gap-4 w-full">
                                <div>
                                    <label
                                        class="mb-2 block text-[10px] font-bold uppercase tracking-widest text-slate-400">
                                        Opening Time
                                    </label>
                                    <input type="time" name="hours[{{ $hour->id }}][open_time]"
                                        value="{{ \Carbon\Carbon::parse($hour->open_time)->format('H:i') }}"
                                        class="w-full rounded-xl border-slate-200 bg-white px-3 py-2.5 text-sm font-semibold text-slate-700 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all disabled:opacity-40 disabled:bg-slate-50"
                                        {{ $hour->is_closed ? 'disabled' : '' }}>
                                </div>

                                <div>
                                    <label
                                        class="mb-2 block text-[10px] font-bold uppercase tracking-widest text-slate-400">
                                        Closing Time
                                    </label>
                                    <input type="time" name="hours[{{ $hour->id }}][close_time]"
                                        value="{{ \Carbon\Carbon::parse($hour->close_time)->format('H:i') }}"
                                        class="w-full rounded-xl border-slate-200 bg-white px-3 py-2.5 text-sm font-semibold text-slate-700 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all disabled:opacity-40 disabled:bg-slate-50"
                                        {{ $hour->is_closed ? 'disabled' : '' }}>
                                </div>
                            </div>

                            {{-- Desktop open time --}}
                            <div class="hidden md:block col-span-3">
                                <input type="time" name="hours[{{ $hour->id }}][open_time]"
                                    value="{{ \Carbon\Carbon::parse($hour->open_time)->format('H:i') }}"
                                    class="w-full rounded-xl border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all disabled:opacity-40 disabled:bg-slate-50"
                                    {{ $hour->is_closed ? 'disabled' : '' }}>
                            </div>

                            {{-- Desktop close time --}}
                            <div class="hidden md:block col-span-3">
                                <input type="time" name="hours[{{ $hour->id }}][close_time]"
                                    value="{{ \Carbon\Carbon::parse($hour->close_time)->format('H:i') }}"
                                    class="w-full rounded-xl border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all disabled:opacity-40 disabled:bg-slate-50"
                                    {{ $hour->is_closed ? 'disabled' : '' }}>
                            </div>

                            {{-- Toggle --}}
                            <div class="col-span-3 flex md:justify-center">
                                <label
                                    class="relative inline-flex items-center justify-between md:justify-center gap-3 cursor-pointer w-full md:w-auto">
                                    <span class="md:hidden text-xs font-bold uppercase tracking-widest text-slate-400">
                                        Mark as Closed
                                    </span>

                                    <input type="checkbox" name="hours[{{ $hour->id }}][is_closed]"
                                        class="sr-only peer" {{ $hour->is_closed ? 'checked' : '' }}
                                        onchange="this.closest('.grid').querySelectorAll('input[type=time]').forEach(el => el.disabled = this.checked)">

                                    <div
                                        class="relative w-11 h-6 bg-slate-200 rounded-full transition-colors peer-checked:bg-rose-500 peer-focus:ring-4 peer-focus:ring-rose-500/10 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-slate-300 after:bg-white after:transition-all peer-checked:after:translate-x-5 peer-checked:after:border-white">
                                    </div>
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div
                class="bg-slate-50 border-t border-slate-100 px-5 sm:px-8 py-5 sm:py-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <p class="text-xs text-slate-400 flex items-start sm:items-center gap-2">
                    <i data-lucide="info" class="w-4 h-4 shrink-0 mt-0.5 sm:mt-0"></i>
                    <span>Changes affect all future available slots.</span>
                </p>

                <button type="submit"
                    class="inline-flex w-full sm:w-auto items-center justify-center gap-2 rounded-xl bg-slate-900 px-6 sm:px-8 py-3 text-sm font-bold text-white hover:bg-slate-800 transition-all shadow-lg shadow-slate-200">
                    <i data-lucide="save" class="w-4 h-4 text-slate-400"></i>
                    Save Schedule
                </button>
            </div>
        </form>
    </div>
@endsection
