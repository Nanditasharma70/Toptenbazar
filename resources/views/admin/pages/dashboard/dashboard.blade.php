@extends('admin.pages.layout.main')
@section('title', 'Admin Dashboard')

@section('content')
    <!-- Header Section -->
    <div class="flex flex-col xs:flex-row justify-between items-center  mb-6">
        <h1 class="text-2xl font-semibold">Dashboard</h1>
        <div class="flex space-x-4 mt-4 md:mt-0">
            <a href="{{ route('products.create') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">+
                Add Product</a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">

        <!-- Card 1 -->
        <div class="bg-white rounded-lg p-3 shadow-xl w-full  mx-auto">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Today's Sales</p>
                    <h2 class="text-4xl font-bold text-gray-900 mt-1">40,689</h2>
                </div>
                <div class="bg-[#D1FAE5]  rounded-xl">
                    <img src="{{ asset('assets/images/icon.png') }}" alt="Sales Icon"
                        class="w-[45px] h-[45px] object-contain" />
                </div>
            </div>
            <div class="flex items-center space-x-2 mt-4">
                <img src="{{ asset('assets/images/arrow-up.png') }}" alt="Up Icon" class="w-4 h-4 object-contain" />
                <p class="text-sm text-gray-600"><span class="text-green-600 font-semibold">8.5%</span> Up from yesterday
                </p>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-lg p-3 shadow-xl w-full  mx-auto">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Monthly Sales</p>
                    <h2 class="text-4xl font-bold text-gray-900 mt-1">18,220</h2>
                </div>
                <div class="bg-[#DBEAFE]  rounded-xl">
                    <img src="{{ asset('assets/images/icons1.png') }}" alt="Users Icon"
                        class="w-[45px] h-[45px] object-contain" />
                </div>
            </div>
            <div class="flex items-center space-x-2 mt-4">
                <img src="{{ asset('assets/images/arrow-up.png') }}" alt="Up Icon" class="w-4 h-4 object-contain" />
                <p class="text-sm text-gray-600"><span class="text-green-600 font-semibold">4.2%</span> Up from yesterday
                </p>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-lg p-3 shadow-xl w-full  mx-auto">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Today’s Order</p>
                    <h2 class="text-4xl font-bold text-gray-900 mt-1">5,430</h2>
                </div>
                <div class="bg-[#FEF9C3]  rounded-xl">
                    <img src="{{ asset('assets/images/icons2.png') }}" alt="Orders Icon"
                        class="w-[45px] h-[45px] object-contain" />
                </div>
            </div>
            <div class="flex items-center space-x-2 mt-4">
                <img src="{{ asset('assets/images/arrow-up.png') }}" alt="Up Icon" class="w-4 h-4 object-contain" />
                <p class="text-sm text-gray-600"><span class="text-green-600 font-semibold">3.1%</span> Up from yesterday
                </p>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="bg-white rounded-lg p-3 shadow-xl w-full  mx-auto">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Last 30 Days Orders</p>
                    <h2 class="text-4xl font-bold text-gray-900 mt-1">₹2.1L</h2>
                </div>
                <div class="bg-[#f9f9f9] rounded-xl">
                    <img src="{{ asset('assets/images/icons3.png') }}" alt="Revenue Icon"
                        class="w-[45px] h-[45px] object-contain" />
                </div>
            </div>
            <div class="flex items-center space-x-2 mt-4">
                <img src="{{ asset('assets/images/arrow-up.png') }}" alt="Up Icon" class="w-4 h-4 object-contain" />
                <p class="text-sm text-gray-600"><span class="text-green-600 font-semibold">6.9%</span> Up from yesterday
                </p>
            </div>
        </div>

    </div>


    <!-- Chart Placeholder -->
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Sales Details</h2>
            <select class="border rounded px-2 py-1 text-sm">
                <option>October</option>
            </select>
        </div>
        <div class="h-[200px] flex items-center justify-center text-gray-400">
            <p>[Chart Removed]</p>
        </div>
    </div>

    <!-- Top Selling Products -->
    <div class="bg-white rounded-2xl shadow-md overflow-x-auto p-4">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Top Selling Products</h2>
        <table class="min-w-full text-sm text-left text-gray-600">
            <thead class="bg-gray-100 text-xs text-gray-500 uppercase">
                <tr>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">Product</th>
                    <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">Price</th>
                    <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">Sales</th>
                </tr>
            </thead>
            <tbody>
                <!-- Repeat row as needed -->
                <tr class="bg-white border-b hover:bg-gray-50 transition">
                    <td class="px-6 py-4 flex items-center gap-4 whitespace-nowrap">
                        <img src="{{ asset('assets/images/Produk.png') }}" alt="Product" class="w-10 h-10 rounded">
                        <div>
                            <div class="text-xs text-gray-500">021231</div>
                            <div class="font-medium text-gray-800 whitespace-nowrap">Kanky Kitadakate (Green)</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap">$20.00</td>
                    <td class="px-6 py-4 text-center text-green-600 font-semibold whitespace-nowrap">
                        Increased by 40% from last month
                    </td>
                </tr>
                 <tr class="bg-white border-b hover:bg-gray-50 transition">
                    <td class="px-6 py-4 flex items-center gap-4 whitespace-nowrap">
                        <img src="{{ asset('assets/images/Produk.png') }}" alt="Product" class="w-10 h-10 rounded">
                        <div>
                            <div class="text-xs text-gray-500">021231</div>
                            <div class="font-medium text-gray-800 whitespace-nowrap">Kanky Kitadakate (Green)</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap">$20.00</td>
                    <td class="px-6 py-4 text-center text-green-600 font-semibold whitespace-nowrap">
                        Increased by 40% from last month
                    </td>
                </tr>
                 <tr class="bg-white border-b hover:bg-gray-50 transition">
                    <td class="px-6 py-4 flex items-center gap-4 whitespace-nowrap">
                        <img src="{{ asset('assets/images/Produk.png') }}" alt="Product" class="w-10 h-10 rounded">
                        <div>
                            <div class="text-xs text-gray-500">021231</div>
                            <div class="font-medium text-gray-800 whitespace-nowrap">Kanky Kitadakate (Green)</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap">$20.00</td>
                    <td class="px-6 py-4 text-center text-green-600 font-semibold whitespace-nowrap">
                        Increased by 40% from last month
                    </td>
                </tr>
                 <tr class="bg-white border-b hover:bg-gray-50 transition">
                    <td class="px-6 py-4 flex items-center gap-4 whitespace-nowrap">
                        <img src="{{ asset('assets/images/Produk.png') }}" alt="Product" class="w-10 h-10 rounded">
                        <div>
                            <div class="text-xs text-gray-500">021231</div>
                            <div class="font-medium text-gray-800 whitespace-nowrap">Kanky Kitadakate (Green)</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap">$20.00</td>
                    <td class="px-6 py-4 text-center text-green-600 font-semibold whitespace-nowrap">
                        Increased by 40% from last month
                    </td>
                </tr>


                <!-- Add more rows as necessary -->
            </tbody>
        </table>
    </div>


    <!-- Order Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2  lg:grid-cols-4 gap-4 mt-6">
        <div class="bg-white rounded-xl shadow-md p-4 flex items-center gap-4 w-full ">
            <!-- Image instead of SVG -->
            <div class="bg-green-100 p-3 rounded-full">
                <img src="{{ asset('assets/images/cartt.png') }}" alt="Orders Icon" class="w-6 h-6">
            </div>
            <div>
                <div class="text-2xl font-semibold text-gray-800">56</div>
                <div class="text-sm text-gray-500">Total Orders</div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-4 flex items-center gap-4 w-full ">
            <!-- Image instead of SVG -->
            <div class="bg-[#f4d8d8] p-3 rounded-full">
                <img src="{{ asset('assets/images/timer.png') }}" alt="Orders Icon" class="w-6 h-6">
            </div>
            <div>
                <div class="text-2xl font-semibold text-gray-800">56</div>
                <div class="text-sm text-gray-500">Total Orders</div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-4 flex items-center gap-4 w-full ">
            <!-- Image instead of SVG -->
            <div class="bg-[#f4f4f4] p-3 rounded-full">
                <img src="{{ asset('assets/images/sync.png') }}" alt="Orders Icon" class="w-6 h-6">
            </div>
            <div>
                <div class="text-2xl font-semibold text-gray-800">56</div>
                <div class="text-sm text-gray-500">Total Orders</div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-4 flex items-center gap-4 w-full ">
            <!-- Image instead of SVG -->
            <div class="bg-[#F9C9C9] p-3 rounded-full">
                <img src="{{ asset('assets/images/cut.png') }}" alt="Orders Icon" class="w-6 h-6">
            </div>
            <div>
                <div class="text-2xl font-semibold text-gray-800">56</div>
                <div class="text-sm text-gray-500">Total Orders</div>
            </div>
        </div>

    </div>

    <!-- Latest Orders Table -->
    <div class="bg-white rounded-2xl shadow-md p-6 overflow-x-auto mt-6">
        <div class="flex justify-between items-center mb-4 w-full">
            <h2 class="text-lg font-semibold text-gray-800">Latest Order</h2>
            <button class="bg-green-500 text-white px-4 py-2 rounded-md text-sm hover:bg-green-600 transition">View
                All</button>
        </div>

        <table class="w-full text-sm text-left text-gray-700 ">
            <thead class="bg-gray-100 text-xs uppercase text-gray-500">
                <tr>
                    <th class="px-4 py-3 whitespace-nowrap">Order Code</th>
                    <th class="px-4 py-3 whitespace-nowrap">Customer</th>
                    <th class="px-4 py-3 whitespace-nowrap">Placed On</th>
                    <th class="px-4 py-3 whitespace-nowrap">Items</th>
                    <th class="px-4 py-3 whitespace-nowrap">Payment Status</th>
                    <th class="px-4 py-3 whitespace-nowrap">Delivery Status</th>
                    <th class="px-4 py-3 whitespace-nowrap">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example row -->
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="px-4 py-3 whitespace-nowrap">#G-Store:39</td>
                    <td class="px-4 py-3 whitespace-nowrap">Customer1</td>
                    <td class="px-4 py-3 whitespace-nowrap">22 Jun, 2025</td>
                    <td class="px-4 py-3 whitespace-nowrap">3</td>
                    <td class="px-4 py-3 text-red-600 font-medium whitespace-nowrap">Unpaid</td>
                    <td class="px-4 py-3 text-green-600 font-medium whitespace-nowrap">Order Placed</td>
                    <td class="px-4 py-3 space-x-2 whitespace-nowrap">
                        <button
                            class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition whitespace-nowrap">Accept</button>
                        <button
                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition whitespace-nowrap">Reject</button>
                    </td>
                </tr>

                 <tr class="border-b hover:bg-gray-50 transition">
                    <td class="px-4 py-3 whitespace-nowrap">#G-Store:39</td>
                    <td class="px-4 py-3 whitespace-nowrap">Customer1</td>
                    <td class="px-4 py-3 whitespace-nowrap">22 Jun, 2025</td>
                    <td class="px-4 py-3 whitespace-nowrap">3</td>
                    <td class="px-4 py-3 text-red-600 font-medium whitespace-nowrap">Unpaid</td>
                    <td class="px-4 py-3 text-green-600 font-medium whitespace-nowrap">Order Placed</td>
                    <td class="px-4 py-3 space-x-2 whitespace-nowrap">
                        <button
                            class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition whitespace-nowrap">Accept</button>
                        <button
                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition whitespace-nowrap">Reject</button>
                    </td>
                </tr>
                 <tr class="border-b hover:bg-gray-50 transition">
                    <td class="px-4 py-3 whitespace-nowrap">#G-Store:39</td>
                    <td class="px-4 py-3 whitespace-nowrap">Customer1</td>
                    <td class="px-4 py-3 whitespace-nowrap">22 Jun, 2025</td>
                    <td class="px-4 py-3 whitespace-nowrap">3</td>
                    <td class="px-4 py-3 text-red-600 font-medium whitespace-nowrap">Unpaid</td>
                    <td class="px-4 py-3 text-green-600 font-medium whitespace-nowrap">Order Placed</td>
                    <td class="px-4 py-3 space-x-2 whitespace-nowrap">
                        <button
                            class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition whitespace-nowrap">Accept</button>
                        <button
                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition whitespace-nowrap">Reject</button>
                    </td>
                </tr>
                 <tr class="border-b hover:bg-gray-50 transition">
                    <td class="px-4 py-3 whitespace-nowrap">#G-Store:39</td>
                    <td class="px-4 py-3 whitespace-nowrap">Customer1</td>
                    <td class="px-4 py-3 whitespace-nowrap">22 Jun, 2025</td>
                    <td class="px-4 py-3 whitespace-nowrap">3</td>
                    <td class="px-4 py-3 text-red-600 font-medium whitespace-nowrap">Unpaid</td>
                    <td class="px-4 py-3 text-green-600 font-medium whitespace-nowrap">Order Placed</td>
                    <td class="px-4 py-3 space-x-2 whitespace-nowrap">
                        <button
                            class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition whitespace-nowrap">Accept</button>
                        <button
                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition whitespace-nowrap">Reject</button>
                    </td>
                </tr>
                <!-- Repeat rows as needed -->
            </tbody>
        </table>
    </div>


    <!-- Static Pagination (Responsive) -->
    <div class="mt-6 flex flex-col sm:flex-row justify-between items-center gap-4">

        <!-- Showing Info -->
        <div class="text-sm text-gray-500">
            Showing <span class="font-semibold text-black">1</span> to <span class="font-semibold text-black">10</span> of
            <span class="font-semibold text-black">50</span> results
        </div>

        <!-- Pagination Buttons -->
        <div class="flex flex-wrap gap-1">
            <button
                class="px-3 py-1 text-sm bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">Previous</button>
            <button class="px-3 py-1 text-sm bg-green-500 text-white rounded">1</button>
            <button class="px-3 py-1 text-sm bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">2</button>
            <button class="px-3 py-1 text-sm bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">3</button>
            <span class="px-3 py-1 text-sm text-gray-500">...</span>
            <button class="px-3 py-1 text-sm bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">Next</button>
        </div>

    </div>




@endsection
