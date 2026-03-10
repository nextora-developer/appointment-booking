@extends('layouts.admin')

@section('title', 'Service Details')
@section('page_title', 'Service Details')
@section('page_description', 'View service information')

@section('content')
    <div class="max-w-3xl rounded-3xl bg-white border border-slate-200 p-8 shadow-sm">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <div class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">Name</div>
                <div class="mt-2 text-lg font-black text-slate-900">{{ $service->name }}</div>
            </div>

            <div>
                <div class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">Price</div>
                <div class="mt-2 text-lg font-black text-slate-900">RM {{ number_format($service->price, 2) }}</div>
            </div>

            <div>
                <div class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">Duration</div>
                <div class="mt-2 text-lg font-black text-slate-900">{{ $service->duration }} mins</div>
            </div>

            <div>
                <div class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">Status</div>
                <div class="mt-2">
                    @if ($service->is_active)
                        <span
                            class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700">Active</span>
                    @else
                        <span
                            class="inline-flex rounded-full bg-slate-200 px-3 py-1 text-xs font-bold text-slate-600">Inactive</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-8">
            <div class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">Description</div>
            <div class="mt-2 text-sm leading-7 text-slate-600">
                {{ $service->description ?: 'No description available.' }}
            </div>
        </div>

        <div class="mt-8 flex gap-3">
            <a href="{{ route('admin.services.edit', $service) }}"
                class="inline-flex items-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-bold text-white hover:bg-slate-800">
                Edit
            </a>

            <a href="{{ route('admin.services.index') }}"
                class="inline-flex items-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-slate-700 hover:bg-slate-50">
                Back
            </a>
        </div>
    </div>
@endsection
