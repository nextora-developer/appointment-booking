@extends('layouts.admin')

@section('title', 'Manage Services')
@section('page_title', 'Services')
@section('page_description', 'Manage all services available for booking')

@section('content')
    <div class="flex justify-end mb-6">
        <a href="{{ route('admin.services.create') }}"
           class="inline-flex items-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-bold text-white hover:bg-slate-800">
            Add Service
        </a>
    </div>

    <div class="rounded-3xl bg-white border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left font-bold text-slate-500">Name</th>
                        <th class="px-6 py-4 text-left font-bold text-slate-500">Price</th>
                        <th class="px-6 py-4 text-left font-bold text-slate-500">Duration</th>
                        <th class="px-6 py-4 text-left font-bold text-slate-500">Status</th>
                        <th class="px-6 py-4 text-right font-bold text-slate-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($services as $service)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-900">{{ $service->name }}</div>
                                <div class="text-xs text-slate-500 mt-1">{{ \Illuminate\Support\Str::limit($service->description, 60) }}</div>
                            </td>
                            <td class="px-6 py-4 text-slate-700">RM {{ number_format($service->price, 2) }}</td>
                            <td class="px-6 py-4 text-slate-700">{{ $service->duration }} mins</td>
                            <td class="px-6 py-4">
                                @if($service->is_active)
                                    <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700">Active</span>
                                @else
                                    <span class="inline-flex rounded-full bg-slate-200 px-3 py-1 text-xs font-bold text-slate-600">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.services.show', $service) }}"
                                       class="rounded-xl border border-slate-200 px-3 py-2 text-xs font-bold text-slate-700 hover:bg-slate-50">
                                        View
                                    </a>
                                    <a href="{{ route('admin.services.edit', $service) }}"
                                       class="rounded-xl border border-slate-200 px-3 py-2 text-xs font-bold text-slate-700 hover:bg-slate-50">
                                        Edit
                                    </a>

                                    <form method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('Delete this service?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="rounded-xl border border-rose-200 px-3 py-2 text-xs font-bold text-rose-600 hover:bg-rose-50">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-500">No services found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-slate-200">
            {{ $services->links() }}
        </div>
    </div>
@endsection