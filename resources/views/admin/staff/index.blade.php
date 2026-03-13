@extends('layouts.admin')

@section('title', 'Manage Staff')
@section('page_title', 'Staff')
@section('page_description', 'Manage staff accounts and profiles')

@section('content')

    <div class="mb-6 flex items-center justify-end">
        <a href="{{ route('admin.staff.create') }}"
            class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2 text-sm font-bold text-white hover:bg-indigo-700 transition-all shadow-md shadow-indigo-200">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Add Staff
        </a>
    </div>

    <div class="rounded-3xl bg-white border border-slate-200 shadow-sm overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left border-collapse">

                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">Staff</th>
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">Email</th>
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">Phone</th>
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">Status</th>
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-slate-400 text-right">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse($staffMembers as $member)
                        <tr class="group hover:bg-slate-50/50 transition-colors">

                            {{-- STAFF --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="h-9 w-9 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-xs font-bold text-slate-600 shadow-sm">
                                        {{ strtoupper(substr($member->user->name ?? '?', 0, 1)) }}
                                    </div>

                                    <div>
                                        <div class="font-bold text-slate-900">
                                            {{ $member->user->name ?? 'N/A' }}
                                        </div>

                                        <div class="text-[11px] text-slate-400 flex items-center gap-1 mt-0.5">
                                            <i data-lucide="user" class="w-3 h-3"></i>
                                            Staff ID: {{ $member->id }}
                                        </div>
                                    </div>

                                </div>

                            </td>

                            {{-- EMAIL --}}
                            <td class="px-6 py-4">
                                <span class="text-slate-700 font-medium">
                                    {{ $member->user->email ?? 'N/A' }}
                                </span>
                            </td>

                            {{-- PHONE --}}
                            <td class="px-6 py-4">
                                <span class="text-slate-600">
                                    {{ $member->phone ?: '-' }}
                                </span>
                            </td>

                            {{-- STATUS --}}
                            <td class="px-6 py-4">

                                @if ($member->is_active)
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

                            {{-- ACTIONS --}}
                            <td class="px-6 py-4 text-right">

                                <div class="flex items-center justify-end gap-1">

                                    <a href="{{ route('admin.staff.show', $member) }}"
                                        class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all"
                                        title="View Staff">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                    </a>

                                    <a href="{{ route('admin.staff.edit', $member) }}"
                                        class="p-2 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-all"
                                        title="Edit Staff">
                                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                                    </a>

                                    <form method="POST" action="{{ route('admin.staff.destroy', $member) }}"
                                        onsubmit="return confirm('Delete this staff member?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all"
                                            title="Delete Staff">
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
                                        <i data-lucide="users" class="w-8 h-8"></i>
                                    </div>

                                    <h3 class="text-sm font-bold text-slate-900">
                                        No staff found
                                    </h3>

                                    <p class="mt-1 text-xs text-slate-500">
                                        Add your first staff member to start managing bookings.
                                    </p>

                                </div>

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>
        </div>

        @if ($staffMembers->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/30">
                {{ $staffMembers->links() }}
            </div>
        @endif

    </div>

@endsection
