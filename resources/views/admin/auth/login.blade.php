<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#1B1725] text-white">
    <div class="relative min-h-screen overflow-hidden">
        {{-- Background Glow --}}
        <div
            class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(124,92,255,0.18),_transparent_35%),radial-gradient(circle_at_bottom_right,_rgba(124,92,255,0.12),_transparent_30%)]">
        </div>

        <div class="relative z-10 flex min-h-screen items-center justify-center px-4 py-6 sm:px-6 lg:px-8">
            <div
                class="w-full max-w-6xl rounded-[28px] border border-white/10 bg-white/[0.04] p-3 shadow-[0_25px_80px_rgba(0,0,0,0.45)] backdrop-blur-xl">

                <div class="grid overflow-hidden rounded-[24px] lg:grid-cols-[1.05fr_0.95fr]">
                    {{-- Left Visual Panel --}}
                    <div class="relative hidden min-h-[640px] overflow-hidden rounded-[20px] lg:block">
                        {{-- Background Image --}}
                        <img src="{{ asset('images/admin-login-cover.jpg') }}" alt="Admin Cover"
                            class="absolute inset-0 h-full w-full object-cover scale-[1.03]">

                        {{-- Dark / Purple Overlay --}}
                        <div
                            class="absolute inset-0 bg-gradient-to-b from-[#6D5BFF]/35 via-[#2A2140]/30 to-[#0E0B17]/80">
                        </div>

                        {{-- Soft Glow --}}
                        <div class="absolute -top-16 -left-10 h-56 w-56 rounded-full bg-[#7C5CFF]/25 blur-[100px]">
                        </div>
                        <div class="absolute bottom-0 right-0 h-56 w-56 rounded-full bg-[#4F46E5]/20 blur-[110px]">
                        </div>

                        {{-- Top Bar --}}
                        <div class="absolute left-0 right-0 top-0 z-20 flex items-center justify-between p-7">
                            <div>
                                <a href="{{ url('/') }}"
                                    class="inline-flex items-center text-xl font-black tracking-[0.2em] text-white drop-shadow">
                                    Extech Studio
                                </a>
                            </div>

                            <a href="{{ url('/') }}"
                                class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/10 px-4 py-2 text-xs font-semibold text-white/90 backdrop-blur-md transition hover:bg-white/15">
                                Back to website
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2"
                                        d="M5 12h14m-6-6 6 6-6 6" />
                                </svg>
                            </a>
                        </div>

                        {{-- Bottom Content --}}
                        <div class="absolute inset-x-0 bottom-0 z-20 p-8">
                            <div class="max-w-sm">
                                <h2 class="text-[2.2rem] font-light leading-[1.1] tracking-tight text-white">
                                    Secure Access,
                                    <br>
                                    Powerful Control
                                </h2>

                                <p class="mt-4 max-w-xs text-sm leading-6 text-white/70">
                                    Manage your appointment booking system with a secure, elegant, and modern admin
                                    experience.
                                </p>
                            </div>

                            
                        </div>
                    </div>
                    {{-- Right Form Panel --}}
                    <div class="flex min-h-[640px] items-center bg-[#241E31]/95 px-6 py-10 sm:px-10 lg:px-14 lg:py-14">
                        <div class="mx-auto w-full max-w-md">
                            {{-- Mobile Logo --}}
                            <div class="mb-8 flex items-center justify-between lg:hidden">
                                <a href="{{ url('/') }}"
                                    class="text-lg font-black tracking-[0.2em] text-white">Extech Studio</a>

                                <a href="{{ url('/') }}"
                                    class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/10 px-4 py-2 text-xs font-semibold text-white/90 backdrop-blur hover:bg-white/15 transition">
                                    Back
                                </a>
                            </div>

                            <div>
                                <h1 class="text-4xl font-semibold tracking-tight text-white sm:text-5xl">
                                    Admin Login
                                </h1>
                                <p class="mt-3 text-sm text-white/55">
                                    Enter your credentials to access the admin panel.
                                </p>
                            </div>

                            @if (session('status'))
                                <div
                                    class="mt-6 rounded-2xl border border-emerald-400/20 bg-emerald-400/10 px-4 py-3 text-sm text-emerald-200">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('admin.login.store') }}" class="mt-8 space-y-5">
                                @csrf

                                <div>
                                    <label class="mb-2 block text-sm font-medium text-white/80">Email</label>
                                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                                        placeholder="Enter your email"
                                        class="w-full rounded-xl border border-white/10 bg-white/[0.06] px-4 py-3.5 text-sm text-white placeholder:text-white/30 outline-none transition focus:border-[#8B7BFF] focus:bg-white/[0.08] focus:ring-0">
                                    @error('email')
                                        <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="mb-2 block text-sm font-medium text-white/80">Password</label>
                                    <input type="password" name="password" required placeholder="Enter your password"
                                        class="w-full rounded-xl border border-white/10 bg-white/[0.06] px-4 py-3.5 text-sm text-white placeholder:text-white/30 outline-none transition focus:border-[#8B7BFF] focus:bg-white/[0.08] focus:ring-0">
                                    @error('password')
                                        <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex items-center justify-between gap-4 pt-1">
                                    <label class="flex items-center gap-3 text-sm text-white/65">
                                        <input id="remember" type="checkbox" name="remember"
                                            class="h-4 w-4 rounded border-white/20 bg-white/5 text-[#8B7BFF] focus:ring-0">
                                        <span>Remember me</span>
                                    </label>

                                    <a href="#"
                                        class="text-sm font-medium text-white/55 underline underline-offset-4 hover:text-white">
                                        Forgot password?
                                    </a>
                                </div>

                                <button type="submit"
                                    class="w-full rounded-xl bg-[#7C5CFF] px-5 py-3.5 text-sm font-semibold text-white shadow-[0_12px_30px_rgba(124,92,255,0.35)] transition hover:bg-[#6f50f0]">
                                    Sign In
                                </button>
                            </form>

                            <div class="mt-8">
                                <div class="relative">
                                    <div class="absolute inset-0 flex items-center">
                                        <div class="w-full border-t border-white/10"></div>
                                    </div>
                                    <div class="relative flex justify-center">
                                        <span class="bg-[#241E31] px-4 text-xs text-white/35">Admin Access Only</span>
                                    </div>
                                </div>

                                <p class="mt-6 text-center text-sm text-white/40">
                                    Protected login for authorized administrators.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
