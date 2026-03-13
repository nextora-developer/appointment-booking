@extends('layouts.admin')

@section('title', 'Manage Services')
@section('page_title', 'Services')
@section('page_description', 'Manage all services available for booking')

@section('content')

    <div class="mb-6 flex items-center justify-end">
        <a href="{{ route('admin.services.create') }}"
            class="inline-flex w-full sm:w-auto items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-bold text-white hover:bg-indigo-700 transition-all shadow-md shadow-indigo-200">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Add Service
        </a>
    </div>

    {{-- Desktop Table --}}
    <div class="hidden lg:block rounded-3xl bg-white border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">Service</th>
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">Price</th>
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">Duration</th>
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">Status</th>
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400 text-right">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse($services as $service)
                        <tr class="group hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="h-9 w-9 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-xs font-bold text-slate-600 shadow-sm">
                                        {{ strtoupper(substr($service->name, 0, 1)) }}
                                    </div>

                                    <div class="min-w-0">
                                        <div class="font-bold text-slate-900">
                                            {{ $service->name }}
                                        </div>

                                        <div class="text-[11px] text-slate-400 mt-0.5 line-clamp-1">
                                            {{ \Illuminate\Support\Str::limit($service->description, 60) }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <span class="font-semibold text-slate-700">
                                    RM {{ number_format($service->price, 2) }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <span class="text-slate-600 font-medium">
                                    {{ $service->duration }} mins
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                @if ($service->is_active)
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-lg border border-emerald-100 bg-emerald-50 px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider text-emerald-700">
                                        Active
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-slate-50 px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider text-slate-600">
                                        Inactive
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.services.show', $service) }}"
                                        class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all"
                                        title="View Service">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                    </a>

                                    <a href="{{ route('admin.services.edit', $service) }}"
                                        class="p-2 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-all"
                                        title="Edit Service">
                                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                                    </a>

                                    <form method="POST" action="{{ route('admin.services.destroy', $service) }}"
                                        onsubmit="return confirm('Delete this service?')">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all"
                                            title="Delete Service">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="max-w-xs mx-auto">
                                    <div
                                        class="mb-4 inline-flex h-16 w-16 items-center justify-center rounded-full bg-slate-50 text-slate-200">
                                        <i data-lucide="briefcase" class="w-8 h-8"></i>
                                    </div>

                                    <h3 class="text-sm font-bold text-slate-900">
                                        No services found
                                    </h3>

                                    <p class="mt-1 text-xs text-slate-500">
                                        Create your first service to start accepting bookings.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($services->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/30">
                {{ $services->links() }}
            </div>
        @endif
    </div>

    {{-- Mobile / Tablet Cards --}}
    <div class="lg:hidden space-y-4">
        @forelse($services as $service)
            <div class="rounded-[1.5rem] bg-white border border-slate-200 shadow-sm p-4 sm:p-5">
                <div class="flex items-start gap-3">
                    <div
                        class="h-11 w-11 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-sm font-bold text-slate-600 shadow-sm shrink-0">
                        {{ strtoupper(substr($service->name, 0, 1)) }}
                    </div>

                    <div class="min-w-0 flex-1">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <h3 class="text-sm sm:text-base font-bold text-slate-900 break-words">
                                    {{ $service->name }}
                                </h3>

                                <p class="mt-1 text-xs text-slate-500 leading-relaxed">
                                    {{ \Illuminate\Support\Str::limit($service->description, 100) }}
                                </p>
                            </div>

                            @if ($service->is_active)
                                <span
                                    class="inline-flex items-center gap-1 rounded-lg border border-emerald-100 bg-emerald-50 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-emerald-700 whitespace-nowrap">
                                    Active
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center gap-1 rounded-lg border border-slate-200 bg-slate-50 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-slate-600 whitespace-nowrap">
                                    Inactive
                                </span>
                            @endif
                        </div>

                        <div class="mt-4 grid grid-cols-2 gap-3">
                            <div class="rounded-xl bg-slate-50 px-3 py-3">
                                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Price</p>
                                <p class="mt-1 text-sm font-semibold text-slate-800">
                                    RM {{ number_format($service->price, 2) }}
                                </p>
                            </div>

                            <div class="rounded-xl bg-slate-50 px-3 py-3">
                                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Duration</p>
                                <p class="mt-1 text-sm font-semibold text-slate-700">
                                    {{ $service->duration }} mins
                                </p>
                            </div>
                        </div>

                        <div class="mt-4 grid grid-cols-3 gap-2 sm:gap-3">
                            <a href="{{ route('admin.services.show', $service) }}"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-50 px-3 py-2.5 text-sm font-bold text-indigo-600 hover:bg-indigo-100 transition-colors">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                                <span class="hidden sm:inline">View</span>
                            </a>

                            <a href="{{ route('admin.services.edit', $service) }}"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-amber-50 px-3 py-2.5 text-sm font-bold text-amber-600 hover:bg-amber-100 transition-colors">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                                <span class="hidden sm:inline">Edit</span>
                            </a>

                            <form method="POST" action="{{ route('admin.services.destroy', $service) }}"
                                onsubmit="return confirm('Delete this service?')" class="w-full">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-rose-50 px-3 py-2.5 text-sm font-bold text-rose-600 hover:bg-rose-100 transition-colors">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    <span class="hidden sm:inline">Delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="rounded-[1.5rem] bg-white border border-slate-200 shadow-sm px-6 py-10 text-center">
                <div class="max-w-xs mx-auto">
                    <div
                        class="mb-4 inline-flex h-16 w-16 items-center justify-center rounded-full bg-slate-50 text-slate-200">
                        <i data-lucide="briefcase" class="w-8 h-8"></i>
                    </div>

                    <h3 class="text-sm font-bold text-slate-900">
                        No services found
                    </h3>

                    <p class="mt-1 text-xs text-slate-500">
                        Create your first service to start accepting bookings.
                    </p>
                </div>
            </div>
        @endforelse

        @if ($services->hasPages())
            <div class="rounded-2xl bg-white border border-slate-200 shadow-sm px-4 py-4">
                {{ $services->links() }}
            </div>
        @endif
    </div>

@endsection
