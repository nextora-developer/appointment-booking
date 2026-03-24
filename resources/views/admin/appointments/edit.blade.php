@extends('layouts.admin')

@section('title', 'Edit Appointment')
@section('page_title', 'Edit Appointment')
@section('page_description', 'Update scheduling details, assign staff, or change status')

@section('content')

    <div class="max-w-3xl mx-auto">

        <div class="mb-6">
            <a href="{{ route('admin.appointments.index', $appointment) }}"
                class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-indigo-600 transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back to Appointment
            </a>
        </div>

        <form method="POST" action="{{ route('admin.appointments.update', $appointment) }}"
            class="bg-white border border-slate-200 rounded-[2rem] shadow-sm overflow-hidden">

            @csrf
            @method('PUT')

            <div class="p-8 lg:p-10 space-y-8">

                <div class="flex items-center gap-4 pb-6 border-b border-slate-100">

                    <div class="p-3 bg-amber-50 text-amber-600 rounded-2xl">
                        <i data-lucide="edit-3" class="w-6 h-6"></i>
                    </div>

                    <div>
                        <h3 class="text-lg font-black text-slate-900">Modify Booking</h3>
                        <p class="text-xs text-slate-500 font-medium">
                            Reference: {{ $appointment->booking_reference }}
                        </p>
                    </div>

                </div>


                <div class="space-y-8">

                    <div
                        class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50/50 p-6 rounded-[2rem] border border-slate-100">


                        <div class="space-y-1">

                            <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 ml-1">
                                Customer
                            </label>

                            <div
                                class="px-4 py-3 rounded-xl bg-white border border-slate-200 text-sm font-bold text-slate-900 shadow-sm flex items-center gap-2">
                                <i data-lucide="user" class="w-4 h-4 text-slate-300"></i>
                                {{ $appointment->customer->name ?? 'N/A' }}
                            </div>

                        </div>



                        <div class="space-y-1">

                            <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 ml-1">
                                Service
                            </label>

                            <div
                                class="px-4 py-3 rounded-xl bg-white border border-slate-200 text-sm font-bold text-slate-900 shadow-sm flex items-center gap-2">
                                <i data-lucide="scissors" class="w-4 h-4 text-slate-300"></i>
                                {{ $appointment->service->name ?? 'N/A' }}
                            </div>

                        </div>



                        <div class="space-y-1">

                            <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 ml-1">
                                Date
                            </label>

                            <div
                                class="px-4 py-3 rounded-xl bg-white border border-slate-200 text-sm font-bold text-slate-900 shadow-sm flex items-center gap-2">
                                <i data-lucide="calendar" class="w-4 h-4 text-slate-300"></i>

                                {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}

                            </div>

                        </div>



                        <div class="space-y-1">

                            <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 ml-1">
                                Time Slot
                            </label>

                            <div
                                class="px-4 py-3 rounded-xl bg-white border border-slate-200 text-sm font-bold text-slate-900 shadow-sm flex items-center gap-2">
                                <i data-lucide="clock" class="w-4 h-4 text-slate-300"></i>

                                {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}

                            </div>

                        </div>

                    </div>



                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">


                        <div class="space-y-2">

                            <label for="staff_id"
                                class="block text-xs font-bold uppercase tracking-widest text-slate-500 ml-1">
                                Assign Staff
                            </label>

                            <div class="relative">

                                <select name="staff_id" id="staff_id"
                                    class="w-full appearance-none rounded-2xl border-slate-200 bg-white px-4 py-3.5 text-sm font-bold text-slate-700 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all cursor-pointer @error('staff_id') border-rose-500 @enderror">

                                    <option value="">Not Assigned</option>

                                    @foreach ($staffMembers as $member)
                                        <option value="{{ $member->id }}" @selected(old('staff_id', $appointment->staff_id) == $member->id)>

                                            {{ $member->user->name }}

                                        </option>
                                    @endforeach

                                </select>


                            </div>

                            @error('staff_id')
                                <p class="mt-2 text-[11px] font-bold text-rose-500 flex items-center gap-1">
                                    <i data-lucide="alert-circle" class="w-3 h-3"></i>
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>



                        <div class="space-y-2">

                            <label for="status"
                                class="block text-xs font-bold uppercase tracking-widest text-slate-500 ml-1">
                                Current Status
                            </label>

                            <div class="relative">

                                <select name="status" id="status"
                                    class="w-full appearance-none rounded-2xl border-slate-200 bg-white px-4 py-3.5 text-sm font-bold text-slate-700 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all cursor-pointer @error('status') border-rose-500 @enderror">

                                    @foreach ($statuses as $status)
                                        <option value="{{ $status }}" @selected(old('status', $appointment->status) === $status)>

                                            {{ ucfirst($status) }}

                                        </option>
                                    @endforeach

                                </select>

                            </div>

                            @error('status')
                                <p class="mt-2 text-[11px] font-bold text-rose-500 flex items-center gap-1">
                                    <i data-lucide="alert-circle" class="w-3 h-3"></i>
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>



                    <div class="space-y-2">

                        <label for="notes" class="block text-xs font-bold uppercase tracking-widest text-slate-500 ml-1">
                            Internal Notes
                        </label>

                        <textarea name="notes" id="notes" rows="4"
                            placeholder="Add specific details or instructions for this booking..."
                            class="w-full rounded-2xl border-slate-200 bg-white px-4 py-3.5 text-sm font-medium text-slate-600 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all @error('notes') border-rose-500 @enderror">{{ old('notes', $appointment->notes) }}</textarea>

                        @error('notes')
                            <p class="mt-2 text-[11px] font-bold text-rose-500 flex items-center gap-1">
                                <i data-lucide="alert-circle" class="w-3 h-3"></i>
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                </div>

            </div>



            <div class="bg-slate-50 border-t border-slate-100 px-8 py-6 flex items-center justify-end gap-3">

                <a href="{{ route('admin.appointments.index') }}"
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
