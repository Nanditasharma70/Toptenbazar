   <header class="sticky top-0 z-20 bg-white shadow px-6 py-4 flex justify-between items-center space-x-4">
      <div class="flex items-center justify-between w-full ">
    <!-- Search Input -->
    <div class="relative w-full md:w-[70%]">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
            <i class="fas fa-search"></i> <!-- Font Awesome search icon -->
        </span>
        <input type="text" id="searchInput" placeholder="Search"
            class="w-full px-4 py-1 pl-10 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" />
    </div>

    <!-- Buttons -->
    <div class="flex items-center gap-4 ml-4">
        <button class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-gray-200">
            <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
        </button>
        <div>
            <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="User Avatar"
                class="w-10 h-10 rounded-full object-cover border-2 border-gray-300">
        </div>
    </div>
</div>

       <div>
           <button id="toggleSidebar" class=" text-[25px] text-gray-600 hover:text-black md:hidden">
               <i class="fa fa-bars" id="toggleIcon"></i>
           </button>
       </div>
   </header>
   <script>
document.addEventListener("DOMContentLoaded", function() {
    const toggleButton = document.getElementById("toggleSidebar");
    const toggleIcon = document.getElementById("toggleIcon");
    const sidebar = document.getElementById("sidebar");

    function updateIcon() {
        if (sidebar.classList.contains("-translate-x-full")) {
            toggleIcon.classList.remove("fa-times");
            toggleIcon.classList.add("fa-bars");
        } else {
            toggleIcon.classList.remove("fa-bars");
            toggleIcon.classList.add("fa-times");
        }
    }

    // Initial check on load
    updateIcon();

    toggleButton.addEventListener("click", function() {
        if (window.innerWidth < 768) {
            sidebar.classList.toggle("-translate-x-full");
            updateIcon();
        }
    });

    // Handle window resize
    window.addEventListener("resize", () => {
        if (window.innerWidth >= 768) {
            sidebar.classList.remove("-translate-x-full");
        } else {
            sidebar.classList.add("-translate-x-full");
        }
        updateIcon();
    });
});
   </script>