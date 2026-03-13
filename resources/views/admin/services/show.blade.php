@extends('layouts.admin')

@section('title', 'Service Details')
@section('page_title', 'Service Details')
@section('page_description', 'In-depth configuration and availability for this service')

@section('content')
    <div class="max-w-4xl space-y-6">
        <div class="flex items-center justify-between bg-white border border-slate-200 p-4 rounded-3xl shadow-sm">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.services.index') }}"
                    class="p-2 hover:bg-slate-50 rounded-xl text-slate-400 hover:text-slate-600 transition-colors">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i>
                </a>
                <div class="h-6 w-px bg-slate-100 mx-1"></div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Service Overview</span>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.services.edit', $service) }}"
                    class="inline-flex items-center gap-2 bg-slate-900 text-white px-5 py-2.5 rounded-xl text-xs font-bold hover:bg-slate-800 transition-all shadow-md shadow-slate-200">
                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                    Edit Service
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white border border-slate-200 rounded-[2rem] p-8 shadow-sm relative overflow-hidden">
                    <i data-lucide="scissors"
                        class="absolute -right-8 -top-8 w-48 h-48 text-slate-50 -rotate-12 pointer-events-none"></i>

                    <div class="relative z-10">
                        <div class="flex items-center gap-2 mb-2">
                            @if ($service->is_active)
                                <span class="flex h-2 w-2 rounded-full bg-emerald-500"></span>
                                <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-tighter">Live &
                                    Booking</span>
                            @else
                                <span class="flex h-2 w-2 rounded-full bg-slate-300"></span>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Currently
                                    Disabled</span>
                            @endif
                        </div>

                        <h2 class="text-4xl font-black text-slate-900 tracking-tight">{{ $service->name }}</h2>

                        <div class="mt-10 grid grid-cols-2 gap-8 border-t border-slate-50 pt-8">
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Standard Rate
                                </p>
                                <p class="text-3xl font-black text-slate-900">
                                    <span
                                        class="text-lg font-medium text-slate-400">RM</span>{{ number_format($service->price, 2) }}
                                </p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Total
                                    Duration</p>
                                <div class="flex items-baseline gap-1">
                                    <p class="text-3xl font-black text-slate-900">{{ $service->duration }}</p>
                                    <span class="text-sm font-bold text-slate-400">Minutes</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-[2rem] p-8 shadow-sm">
                    <h3 class="flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-slate-400 mb-4">
                        <i data-lucide="align-left" class="w-4 h-4"></i>
                        Service Description
                    </h3>
                    <div
                        class="text-slate-600 leading-relaxed text-sm bg-slate-50/50 p-6 rounded-2xl border border-slate-50">
                        {{ $service->description ?: 'No detailed description provided for this service yet.' }}
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-slate-900 rounded-[2rem] p-8 text-white shadow-xl shadow-slate-200">
                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em] mb-6">Booking Insight</h4>

                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="h-10 w-10 rounded-xl bg-white/10 flex items-center justify-center text-indigo-400">
                                <i data-lucide="calendar-check" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-500 uppercase">Usage Status</p>
                                <p class="text-sm font-bold text-white">Currently Public</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="h-10 w-10 rounded-xl bg-white/10 flex items-center justify-center text-indigo-400">
                                <i data-lucide="users" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-500 uppercase">Assigned Staff</p>
                                <p class="text-sm font-bold text-white">All Staff Members</p>
                            </div>
                        </div>
                    </div>

                    <hr class="my-8 border-white/10">

                    <div class="bg-white/5 rounded-2xl p-4 border border-white/5">
                        <p class="text-[10px] leading-relaxed text-slate-400 font-medium italic">
                            "Visible services are available for customer selection in the frontend booking portal
                            immediately."
                        </p>
                    </div>
                </div>

                <div class="px-4 py-2 text-center">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                        Last Updated {{ $service->updated_at->format('M d, Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
