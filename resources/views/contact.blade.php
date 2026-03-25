@extends('layouts.customer')

@section('title', 'Contact Us')

@section('content')
    <section class="relative h-[60vh] bg-cover bg-center md:bg-fixed flex items-center justify-center text-center"
        style="background-image: url('{{ asset('images/hero_bg_1.jpg') }}')">

        {{-- 不要暗的话就不要 overlay --}}
        {{-- <div class="absolute inset-0 bg-black/30"></div> --}}

        <div class="relative text-white px-4">

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-serif font-light drop-shadow-lg">
                Contact Us
            </h1>

        </div>

    </section>

    <section class="py-24 bg-[#f7f7f7]">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- LEFT: CONTACT FORM --}}
                <div class="lg:col-span-2 bg-white p-10">
                    <form action="" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-lg font-serif text-slate-900 mb-3">First Name</label>
                                <input type="text" name="first_name" placeholder="First Name"
                                    class="w-full border border-slate-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#8bc34a]/40 placeholder:text-slate-400">
                            </div>

                            <div>
                                <label class="block text-lg font-serif text-slate-900 mb-3">Last Name</label>
                                <input type="text" name="last_name" placeholder="Last Name"
                                    class="w-full border border-slate-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#8bc34a]/40 placeholder:text-slate-400">
                            </div>
                        </div>

                        <div>
                            <label class="block text-lg font-serif text-slate-900 mb-3">Email</label>
                            <input type="email" name="email" placeholder="Email Address"
                                class="w-full border border-slate-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#8bc34a]/40 placeholder:text-slate-400">
                        </div>

                        <div>
                            <label class="block text-lg font-serif text-slate-900 mb-3">Subject</label>
                            <input type="text" name="subject" placeholder="Subject"
                                class="w-full border border-slate-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#8bc34a]/40 placeholder:text-slate-400">
                        </div>

                        <div>
                            <label class="block text-lg font-serif text-slate-900 mb-3">Message</label>
                            <textarea name="message" rows="8" placeholder="Write your message here..."
                                class="w-full border border-slate-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#8bc34a]/40 placeholder:text-slate-400"></textarea>
                        </div>

                        <button type="submit"
                            class="bg-[#8bc34a] text-white px-8 py-3 font-semibold hover:bg-[#7cb342] transition">
                            Send Message
                        </button>
                    </form>
                </div>

                {{-- RIGHT: INFO BOXES --}}
                <div class="space-y-6">

                    <div class="bg-white p-8">
                        <h3 class="text-2xl font-bold text-slate-800 mb-4">Address</h3>
                        <p class="text-slate-600 leading-8">
                            203 Fake St. Mountain View, San Francisco,<br>
                            California, USA
                        </p>

                        <h3 class="text-2xl font-bold text-slate-800 mt-8 mb-4">Phone</h3>
                        <p class="text-[#8bc34a] text-lg">+1 232 3235 324</p>

                        <h3 class="text-2xl font-bold text-slate-800 mt-8 mb-4">Email Address</h3>
                        <p class="text-[#8bc34a] text-lg">youremail@domain.com</p>
                    </div>

                    <div class="bg-white p-8">
                        <h3 class="text-3xl font-serif text-slate-900 mb-4">More Info</h3>
                        <p class="text-slate-600 leading-8">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa ad iure porro mollitia
                            architecto hic consequuntur. Distinctio nisi perferendis dolore, ipsa consectetur?
                            Fugiat quaerat eos qui, libero neque sed nulla.
                        </p>

                        <div class="mt-8">
                            <a href="{{ route('about') }}"
                                class="inline-block bg-[#8bc34a] text-white px-8 py-3 font-semibold hover:bg-[#7cb342] transition">
                                Learn More
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
