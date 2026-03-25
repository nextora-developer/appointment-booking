@extends('layouts.customer')

@section('title', 'About Us')

@section('content')
    <section class="relative h-[60vh] bg-cover bg-center md:bg-fixed flex items-center justify-center text-center"
        style="background-image: url('{{ asset('images/hero_bg_1.jpg') }}')">

        {{-- 不要暗的话就不要 overlay --}}
        {{-- <div class="absolute inset-0 bg-black/30"></div> --}}

        <div class="relative text-white px-4">

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-serif font-light drop-shadow-lg">
                About Us
            </h1>

        </div>

    </section>

    <section class="py-24 bg-[#f7f7f7]">
        <div class="max-w-7xl mx-auto px-6">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                {{-- LEFT: IMAGE --}}
                <div class="overflow-hidden">
                    <img src="{{ asset('images/img_5.jpg') }}"
                        class="w-full h-[300px] sm:h-[400px] md:h-[500px] object-cover transition duration-500 hover:scale-105">
                </div>

                {{-- RIGHT: TEXT --}}
                <div>

                    <h2 class="text-4xl md:text-5xl font-serif text-slate-900 leading-tight">
                        Our Story
                    </h2>

                    <div class="w-12 h-[2px] bg-[#8bc34a] mt-4 mb-6"></div>

                    <p class="text-slate-600 leading-8">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Quisquam, voluptatum. Harum, vel! Ratione, explicabo.
                        Tempora nemo maxime veniam, fugiat odio nam eveniet ipsam
                        atque, corrupti porro.
                    </p>

                    <p class="mt-6 text-slate-600 leading-8">
                        Our salon has been dedicated to delivering exceptional
                        hair styling services, combining modern techniques with
                        classic styles to bring out the best in every client.
                    </p>

                    {{-- CTA --}}
                    <div class="mt-8">
                        <a href="{{ route('services.index') }}"
                            class="px-6 py-3 border border-[#8bc34a] text-[#8bc34a] font-semibold
                               hover:bg-[#8bc34a] hover:text-white transition">
                            Explore Services
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">

            {{-- TITLE --}}
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-serif text-slate-900">
                    Our Barbers
                </h2>
                <div class="w-12 h-[2px] bg-[#8bc34a] mx-auto mt-4"></div>
            </div>

            {{-- TEAM --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">

                @forelse($staffMembers as $staff)
                    <div>
                        <div class="flex justify-center">
                            @if ($staff->image)
                                <img src="{{ asset('storage/' . $staff->image) }}" alt="{{ $staff->user->name }}"
                                    class="w-44 h-44 rounded-full object-cover">
                            @else
                                {{-- fallback --}}
                                <div class="w-44 h-44 rounded-full bg-[#8bc34a]/10 flex items-center justify-center">
                                    <span class="text-4xl font-bold text-[#8bc34a]">
                                        {{ strtoupper(substr($staff->user->name ?? '?', 0, 1)) }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <h3 class="mt-6 text-2xl font-serif text-slate-900">
                            {{ $staff->user->name }}
                        </h3>

                        <p class="mt-6 text-slate-500 leading-9 max-w-sm mx-auto">
                            {{ $staff->bio ?? 'Professional barber with years of experience.' }}
                        </p>

                        <div class="mt-8 flex justify-center gap-6 text-[#8bc34a]">
                            {{-- 你以后可以换成真实 social --}}
                            <a href="#" class="hover:opacity-70 transition">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23 3..." />
                                </svg>
                            </a>
                            <a href="#" class="hover:opacity-70 transition">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M7 2..." />
                                </svg>
                            </a>
                            <a href="#" class="hover:opacity-70 transition">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22 12..." />
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="col-span-3 text-gray-400 text-center">
                        No staff available
                    </p>
                @endforelse

            </div>
        </div>
    </section>
@endsection
