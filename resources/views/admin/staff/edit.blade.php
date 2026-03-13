@extends('layouts.admin')

@section('title', 'Edit Staff')
@section('page_title', 'Edit Staff')
@section('page_description', 'Update staff profile and account')

@section('content')

    <div class="max-w-4xl mx-auto">

        <div class="mb-6">
            <a href="{{ route('admin.staff.index') }}"
                class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-indigo-600 transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back to Staff
            </a>
        </div>

        <form method="POST" action="{{ route('admin.staff.update', $staff) }}"
            class="bg-white border border-slate-200 rounded-[2rem] shadow-sm overflow-hidden">

            @csrf
            @method('PUT')

            <div class="p-8 lg:p-10 space-y-8">

                <div class="flex items-center gap-4 pb-6 border-b border-slate-100">
                    <div class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl">
                        <i data-lucide="user" class="w-6 h-6"></i>
                    </div>

                    <div>
                        <h3 class="text-lg font-black text-slate-900">Edit Staff Profile</h3>
                        <p class="text-xs text-slate-500 font-medium">
                            Update staff account and profile details
                        </p>
                    </div>
                </div>

                <div class="space-y-6">

                    {{-- ROW 1: NAME | EMAIL --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="space-y-2">
                            <label class="block text-xs font-bold uppercase tracking-widest text-slate-500 ml-1">
                                Name
                            </label>

                            <input type="text" name="name" value="{{ old('name', $staff->user->name ?? '') }}"
                                class="w-full rounded-2xl border-slate-200 bg-white px-4 py-3 text-sm font-bold text-slate-700 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all @error('name') border-rose-500 @enderror">

                            @error('name')
                                <p class="mt-2 text-[11px] font-bold text-rose-500 flex items-center gap-1">
                                    <i data-lucide="alert-circle" class="w-3 h-3"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-xs font-bold uppercase tracking-widest text-slate-500 ml-1">
                                Email
                            </label>

                            <input type="email" name="email" value="{{ old('email', $staff->user->email ?? '') }}"
                                class="w-full rounded-2xl border-slate-200 bg-white px-4 py-3 text-sm font-bold text-slate-700 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all @error('email') border-rose-500 @enderror">

                            @error('email')
                                <p class="mt-2 text-[11px] font-bold text-rose-500 flex items-center gap-1">
                                    <i data-lucide="alert-circle" class="w-3 h-3"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>

                    {{-- ROW 2: PASSWORD | PHONE | ACTIVE --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        <div class="space-y-2">
                            <label class="block text-xs font-bold uppercase tracking-widest text-slate-500 ml-1">
                                Password
                                <span class="text-slate-400 normal-case">(Leave blank to keep current password)</span>
                            </label>

                            <input type="password" name="password"
                                class="w-full rounded-2xl border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-600 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all @error('password') border-rose-500 @enderror">

                            @error('password')
                                <p class="mt-2 text-[11px] font-bold text-rose-500 flex items-center gap-1">
                                    <i data-lucide="alert-circle" class="w-3 h-3"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-xs font-bold uppercase tracking-widest text-slate-500 ml-1">
                                Phone
                            </label>

                            <input type="text" name="phone" value="{{ old('phone', $staff->phone ?? '') }}"
                                class="w-full rounded-2xl border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-600 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all @error('phone') border-rose-500 @enderror">

                            @error('phone')
                                <p class="mt-2 text-[11px] font-bold text-rose-500 flex items-center gap-1">
                                    <i data-lucide="alert-circle" class="w-3 h-3"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-xs font-bold uppercase tracking-widest text-slate-500 ml-1">
                                Status
                            </label>

                            <div class="relative">
                                <select name="is_active"
                                    class="w-full appearance-none rounded-2xl border-slate-200 bg-white px-4 py-3 text-sm font-bold text-slate-700 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all @error('is_active') border-rose-500 @enderror">

                                    <option value="1" @selected(old('is_active', $staff->is_active ?? 1) == 1)>
                                        Active
                                    </option>

                                    <option value="0" @selected(old('is_active', $staff->is_active ?? 1) == 0)>
                                        Inactive
                                    </option>

                                </select>
                            </div>

                            @error('is_active')
                                <p class="mt-2 text-[11px] font-bold text-rose-500 flex items-center gap-1">
                                    <i data-lucide="alert-circle" class="w-3 h-3"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>

                    {{-- ROW 3: BIO --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-slate-500 ml-1">
                            Bio
                        </label>

                        <textarea name="bio" rows="4"
                            class="w-full rounded-2xl border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-600 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all @error('bio') border-rose-500 @enderror">{{ old('bio', $staff->bio ?? '') }}</textarea>

                        @error('bio')
                            <p class="mt-2 text-[11px] font-bold text-rose-500 flex items-center gap-1">
                                <i data-lucide="alert-circle" class="w-3 h-3"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>

            </div>

            <div class="bg-slate-50 border-t border-slate-100 px-8 py-6 flex items-center justify-end gap-3">
                <a href="{{ route('admin.staff.index') }}"
                    class="px-6 py-3 rounded-xl text-sm font-bold text-slate-500 hover:bg-slate-200 transition-all">
                    Cancel
                </a>

                <button type="submit"
                    class="px-8 py-3 rounded-xl bg-indigo-600 text-white text-sm font-bold hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all">
                    Save Staff
                </button>
            </div>

        </form>

    </div>

@endsection