@extends('layouts.customer')

@section('title', 'Book Appointment')

@section('content')

    <section class="relative h-[60vh] bg-cover bg-center md:bg-fixed flex items-center justify-center text-center"
        style="background-image: url('{{ asset('images/hero_bg_1.jpg') }}')">

        {{-- 不要暗的话就不要 overlay --}}
        {{-- <div class="absolute inset-0 bg-black/30"></div> --}}

        <div class="relative text-white px-4">

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-serif font-light drop-shadow-lg">
                Book Now
            </h1>

        </div>

    </section>

    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-6 text-center">

            {{-- TITLE --}}
            <h2 class="text-3xl md:text-4xl font-serif text-slate-900">
                Booking Process
            </h2>

            <div class="w-12 h-[2px] bg-[#8bc34a] mx-auto mt-4 mb-12"></div>

            {{-- STEPS --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

                {{-- STEP 1 --}}
                <div class="group">
                    <div class="flex justify-center mb-6">
                        <div
                            class="w-16 h-16 flex items-center justify-center rounded-full 
                                border-2 border-[#8bc34a] text-[#8bc34a] text-xl font-bold
                                group-hover:bg-[#8bc34a] group-hover:text-white transition">
                            1
                        </div>
                    </div>

                    <h3 class="text-xl font-serif text-slate-900 mb-3">
                        Choose Service
                    </h3>

                    <p class="text-slate-500 text-sm leading-relaxed">
                        Select your preferred service, staff and appointment date.
                    </p>
                </div>


                {{-- STEP 2 --}}
                <div class="group">
                    <div class="flex justify-center mb-6">
                        <div
                            class="w-16 h-16 flex items-center justify-center rounded-full 
                                border-2 border-[#8bc34a] text-[#8bc34a] text-xl font-bold
                                group-hover:bg-[#8bc34a] group-hover:text-white transition">
                            2
                        </div>
                    </div>

                    <h3 class="text-xl font-serif text-slate-900 mb-3">
                        Pick Time Slot
                    </h3>

                    <p class="text-slate-500 text-sm leading-relaxed">
                        View available time slots and choose the one that suits you best.
                    </p>
                </div>


                {{-- STEP 3 --}}
                <div class="group">
                    <div class="flex justify-center mb-6">
                        <div
                            class="w-16 h-16 flex items-center justify-center rounded-full 
                                border-2 border-[#8bc34a] text-[#8bc34a] text-xl font-bold
                                group-hover:bg-[#8bc34a] group-hover:text-white transition">
                            3
                        </div>
                    </div>

                    <h3 class="text-xl font-serif text-slate-900 mb-3">
                        Confirm Booking
                    </h3>

                    <p class="text-slate-500 text-sm leading-relaxed">
                        Submit your booking and we’ll reserve your appointment instantly.
                    </p>
                </div>

            </div>

        </div>
    </section>

    <section class="py-10 bg-white">
        <div class="max-w-3xl mx-auto px-6">

            <div class="bg-white border border-slate-200 p-10 shadow-sm">

                {{-- TITLE --}}
                <h1 class="text-4xl font-serif text-slate-900">
                    Book Appointment
                </h1>

                <p class="text-slate-500 mt-3 mb-10">
                    Choose your service, preferred staff and date to see available time slots.
                </p>

                {{-- STEP 1 --}}
                <form method="GET" action="{{ route('appointments.create') }}#slots-section" class="space-y-6">

                    {{-- SERVICE --}}
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Service</label>

                        <select name="service_id"
                            class="mt-2 w-full border border-slate-200 px-4 py-3 
                               focus:outline-none focus:ring-2 focus:ring-[#8bc34a]/40">

                            <option value="">Select Service</option>

                            @foreach ($services as $service)
                                <option value="{{ $service->id }}" @selected(request('service_id') == $service->id)>
                                    {{ $service->name }} (RM {{ number_format($service->price, 2) }})
                                </option>
                            @endforeach

                        </select>
                    </div>


                    {{-- STAFF --}}
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Staff</label>

                        <select name="staff_id"
                            class="mt-2 w-full border border-slate-200 px-4 py-3 
                               focus:outline-none focus:ring-2 focus:ring-[#8bc34a]/40">

                            <option value="">Any Available Staff</option>

                            @foreach ($staff as $member)
                                <option value="{{ $member->id }}" @selected(request('staff_id') == $member->id)>
                                    {{ $member->user->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>


                    {{-- DATE --}}
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Date</label>

                        <input type="date" name="appointment_date" value="{{ request('appointment_date') }}"
                            min="{{ now()->toDateString() }}"
                            class="mt-2 w-full border border-slate-200 px-4 py-3 
                               focus:outline-none focus:ring-2 focus:ring-[#8bc34a]/40">
                    </div>


                    {{-- BUTTON --}}
                    <button
                        class="w-full py-3 bg-[#8bc34a] text-white font-semibold 
                           hover:bg-[#7cb342] transition duration-300">
                        Check Available Slots
                    </button>

                </form>


                {{-- STEP 2 --}}
                @if (request('appointment_date'))

                    <div id="slots-section" class="mt-12 border-t border-slate-100 pt-10">

                        <h2 class="text-2xl font-serif text-slate-900 mb-6">
                            Available Time Slots
                        </h2>

                        @if (count($availableSlots))

                            <form method="POST" action="{{ route('appointments.store') }}" class="space-y-6">
                                @csrf

                                <input type="hidden" name="service_id" value="{{ request('service_id') }}">
                                <input type="hidden" name="staff_id" value="{{ request('staff_id') }}">
                                <input type="hidden" name="appointment_date" value="{{ request('appointment_date') }}">


                                {{-- SLOTS --}}
                                <div class="grid grid-cols-3 gap-4">

                                    @foreach ($availableSlots as $slot)
                                        <label
                                            class="border border-slate-200 p-3 text-center cursor-pointer 
                                                    transition
                                                    hover:border-[#8bc34a]
                                                    has-[input:checked]:bg-[#8bc34a]
                                                    has-[input:checked]:border-[#8bc34a]
                                                    has-[input:checked]:text-white">

                                            <input type="radio" name="appointment_time" value="{{ $slot }}"
                                                class="hidden">

                                            <span class="block font-semibold py-2">
                                                {{ \Carbon\Carbon::parse($slot)->format('g:i A') }}
                                            </span>

                                        </label>
                                    @endforeach

                                </div>


                                {{-- NOTES --}}
                                <div>
                                    <label class="text-sm font-semibold text-slate-700">Notes</label>

                                    <textarea name="notes" rows="4" placeholder="Any notes or special requests (optional)..."
                                        class="mt-2 w-full border border-slate-200 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#8bc34a]/40"></textarea>
                                </div>


                                {{-- CONFIRM --}}
                                <button
                                    class="w-full py-3 bg-[#8bc34a] text-white font-semibold 
                                       hover:bg-[#7cb342] transition duration-300">

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
