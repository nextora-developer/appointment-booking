@extends('layouts.customer')

@section('title', 'Book Appointment')

@section('content')
    <section class="py-16 lg:py-20">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
                <div class="max-w-xl">
                    <h1 class="text-3xl font-black tracking-tight text-slate-900">Book Appointment</h1>
                    <p class="mt-3 text-slate-600">
                        Fill in your appointment details below and submit your booking request.
                    </p>
                </div>

                <form method="POST" action="{{ route('appointments.store') }}" class="mt-8 space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-bold text-slate-700">Service</label>
                        <select name="service_id"
                            class="mt-2 w-full rounded-2xl border-slate-300 focus:border-sky-500 focus:ring-sky-500">
                            <option value="">Select Service</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}" @selected(old('service_id', request('service_id')) == $service->id)>
                                    {{ $service->name }} - RM {{ number_format($service->price, 2) }}
                                </option>
                            @endforeach
                        </select>
                        @error('service_id')
                            <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700">Staff</label>
                        <select name="staff_id"
                            class="mt-2 w-full rounded-2xl border-slate-300 focus:border-sky-500 focus:ring-sky-500">
                            <option value="">Any Available Staff</option>
                            @foreach ($staff as $member)
                                <option value="{{ $member->id }}" @selected(old('staff_id') == $member->id)>
                                    {{ $member->user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('staff_id')
                            <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700">Appointment Date</label>
                            <input type="date" name="appointment_date" value="{{ old('appointment_date') }}"
                                class="mt-2 w-full rounded-2xl border-slate-300 focus:border-sky-500 focus:ring-sky-500">
                            @error('appointment_date')
                                <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700">Appointment Time</label>
                            <input type="time" name="appointment_time" value="{{ old('appointment_time') }}"
                                class="mt-2 w-full rounded-2xl border-slate-300 focus:border-sky-500 focus:ring-sky-500">
                            @error('appointment_time')
                                <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700">Notes</label>
                        <textarea name="notes" rows="4"
                            class="mt-2 w-full rounded-2xl border-slate-300 focus:border-sky-500 focus:ring-sky-500">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="inline-flex items-center rounded-2xl bg-slate-900 px-6 py-3 text-sm font-bold text-white hover:bg-slate-800">
                            Confirm Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
