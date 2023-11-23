<nav class="fixed top-0 left-0 w-full bg-green-900 text-white py-4 z-10">
  <div class="container mx-auto flex justify-between items-center">
      <!-- Logo or Branding (if needed) -->
      <a href="#" class="text-white text-2xl font-bold">My Website</a>

      <!-- Mobile Menu Button (Hamburger Icon) -->
      <button id="mobile-menu-button" class="lg:hidden text-white hover:text-green-500 focus:outline-none">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
          </svg>
      </button>

      <!-- Navigation Links (hidden on mobile) -->
      <div class="hidden lg:flex space-x-4">
          <a href="#" class="text-white hover:text-green-500 transition duration-300">Home</a>
          <a href="#" class="text-white hover:text-green-500 transition duration-300">About</a>
          <a href="#" class="text-white hover:text-green-500 transition duration-300">Services</a>
          <a href="#" class="text-white hover:text-green-500 transition duration-300">Portfolio</a>
          <a href="#" class="text-white hover:text-green-500 transition duration-300">Contact</a>
      </div>
  </div>
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
</nav>