<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex overflow-hidden">

        {{-- LEFT: FORM --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center bg-gray-100 px-6 py-12 min-h-screen">

            <div class="w-full max-w-md">

                {{-- Title --}}
                <h2 class="text-2xl font-semibold text-gray-900 mb-6">
                    Create Account
                </h2>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    {{-- Name --}}
                    <div class="space-y-1">
                        <label class="text-xs tracking-wider text-gray-400 uppercase">
                            Name
                        </label>

                        <input type="text" name="name" value="{{ old('name') }}" placeholder="John Tan"
                            class="w-full px-4 py-3 bg-white border border-gray-200 rounded-none
               focus:border-[#8bc34a] focus:ring-2 focus:ring-[#8bc34a]/20
               placeholder:text-gray-300
               transition duration-200 outline-none"
                            required autofocus>

                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

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

                    {{-- Confirm Password --}}
                    <div class="space-y-1">
                        <label class="text-xs tracking-wider text-gray-400 uppercase">
                            Confirm Password
                        </label>

                        <input type="password" name="password_confirmation" placeholder="••••••••"
                            class="w-full px-4 py-3 bg-white border border-gray-200 rounded-none
               focus:border-[#8bc34a] focus:ring-2 focus:ring-[#8bc34a]/20
               placeholder:text-gray-300
               transition duration-200 outline-none"
                            required>

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                    </div>

                    {{-- Button --}}
                    <button type="submit"
                        class="w-full bg-[#8bc34a] text-white py-3 rounded-none font-medium hover:bg-[#7cb342] transition">
                        Register
                    </button>

                    {{-- Divider --}}
                    <div class="flex items-center gap-3">
                        <div class="flex-1 h-px bg-gray-300"></div>
                        <span class="text-xs text-gray-400">OR</span>
                        <div class="flex-1 h-px bg-gray-300"></div>
                    </div>

                    {{-- Login --}}
                    <p class="text-sm text-center text-gray-500">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-[#8bc34a] font-medium hover:underline">
                            Log in
                        </a>
                    </p>

                </form>
            </div>
        </div>

        {{-- RIGHT: IMAGE --}}
        <div class="hidden lg:block w-1/2 h-screen">
            <img src="{{ asset('images/img_6.jpg') }}" class="w-full h-full object-cover" alt="register image">
        </div>

    </div>

</body>

</html>
