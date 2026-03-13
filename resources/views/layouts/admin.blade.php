<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel') | Appointment System</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://unpkg.com/lucide@latest"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="h-full bg-slate-50 text-slate-900 antialiased">
    <div class="flex min-h-screen" id="adminLayout">

        {{-- Mobile Overlay --}}
        <div id="mobileSidebarOverlay" class="fixed inset-0 z-40 bg-slate-950/50 backdrop-blur-sm hidden lg:hidden">
        </div>

        {{-- Desktop Sidebar --}}
        <aside class="fixed inset-y-0 left-0 z-50 w-72 bg-slate-950 text-white hidden lg:flex lg:flex-col shadow-2xl">
            <div class="px-8 py-8">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                    <div class="p-2 bg-indigo-600 rounded-lg group-hover:bg-indigo-500 transition-colors">
                        <i data-lucide="calendar-check-2" class="w-6 h-6 text-white"></i>
                    </div>
                    <div>
                        <span class="block text-lg font-bold leading-none tracking-tight">Admin<span
                                class="text-indigo-400">Hub</span></span>
                        <span class="text-[10px] uppercase tracking-[0.2em] text-slate-500 font-bold">Booking
                            System</span>
                    </div>
                </a>
            </div>

            <nav class="flex-1 px-4 space-y-1 overflow-y-auto custom-scrollbar">
                <div class="pb-4 pt-2">
                    <a href="{{ route('admin.dashboard') }}"
                        class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all
                        {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-900/20' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                        <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                        Dashboard
                    </a>
                </div>

                <div class="space-y-1">
                    <label
                        class="px-4 text-[10px] font-bold uppercase tracking-widest text-slate-500">Management</label>

                    <a href="{{ route('admin.appointments.index') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.appointments.index') ? 'bg-white/10 text-white border-l-4 border-indigo-500 rounded-l-none' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                        <i data-lucide="calendar-days" class="w-5 h-5"></i>
                        Appointments
                    </a>

                    <a href="{{ route('admin.appointments.calendar') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.appointments.calendar') ? 'bg-white/10 text-white border-l-4 border-indigo-500 rounded-l-none' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                        <i data-lucide="calendar-range" class="w-5 h-5"></i>
                        Calendar
                    </a>

                    <a href="{{ route('admin.customers.index') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.customers.*') ? 'bg-white/10 text-white border-l-4 border-indigo-500 rounded-l-none' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                        <i data-lucide="user-round" class="w-5 h-5"></i>
                        Customers
                    </a>
                </div>

                <div class="pt-6 space-y-1">
                    <label
                        class="px-4 text-[10px] font-bold uppercase tracking-widest text-slate-500">Configuration</label>

                    <a href="{{ route('admin.services.index') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.services.*') ? 'bg-white/10 text-white border-l-4 border-indigo-500 rounded-l-none' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                        <i data-lucide="package" class="w-5 h-5"></i>
                        Services
                    </a>

                    <a href="{{ route('admin.staff.index') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.staff.*') ? 'bg-white/10 text-white border-l-4 border-indigo-500 rounded-l-none' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                        <i data-lucide="users" class="w-5 h-5"></i>
                        Staff
                    </a>

                    <a href="{{ route('admin.business-hours.index') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.business-hours.*') ? 'bg-white/10 text-white border-l-4 border-indigo-500 rounded-l-none' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                        <i data-lucide="clock" class="w-5 h-5"></i>
                        Business Hours
                    </a>
                </div>
            </nav>

            <div class="p-4 mt-auto border-t border-white/5 space-y-1">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-400 hover:bg-white/5 hover:text-white transition-all">
                    <i data-lucide="external-link" class="w-5 h-5"></i>
                    Customer View
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-rose-400 hover:bg-rose-500/10 hover:text-rose-300 transition-all">
                        <i data-lucide="log-out" class="w-5 h-5"></i>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Mobile Sidebar --}}
        <aside id="mobileSidebar"
            class="fixed inset-y-0 left-0 z-50 w-72 max-w-[85vw] bg-slate-950 text-white flex flex-col shadow-2xl transform -translate-x-full transition-transform duration-300 ease-in-out lg:hidden">
            <div class="px-6 py-6 border-b border-white/5 flex items-center justify-between">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                    <div class="p-2 bg-indigo-600 rounded-lg">
                        <i data-lucide="calendar-check-2" class="w-5 h-5 text-white"></i>
                    </div>
                    <div>
                        <span class="block text-base font-bold leading-none tracking-tight">Admin<span
                                class="text-indigo-400">Hub</span></span>
                        <span class="text-[10px] uppercase tracking-[0.2em] text-slate-500 font-bold">Booking
                            System</span>
                    </div>
                </a>

                <button id="closeMobileSidebar"
                    class="h-10 w-10 rounded-xl bg-white/5 hover:bg-white/10 flex items-center justify-center transition">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
                <div class="pb-4 pt-2">
                    <a href="{{ route('admin.dashboard') }}"
                        class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all
                        {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-900/20' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                        <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                        Dashboard
                    </a>
                </div>

                <div class="space-y-1">
                    <label
                        class="px-4 text-[10px] font-bold uppercase tracking-widest text-slate-500">Management</label>

                    <a href="{{ route('admin.appointments.index') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.appointments.index') ? 'bg-white/10 text-white border-l-4 border-indigo-500 rounded-l-none' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                        <i data-lucide="calendar-days" class="w-5 h-5"></i>
                        Appointments
                    </a>

                    <a href="{{ route('admin.appointments.calendar') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.appointments.calendar') ? 'bg-white/10 text-white border-l-4 border-indigo-500 rounded-l-none' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                        <i data-lucide="calendar-range" class="w-5 h-5"></i>
                        Calendar
                    </a>

                    <a href="{{ route('admin.customers.index') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.customers.*') ? 'bg-white/10 text-white border-l-4 border-indigo-500 rounded-l-none' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                        <i data-lucide="user-round" class="w-5 h-5"></i>
                        Customers
                    </a>
                </div>

                <div class="pt-6 space-y-1">
                    <label
                        class="px-4 text-[10px] font-bold uppercase tracking-widest text-slate-500">Configuration</label>

                    <a href="{{ route('admin.services.index') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.services.*') ? 'bg-white/10 text-white border-l-4 border-indigo-500 rounded-l-none' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                        <i data-lucide="package" class="w-5 h-5"></i>
                        Services
                    </a>

                    <a href="{{ route('admin.staff.index') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.staff.*') ? 'bg-white/10 text-white border-l-4 border-indigo-500 rounded-l-none' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                        <i data-lucide="users" class="w-5 h-5"></i>
                        Staff
                    </a>

                    <a href="{{ route('admin.business-hours.index') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all {{ request()->routeIs('admin.business-hours.*') ? 'bg-white/10 text-white border-l-4 border-indigo-500 rounded-l-none' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                        <i data-lucide="clock" class="w-5 h-5"></i>
                        Business Hours
                    </a>
                </div>
            </nav>

            <div class="p-4 mt-auto border-t border-white/5 space-y-1">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-400 hover:bg-white/5 hover:text-white transition-all">
                    <i data-lucide="external-link" class="w-5 h-5"></i>
                    Customer View
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-rose-400 hover:bg-rose-500/10 hover:text-rose-300 transition-all">
                        <i data-lucide="log-out" class="w-5 h-5"></i>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 lg:ml-72 flex flex-col">

            <header class="sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-slate-200">
                <div class="px-4 sm:px-6 lg:px-10 py-4 flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3 min-w-0">
                        {{-- Mobile Menu Button --}}
                        <button id="openMobileSidebar"
                            class="lg:hidden h-11 w-11 rounded-xl border border-slate-200 bg-white flex items-center justify-center shadow-sm">
                            <i data-lucide="menu" class="w-5 h-5"></i>
                        </button>

                        <div class="min-w-0">
                            <h2 class="text-lg sm:text-xl font-bold text-slate-900 leading-tight truncate">
                                @yield('page_title', 'Admin Panel')
                            </h2>
                            <p class="text-[11px] sm:text-xs text-slate-500 font-medium mt-0.5 truncate">
                                @yield('page_description', 'Manage your booking system')
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 sm:gap-4 shrink-0">
                        <div class="hidden md:flex flex-col items-end">
                            <span class="text-sm font-semibold text-slate-900">{{ auth()->user()->name }}</span>
                            <span
                                class="text-[10px] font-bold text-emerald-600 uppercase tracking-tighter">Administrator</span>
                        </div>
                        <div
                            class="h-10 w-10 rounded-full bg-gradient-to-tr from-indigo-600 to-violet-500 flex items-center justify-center text-white font-bold shadow-inner">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                    </div>
                </div>
            </header>

            <main class="p-4 sm:p-6 lg:p-10 flex-1">
                @if (session('success'))
                    <div
                        class="mb-6 sm:mb-8 flex items-start sm:items-center gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 sm:px-5 py-4 text-emerald-800 shadow-sm animate-in fade-in slide-in-from-top-4 duration-300">
                        <i data-lucide="check-circle" class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5 sm:mt-0"></i>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="max-w-8xl mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
        lucide.createIcons();

        const mobileSidebar = document.getElementById('mobileSidebar');
        const mobileSidebarOverlay = document.getElementById('mobileSidebarOverlay');
        const openMobileSidebar = document.getElementById('openMobileSidebar');
        const closeMobileSidebar = document.getElementById('closeMobileSidebar');

        function openSidebar() {
            mobileSidebar.classList.remove('-translate-x-full');
            mobileSidebarOverlay.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeSidebar() {
            mobileSidebar.classList.add('-translate-x-full');
            mobileSidebarOverlay.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        if (openMobileSidebar) {
            openMobileSidebar.addEventListener('click', openSidebar);
        }

        if (closeMobileSidebar) {
            closeMobileSidebar.addEventListener('click', closeSidebar);
        }

        if (mobileSidebarOverlay) {
            mobileSidebarOverlay.addEventListener('click', closeSidebar);
        }

        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                closeSidebar();
            }
        });
    </script>
</body>

</html>
