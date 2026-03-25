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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

                @forelse($services as $service)
                    <div class="bg-[#f7f7f7] p-10 text-center group transition hover:shadow-lg">

                        {{-- ICON（先统一，之后可做动态） --}}
                        <div class="text-[#8bc34a] mb-6 flex justify-center">
                            <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664" />
                            </svg>

                        </div>

                        {{-- TITLE --}}
                        <h3 class="text-xl font-serif text-slate-900 mb-3">
                            {{ $service->name }}
                        </h3>

                        {{-- DESCRIPTION --}}
                        <p class="text-slate-500 text-sm leading-relaxed">
                            {{ $service->description ?: 'No description available.' }}
                        </p>

                        {{-- PRICE --}}
                        <div class="mt-6 text-[#8bc34a] font-semibold">
                            RM {{ number_format($service->price, 2) }}
                        </div>

                    </div>
                @empty
                    <div class="col-span-full text-center text-slate-500">
                        No services available.
                    </div>
                @endforelse

            </div>
        </div>
    </section>
@endsection
