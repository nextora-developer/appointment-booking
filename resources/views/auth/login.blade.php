<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex overflow-hidden">

        {{-- LEFT: FORM --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center bg-gray-100 px-6 py-12 min-h-screen">

            <a href="{{ route('home') }}"
                class="absolute top-6 left-6 w-10 h-10 flex items-center justify-center
          border border-gray-300 hover:border-[#8bc34a]
          text-gray-500 hover:text-[#8bc34a] transition">

                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>

            <div class="w-full max-w-md">

                {{-- Title --}}
                <h2 class="text-2xl font-semibold text-gray-900 mb-6">
                    Welcome Back
                </h2>

                {{-- Session Status --}}
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div class="space-y-1">
                        <label class="text-xs tracking-wider text-gray-400 uppercase">
                            Email address
                        </label>

                        <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com"
                            class="w-full px-4 py-3 bg-white border border-gray-200 rounded-none
           focus:border-[#8bc34a] focus:ring-2 focus:ring-[#8bc34a]/20
           placeholder:text-gray-300
           transition duration-200 outline-none"
                            required>

                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    {{-- Password --}}
                    <div class="space-y-1">
                        <label class="text-xs tracking-wider text-gray-400 uppercase">
                            Password
                        </label>

                        <input type="password" name="password" placeholder="••••••••"
                            class="w-full px-4 py-3 bg-white border border-gray-200 rounded-none
           focus:border-[#8bc34a] focus:ring-2 focus:ring-[#8bc34a]/20
           placeholder:text-gray-300
           transition duration-200 outline-none"
                            required>

                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    {{-- Remember --}}
                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="remember"
                                class="rounded-none border-gray-300 text-[#8bc34a] focus:ring-[#8bc34a]">
                            Remember me
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-gray-500 hover:text-black">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    {{-- Button --}}
                    <button type="submit"
                        class="w-full bg-[#8bc34a] text-white py-2 rounded-none font-medium hover:bg-[#7cb342] transition">
                        Log in
                    </button>

                    {{-- Divider --}}
                    <div class="flex items-center gap-3">
                        <div class="flex-1 h-px bg-gray-300"></div>
                        <span class="text-xs text-gray-400">OR</span>
                        <div class="flex-1 h-px bg-gray-300"></div>
                    </div>

                    {{-- Register --}}
                    <p class="text-sm text-center text-gray-500">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-[#8bc34a] font-medium hover:underline">
                            Sign up
                        </a>
                    </p>
                </form>
            </div>
        </div>


        {{-- RIGHT: IMAGE --}}
        <div class="hidden lg:block w-1/2 h-screen">
            <img src="{{ asset('images/img_6.jpg') }}" class="w-full h-full object-cover" alt="login image">
        </div>

    </div>

</body>

</html>
