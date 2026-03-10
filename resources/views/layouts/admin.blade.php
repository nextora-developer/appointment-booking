<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 text-slate-900">
    <div class="min-h-screen flex">
        <aside class="w-72 bg-slate-900 text-white hidden lg:flex lg:flex-col">
            <div class="px-6 py-6 border-b border-white/10">
                <a href="{{ route('admin.dashboard') }}" class="text-xl font-black tracking-tight">
                    Admin Panel
                </a>
                <p class="mt-1 text-xs text-slate-400">Appointment Booking System</p>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center rounded-2xl px-4 py-3 text-sm font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-white text-slate-900' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    Dashboard
                </a>

                <a href="{{ route('admin.appointments.index') }}"
                    class="flex items-center rounded-2xl px-4 py-3 text-sm font-semibold transition {{ request()->routeIs('admin.appointments.*') ? 'bg-white text-slate-900' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    Appointments
                </a>

                <a href="{{ route('admin.services.index') }}"
                    class="flex items-center rounded-2xl px-4 py-3 text-sm font-semibold transition {{ request()->routeIs('admin.services.*') ? 'bg-white text-slate-900' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    Services
                </a>

                <a href="{{ route('admin.staff.index') }}"
                    class="flex items-center rounded-2xl px-4 py-3 text-sm font-semibold transition {{ request()->routeIs('admin.staff.*') ? 'bg-white text-slate-900' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    Staff
                </a>
            </nav>

            <div class="px-4 py-4 border-t border-white/10 space-y-2">
                <a href="{{ route('dashboard') }}"
                    class="block rounded-2xl px-4 py-3 text-sm font-semibold text-slate-300 hover:bg-white/10 hover:text-white">
                    Customer Dashboard
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left rounded-2xl px-4 py-3 text-sm font-semibold text-rose-300 hover:bg-rose-500/10 hover:text-rose-200">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1">
            <header class="bg-white border-b border-slate-200">
                <div class="px-6 lg:px-8 py-5 flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-black tracking-tight text-slate-900">
                            @yield('page_title', 'Admin Panel')
                        </h1>
                        <p class="mt-1 text-sm text-slate-500">@yield('page_description', 'Manage your booking system')</p>
                    </div>

                    <div class="text-sm text-slate-500 font-semibold">
                        {{ auth()->user()->name }}
                    </div>
                </div>
            </header>

            <main class="p-6 lg:p-8">
                @if (session('success'))
                    <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-700">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
