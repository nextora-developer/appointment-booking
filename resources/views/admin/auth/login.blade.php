<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-950 text-white">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md rounded-3xl border border-white/10 bg-white/5 backdrop-blur p-8 shadow-2xl">
            <div class="text-center">
                <div
                    class="inline-flex items-center rounded-full border border-sky-400/20 bg-sky-400/10 px-4 py-1 text-xs font-bold uppercase tracking-[0.25em] text-sky-300">
                    Admin Panel
                </div>

                <h1 class="mt-5 text-3xl font-black tracking-tight">
                    Admin Login
                </h1>

                <p class="mt-2 text-sm text-slate-300">
                    Sign in to manage the appointment booking system.
                </p>
            </div>

            <form method="POST" action="{{ route('admin.login.store') }}" class="mt-8 space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-slate-200">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder-slate-400 focus:border-sky-400 focus:ring-sky-400">
                    @error('email')
                        <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-200">Password</label>
                    <input type="password" name="password" required
                        class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder-slate-400 focus:border-sky-400 focus:ring-sky-400">
                    @error('password')
                        <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-3">
                    <input id="remember" type="checkbox" name="remember"
                        class="rounded border-white/20 bg-white/5 text-sky-500 focus:ring-sky-400">
                    <label for="remember" class="text-sm text-slate-300">Remember me</label>
                </div>

                <button type="submit"
                    class="w-full rounded-2xl bg-white px-5 py-3 text-sm font-black text-slate-900 hover:bg-slate-100 transition">
                    Sign In
                </button>
            </form>
        </div>
    </div>
</body>

</html>
