@extends('layouts.admin')

@section('title', 'Staff Details')
@section('page_title', 'Staff Profile')
@section('page_description', 'Manage performance and personal information for your team')

@section('content')
    <div class="max-w-4xl space-y-6">
        <div class="flex items-center justify-between bg-white border border-slate-200 p-4 rounded-3xl shadow-sm">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.staff.index') }}"
                    class="p-2 hover:bg-slate-50 rounded-xl text-slate-400 hover:text-slate-600 transition-colors">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i>
                </a>
                <div class="h-6 w-px bg-slate-100 mx-1"></div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Team Member Profile</span>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.staff.edit', $staff) }}"
                    class="inline-flex items-center gap-2 bg-slate-900 text-white px-5 py-2.5 rounded-xl text-xs font-bold hover:bg-slate-800 transition-all shadow-md shadow-slate-200">
                    <i data-lucide="user-cog" class="w-4 h-4 text-slate-400"></i>
                    Edit Profile
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white border border-slate-200 rounded-[2.5rem] p-8 shadow-sm">
                    <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
                        <div class="relative">
                            <div
                                class="h-32 w-32 rounded-[2rem] bg-gradient-to-br from-indigo-500 to-purple-600 p-1 shadow-lg shadow-indigo-100">
                                <div
                                    class="h-full w-full rounded-[1.8rem] bg-white flex items-center justify-center overflow-hidden">
                                    <span class="text-4xl font-black text-indigo-500">
                                        {{ strtoupper(substr($staff->user->name ?? '?', 0, 1)) }}
                                    </span>
                                </div>
                            </div>
                            @if ($staff->is_active)
                                <span
                                    class="absolute -bottom-2 -right-2 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-500 border-4 border-white text-white shadow-sm"
                                    title="Active">
                                    <i data-lucide="check" class="w-4 h-4"></i>
                                </span>
                            @endif
                        </div>

                        <div class="flex-1 text-center md:text-left">
                            <div class="flex flex-col md:flex-row md:items-center gap-2 mb-2">
                                <h2 class="text-3xl font-black text-slate-900 tracking-tight">
                                    {{ $staff->user->name ?? 'N/A' }}
                                </h2>
                                <span
                                    class="inline-flex self-center md:self-auto rounded-lg bg-slate-100 px-2 py-1 text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                                    Team Member
                                </span>
                            </div>
                            <p class="text-slate-500 font-medium flex items-center justify-center md:justify-start gap-2">
                                <i data-lucide="mail" class="w-4 h-4 text-slate-300"></i>
                                {{ $staff->user->email ?? 'N/A' }}
                            </p>

                            <div class="mt-6 flex flex-wrap justify-center md:justify-start gap-3">
                                <div class="px-4 py-2 bg-slate-50 border border-slate-100 rounded-xl">
                                    <p
                                        class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none mb-1">
                                        Phone</p>
                                    <p class="text-sm font-bold text-slate-700">{{ $staff->phone ?: 'Not provided' }}</p>
                                </div>
                                <div class="px-4 py-2 bg-slate-50 border border-slate-100 rounded-xl">
                                    <p
                                        class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none mb-1">
                                        Joined</p>
                                    <p class="text-sm font-bold text-slate-700">{{ $staff->created_at->format('M Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-10 border-slate-50">

                    <div class="space-y-4">
                        <h3 class="flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-slate-400">
                            <i data-lucide="book-open" class="w-4 h-4"></i>
                            Professional Biography
                        </h3>
                        <div
                            class="text-slate-600 leading-relaxed text-sm bg-slate-50/50 p-6 rounded-2xl border border-slate-50 italic">
                            "{{ $staff->bio ?: 'This team member hasn\'t added a biography yet. A bio helps customers feel more comfortable when booking.' }}"
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div
                    class="bg-indigo-600 rounded-[2.5rem] p-8 text-white shadow-xl shadow-indigo-100 relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-white/10"></div>

                    <h4 class="text-xs font-bold text-indigo-200 uppercase tracking-[0.2em] mb-6">Staff Availability</h4>

                    <div class="space-y-6 relative z-10">
                        <div class="flex items-center gap-4">
                            <div class="h-10 w-10 rounded-xl bg-white/20 flex items-center justify-center">
                                <i data-lucide="calendar" class="w-5 h-5 text-white"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-indigo-200 uppercase">Work Schedule</p>
                                <p class="text-sm font-bold">Default Business Hours</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="h-10 w-10 rounded-xl bg-white/20 flex items-center justify-center">
                                <i data-lucide="check-circle" class="w-5 h-5 text-white"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-indigo-200 uppercase">Booking Status</p>
                                <p class="text-sm font-bold">Open for Appointments</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10">
                        <button
                            class="w-full py-3 bg-white text-indigo-600 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-indigo-50 transition-colors">
                            View Schedule
                        </button>
                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-[2rem] p-6 text-center shadow-sm">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                        System ID: #STF-{{ str_pad($staff->id, 4, '0', STR_PAD_LEFT) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
