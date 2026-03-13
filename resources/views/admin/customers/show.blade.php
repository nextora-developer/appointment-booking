@extends('layouts.admin')

@section('title', 'Customer Details')
@section('page_title', 'Customer Details')
@section('page_description', 'View customer profile and booking history')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6">

        <div class="mb-2">
            <a href="{{ route('admin.customers.index') }}"
                class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-indigo-600 transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back to Customers
            </a>
        </div>

        <div class="rounded-[2rem] border border-slate-200 bg-white shadow-sm overflow-hidden">
            <div class="p-8 border-b border-slate-100">
                <div class="flex items-center gap-4">
                    <div
                        class="h-14 w-14 rounded-full bg-gradient-to-tr from-indigo-600 to-violet-500 flex items-center justify-center text-white text-lg font-bold shadow-inner">
                        {{ strtoupper(substr($customer->name ?? '?', 0, 1)) }}
                    </div>

                    <div>
                        <h3 class="text-xl font-black text-slate-900">{{ $customer->name }}</h3>
                        <p class="text-sm text-slate-500 font-medium">{{ $customer->email ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="p-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="rounded-2xl border border-slate-100 bg-slate-50/70 p-5">
                    <div class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Phone</div>
                    <div class="mt-2 text-sm font-bold text-slate-900">{{ $customer->phone ?? '-' }}</div>
                </div>

                <div class="rounded-2xl border border-slate-100 bg-slate-50/70 p-5">
                    <div class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Total Bookings</div>
                    <div class="mt-2 text-sm font-bold text-slate-900">{{ $customer->appointments()->count() }}</div>
                </div>

                <div class="rounded-2xl border border-slate-100 bg-slate-50/70 p-5">
                    <div class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Customer ID</div>
                    <div class="mt-2 text-sm font-bold text-slate-900">#{{ $customer->id }}</div>
                </div>
            </div>
        </div>

        <div class="rounded-[2rem] border border-slate-200 bg-white shadow-sm overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-100">
                <h4 class="text-sm font-black text-slate-900">Booking History</h4>
                <p class="text-xs text-slate-500 mt-1">All appointments created by this customer</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">Reference</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">Service</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">Staff</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">Schedule</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse($appointments as $appointment)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 font-bold text-slate-900">
                                    {{ $appointment->booking_reference ?? 'REF-NONE' }}
                                </td>

                                <td class="px-6 py-4 text-slate-700 font-medium">
                                    {{ $appointment->service->name ?? 'N/A' }}
                                </td>

                                <td class="px-6 py-4 text-slate-600">
                                    {{ $appointment->staff?->user?->name ?? 'Unassigned' }}
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-slate-700">
                                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M, Y') }}
                                        </span>
                                        <span class="text-xs text-slate-400 font-medium">
                                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}
                                        </span>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    @php
                                        $statusClasses = match ($appointment->status) {
                                            'pending' => 'bg-amber-50 text-amber-700 border-amber-100',
                                            'confirmed' => 'bg-indigo-50 text-indigo-700 border-indigo-100',
                                            'completed' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                            'cancelled' => 'bg-rose-50 text-rose-700 border-rose-100',
                                            default => 'bg-slate-50 text-slate-700 border-slate-100',
                                        };
                                    @endphp

                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-lg border px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider {{ $statusClasses }}">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                    No booking history found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($appointments->hasPages())
                <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/30">
                    {{ $appointments->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection