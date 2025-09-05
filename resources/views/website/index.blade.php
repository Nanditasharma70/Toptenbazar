<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<script src="https://cdn.tailwindcss.com"></script>
    <style>
        body{
            font-family: 'Poppins', sans-serif;
        }
        html {
            scroll-behavior: smooth;
        }
    </style>

</head>

<body class="bg-white w-full font-headingfont">
 <!-- Navbar -->
<nav class="sticky top-0 z-50 bg-white/95 px-4 sm:px-6 lg:px-8">
  <div class="flex justify-between items-center max-w-[1600px] mx-auto w-[100%] py-5 md:py-4">

    <!-- Logo -->
    <div class="flex items-center">
      <img src="{{ asset('assets/images/logo.png') }}" 
           alt="Logo" 
           class="h-10 sm:h-12 md:h-14 lg:h-16 w-auto border-none" />
    </div>

    <!-- Desktop Menu -->
    <div class="hidden md:flex space-x-8 items-center font-medium text-base lg:text-lg">
      <a href="#" class="text-green-600 py-6 hover:text-green-700 transition">Home</a>
      <a href="#why" class="text-gray-700 py-6 hover:text-green-600 transition">Why Choose Us</a>
      <a href="#about" class="text-gray-700 py-6 hover:text-green-600 transition">About Us</a>
      <a href="#testimonial" class="text-gray-700 py-6 hover:text-green-600 transition">Testimonials</a>
      <a href="#contact" class="text-gray-700 py-6 hover:text-green-600 transition">Contact Us</a>
    </div>

    <!-- Mobile Button -->
    <div class="md:hidden">
      <button id="menu-btn" class="text-gray-700 focus:outline-none" aria-label="Open menu">
        <!-- Hamburger -->
        <svg id="hamburger" class="w-7 h-7 block" fill="none" stroke="currentColor" stroke-width="2"
          viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <!-- Close -->
        <svg id="close-icon" class="w-7 h-7 hidden" fill="none" stroke="currentColor" stroke-width="2"
          viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
  </div>
</nav>

<!-- Overlay -->
<div id="overlay" class="fixed inset-0 bg-black/40 hidden z-40"></div>

<!-- Mobile Menu Drawer -->
<div id="mobile-menu"
  class="fixed top-0 right-0 h-full w-3/4 max-w-xs bg-white translate-x-full 
  transition-transform duration-500 ease-in-out z-50 flex flex-col shadow-lg will-change-transform">

  <!-- Drawer Header -->
  <div class="flex justify-end items-center p-4">
    <button id="drawer-close" class="text-gray-700 focus:outline-none" aria-label="Close menu">
      <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
  </div>

  <!-- Links -->
  <div class="flex flex-col space-y-6 p-6 font-medium text-lg">
    <a href="#" class="text-green-600 hover:text-green-700 transition">Home</a>
    <a href="#why" class="text-gray-700 hover:text-green-600 transition">Why Choose Us</a>
    <a href="#about" class="text-gray-700 hover:text-green-600 transition">About Us</a>
    <a href="#testimonial" class="text-gray-700 hover:text-green-600 transition">Testimonials</a>
    <a href="#contact" class="text-gray-700 hover:text-green-600 transition">Contact Us</a>
  </div>
