@extends('layouts.customer')

@section('title', 'Home - Appointment Booking System')

@section('content')
    <section x-data="{ slide: 1 }" class="relative min-h-[100svh] overflow-hidden">

        {{-- SLIDE 1 --}}
        <div x-show="slide === 1" class="absolute inset-0 bg-cover bg-center md:bg-fixed transition-all duration-700"
            style="background-image: url('{{ asset('images/hero_bg_1.jpg') }}')">

            <div class="relative h-full flex items-center justify-center text-center px-4">
                <div class="text-white max-w-4xl">

                    {{-- SMALL TEXT --}}
                    <div class="text-xs tracking-[0.3em] uppercase mb-6 font-semibold">
                        Welcome to Hairsal
                    </div>

                    {{-- BIG TITLE --}}
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-serif font-light leading-tight drop-shadow-lg">
                        Hair Salon <br class="sm:hidden"> Expert
                    </h1>

                    {{-- BUTTON --}}
                    <div class="mt-10">
                        @auth
                            <a href="{{ route('appointments.create') }}"
                                class="px-8 py-3 bg-black text-white font-semibold tracking-wide 
                   hover:bg-white hover:text-black transition">
                                Book Now!
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="px-8 py-3 bg-black text-white font-semibold tracking-wide 
                   hover:bg-white hover:text-black transition">
                                Book Now!
                            </a>
                        @endauth
                    </div>

                </div>
            </div>
        </div>


        {{-- SLIDE 2 --}}
        <div x-show="slide === 2" class="absolute inset-0 bg-cover bg-center md:bg-fixed transition-all duration-700"
            style="background-image: url('{{ asset('images/hero_bg_2.jpg') }}')">

            <div class="relative h-full flex items-center justify-center text-center px-4">
                <div class="text-white max-w-3xl">

                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-serif font-light leading-tight drop-shadow-lg">
                        Beautiful Hair,<br>Healthy You!
                    </h1>

                    <div class="mt-8">
                        <a href="{{ route('services.index') }}"
                            class="px-8 py-3 bg-black text-white font-semibold tracking-wide hover:bg-white hover:text-black transition">
                            Book Now!
                        </a>
                    </div>

                </div>
            </div>
        </div>


        {{-- LEFT --}}
        <button @click="slide = slide === 1 ? 2 : 1"
            class="absolute left-5 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-black/40 backdrop-blur text-white flex items-center justify-center hover:bg-white/40 transition">
            ‹
        </button>

        {{-- RIGHT --}}
        <button @click="slide = slide === 2 ? 1 : 2"
            class="absolute right-5 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-black/40 backdrop-blur text-white flex items-center justify-center hover:bg-white/40 transition">
            ›
        </button>

    </section>

    <section class="relative bg-white py-10 md:py-20 z-10">
        <div class="max-w-7xl mx-auto px-6">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 items-center">

                {{-- LEFT: TEXT --}}
                <div class="text-center mx-auto max-w-xl">

                    <h2 class="text-4xl lg:text-5xl font-serif text-slate-900 leading-tight">
                        Welcome to <br>
                        <span class="text-[#8bc34a] italic">Hair Salon</span>
                    </h2>

                    <p class="mt-6 text-slate-600 leading-relaxed">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt architecto ab hic
                        rem placeat eius commodi eum eligendi recusandae sed qui cumque quibusdam.
                    </p>

                    <a href="{{ route('services.index') }}"
                        class="inline-block mt-6 text-sm font-semibold tracking-wide text-[#8bc34a] hover:underline">
                        READ MORE
                    </a>
                </div>


                {{-- CENTER: IMAGE --}}
                <div class="overflow-hidden rounded-sm">
                    <img src="{{ asset('images/img_2.jpg') }}"
                        class="w-full h-[400px] object-cover transition duration-500 ease-in-out hover:scale-110">
                </div>


                {{-- RIGHT: OPENING HOURS --}}
                <div class="border border-slate-200 p-8 text-center h-[400px] flex flex-col justify-center">

                    <h3 class="text-2xl font-serif text-[#8bc34a] mb-6">
                        Opening Hours
                    </h3>

                    <div class="space-y-6 text-slate-700 text-sm">

                        <div>
                            <div class="font-semibold">Mon – Fri</div>
                            <div class="text-slate-500">10:00 AM – 8:30 PM</div>
                        </div>

                        <div>
                            <div class="font-semibold">Saturday</div>
                            <div class="text-slate-500">Closed</div>
                        </div>

                        <div>
                            <div class="font-semibold">Sunday</div>
                            <div class="text-slate-500">10:00 AM – 8:30 PM</div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>

    <section class="py-10 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6">

            {{-- TITLE --}}
            <div class="text-center mb-16">
                <h2 class="text-4xl font-serif text-slate-900">
                    Featured Services
                </h2>

                <div class="w-12 h-[2px] bg-[#8bc34a] mx-auto mt-4"></div>
            </div>

            {{-- CARDS --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                @forelse($services->take(3) as $service)
                    <a href="{{ route('appointments.create', ['service_id' => $service->id]) }}"
                        class="group block bg-[#f7f7f7] p-8 text-center transition duration-300 hover:-translate-y-1 hover:shadow-xl border border-transparent hover:border-[#8bc34a]/20">

                        {{-- ICON --}}
                        <div class="mb-6 flex justify-center text-[#8bc34a]">
                            <div
                                class="flex h-16 w-16 items-center justify-center rounded-full bg-white shadow-sm transition group-hover:scale-105">
                               <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664" />
                                </svg>
                            </div>
                        </div>

                        {{-- TITLE --}}
                        <h3 class="text-xl font-serif text-slate-900 mb-3 transition group-hover:text-[#8bc34a]">
                            {{ $service->name }}
                        </h3>

                        {{-- DESCRIPTION --}}
                        <p class="text-slate-500 text-sm leading-relaxed min-h-[60px]">
                            {{ $service->description ?: 'No description available.' }}
                        </p>

                        {{-- PRICE --}}
                        <div class="mt-5 text-[#8bc34a] font-semibold">
                            RM {{ number_format($service->price, 2) }}
                        </div>

                        {{-- CTA --}}
                        <div class="mt-6 text-sm font-semibold text-slate-700 group-hover:text-[#8bc34a]">
                            Book Now →
                        </div>

                    </a>
                @empty
                    <div class="col-span-full text-center text-slate-500">
                        No services available.
                    </div>
                @endforelse

            </div>

            {{-- VIEW MORE --}}
            <div class="mt-14 text-center">
                <a href="{{ route('services.index') }}"
                    class="inline-flex items-center justify-center border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition duration-300">
                    View All Services
                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                    </svg>
                </a>
            </div>

        </div>
    </section>

    <section class="py-10 md:py-20 bg-[#f7f7f7]">
        <div class="max-w-6xl mx-auto px-6">

            <div class="relative flex flex-col md:flex-row items-center">

                {{-- IMAGE --}}
                <div class="w-full md:w-2/3 flex justify-center">
                    <img src="{{ asset('images/person_1.jpg') }}"
                        class="w-full max-w-[665px] h-[260px] md:h-[665px] object-cover">
                </div>

                {{-- FLOATING CARD --}}
                <div class="bg-white p-10 shadow-lg md:absolute md:right-0 md:w-[50%] md:-mr-20 mt-10 md:mt-0">

                    <h2 class="text-4xl font-serif text-slate-900">
                        New hairstyle!
                    </h2>

                    <div class="w-12 h-[2px] bg-[#8bc34a] mt-4 mb-6"></div>

                    <p class="text-slate-600 leading-relaxed italic">
                        “Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique dolorem quisquam
                        laudantium, incidunt id laborum, tempora aliquid labore minus. Nemo maxime, veniam!
                        Fugiat odio nam eveniet ipsam atque, corrupti porro”
                    </p>

                    <p class="mt-6 text-sm font-semibold text-slate-700">
                        — Stellla Martin
                    </p>

                </div>

            </div>

        </div>
    </section>

    <section class="relative py-28 md:py-40 bg-center bg-cover md:bg-fixed text-center text-white"
        style="background-image: url('{{ asset('images/hero_bg_2.jpg') }}')">

        <div class="absolute inset-0 bg-black/30"></div>

        <div class="relative max-w-7xl mx-auto px-6">
            <h2 class="text-3xl sm:text-4xl md:text-6xl lg:text-7xl font-serif leading-tight">
                Experience Our Outstanding <br class="hidden sm:block"> Services
            </h2>
        </div>
    </section>
@endsection
