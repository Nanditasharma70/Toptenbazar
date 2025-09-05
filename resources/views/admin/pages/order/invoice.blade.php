@extends('admin.pages.layout.main')
@section('title', 'Unit')
@section('content')
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Order Detail</h1>
        <div class="flex gap-3 mt-4 md:mt-0">
            <button
                class="bg-gray-200 px-4 py-2 rounded-md text-sm text-gray-700 hover:bg-gray-300 flex items-center gap-1 transition">
                <i class="fa fa-save"></i> Save
            </button>
            <button
                class="bg-green-500 text-white px-4 py-2 rounded-md text-sm hover:bg-green-600 flex items-center gap-1 transition">
                <i class="fa fa-download"></i> Download Invoice
            </button>
        </div>
    </div>

    <!-- Invoice Card -->
    <div class="bg-white rounded-xl shadow-md p-6 w-full overflow-x-auto">

        <!-- Invoice Header -->
        <div class="flex flex-col md:flex-row md:items-start md:justify-between mb-6 gap-6">
            <!-- Left: Invoice Title + Meta -->
            <div>
                <h2 class="text-xl font-bold text-gray-800">
                    INVOICE <span class="text-orange-500">#G–Store:43</span>
                </h2>
                <!-- Meta Information -->
                <div class="text-sm text-gray-700 mt-2 space-y-1">
                    <p><strong>Order Date:</strong> 04 Jul, 2025</p>
                    <p><strong>Location:</strong> Kirti Nagar</p>
                </div>
            </div>

            <!-- Right: Delivery Assignments -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 w-full md:w-auto">
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Assign Deliveryman</label>
                    <select
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring focus:ring-blue-200">
                        <option>Select Deliverymen</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Payment Status</label>
                    <select
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring focus:ring-blue-200">
                        <option>Payment Status</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Delivery Status</label>
                    <select
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring focus:ring-blue-200">
                        <option>Select Delivery Status</option>
                    </select>
                </div>
            </div>
        </div>


        <!-- Address Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <div>
                <h3 class="font-semibold text-gray-800 mb-2">Customer Info</h3>
                <p>Name: Customer</p>
                <p>Email: customer@themetags.com</p>
                <p>Phone: —</p>
                <p>Delivery Type: Regular</p>
            </div>
            <div>
                <h3 class="font-semibold text-gray-800 mb-2">Shipping Address</h3>
                <p>Kirti Nagar, Delhi-110046</p>
            </div>
            <div>
                <h3 class="font-semibold text-gray-800 mb-2">Billing Address</h3>
                <p>96/2 Gali No 12, Main Jagatpur Road, near Sachdeva Convent School, New Delhi 110084</p>
            </div>
        </div>

        <!-- Product Table -->
        <div class="overflow-x-auto border border-gray-200 rounded-lg">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100 font-semibold text-gray-800">
                    <tr>
                        <th class="px-4 py-3 border-b">S/L</th>
                        <th class="px-4 py-3 border-b">Products</th>
                        <th class="px-4 py-3 border-b">Unit Price</th>
                        <th class="px-4 py-3 border-b">Quantity</th>
                        <th class="px-4 py-3 border-b">Price</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="px-4 py-3">1</td>
                        <td class="px-4 py-3 flex items-center gap-2">
                            <img src="/images/bread.jpg" alt="product" class="w-8 h-8 object-cover rounded" />
                            Brown Bread
                        </td>
                        <td class="px-4 py-3">350</td>
                        <td class="px-4 py-3">4</td>
                        <td class="px-4 py-3 text-orange-500 font-semibold">900</td>
                    </tr>
                    <!-- Add more rows here dynamically -->
                </tbody>
            </table>
        </div>

        <!-- Summary Footer -->
        <div
            class="grid grid-cols-2 md:grid-cols-5 gap-4 text-sm font-medium text-gray-800 mt-6 bg-gray-100 p-4 rounded-md">
            <div>
                <span class="block text-gray-500">Payment Method</span>
                <strong class="text-black">COD</strong>
            </div>
            <div>
                <span class="block text-gray-500">Logistic</span>
                <strong class="text-black">XYZ</strong>
            </div>
            <div>
                <span class="block text-gray-500">Sub Total</span>
                <strong class="text-black">900</strong>
            </div>
            <div>
                <span class="block text-gray-500">Shipping Cost</span>
                <strong class="text-black">50</strong>
            </div>
            <div>
                <span class="block text-gray-500">Grand Total</span>
                <strong class="text-orange-500 text-lg">3600</strong>
            </div>
        </div>
    </div>

@endsection
