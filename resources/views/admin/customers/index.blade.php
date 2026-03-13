@extends('layouts.admin')

@section('title', 'Manage Customers')
@section('page_title', 'Customers')
@section('page_description', 'View and manage customer accounts and booking history')

@section('content')
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <form method="GET" action="{{ route('admin.customers.index') }}" class="relative w-full max-w-sm">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                <i data-lucide="search" class="w-4 h-4"></i>
            </span>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search customers..."
                class="w-full rounded-xl border-slate-200 pl-10 pr-4 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
        </form>
    </div>

    <div class="rounded-3xl bg-white border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">Customer</th>
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">Email</th>
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">Phone</th>
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">Bookings</th>
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400 text-right">
                            Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse($customers as $customer)
                        <tr class="group hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="h-9 w-9 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-xs font-bold text-slate-600 shadow-sm">
                                        {{ strtoupper(substr($customer->name ?? '?', 0, 1)) }}
                                    </div>

                                    <div>
                                        <div class="font-bold text-slate-900 line-clamp-1">
                                            {{ $customer->name }}
                                        </div>
                                        <div class="text-[11px] font-medium text-slate-400 flex items-center gap-1">
                                            <i data-lucide="badge-check" class="w-3 h-3"></i>
                                            Customer ID: {{ $customer->id }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-slate-700 font-medium">
                                {{ $customer->email ?? '-' }}
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ $customer->phone ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-lg border border-indigo-100 bg-indigo-50 px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider text-indigo-700">
                                    {{ $customer->appointments_count }} bookings
                                </span>
                            </td>

                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-1">

                                    {{-- VIEW --}}
                                    <a href="{{ route('admin.customers.show', $customer) }}"
                                        class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all"
                                        title="View Customer">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                    </a>

                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.customers.edit', $customer) }}"
                                        class="p-2 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-all"
                                        title="Edit Customer">
                                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                                    </a>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="max-w-xs mx-auto">
                                    <div
                                        class="mb-4 inline-flex h-16 w-16 items-center justify-center rounded-full bg-slate-50 text-slate-200">
                                        <i data-lucide="users" class="w-8 h-8"></i>
                                    </div>
                                    <h3 class="text-sm font-bold text-slate-900">No customers found</h3>
                                    <p class="mt-1 text-xs text-slate-500">
                                        Try adjusting your search keyword.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($customers->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/30">
                {{ $customers->links() }}
            </div>
        @endif
    </div>
@endsection
