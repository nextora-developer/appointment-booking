<nav x-data="{ mobileOpen: false, profileOpen: false }" class="sticky top-0 z-50 bg-white border-b border-slate-200">
    <div class="mx-auto px-4 sm:px-6 py-2">
        <div class="flex items-center justify-between h-16">

            {{-- LEFT: LOGO --}}
            <div class="text-2xl font-serif text-slate-900">
                <a href="{{ route('home') }}">BookEase</a>
            </div>

            {{-- DESKTOP MENU --}}
            <div class="hidden md:flex items-center gap-8 text-sm font-semibold tracking-wide">

                <a href="{{ route('home') }}"
                    class="{{ request()->routeIs('home') ? 'text-[#8bc34a]' : 'text-slate-700 hover:text-black' }}">
                    HOME
                </a>

                <a href="{{ route('services.index') }}"
                    class="{{ request()->routeIs('services.*') ? 'text-[#8bc34a]' : 'text-slate-700 hover:text-black' }}">
                    SERVICES
                </a>

                <a href="{{ route('about') }}"
                    class="{{ request()->routeIs('about') ? 'text-[#8bc34a]' : 'text-slate-700 hover:text-black' }}">
                    ABOUT
                </a>

                <a href="{{ route('appointments.create') }}"
                    class="{{ request()->routeIs('appointments.create') ? 'text-[#8bc34a]' : 'text-slate-700 hover:text-black' }}">
                    BOOK ONLINE
                </a>

                <a href="{{ route('contact') }}"
                    class="{{ request()->routeIs('contact') ? 'text-[#8bc34a]' : 'text-slate-700 hover:text-black' }}">
                    CONTACT
                </a>

            </div>

            {{-- RIGHT --}}
            <div class="flex items-center gap-3">

                {{-- DESKTOP GUEST --}}
                @guest
                    <a href="{{ route('login') }}"
                        class="hidden md:inline-flex px-4 py-2 bg-black text-white text-sm font-semibold hover:bg-white hover:text-black border border-black transition duration-300">
                        Login
                    </a>
                @endguest

                {{-- DESKTOP AUTH --}}
                @auth
                    <div class="hidden md:block relative">
                        <button @click="profileOpen = !profileOpen"
                            class="flex items-center gap-2 text-sm font-semibold text-slate-700 hover:text-black transition">
                            <span>{{ auth()->user()->name }}</span>

                            <svg class="w-4 h-4 transition-transform" :class="profileOpen ? 'rotate-180' : ''"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="profileOpen" @click.away="profileOpen = false" x-transition
                            class="absolute right-0 mt-3 w-48 bg-white border border-slate-200 shadow-lg rounded-xl overflow-hidden">

                            <a href="{{ route('dashboard') }}" class="block px-4 py-3 text-sm hover:bg-slate-50">
                                Dashboard
                            </a>

                            <a href="{{ route('appointments.index') }}" class="block px-4 py-3 text-sm hover:bg-slate-50">
                                My Appointments
                            </a>

                            <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-sm hover:bg-slate-50">
                                Profile
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth

                {{-- MOBILE HAMBURGER --}}
                <button @click="mobileOpen = !mobileOpen"
                    class="md:hidden inline-flex items-center justify-center w-11 h-11 rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-50 transition">
                    <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>

                    <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

            </div>
        </div>

        {{-- MOBILE MENU --}}
        <div x-show="mobileOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            x-cloak
            class="md:hidden fixed inset-x-0 top-[73px] bg-white/95 backdrop-blur-xl shadow-2xl border-b border-slate-200 overflow-hidden z-40">

            <div class="px-4 pt-2 pb-6">
                {{-- Navigation Links Section --}}
                <div class="space-y-1">
                    @php
                        $navItems = [
                            [
                                'name' => 'Home',
                                'route' => 'home',
                                'icon' =>
                                    'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
                            ],
                            [
                                'name' => 'Services',
                                'route' => 'services.index',
                                'icon' =>
                                    'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745V6c0-1.105.895-2 2-2h14c1.105 0 2 .895 2 2v7.255z',
                            ],
                            [
                                'name' => 'About',
                                'route' => 'about',
                                'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                            ],
                            [
                                'name' => 'Contact',
                                'route' => 'contact',
                                'icon' =>
                                    'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                            ],
                        ];
                    @endphp

                    @foreach ($navItems as $item)
                        <a href="{{ route($item['route']) }}"
                            class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 
                   {{ request()->routeIs($item['route']) ? 'bg-[#8bc34a]/10 text-[#8bc34a]' : 'text-slate-600 active:bg-slate-50' }}">
                            <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="{{ $item['icon'] }}" />
                            </svg>
                            <span class="text-sm font-bold tracking-wide uppercase">{{ $item['name'] }}</span>
                        </a>
                    @endforeach

                    {{-- Special CTA for Booking --}}
                    <a href="{{ route('appointments.create') }}"
                        class="flex items-center gap-4 px-4 py-4 mt-2 rounded-2xl bg-slate-900 text-white shadow-lg shadow-slate-200">
                        <svg class="w-5 h-5 text-[#8bc34a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-sm font-bold tracking-wide uppercase">Book Online</span>
                    </a>
                </div>

                {{-- Auth Section --}}
                <div class="mt-2 pt-2 border-t border-slate-100">
                    @guest
                        <a href="{{ route('login') }}"
                            class="flex items-center justify-center w-full py-3.5 text-sm font-semibold text-white bg-[#8bc34a] rounded-xl shadow hover:opacity-90 transition">
                            Login
                        </a>
                    @endguest

                    @auth
                        {{-- User "Card" --}}
                        <div class="bg-slate-50 rounded-3xl p-4">
                            <div class="flex items-center gap-3 mb-4 px-2">
                                <div
                                    class="w-10 h-10 rounded-full bg-[#8bc34a] flex items-center justify-center text-white font-bold">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-900">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-slate-500">{{ auth()->user()->email }}</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-2">
                                <a href="{{ route('dashboard') }}"
                                    class="flex items-center justify-center py-3 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-700 hover:border-[#8bc34a]/30 hover:text-[#8bc34a] transition">
                                    Dashboard
                                </a>

                                <a href="{{ route('profile.edit') }}"
                                    class="flex items-center justify-center py-3 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-700 hover:border-[#8bc34a]/30 hover:text-[#8bc34a] transition">
                                    My Profile
                                </a>

                                <a href="{{ route('appointments.index') }}"
                                    class="col-span-2 flex items-center justify-center py-3 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-700 hover:border-[#8bc34a]/30 hover:text-[#8bc34a] transition">
                                    My Bookings
                                </a>
                            </div>

                            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                                @csrf
                                <button type="submit"
                                    class="w-full py-3 text-xs font-bold text-red-500 hover:bg-red-50 rounded-xl transition">
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>
