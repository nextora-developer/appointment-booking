<nav class="sticky top-0 z-50 border-b border-slate-200 bg-white/90 backdrop-blur">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="h-16 flex items-center justify-between">
            <div class="flex items-center gap-10">
                <a href="{{ route('home') }}" class="text-xl font-black tracking-tight text-slate-900">
                    BookEase
                </a>

                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('home') }}"
                        class="text-sm font-semibold {{ request()->routeIs('home') ? 'text-sky-600' : 'text-slate-600 hover:text-slate-900' }}">
                        Home
                    </a>

                    <a href="{{ route('services.index') }}"
                        class="text-sm font-semibold {{ request()->routeIs('services.*') ? 'text-sky-600' : 'text-slate-600 hover:text-slate-900' }}">
                        Services
                    </a>

                    <a href="{{ route('about') }}"
                        class="text-sm font-semibold {{ request()->routeIs('about') ? 'text-sky-600' : 'text-slate-600 hover:text-slate-900' }}">
                        About
                    </a>

                    <a href="{{ route('contact') }}"
                        class="text-sm font-semibold {{ request()->routeIs('contact') ? 'text-sky-600' : 'text-slate-600 hover:text-slate-900' }}">
                        Contact
                    </a>

                </div>
            </div>

            <div class="flex items-center gap-3">
                @guest
                    <a href="{{ route('login') }}"
                        class="hidden sm:inline-flex items-center rounded-xl px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                        class="hidden sm:inline-flex items-center rounded-xl px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">
                        Register
                    </a>

                    <a href="{{ route('login') }}"
                        class="inline-flex items-center rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">
                        Book Now
                    </a>
                @endguest

                @auth
                    <a href="{{ route('appointments.create') }}"
                        class="hidden sm:inline-flex items-center rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">
                        Book Now
                    </a>

                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                            <span>{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute right-0 mt-2 w-56 rounded-2xl border border-slate-200 bg-white shadow-xl overflow-hidden">
                            <a href="{{ route('dashboard') }}"
                                class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-50">
                                Dashboard
                            </a>
                            <a href="{{ route('appointments.index') }}"
                                class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-50">
                                My Appointments
                            </a>
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-50">
                                Profile
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-3 text-sm text-rose-600 hover:bg-rose-50">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
