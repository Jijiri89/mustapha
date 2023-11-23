<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- ... (your existing head content) ... -->
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="antialiased">
<div>
    <nav class="bg-green-900" style="background-color: #00008B"
    >
        <div class="container mx-auto py-4">
            <div class="flex justify-between items-center">
                <img class="rounded-full h-16 w-16 ms-2" src="images/logo.PNG" alt="">
                <!-- Logo or Branding (if needed) -->
                <a href="#" class="text-white text-xl md:text-3xl font-bold">Rising Star 3 Enterprise</a>

                <!-- Mobile Menu Button (Hamburger Icon) -->
                <button id="mobile-menu-button" class="me-4 lg:hidden text-white hover:text-green-500 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>

                <!-- Navigation Links (hidden on mobile) -->
                <div class="hidden lg:flex space-x-4">
                    <a href="/" class="text-white hover:text-green-500 transition duration-300">Home</a>
                    <a href="/admin" class="text-white hover:text-green-500 transition duration-300">Login</a>
                    <a href="https://chat.whatsapp.com/BDSyPSS6j6zLEt4gFEHBM2" class="text-white hover:text-green-500 transition duration-300">Contact Us</a>
                    <!-- Add more menu items here as needed -->
                </div>
            </div>

            <!-- Mobile Menu (hidden on larger screens) -->
            <div class="lg:hidden mt-4  hidden" id="mobile-menu">
                <!-- Mobile Navigation Links (hidden on larger screens) -->
                <div class="flex flex-col space-y-2 m-8">
                    <a href="/" class="text-white hover:text-green-500 transition duration-300">Home</a>
                    <a href="/admin" class="text-white hover:text-green-500 transition duration-300">Login</a>
                    <a href="https://chat.whatsapp.com/BDSyPSS6j6zLEt4gFEHBM2" class="text-white hover:text-green-500 transition duration-300">Contact Us</a>
                    <!-- Add more menu items here as needed -->
                </div>
            </div>
        </div>
    </nav>

    <marquee class="bg-green-400 py-2 text-white text-3xl" behavior="" direction="">Rising Star 3 Enterprise - Laying a good Foundation Today for the better Building Tomorrow</marquee>

    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <!-- Blog Content Cards -->
        @foreach ($blog as $b)
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 mb-4">
            <p class="text-xl font-semibold text-green-800 dark:text-white mb-4">{{ $b->title }}</p>
            <p class="text-lg md:text-xl lg:text-2xl xl:text-3xl text-green-600 dark:text-gray-300"> {!! $b->content !!}</p>
        </div>
        @endforeach

        <!-- Image Cards -->
        <div class="flex flex-wrap -mx-2 md:-mx-4">
            <!-- Card 1 -->
            <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-4">
                <div class="bg-green-300 dark:bg-gray-800 shadow-lg rounded-lg p-6">
                    <div class="flex mb-4">
                        <div class="w-full h-32 md:h-auto mr-4">
                            <img src="{{ asset('images/buildind.jpg') }}" alt="Image 1" class="w-full h-full object-cover rounded">
                        </div>
                        <div class="flex-1">
                            <!-- Content goes here -->
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- ... (repeat for other image cards) ... -->
            <!-- Card 2 -->
<div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-4">
    <div class="bg-green-300 dark:bg-gray-800 shadow-lg rounded-lg p-6">
        <div class="flex mb-4">
            <div class="w-full h-32 md:h-auto mr-4">
                <img src="{{ asset('images/iron.jpg') }}" alt="Image 2" class="w-full h-full object-cover rounded">
            </div>
            <div class="flex-1">
                <!-- Content goes here -->
            </div>
        </div>
    </div>
</div>

<!-- Card 3 -->
<div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-4">
    <div class="bg-green-300 dark:bg-gray-800 shadow-lg rounded-lg p-6">
        <div class="flex mb-4">
            <div class="w-full h-32 md:h-auto mr-4">
                <img src="{{ asset('images/mat.jpg') }}" alt="Image 3" class="w-full h-full object-cover rounded">
            </div>
            <div class="flex-1">
                <!-- Content goes here -->
            </div>
        </div>
    </div>
</div>

<!-- Card 4 -->
<div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-4">
    <div class="bg-green-300 dark:bg-gray-800 shadow-lg rounded-lg p-6">
        <div class="flex mb-4">
            <div class="w-full h-32 md:h-auto mr-4">
                <img src="{{ asset('images/rof.jpg') }}" alt="Image 4" class="w-full h-full object-cover rounded">
            </div>
            <div class="flex-1">
                <!-- Content goes here -->
            </div>
        </div>
    </div>
</div>

<!-- Card 5 -->
<div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-4">
    <div class="bg-green-300 dark:bg-gray-800 shadow-lg rounded-lg p-6">
        <div class="flex mb-4">
            <div class="w-full h-32 md:h-auto mr-4">
                <img src="{{ asset('images/paint.jpg') }}" alt="Image 5" class="w-full h-full object-cover rounded">
            </div>
            <div class="flex-1">
                <!-- Content goes here -->
            </div>
        </div>
    </div>
</div>

<!-- Card 6 -->
<div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-4">
    <div class="bg-green-300 dark:bg-gray-800 shadow-lg rounded-lg p-6">
        <div class="flex mb-4">
            <div class="w-full h-32 md:h-auto mr-4">
                <img src="{{ asset('images/sh.jpg') }}" alt="Image 6" class="w-full h-full object-cover rounded">
            </div>
            <div class="flex-1">
                <!-- Content goes here -->
            </div>
        </div>
    </div>
</div>

        </div>
    </div>

    @include('footer')

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const mobileMenuButton = document.getElementById("mobile-menu-button");
            const mobileMenu = document.getElementById("mobile-menu");

            mobileMenuButton.addEventListener("click", function () {
                // Toggle the "hidden" class to show/hide the mobile menu
                if (mobileMenu.classList.contains("hidden")) {
                    mobileMenu.classList.remove("hidden");
                } else {
                    mobileMenu.classList.add("hidden");
                }
            });
        });
    </script>
</div>
</body>
</html>
