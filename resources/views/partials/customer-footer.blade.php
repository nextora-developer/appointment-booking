<footer class="bg-[#2f2f2f] text-gray-400 py-20">
    <div class="max-w-7xl mx-auto px-6">

        {{-- TOP --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

            {{-- ABOUT --}}
            <div>
                <h3 class="text-white font-serif text-lg mb-6">
                    About BookEase
                </h3>

                <p class="text-sm leading-relaxed">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe pariatur
                    reprehenderit vero atque, consequatur id ratione, et non dignissimos culpa?
                    Ut veritatis, quos illum totam quis blanditiis, minima minus odio!
                </p>
            </div>


            {{-- QUICK MENU --}}
            <div>
                <h3 class="text-white font-serif text-lg mb-6">
                    Quick Menu
                </h3>

                <div class="grid grid-cols-2 gap-6 text-sm">

                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="hover:text-white">Home</a></li>
                        <li><a href="#" class="hover:text-white">Services</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white">About Us</a></li>
                        <li><a href="#" class="hover:text-white">Book Online</a></li>
                    </ul>

                    <ul class="space-y-2">
                        <li><a href="{{ route('contact') }}" class="hover:text-white">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white">Term and Conditions</a></li>
                        <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
                    </ul>

                </div>
            </div>


            {{-- NEWSLETTER --}}
            <div>
                <h3 class="text-white font-serif text-lg mb-4">
                    Subscribe Newsletter
                </h3>

                <p class="text-sm mb-6">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit minima minus odio.
                </p>

                <div class="flex">
                    <input type="text" placeholder="Enter Email"
                        class="w-full px-4 py-2 bg-transparent border border-white/20 text-white placeholder-gray-500 focus:outline-none">

                    <button class="bg-[#8bc34a] px-6 text-white font-semibold hover:opacity-90 transition">
                        Send
                    </button>
                </div>
            </div>

        </div>


        {{-- SOCIAL --}}
        <div class="mt-16 flex justify-center gap-6 text-gray-400">
            <a href="#" class="hover:text-white transition-colors" aria-label="Facebook">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" />
                </svg>
            </a>

            <a href="#" class="hover:text-white transition-colors" aria-label="X">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M18.901 1.153h3.68l-8.04 9.19L24 22.846h-7.406l-5.8-7.584-6.638 7.584H.474l8.6-9.83L0 1.154h7.594l5.243 6.932L18.901 1.153zM17.61 20.644h2.039L6.486 3.24H4.298L17.61 20.644z" />
                </svg>
            </a>

            <a href="#" class="hover:text-white transition-colors" aria-label="Instagram">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.981 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                </svg>
            </a>

            <a href="#" class="hover:text-white transition-colors" aria-label="LinkedIn">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                </svg>
            </a>
        </div>


        {{-- COPYRIGHT --}}
        <div class="mt-8 text-center text-sm text-gray-500">
            © {{ date('Y') }} All rights reserved | Designed by Extech Studio
        </div>

    </div>
</footer>
