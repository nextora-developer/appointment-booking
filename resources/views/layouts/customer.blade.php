<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Appointment Booking System')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-900 min-h-screen">
    @include('partials.customer-navbar')

    <main>
        @yield('content')
    </main>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: @json(session('success')),
                    confirmButtonColor: '#8bc34a'
                });
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: @json(session('error')),
                    confirmButtonColor: '#8bc34a'
                });
            });
        </script>
    @endif

    @include('partials.customer-footer')

    <button id="scrollTopBtn"
        class="fixed bottom-6 right-6 z-50 hidden items-center justify-center 
           w-12 h-12 rounded-full bg-[#8bc34a] text-white shadow-lg 
           hover:bg-[#7cb342] transition-all duration-300">

        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
        </svg>

    </button>
</body>

<script>
    const scrollBtn = document.getElementById('scrollTopBtn');

    // 滚动时显示按钮
    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            scrollBtn.classList.remove('hidden');
            scrollBtn.classList.add('flex');
        } else {
            scrollBtn.classList.add('hidden');
            scrollBtn.classList.remove('flex');
        }
    });

    // 点击回到顶部
    scrollBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>

</html>
