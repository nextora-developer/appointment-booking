@extends('layouts.customer')

@section('title', 'Contact Us')

@section('content')
    <section class="py-16 lg:py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl border border-slate-200 bg-white p-8 lg:p-10 shadow-sm">
                <h1 class="text-3xl lg:text-4xl font-black tracking-tight text-slate-900">Contact Us</h1>

                <div class="mt-8 space-y-4 text-slate-600">
                    <div><span class="font-bold text-slate-900">Phone:</span> +60 12-345 6789</div>
                    <div><span class="font-bold text-slate-900">Email:</span> hello@example.com</div>
                    <div><span class="font-bold text-slate-900">Address:</span> Kuala Lumpur, Malaysia</div>
                    <div><span class="font-bold text-slate-900">Business Hours:</span> Monday - Saturday, 9:00 AM - 6:00 PM
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
