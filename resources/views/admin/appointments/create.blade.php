@extends('layouts.admin')

@section('title', 'Create Appointment')
@section('page_title', 'Create Appointment')
@section('page_description', 'Manually create a booking for a customer')

@section('content')

    <div class="max-w-4xl mx-auto">

        <div class="mb-6">
            <a href="{{ route('admin.appointments.index') }}"
                class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-indigo-600 transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back to Appointments
            </a>
        </div>

        <div class="bg-white border border-slate-200 rounded-[2rem] shadow-sm overflow-hidden">
            <div class="p-8 lg:p-10">

                {{-- Header --}}
                <div class="flex items-center gap-4 pb-6 border-b border-slate-100 mb-8">
                    <div class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl">
                        <i data-lucide="calendar-plus" class="w-6 h-6"></i>
                    </div>

                    <div>
                        <h2 class="text-xl font-bold text-slate-800">
                            New Appointment
                        </h2>
                        <p class="text-sm text-slate-500">
                            Select customer, service, staff and date to view available slots
                        </p>
                    </div>
                </div>

                {{-- STEP 1: CHECK AVAILABLE SLOTS --}}
                <form method="GET" action="{{ route('admin.appointments.create') }}" class="space-y-8">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Customer --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700">
                                Customer
                            </label>

                            <select name="customer_id"
                                class="mt-2 w-full rounded-xl border-slate-300 focus:ring-indigo-500">
                                <option value="">Select Customer</option>

                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}" @selected(request('customer_id') == $customer->id)>
                                        {{ $customer->name }} ({{ $customer->email }})
                                    </option>
                                @endforeach
                            </select>

                            @error('customer_id')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Service --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700">
                                Service
                            </label>

                            <select name="service_id" class="mt-2 w-full rounded-xl border-slate-300 focus:ring-indigo-500">
                                <option value="">Select Service</option>

                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}" @selected(request('service_id') == $service->id)>
                                        {{ $service->name }} (RM {{ number_format($service->price, 2) }})
                                    </option>
                                @endforeach
                            </select>

                            @error('service_id')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Staff --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700">
                                Staff
                            </label>

                            <select name="staff_id" class="mt-2 w-full rounded-xl border-slate-300 focus:ring-indigo-500">
                                <option value="">Any Available Staff</option>

                                @foreach ($staffMembers as $staff)
                                    <option value="{{ $staff->id }}" @selected(request('staff_id') == $staff->id)>
                                        {{ $staff->user->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('staff_id')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Date --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700">
                                Date
                            </label>

                            <input type="date" name="appointment_date" value="{{ request('appointment_date') }}"
                                min="{{ now()->toDateString() }}"
                                class="mt-2 w-full rounded-xl border-slate-300 focus:ring-indigo-500">

                            @error('appointment_date')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="pt-2">
                        <button
                            class="px-6 py-3 bg-slate-900 text-white rounded-xl font-bold hover:bg-slate-800 transition">
                            Check Available Slots
                        </button>
                    </div>

                </form>

                {{-- STEP 2: SHOW AVAILABLE SLOTS --}}
                @if (request('service_id') && request('appointment_date'))
                    <div class="mt-10 border-t pt-8">
                        <h3 class="text-lg font-bold text-slate-800 mb-2">
                            Available Time Slots
                        </h3>
                        <p class="text-sm text-slate-500 mb-6">
                            Select a time slot to create the appointment
                        </p>

                        @if (count($availableSlots))
                            <form method="POST" action="{{ route('admin.appointments.store') }}" class="space-y-6">
                                @csrf

                                <input type="hidden" name="customer_id" value="{{ request('customer_id') }}">
                                <input type="hidden" name="service_id" value="{{ request('service_id') }}">
                                <input type="hidden" name="staff_id" value="{{ request('staff_id') }}">
                                <input type="hidden" name="appointment_date" value="{{ request('appointment_date') }}">

                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                    @foreach ($availableSlots as $slot)
                                        <label
                                            class="border border-slate-200 rounded-2xl p-3 text-center cursor-pointer hover:bg-slate-50 transition">
                                            <input type="radio" name="appointment_time" value="{{ $slot }}"
                                                class="hidden peer" @checked(old('appointment_time') == $slot)>

                                            <span
                                                class="block rounded-xl px-3 py-2 font-semibold text-slate-700 peer-checked:bg-slate-900 peer-checked:text-white">
                                                {{ \Carbon\Carbon::createFromFormat('H:i', $slot)->format('g:i A') }}
                                            </span>
                                        </label>
                                    @endforeach
                                </div>

                                @error('appointment_time')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror

                                <div>
                                    <label class="block text-sm font-semibold text-slate-700">
                                        Notes
                                    </label>

                                    <textarea name="notes" rows="4" class="mt-2 w-full rounded-xl border-slate-300 focus:ring-indigo-500">{{ old('notes') }}</textarea>
                                </div>

                                <div class="pt-4 border-t border-slate-100 flex justify-end">
                                    <button
                                        class="px-6 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition">
                                        Create Appointment
                                    </button>
                                </div>
                            </form>
                        @else
                            <div class="rounded-2xl border border-red-100 bg-red-50 px-4 py-4 text-red-600">
                                No available slots for this date.
                            </div>
                        @endif
                    </div>
                @endif

            </div>
        </div>

    </div>

@endsection
