@extends('layouts.customer')

@section('title', 'Our Services')

@section('content')
    <section class="py-16 lg:py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl border border-slate-200 bg-white p-8 lg:p-10 shadow-sm">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-6">
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-black tracking-tight text-slate-900">
                            {{ $service->name }}
                        </h1>
                        <p class="mt-4 text-slate-600 leading-8">
                            {{ $service->description ?: 'No description available for this service yet.' }}
                        </p>
                    </div>

                    <div class="rounded-2xl bg-slate-50 border border-slate-200 p-5 min-w-[220px]">
                        <div class="text-xs uppercase tracking-[0.2em] font-bold text-slate-400">Price</div>
                        <div class="mt-1 text-2xl font-black text-sky-600">
                            RM {{ number_format($service->price, 2) }}
                        </div>

                        <div class="mt-5 text-xs uppercase tracking-[0.2em] font-bold text-slate-400">Duration</div>
                        <div class="mt-1 text-base font-bold text-slate-800">
                            {{ $service->duration }} minutes
                        </div>
                    </div>
                </div>

                <div class="mt-10">
                    @auth
                        <a href="{{ route('appointments.create', ['service_id' => $service->id]) }}"
                            class="inline-flex items-center rounded-2xl bg-slate-900 px-6 py-3 text-sm font-bold text-white hover:bg-slate-800">
                            Book This Service
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center rounded-2xl bg-slate-900 px-6 py-3 text-sm font-bold text-white hover:bg-slate-800">
                            Login to Book
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>
@endsection
