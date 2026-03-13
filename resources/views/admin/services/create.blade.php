@extends('layouts.admin')

@section('title', 'Add Service')
@section('page_title', 'New Service')
@section('page_description', 'Define a new offering, its pricing, and booking duration')

@section('content')

    <div class="max-w-3xl mx-auto">

        <div class="mb-6">
            <a href="{{ route('admin.services.index') }}"
                class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-indigo-600 transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back to Service List
            </a>
        </div>

        <form method="POST" action="{{ route('admin.services.store') }}"
            class="bg-white border border-slate-200 rounded-[2rem] shadow-sm overflow-hidden">

            @csrf

            <div class="p-8 lg:p-10 space-y-8">

                <div class="flex items-center gap-4 pb-6 border-b border-slate-100">

                    <div class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl">
                        <i data-lucide="plus-circle" class="w-6 h-6"></i>
                    </div>

                    <div>
                        <h3 class="text-lg font-black text-slate-900">Create Service</h3>
                        <p class="text-xs text-slate-500 font-medium">
                            Add a new service, pricing and duration
                        </p>
                    </div>

                </div>

                <div class="space-y-6">

                    <div class="space-y-2">

                        <label class="block text-xs font-bold uppercase tracking-widest text-slate-500 ml-1">
                            Service Name
                        </label>

                        <input type="text" name="name" placeholder="Enter service name" value="{{ old('name') }}"
                            class="w-full rounded-2xl border-slate-200 bg-white px-4 py-3 text-sm font-bold text-slate-700 placeholder:text-slate-400 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all @error('name') border-rose-500 @enderror">

                        @error('name')
                            <p class="mt-2 text-[11px] font-bold text-rose-500 flex items-center gap-1">
                                <i data-lucide="alert-circle" class="w-3 h-3"></i>
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <div class="space-y-2">

                        <label class="block text-xs font-bold uppercase tracking-widest text-slate-500 ml-1">
                            Description
                        </label>

                        <textarea name="description" rows="5" placeholder="Write a short description for this service..."
                            class="w-full rounded-2xl border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-600 placeholder:text-slate-400 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all @error('description') border-rose-500 @enderror">{{ old('description') }}</textarea>

                        @error('description')
                            <p class="mt-2 text-[11px] font-bold text-rose-500 flex items-center gap-1">
                                <i data-lucide="alert-circle" class="w-3 h-3"></i>
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        {{-- PRICE --}}
                        <div class="space-y-2">

                            <label class="block text-xs font-bold uppercase tracking-widest text-slate-500 ml-1">
                                Price (RM)
                            </label>

                            <input type="number" step="0.01" min="0" name="price" placeholder="e.g. 50.00"
                                value="{{ old('price') }}"
                                class="w-full rounded-2xl border-slate-200 bg-white px-4 py-3 text-sm font-bold text-slate-700 placeholder:text-slate-400 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all @error('price') border-rose-500 @enderror">

                            @error('price')
                                <p class="mt-2 text-[11px] font-bold text-rose-500 flex items-center gap-1">
                                    <i data-lucide="alert-circle" class="w-3 h-3"></i>
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- DURATION --}}
                        <div class="space-y-2">

                            <label class="block text-xs font-bold uppercase tracking-widest text-slate-500 ml-1">
                                Duration (minutes)
                            </label>

                            <input type="number" min="1" name="duration" placeholder="e.g. 30"
                                value="{{ old('duration', 30) }}"
                                class="w-full rounded-2xl border-slate-200 bg-white px-4 py-3 text-sm font-bold text-slate-700 placeholder:text-slate-400 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all @error('duration') border-rose-500 @enderror">

                            @error('duration')
                                <p class="mt-2 text-[11px] font-bold text-rose-500 flex items-center gap-1">
                                    <i data-lucide="alert-circle" class="w-3 h-3"></i>
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- STATUS --}}
                        <div class="space-y-2">

                            <label class="block text-xs font-bold uppercase tracking-widest text-slate-500 ml-1">
                                Status
                            </label>

                            <div class="relative">
                                <select name="is_active"
                                    class="w-full appearance-none rounded-2xl border-slate-200 bg-white px-4 py-3 pr-10 text-sm font-bold text-slate-700 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all @error('is_active') border-rose-500 @enderror">

                                    <option value="1" @selected(old('is_active', 1) == 1)>
                                        Active
                                    </option>

                                    <option value="0" @selected(old('is_active', 1) == 0)>
                                        Inactive
                                    </option>

                                </select>

                                <div
                                    class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400">
                                    <i data-lucide="chevron-down" class="w-4 h-4"></i>
                                </div>
                            </div>

                            @error('is_active')
                                <p class="mt-2 text-[11px] font-bold text-rose-500 flex items-center gap-1">
                                    <i data-lucide="alert-circle" class="w-3 h-3"></i>
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                </div>

            </div>

            <div class="bg-slate-50 border-t border-slate-100 px-8 py-6 flex items-center justify-end gap-3">

                <a href="{{ route('admin.services.index') }}"
                    class="px-6 py-3 rounded-xl text-sm font-bold text-slate-500 hover:bg-slate-200 transition-all">
                    Discard
                </a>

                <button type="submit"
                    class="px-8 py-3 rounded-xl bg-indigo-600 text-white text-sm font-bold hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all">
                    Create Service
                </button>

            </div>

        </form>

    </div>

@endsection
