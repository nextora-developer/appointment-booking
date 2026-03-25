@extends('layouts.customer')

@section('title', 'Profile')

@section('content')
    <section class="bg-[#f8faf7] py-16 lg:py-20">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                <div>
                    {{-- <div class="text-xs font-semibold uppercase tracking-[0.25em] text-[#8bc34a]">
                        Appointment History
                    </div> --}}

                    <h1 class="mt-2 text-3xl lg:text-4xl font-serif text-slate-900">
                        My Profile
                    </h1>

                    <p class="mt-3 text-slate-600">
                        View your upcoming bookings and past salon visits.
                    </p>
                </div>

            </div>

            <div class="mt-10 space-y-6">

                {{-- PROFILE INFO --}}
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 sm:p-8 shadow-sm">
                    <div class="max-w-5xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection