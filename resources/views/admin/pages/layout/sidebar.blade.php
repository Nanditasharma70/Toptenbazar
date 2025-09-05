<aside id="sidebar"
    class="fixed top-0 left-0 w-[250px] h-full bg-white shadow z-30 transform transition-transform duration-300 -translate-x-full md:translate-x-0 overflow-x-auto">
    <div class="flex justify-between items-center mb-6 px-3 py-2">
        <!-- Logo -->
        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="h-10 object-contain">


    </div>


    @php
        $productRoutes = [
            'products.index',
            'category.index',
            'sub-categories.index',
            'variation.index',
            'product-tag.index',
            'unit.index',
        ];
        $reportRoutes = ['category-sales.index', 'order-report.index', 'product-sales.index', 'delivery-status.index'];
    @endphp

    <nav class="space-y-2 text-gray-700 text-sm font-medium w-[215px]">
        <!-- Dashboard -->
        <div>
            <a href="{{ route('dashboard') }}"
                class="flex items-center px-4 py-2 rounded {{ Route::is('dashboard') ? 'bg-green-500 text-white' : 'hover:bg-green-500 hover:text-white' }}">
                <i class="fas fa-chart-line mr-3 text-[16px]"></i>
                Dashboard
            </a>
        </div>

        <!-- Products -->
        <div>
            <button id="products-toggle"
                class="w-full flex items-center px-4 py-2 text-gray-600 hover:bg-green-500 hover:text-white rounded focus:outline-none">
                <i class="fa-solid fa-bag-shopping mr-3 text-[16px]"></i>
                Products
                <i id="toggle-icon-products"
                    class="ml-auto fas fa-chevron-down w-4 h-4 transition-transform duration-300 {{ Route::is($productRoutes) ? 'rotate-180' : '' }}"></i>
            </button>

            <div id="products-menu"
                class="ml-[40px]  space-y-1 overflow-hidden transition-[max-height] duration-300 ease-in-out"
                style="{{ Route::is($productRoutes) ? 'max-height: 1000px;' : 'max-height: 0;' }}">
                <a href="{{ route('products.index') }}"
                    class="block px-2 py-1 rounded {{ Route::is('products.index') ? ' text-green-500' : 'hover: hover:text-green-500' }}">Products</a>
                <a href="{{ route('category.index') }}"
                    class="block px-2 py-1 rounded {{ Route::is('category.index') ? ' text-green-500' : 'hover: hover:text-green-500' }}">Categories</a>
                <a href="{{ route('sub-categories.index') }}"
                    class="block px-2 py-1 rounded {{ Route::is('sub-categories.index') ? ' text-green-500' : 'hover: hover:text-green-500' }}">Sub
                    Categories</a>
                <a href="{{ route('variation.index') }}"
                    class="block px-2 py-1 rounded {{ Route::is('variation.index') ? ' text-green-500' : 'hover: hover:text-green-500' }}">Variations</a>
                <a href="{{ route('product-tag.index') }}"
                    class="block px-2 py-1 rounded {{ Route::is('product-tag.index') ? ' text-green-500' : 'hover: hover:text-green-500' }}">Product
                    Tags</a>
                <a href="{{ route('unit.index') }}"
                    class="block px-2 py-1 rounded {{ Route::is('unit.index') ? ' text-green-500' : 'hover: hover:text-green-500' }}">Units</a>
            </div>
        </div>

        <!-- Orders -->
        <div>
            <a href="{{ route('order.index') }}"
                class="flex items-center px-4 py-2 mt-0 rounded {{ Route::is('order.index') ? 'bg-green-500 text-white' : 'hover:bg-green-500 hover:text-white' }}">
                <i class="fas fa-shopping-cart mr-3 text-[16px]"></i>
                Orders
            </a>
        </div>

        <!-- Customers -->
        <div>
            <a href="{{ route('customer.index') }}"
                class="flex items-center px-4 py-2 rounded {{ Route::is('customer.index') ? 'bg-green-500 text-white' : 'hover:bg-green-500 hover:text-white' }}">
                <i class="fa-solid fa-user text-[16px] mr-3"></i>
                Customers
            </a>
        </div>

        <!-- Delivery Men -->
        <div>
            <a href="{{ route('delivery-man.index') }}"
                class="flex items-center px-4 py-2 rounded {{ Route::is('delivery-man.index') ? 'bg-green-500 text-white' : 'hover:bg-green-500 hover:text-white' }}">
                <i class="fas fa-user-friends mr-3 text-[16px]"></i>
                Delivery Men
            </a>
        </div>

        <!-- Coupons -->
        <div>
            <a href="{{ route('coupon.index') }}"
                class="flex items-center px-4 py-2 rounded {{ Route::is('coupon.index') ? 'bg-green-500 text-white' : 'hover:bg-green-500 hover:text-white' }}">
                <i class="fa fa-tags mr-3 text-[16px]"></i>
                Coupons
            </a>
        </div>

        <!-- Charge Config -->
        <div>
            <a href="{{ route('charge.index') }}"
                class="flex items-center px-4 py-2 rounded {{ Route::is('charge.index') ? 'bg-green-500 text-white' : 'hover:bg-green-500 hover:text-white' }}">
                <i class="fa fa-cogs mr-3 text-[16px]"></i>
                Charge Config
            </a>
        </div>

        <!-- Banner Config -->
        <div>
            <a href="{{ route('banner.index') }}"
                class="flex items-center px-4 py-2 rounded {{ Route::is('banner.index') ? 'bg-green-500 text-white' : 'hover:bg-green-500 hover:text-white' }}">
                <i class="fas fa-image mr-3 text-[16px]"></i>
                Banner Config
            </a>
        </div>

        {{-- Image Config --}}
        <div>
            <a href="{{ route('image-config.index') }}"
                class="flex items-center px-4 py-2 rounded {{ Route::is('image-config.index') ? 'bg-green-500 text-white' : 'hover:bg-green-500 hover:text-white' }}">
                <i class="fas fa-image mr-3 text-[16px]"></i>
                Image Config
            </a>

        </div>

        <!-- Reports -->
        <div>
            <button id="reports-toggle"
                class="w-full flex items-center px-4 py-2 text-gray-600 hover:bg-green-500 hover:text-white rounded focus:outline-none">
                <i class="fa fa-file-invoice mr-3 text-[16px]"></i>
                Reports
                <i id="toggle-icon-reports"
                    class="ml-auto fas fa-chevron-down transition-transform duration-300 {{ Route::is($reportRoutes) ? 'rotate-180' : '' }}"></i>
            </button>

            <div id="reports-menu"
                class="ml-[40px]  space-y-1 overflow-hidden transition-[max-height] duration-300 ease-in-out"
                style="{{ Route::is($reportRoutes) ? 'max-height: 1000px;' : 'max-height: 0;' }}">
                <a href="{{ route('category-sales.index') }}"
                    class="block px-2 py-1 rounded {{ Route::is('category-sales.index') ? ' text-green-500' : 'hover: hover:text-green-500' }}">Category
                    Sales</a>
                <a href="{{ route('order-report.index') }}"
                    class="block px-2 py-1 rounded {{ Route::is('order-report.index') ? ' text-green-500' : 'hover: hover:text-green-500' }}">Orders
                    Report</a>
                <a href="{{ route('product-sales.index') }}"
                    class="block px-2 py-1 rounded {{ Route::is('product-sales.index') ? ' text-green-500' : 'hover: hover:text-green-500' }}">Product
                    Sales</a>
                <a href="{{ route('delivery-status.index') }}"
                    class="block px-2 py-1 rounded {{ Route::is('delivery-status.index') ? ' text-green-500' : 'hover: hover:text-green-500' }}">Delivery
                    Status</a>
            </div>
        </div>

        <!-- Logout -->
        <a href="{{ route('logout') }}" class="flex items-center px-4 py-2 text-red-500 hover:bg-red-100 rounded">
            <i class="fa fa-sign-out-alt text-[16px] mr-3"></i>
            Logout
        </a>
    </nav>
