@extends('layouts.customer')

@section('title', 'Our Services')

@section('content')
    <section class="py-16 lg:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl">
                <h1 class="text-3xl lg:text-4xl font-black tracking-tight text-slate-900">Our Services</h1>
                <p class="mt-3 text-slate-600">
                    Browse our available services and choose the option that suits your needs best.
                </p>
            </div>

            <div class="mt-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($services as $service)
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h2 class="text-xl font-black text-slate-900">{{ $service->name }}</h2>

                        <p class="mt-3 text-sm text-slate-600 leading-7">
                            {{ $service->description ?: 'No description available for this service yet.' }}
                        </p>

                        <div class="mt-6 flex items-center justify-between">
                            <div>
                                <div class="text-xs uppercase tracking-[0.2em] font-bold text-slate-400">Price</div>
                                <div class="mt-1 text-lg font-black text-sky-600">
                                    RM {{ number_format($service->price, 2) }}
                                </div>
                            </div>

                            <div class="text-right">
                                <div class="text-xs uppercase tracking-[0.2em] font-bold text-slate-400">Duration</div>
                                <div class="mt-1 text-sm font-bold text-slate-700">
                                    {{ $service->duration }} mins
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center gap-3">
                            <a href="{{ route('services.show', $service) }}"
                                class="inline-flex items-center rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                                View Details
                            </a>

                            @auth
                                <a href="{{ route('appointments.create', ['service_id' => $service->id]) }}"
                                    class="inline-flex items-center rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">
                                    Book Now
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="inline-flex items-center rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">
                                    Book Now
                                </a>
                            @endauth
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-full rounded-3xl border border-slate-200 bg-white p-8 text-center text-slate-500 shadow-sm">
                        No services available at the moment.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
