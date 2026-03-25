@extends('layouts.customer')

@section('title', 'Our Services')

@section('content')

    <section class="relative h-[60vh] bg-cover bg-center md:bg-fixed flex items-center justify-center text-center"
        style="background-image: url('{{ asset('images/hero_bg_1.jpg') }}')">

        {{-- 不要暗的话就不要 overlay --}}
        {{-- <div class="absolute inset-0 bg-black/30"></div> --}}

        <div class="relative text-white px-4">

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-serif font-light drop-shadow-lg">
                See Our Services!
            </h1>

            <div class="mt-8">
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

    </section>

    <section class="py-16 lg:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">

                @forelse($services as $service)
                    <a href="{{ route('appointments.create', ['service_id' => $service->id]) }}"
                        class="group block bg-[#f7f7f7] p-8 lg:p-10 text-center transition duration-300 hover:-translate-y-1 hover:shadow-xl border border-transparent hover:border-[#8bc34a]/20">

                        {{-- ICON --}}
                        <div class="mb-6 flex justify-center text-[#8bc34a]">
                            <div
                                class="flex h-20 w-20 items-center justify-center rounded-full bg-white shadow-sm transition duration-300 group-hover:scale-105 group-hover:shadow-md">
                                <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664" />
                                </svg>
                            </div>
                        </div>

                        {{-- TITLE --}}
                        <h3
                            class="text-2xl font-serif text-slate-900 mb-3 transition duration-300 group-hover:text-[#8bc34a]">
                            {{ $service->name }}
                        </h3>

                        {{-- DESCRIPTION --}}
                        <p class="text-slate-500 text-sm leading-relaxed min-h-[72px]">
                            {{ $service->description ?: 'No description available.' }}
                        </p>

                        {{-- PRICE --}}
                        <div class="mt-6 text-[#8bc34a] font-semibold text-lg">
                            RM {{ number_format($service->price, 2) }}
                        </div>

                        {{-- BUTTON --}}
                        <div class="mt-8">
                            <span
                                class="inline-flex items-center justify-center bg-[#8bc34a] px-6 py-3 text-sm font-semibold text-white transition duration-300 group-hover:bg-[#7cb342]">
                                Book Now
                                <svg class="ml-2 h-4 w-4 transition duration-300 group-hover:translate-x-1" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                                </svg>
                            </span>
                        </div>

                    </a>
                @empty
                    <div class="col-span-full">
                        <div class="rounded-[2rem] border border-slate-200 bg-[#f7f7f7] p-10 text-center">
                            <div
                                class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-white text-[#8bc34a] shadow-sm">
                                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 6 7 17l-5-5" />
                                </svg>
                            </div>

                            <h3 class="mt-5 text-2xl font-serif text-slate-900">
                                No Services Available
                            </h3>

                            <p class="mt-3 text-slate-500 text-sm">
                                There are currently no services available at the moment.
                            </p>
                        </div>
                    </div>
                @endforelse

            </div>

        </div>
    </section>
@endsection