</div>


    <script>
        const menuBtn = document.getElementById("menu-btn");
        const mobileMenu = document.getElementById("mobile-menu");
        const hamburger = document.getElementById("hamburger");
        const closeIcon = document.getElementById("close-icon");
        const drawerClose = document.getElementById("drawer-close");
        const overlay = document.getElementById("overlay");

        function openMenu() {
            mobileMenu.classList.replace("translate-x-full", "translate-x-0");
            overlay.classList.remove("hidden");
            document.body.classList.add("overflow-hidden");
            hamburger.classList.add("hidden");
            closeIcon.classList.remove("hidden");
        }

        function closeMenu() {
            mobileMenu.classList.replace("translate-x-0", "translate-x-full");
            overlay.classList.add("hidden");
            document.body.classList.remove("overflow-hidden");
            hamburger.classList.remove("hidden");
            closeIcon.classList.add("hidden");
        }

        menuBtn.addEventListener("click", () => {
            const isOpen = !mobileMenu.classList.contains("translate-x-full");
            isOpen ? closeMenu() : openMenu();
        });

        drawerClose.addEventListener("click", closeMenu);
        overlay.addEventListener("click", closeMenu);

        // Close menu + set active when link is clicked
        const menuLinks = document.querySelectorAll("#mobile-menu a, nav .md\\:flex a");

        menuLinks.forEach(link => {
            link.addEventListener("click", e => {
                menuLinks.forEach(l => l.classList.remove("text-green", "font-semibold"));
                e.target.classList.add("text-green", "font-semibold");

                if (mobileMenu.classList.contains("translate-x-0")) {
                    closeMenu();
                }
            });
        });

        // Close drawer when switching to desktop
        window.addEventListener("resize", () => {
            if (window.innerWidth >= 768) {
                closeMenu();
            }
        });
    </script>


    <!-- navbar end -->

    <!-- Hero Section -->
   <section class="py-20 bg-[#57b652] w-[95%] rounded-[71px] max-w-[1600px] mt-3 mx-auto">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center px-4 sm:px-6 lg:px-6">

    <!-- Left: Content -->
    <div class="space-y-6 text-[#ffffff] lg:px-[70px] px-0">
      <h1 class="text-3xl sm:text-4xl lg:text-4xl font-bold leading-tight">
        Everything You Need, <br />
        All in One Place
      </h1>
      <p class="text-base sm:text-lg lg:text-xl leading-relaxed">
        Discover a wide range of products—from groceries to daily essentials—delivered right to your door.
        Shop smart and save more.
      </p>

      <!-- App Store & Play Store Buttons -->
      <div class="flex flex-row xs:flex-row items-start gap-4 w-full">
        <!-- Apple Store Button -->
        <a href="https://www.apple.com/app-store/" target="_blank"
          class="rounded-md hover:opacity-90 transition w-full sm:w-[140px] h-[44px]">
          <img src="{{ asset('assets/images/apple.png') }}" alt="Apple Store"
            class="w-full h-full object-contain" />
        </a>

        <!-- Play Store Button -->
        <a href="https://play.google.com/store" target="_blank"
          class="rounded-md hover:opacity-90 transition w-full sm:w-[140px] h-[44px]">
          <img src="{{ asset('assets/images/play.png') }}" alt="Play Store"
            class="w-full h-full object-contain" />
        </a>
      </div>
    </div>

    <!-- Right: Image Slider with Revolving Orbit -->
    <div class="relative w-full h-64 md:h-80 lg:h-[400px] overflow-hidden flex items-center justify-center">
      
      <!-- Orbit Background (rotating) -->
      <img id="orbitBg" src="{{ asset('assets/images/bg-1.png') }}" alt="Orbit"
        class="absolute w-[400px] h-[400px] object-contain animate-spin-slow" />

      <!-- Slide Image (static, centered) -->
      <img id="slide" class="relative w-40 h-40 sm:w-60 sm:h-60 lg:w-80 lg:h-80 object-contain z-10"
        src="{{ asset('assets/images/slide1.png') }}" alt="Slider Image" />
    </div>

  </div>
</section>