</aside>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const savedScrollY = sessionStorage.getItem("scrollY");
        if (savedScrollY !== null) {
            window.scrollTo(0, parseInt(savedScrollY));
            sessionStorage.removeItem("scrollY");
        }

        // Scroll active sidebar link into view
        const activeLink = document.querySelector("nav a.bg-green-500");
        if (activeLink) {
            activeLink.scrollIntoView({
                behavior: "auto",
                block: "center"
            });
        }

        const menus = [{
                toggleBtn: document.getElementById("products-toggle"),
                menu: document.getElementById("products-menu"),
                icon: document.getElementById("toggle-icon-products")
            },
            {
                toggleBtn: document.getElementById("reports-toggle"),
                menu: document.getElementById("reports-menu"),
                icon: document.getElementById("toggle-icon-reports")
            }
        ];

        menus.forEach(({
            toggleBtn,
            menu,
            icon
        }) => {
            let isOpen = menu.style.maxHeight !== "0px" && menu.style.maxHeight !== "";
            toggleBtn.addEventListener("click", function(e) {
                e.preventDefault();
                e.stopPropagation();
                if (isOpen) {
                    menu.style.maxHeight = "0px";
                    icon.classList.remove("rotate-180");
                    isOpen = false;
                } else {
                    menu.style.maxHeight = menu.scrollHeight + "px";
                    icon.classList.add("rotate-180");
                    isOpen = true;
                }
            });

            menu.querySelectorAll("a").forEach(link => {
                link.addEventListener("click", e => e.stopPropagation());
            });
        });
    });

    window.addEventListener("beforeunload", function() {
        const scrollY = window.scrollY || document.documentElement.scrollTop;
        sessionStorage.setItem("scrollY", scrollY);
    });
</script>
