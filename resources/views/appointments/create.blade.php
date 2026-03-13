@extends('layouts.customer')

@section('title', 'Book Appointment')

@section('content')

    <section class="py-16">
        <div class="max-w-3xl mx-auto px-4">

            <div class="bg-white border rounded-3xl p-8 shadow-sm">

                <h1 class="text-3xl font-black mb-2">Book Appointment</h1>
                <p class="text-slate-500 mb-8">
                    Choose your service, preferred staff and date to see available time slots.
                </p>

                {{-- STEP 1: SELECT SERVICE / STAFF / DATE --}}
                <form method="GET" action="{{ route('appointments.create') }}" class="space-y-6">

                    <div>
                        <label class="font-semibold">Service</label>

                        <select name="service_id" class="mt-2 w-full rounded-xl border-slate-300">

                            <option value="">Select Service</option>

                            @foreach ($services as $service)
                                <option value="{{ $service->id }}" @selected(request('service_id') == $service->id)>
                                    {{ $service->name }} (RM {{ number_format($service->price, 2) }})
                                </option>
                            @endforeach

                        </select>
                    </div>


                    <div>
                        <label class="font-semibold">Staff</label>

                        <select name="staff_id" class="mt-2 w-full rounded-xl border-slate-300">

                            <option value="">Any Available Staff</option>

                            @foreach ($staff as $member)
                                <option value="{{ $member->id }}" @selected(request('staff_id') == $member->id)>
                                    {{ $member->user->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>


                    <div>
                        <label class="font-semibold">Date</label>

                        <input type="date" name="appointment_date" value="{{ request('appointment_date') }}"
                            min="{{ now()->toDateString() }}" class="mt-2 w-full rounded-xl border-slate-300">
                    </div>


                    <button class="px-6 py-3 bg-slate-900 text-white rounded-xl font-bold">
                        Check Available Slots
                    </button>

                </form>


                {{-- STEP 2: SHOW AVAILABLE SLOTS --}}

                @if (request('appointment_date'))

                    <div class="mt-10 border-t pt-8">

                        <h2 class="text-xl font-bold mb-4">
                            Available Time Slots
                        </h2>


                        @if (count($availableSlots))

                            <form method="POST" action="{{ route('appointments.store') }}" class="space-y-6">

                                @csrf

                                <input type="hidden" name="service_id" value="{{ request('service_id') }}">
                                <input type="hidden" name="staff_id" value="{{ request('staff_id') }}">
                                <input type="hidden" name="appointment_date" value="{{ request('appointment_date') }}">


                                <div class="grid grid-cols-3 gap-3">

                                    @foreach ($availableSlots as $slot)
                                        <label class="border rounded-xl p-3 text-center cursor-pointer hover:bg-slate-50">

                                            <input type="radio" name="appointment_time" value="{{ $slot }}"
                                                class="hidden peer">

                                            <span
                                                class="font-semibold peer-checked:text-white peer-checked:bg-slate-900 rounded-lg px-2 py-1 block">

                                                {{ \Carbon\Carbon::createFromFormat('H:i', $slot)->format('g:i A') }}

                                            </span>

                                        </label>
                                    @endforeach

                                </div>


                                <div>
                                    <label class="font-semibold">Notes</label>

                                    <textarea name="notes" rows="4" class="mt-2 w-full border rounded-xl"></textarea>
                                </div>


                                <button class="px-6 py-3 bg-slate-900 text-white rounded-xl font-bold">

                                    Confirm Booking

                                </button>

                            </form>
                        @else
                            <p class="text-red-500">
                                No available slots for this date.
                            </p>

                        @endif

                    </div>

                @endif


            </div>
        </div>
    </section>

@endsection
