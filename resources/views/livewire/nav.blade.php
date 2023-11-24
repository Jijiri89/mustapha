<div>
    <nav class="fixed top-0 left-0 w-full bg-yellow-900 text-white py-4 z-10">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo or Branding (if needed) -->
            <a href="#" class="flex text-center">
                <span class="text-white text-2xl mx-3 font-bold">JAZAKH-ALLAH VENTURES</span>
            </a>

            <!-- Mobile Menu Button (Hamburger Icon) -->
            <button id="mobile-menu-button" class=" mx-2 lg:hidden text-white hover:text-green-500 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>

            <!-- Navigation Links (hidden on mobile) -->
            <div id="mobile-menu" class="lg:hidden space-x-4 hidden">
                <div class="relative">
                    <button
                        class="text-white mx-3 hover:text-green-500 transition duration-300 focus:outline-none"
                        id="mobile-menu-dropdown"
                    >
                        Menu
                    </button>
                    <div
                        class="absolute right-0 mt-2 w-48 bg-white border rounded-md shadow-lg hidden"
                        id="mobile-menu-dropdown-content"
                    >
                        <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Home</a>
                        <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">About</a>
                        <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Login</a>
                        <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Contact</a>
                    </div>
                </div>
            </div>

            <!-- Desktop Menu (visible on larger screens) -->
            <div class="hidden lg:flex space-x-4">
                <a href="#" class="text-white hover:text-green-500 transition duration-300">Home</a>
                <a href="#" class="text-white hover:text-green-500 transition duration-300">About</a>
                <a href="#" class="text-white hover:text-green-500 transition duration-300">Login</a>
                <a href="#" class="text-white hover:text-green-500 transition duration-300">Contact</a>
            </div>
        </div>
    </nav>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const mobileMenuButton = document.getElementById("mobile-menu-button");
        const mobileMenu = document.getElementById("mobile-menu");
        const mobileMenuDropdown = document.getElementById("mobile-menu-dropdown");
        const mobileMenuDropdownContent = document.getElementById("mobile-menu-dropdown-content");

        mobileMenuButton.addEventListener("click", function () {
            // Toggle the 'hidden' class to show/hide the mobile menu
            mobileMenu.classList.toggle("hidden");
        });

        mobileMenuDropdown.addEventListener("click", function () {
            // Toggle the 'hidden' class to show/hide the mobile menu dropdown
            mobileMenuDropdownContent.classList.toggle("hidden");
        });
    });
</script>
