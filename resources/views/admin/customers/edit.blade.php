@extends('layouts.admin')

@section('title', 'Edit Customer')
@section('page_title', 'Edit Customer')
@section('page_description', 'Update customer account information')

@section('content')

    <div class="max-w-3xl mx-auto">

        <div class="mb-1 sm:mb-2">
            <a href="{{ route('admin.customers.index') }}"
                class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-indigo-600 transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back to Customer
            </a>
        </div>

        <form method="POST" action="{{ route('admin.customers.update', $customer) }}"
            class="bg-white border border-slate-200 rounded-[2rem] shadow-sm overflow-hidden">

            @csrf
            @method('PUT')

            <div class="p-8 lg:p-10 space-y-8">

                <div class="flex items-center gap-4 pb-6 border-b border-slate-100">

                    <div class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl">
                        <i data-lucide="user-cog" class="w-6 h-6"></i>
                    </div>

                    <div>
                        <h3 class="text-lg font-black text-slate-900">
                            Edit Customer
                        </h3>

                        <p class="text-xs text-slate-500 font-medium">
                            Customer ID: {{ $customer->id }}
                        </p>
                    </div>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- NAME --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-slate-500 ml-1">
                            Name
                        </label>

                        <input type="text" name="name" value="{{ old('name', $customer->name) }}"
                            class="w-full rounded-2xl border-slate-200 bg-white px-4 py-3 text-sm font-bold text-slate-700
            focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all
            @error('name') border-rose-500 @enderror">

                        @error('name')
                            <p class="mt-2 text-[11px] font-bold text-rose-500 flex items-center gap-1">
                                <i data-lucide="alert-circle" class="w-3 h-3"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- EMAIL --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-slate-500 ml-1">
                            Email
                        </label>

                        <input type="email" name="email" value="{{ old('email', $customer->email) }}"
                            class="w-full rounded-2xl border-slate-200 bg-white px-4 py-3 text-sm font-bold text-slate-700
            focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all
            @error('email') border-rose-500 @enderror">

                        @error('email')
                            <p class="mt-2 text-[11px] font-bold text-rose-500 flex items-center gap-1">
                                <i data-lucide="alert-circle" class="w-3 h-3"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- PHONE --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-slate-500 ml-1">
                            Phone
                        </label>

                        <input type="text" name="phone" value="{{ old('phone', $customer->phone) }}"
                            placeholder="e.g. 0123456789"
                            class="w-full rounded-2xl border-slate-200 bg-white px-4 py-3 text-sm font-bold text-slate-700
                                focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all
                                @error('phone') border-rose-500 @enderror">

                        @error('phone')
                            <p class="mt-2 text-[11px] font-bold text-rose-500 flex items-center gap-1">
                                <i data-lucide="alert-circle" class="w-3 h-3"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- PASSWORD --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-slate-500 ml-1">
                            Password
                            <span class="text-slate-400 normal-case">(optional)</span>
                        </label>

                        <input type="password" name="password" placeholder="Leave blank to keep current password"
                            class="w-full rounded-2xl border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-600
                                focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all
                                @error('password') border-rose-500 @enderror">

                        @error('password')
                            <p class="mt-2 text-[11px] font-bold text-rose-500 flex items-center gap-1">
                                <i data-lucide="alert-circle" class="w-3 h-3"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>

            </div>

            <div class="bg-slate-50 border-t border-slate-100 px-8 py-6 flex items-center justify-end gap-3">

                <a href="{{ route('admin.customers.index', $customer) }}"
                    class="px-6 py-3 rounded-xl text-sm font-bold text-slate-500 hover:bg-slate-200 transition-all">
                    Cancel
                </a>

                <button type="submit"
                    class="px-8 py-3 rounded-xl bg-indigo-600 text-white text-sm font-bold hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all">
                    Save Changes
                </button>

            </div>

        </form>

    </div>

@endsection
