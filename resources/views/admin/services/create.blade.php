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
            class="bg-white border border-slate-200 rounded-[2.5rem] shadow-sm overflow-hidden transition-all">
            @csrf

            <div class="p-8 lg:p-12 space-y-10">
                <div class="flex items-center gap-5">
                    <div class="p-4 bg-emerald-50 text-emerald-600 rounded-3xl">
                        <i data-lucide="plus-circle" class="w-8 h-8"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-slate-900 leading-none">Service Creation</h3>
                        <p class="mt-2 text-sm text-slate-500 font-medium tracking-tight">Enter the details for your new
                            booking category.</p>
                    </div>
                </div>

                @include('admin.services.partials.form', [
                    'service' => null,
                ])
            </div>

            <div class="bg-slate-50 border-t border-slate-100 px-8 py-6 flex items-center justify-end gap-4">
                <a href="{{ route('admin.services.index') }}"
                    class="px-6 py-3 rounded-xl text-sm font-bold text-slate-500 hover:bg-slate-200 transition-all">
                    Discard
                </a>
                <button type="submit"
                    class="px-10 py-3 rounded-2xl bg-slate-900 text-white text-sm font-black hover:bg-slate-800 shadow-xl shadow-slate-200 transition-all flex items-center gap-2">
                    Create Service
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </button>
            </div>
        </form>
    </div>
@endsection
