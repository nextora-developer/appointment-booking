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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
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
        <div x-show="mobileOpen" x-transition.origin.top @click.away="mobileOpen = false"
            class="md:hidden pt-3 pb-4 border-t border-slate-200">

            <div class="flex flex-col">

                <a href="{{ route('home') }}"
                    class="px-2 py-3 text-sm font-semibold {{ request()->routeIs('home') ? 'text-[#8bc34a]' : 'text-slate-700' }}">
                    HOME
                </a>

                <a href="{{ route('services.index') }}"
                    class="px-2 py-3 text-sm font-semibold {{ request()->routeIs('services.*') ? 'text-[#8bc34a]' : 'text-slate-700' }}">
                    SERVICES
                </a>

                <a href="{{ route('about') }}"
                    class="px-2 py-3 text-sm font-semibold {{ request()->routeIs('about') ? 'text-[#8bc34a]' : 'text-slate-700' }}">
                    ABOUT
                </a>

                <a href="{{ route('appointments.create') }}"
                    class="px-2 py-3 text-sm font-semibold {{ request()->routeIs('appointments.create') ? 'text-[#8bc34a]' : 'text-slate-700' }}">
                    BOOK ONLINE
                </a>

                <a href="{{ route('contact') }}"
                    class="px-2 py-3 text-sm font-semibold {{ request()->routeIs('contact') ? 'text-[#8bc34a]' : 'text-slate-700' }}">
                    CONTACT
                </a>

                <div class="mt-3 pt-3 border-t border-slate-200">
                    @guest
                        <a href="{{ route('login') }}"
                            class="block w-full text-center px-4 py-3 bg-black text-white text-sm font-semibold rounded-xl border border-black hover:bg-white hover:text-black transition">
                            Login
                        </a>
                    @endguest

                    @auth
                        <div class="px-2 pb-2 text-sm font-semibold text-slate-900">
                            {{ auth()->user()->name }}
                        </div>

                        <a href="{{ route('dashboard') }}" class="block px-2 py-3 text-sm text-slate-700">
                            Dashboard
                        </a>

                        <a href="{{ route('appointments.index') }}" class="block px-2 py-3 text-sm text-slate-700">
                            My Appointments
                        </a>

                        <a href="{{ route('profile.edit') }}" class="block px-2 py-3 text-sm text-slate-700">
                            Profile
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-2 py-3 text-sm text-red-600">
                                Logout
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>