<!-- Custom Tailwind animation -->
<style>
  @keyframes spin-slow {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

  .animate-spin-slow {
    animation: spin-slow 20s linear infinite;
  }
</style>

    <!-- Hero Section end -->
    <!-- Families Trust start -->
    <section id="why" class="py-12 px-4 sm:px-6 lg:px-8 text-center max-w-4xl mx-auto">
        <!-- Title -->
        <h2 class="text-3xl sm:text-4xl font-extrabold text-black leading-snug">
            Why Families Trust <span class="text-orange-500">Top Ten Bazaar</span><br />
            for Groceries
        </h2>

        <!-- Description -->
        <p class="mt-6 text-[#666d80] text-base  sm:text-lg leading-relaxed">
            Families trust Top Ten Bazaar because we consistently deliver fresh, high-quality groceries at affordable
            prices—right to their doorstep.
            Our commitment to reliability, timely delivery, and a wide range of daily essentials makes shopping easier
            and more convenient for every household.
            With a user-friendly mobile app and excellent customer service, we ensure a smooth shopping experience that
            saves both time and money.
        </p>
    </section>
    <section class=" w-[85%] max-w-[1600px] mx-auto py-12 px-4 sm:px-6 lg:px-0 bg-white">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Card 1 -->
            <div class="bg-[#f3f6fc] rounded-[32px] p-6 flex flex-col items-start text-left h-full">
                <img src="{{ asset('assets/images/Mask group.png') }}" alt="Organic Product" class="w-16 h-16 mb-4">
                <h3 class="text-xl font-bold text-[#0f172a] mb-2">Organic & Quality Products</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    We offer organic and high-quality products sourced from trusted suppliers—free from harmful
                    chemicals and full of freshness, taste, and nutrition you can trust.
                </p>
            </div>

            <!-- Card 2 -->
            <div class="bg-[#f3f6fc] rounded-[32px] p-6 flex flex-col items-start text-left h-full">
                <img src="{{ asset('assets/images/Mask group2.png') }}" alt="Home Delivery" class="w-16 h-16 mb-4">
                <h3 class="text-xl font-bold text-[#0f172a] mb-2">Fast & Safe Home Delivery</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    We offer organic and high-quality products sourced from trusted suppliers—free from harmful
                    chemicals and full of freshness, taste, and nutrition you can trust.
                </p>
            </div>

            <!-- Card 3 -->
            <div class="bg-[#f3f6fc] rounded-[32px] p-6 flex flex-col items-start text-left h-full">
                <img src="{{ asset('assets/images/Mask group1.png') }}" alt="Mobile App" class="w-16 h-16 mb-4">
                <h3 class="text-xl font-bold text-[#0f172a] mb-2">Easy Ordering Via Mobile App</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    We offer organic and high-quality products sourced from trusted suppliers—free from harmful
                    chemicals and full of freshness, taste, and nutrition you can trust.
                </p>
            </div>

        </div>
    </section>
    <!-- Families Trust end -->
    <!-- Fresh Groceries start -->
    <section id="about" class="bg-[#f0802d] text-white py-12 px-4 sm:px-8 lg:px-0 ">
        <div class="grid grid-cols-1 lg:grid-cols-2 items-center gap-10 w-[85%] max-w-[1600px] mx-auto ">

            <!-- Left Text Content -->
            <div class="">
                <h2 class="text-3xl sm:text-4xl font-extrabold leading-snug mb-4">
                    Who We Are – Fresh Groceries,<br />
                    Reliable Service – Everyday Value.
                </h2>
                <p class="text-base sm:text-lg leading-relaxed mb-6">
                    At Top Ten Bazaar, we're more than just a grocery store—we're a part of your daily routine.
                    With a focus on freshness, value, and convenience, we provide everything from farm-fresh produce to
                    everyday essentials, all delivered with care.
                    Our goal is to make your shopping experience smooth, affordable, and always reliable.
                </p>

                <!-- Feature List -->
                <ul class="space-y-3">
                    <li class="flex items-center gap-3">
                        <img src="{{ asset('assets/images/icon1.png') }}" alt="Fresh" class="w-6 h-6">
                        <span>Fresh & Organic Products</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <img src="{{ asset('assets/images/icon2.png') }}" alt="Delivery" class="w-6 h-6">
                        <span>Fast & Safe Home Delivery</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <img src="{{ asset('assets/images/icon3.png') }}" alt="App" class="w-6 h-6">
                        <span>Easy Mobile App Ordering</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <img src="{{ asset('assets/images/icon4.png') }}" alt="Offers" class="w-6 h-6">
                        <span>Reliable Discounts & Offers</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <img src="{{ asset('assets/images/icon1.png') }}" alt="Products" class="w-6 h-6">
                        <span>Wide Product Range</span>
                    </li>
                </ul>
            </div>

            <!-- Right Image -->
            <div class=" grid grid-cols-1 lg:grid-cols-2 gap-3">
                <div>
                    <img src="{{ asset('assets/images/grains.png') }}" alt="Grocery Sacks"
                        class="w-full rounded-[24px] h-full">
                </div>

                <div class="flex flex-col gap-3">
                    <img src="{{ asset('assets/images/bottles.png') }}" alt="Grocery Sacks"
                        class="w-full rounded-[24px]">
                    <img src="{{ asset('assets/images/bowls_of_grains.png') }}" alt="Grocery Sacks"
                        class="w-full rounded-[24px]">
                </div>
            </div>

        </div>
    </section>
    <!-- Fresh Groceries end -->
    <!-- Testimonial Slider start -->
    <section id="testimonial" class="py-12 px-4 sm:px-6 lg:px-16 text-center max-w-3xl mx-auto">
        <!-- Heading -->
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0f172a] leading-snug mb-4">
            Trusted By Families – Here's What<br class="hidden sm:block" />
            They’re Saying
        </h2>

        <!-- Subtext -->
        <p class="text-gray-600 text-base sm:text-lg leading-relaxed">
            From doorstep delivery to fresh products—our customers share their experience and
            why they keep coming back to Top Ten Bazaar.
        </p>


    </section>

    <div class="py-12 px-4 sm:px-6 lg:px-0 bg-white w-[85%] max-w-[1600px] mx-auto">
        <div class="swiper testimonial-swiper">
            <div class="swiper-wrapper">

                <!-- Slide 1 -->
                <div class="swiper-slide bg-white rounded-2xl shadow p-6 flex flex-col justify-between">
                    <img src="{{ asset('assets/images/quote.png') }}" alt="Quote" class="w-8 h-8 mb-4">
                    <p class="text-gray-800 text-base leading-relaxed mb-6 min-h-[96px]">
                        The tenant management tools are fantastic. Communication is seamless, and keeping track of
                        leases and payments has never been easier. Highly recommend Azura!
                    </p>
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('assets/images/user.png') }}" alt="Jimmy Cooper"
                            class="w-10 h-10 rounded-full object-cover">
                        <div>
                            <h4 class="text-[#0f172a] font-bold text-sm">JIMMY COOPER</h4>
                            <p class="text-gray-500 text-xs">CTO</p>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="swiper-slide bg-white rounded-2xl shadow p-6 flex flex-col justify-between">
                    <img src="{{ asset('assets/images/quote.png') }}" alt="Quote" class="w-8 h-8 mb-4">
                    <p class="text-gray-800 text-base leading-relaxed mb-6 min-h-[96px]">
                        Azura made our workflow smoother. From reminders to reports, everything is on point.
                    </p>
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('assets/images/user.png') }}" alt="Sarah Lee"
                            class="w-10 h-10 rounded-full object-cover">
                        <div>
                            <h4 class="text-[#0f172a] font-bold text-sm">SARAH LEE</h4>
                            <p class="text-gray-500 text-xs">Product Manager</p>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="swiper-slide bg-white rounded-2xl shadow p-6 flex flex-col justify-between">
                    <img src="{{ asset('assets/images/quote.png') }}" alt="Quote" class="w-8 h-8 mb-4">
                    <p class="text-gray-800 text-base leading-relaxed mb-6 min-h-[96px]">
                        A complete solution for small businesses. Clean, fast, and professional.
                    </p>
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('assets/images/user.png') }}" alt="David Chen"
                            class="w-10 h-10 rounded-full object-cover">
                        <div>
                            <h4 class="text-[#0f172a] font-bold text-sm">DAVID CHEN</h4>
                            <p class="text-gray-500 text-xs">Founder, MiniMart</p>
                        </div>
                    </div>
                </div>

                <!-- Slide 4 -->
                <div class="swiper-slide bg-white rounded-2xl shadow p-6 flex flex-col justify-between">
                    <img src="{{ asset('assets/images/quote.png') }}" alt="Quote" class="w-8 h-8 mb-4">
                    <p class="text-gray-800 text-base leading-relaxed mb-6 min-h-[96px]">
                        A complete solution for small businesses. Clean, fast, and professional.
                    </p>
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('assets/images/user.png') }}" alt="David Chen"
                            class="w-10 h-10 rounded-full object-cover">
                        <div>
                            <h4 class="text-[#0f172a] font-bold text-sm">DAVID CHEN</h4>
                            <p class="text-gray-500 text-xs">Founder, MiniMart</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Testimonial Slider end -->
    <!-- Quality That Speaks start-->
    <section class="bg-[#F1873D] py-16 px-4 sm:px-8 lg:px-0">
        <div class="max-w-[1600px] mx-auto w-[85%] text-center">
            <!-- Heading -->
            <h2 class="text-4xl sm:text-5xl font-bold text-white mb-4">Quality That Speaks for Itself</h2>
            <p class="text-white text-lg sm:text-xl mb-12 max-w-3xl mx-auto">
                At Top Ten Bazar, we focus on delivering only the best. From fresh produce to daily essentials, our
                quality stands out in every order—because you deserve nothing less.
            </p>

            <!-- Feature Cards -->
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

                <!-- Card 1 -->
                <div class="bg-white rounded-xl p-8 text-center shadow-md">
                    <img src="{{ asset('assets/images/leaf.png') }}" alt="Fresh Products"
                        class="mx-auto w-12 h-12 mb-4">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-800 mb-2">Fresh & Handpicked Products</h3>
                    <p class="text-gray-500 text-sm">
                        Only the best items make it to your doorstep—carefully selected for freshness and taste.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-xl p-8 text-center shadow-md">
                    <img src="{{ asset('assets/images/shield.png') }}" alt="Trusted Suppliers"
                        class="mx-auto w-12 h-12 mb-4">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-800 mb-2">Trusted Suppliers & Brands</h3>
                    <p class="text-gray-500 text-sm">
                        We partner with reliable sources to ensure consistent quality in every category.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-xl p-8 text-center shadow-md">
                    <img src="{{ asset('assets/images/check.png') }}" alt="Quality Checks"
                        class="mx-auto w-12 h-12 mb-4">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-800 mb-2">Strict Quality Checks</h3>
                    <p class="text-gray-500 text-sm">
                        Every product goes through thorough checks so you receive nothing but the finest.
                    </p>
                </div>

            </div>
        </div>
    </section>
    <!-- Quality That Speaks start-->
    <!-- contact section start-->
    <section id="contact" class="bg-gray-100 py-16 px-4 sm:px-6 lg:px-0">
        <div class="max-w-[1600px] w-[85%] mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <!-- Left: Contact Info -->
            <div>
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6">
                    Get in touch with us. We're here to assist you.
                </h2>

                <!-- Address -->
                <div class="flex items-start gap-4 mb-6">
                    <div class="bg-[#F97316] p-3 rounded-full">
                        <img src="{{ asset('assets/images/location.png') }}" alt="Location" class="w-5 h-5">
                    </div>
                    <p class="text-gray-700 text-base">
                        96/2 Gali No 12 Main Jagatpur Road Near Sachdeva Convent School, New Delhi 110084
                    </p>
                </div>

                <!-- Phone -->
                <div class="flex items-start gap-4 mb-6">
                    <div class="bg-[#F97316] p-3 rounded-full">
                        <img src="{{ asset('assets/images/phone.png') }}" alt="Phone" class="w-5 h-5">
                    </div>
                    <p class="text-gray-700 text-base">+91 8130085308</p>
                </div>

                <!-- Email -->
                <div class="flex items-start gap-4 mb-8">
                    <div class="bg-[#F97316] p-3 rounded-full">
                        <img src="{{ asset('assets/images/email.png') }}" alt="Email" class="w-5 h-5">
                    </div>
                    <p class="text-gray-700 text-base">Toptenbazar.helpdesk@gmail.com</p>
                </div>

                <!-- Support Image -->
                <img src="{{ asset('assets/images/support.png') }}" alt="Support"
                    class="w-full max-w-sm mt-6 mx-auto lg:mx-0">
            </div>

            <!-- Right: Form -->
            <div class="bg-white shadow-md rounded-lg p-8">
                <h3 class="text-xl font-semibold text-gray-900 mb-6">Get In Touch</h3>

                <form action="#" method="POST" class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" required placeholder="Enter Full Name"
                            class="w-full border border-gray-300 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Address <span
                                class="text-red-500">*</span></label>
                        <input type="email" required placeholder="Enter Email Address"
                            class="w-full border border-gray-300 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number <span
                                class="text-red-500">*</span></label>
                        <input type="tel" required placeholder="Enter Phone Number"
                            class="w-full border border-gray-300 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Message <span
                                class="text-red-500">*</span></label>
                        <textarea rows="4" required placeholder="Enter Message"
                            class="w-full border border-gray-300 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-400"></textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#F97316] hover:bg-orange-600 text-white font-semibold py-3 rounded-md transition duration-300">
                        Send Message
                    </button>
                </form>
            </div>

        </div>
    </section>
    <!-- contact section end-->
    <!-- footer section start-->
    <footer class="bg-[#34A853] text-white pt-20 relative overflow-hidden ">
        <div
            class="max-w-[1600px] w-[100%] mx-auto grid grid-cols-1 lg:grid-cols-2 gap-10 items-center relative z-10">

            <!-- Left: Logo, Description, and Buttons -->
            <div class="space-y-6 ml-10 pb-10">
                <!-- Logo -->
                <img src="{{ asset('assets/images/logo.png') }}" alt="Top Ten Bazaar Logo" class="w-52 sm:w-60">

                <!-- Description -->
                <p class="text-lg font-medium leading-relaxed max-w-xl">
                    Discover a wide range of products—from groceries to daily essentials—delivered right to your door.
                    Shop smart and save more.
                </p>

                <!-- App Store Buttons -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                    <a href="#" target="_blank">
                        <img src="{{ asset('assets/images/apple.png') }}" alt="App Store" class="h-12">
                    </a>
                    <a href="#" target="_blank">
                        <img src="{{ asset('assets/images/play.png') }}" alt="Google Play" class="h-12">
                    </a>
                </div>
            </div>

            <!-- Right: Phone Image with Half Circle Background -->
            <div class="absolute right-0 bottom-0 flex justify-center lg:justify-end items-end z-10">
                <!-- Decorative Half Circle Background -->
                <div class="rounded-full mt-[200px]">
                    <!-- Phone Image -->
                    <img src="{{ asset('assets/images/footer-bg-prim.png') }}" alt="Phone Mockup"
                        class="relative z-10
                    w-[300px] sm:w-[360px] md:w-[600px] lg:w-[800px] xl:w-[800px] h-auto ml-60" style="margin-bottom: -300px; margin-right:-200px;"> 
                </div>
            </div>

        </div>
    </footer>


    <!-- footer section end-->


    <script>
        const slides = {!! json_encode([
            [
                'slideImg' => asset('assets/images/slide1.png'),
                'bgImg' => asset('assets/images/bg-1.png'),
            ],
            [
                'slideImg' => asset('assets/images/slide2.png'),
                'bgImg' => asset('assets/images/bg-1.png'),
            ],
            [
                'slideImg' => asset('assets/images/slide3.png'),
                'bgImg' => asset('assets/images/bg-1.png'),
            ],
        ]) !!};

        let index = 0;
        const slide = document.getElementById("slide");
        const orbitBg = document.getElementById("orbitBg");

        function showNextSlide() {
            index = (index + 1) % slides.length;

            // Change image sources
            slide.src = slides[index].slideImg;
            orbitBg.src = slides[index].bgImg;

            // Trigger rotate animation
            orbitBg.classList.remove("rotate-animation");
            void orbitBg.offsetWidth;
            orbitBg.classList.add("rotate-animation");
        }

        setInterval(showNextSlide, 4000);
    </script>
    <script src="{{ asset('assets/js/swiperBundle.js') }}"></script>
    <script src="{{ asset('assets/js/swiper.js') }}"></script>
</body>

</html>
