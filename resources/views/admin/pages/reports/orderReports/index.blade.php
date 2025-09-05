@extends('admin.pages.layout.main')
@section('title', 'Order report')
@section('content')

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Order Report</h1>
        <div class="mt-2 md:mt-0 flex gap-2">

            <button onclick="window.print()"
                class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                🖨️ Print
            </button>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-4 w-full overflow-x-auto">


        <!-- Filters -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
            <input type="text" placeholder="Search"
                class="w-full md:w-1/3 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" />
            <div class="flex gap-2">
                <select class="px-3 py-2 border border-gray-300 rounded-md text-sm">
                    <option>Payment Status</option>
                    <option>Published</option>
                    <option>Draft</option>
                </select>
                <select class="px-3 py-2 border border-gray-300 rounded-md text-sm">
                    <option>Delivery Status</option>
                    <option>Published</option>
                    <option>Draft</option>
                </select>
                <select class="px-3 py-2 border border-gray-300 rounded-md text-sm">
                    <option>Select Status</option>
                    <option>Published</option>
                    <option>Draft</option>
                </select>
                <select class="px-3 py-2 border border-gray-300 rounded-md text-sm">
                    <option>Newest</option>
                    <option>Oldest</option>
                </select>
                <div class="text-sm text-gray-700 font-semibold ">
                    <div>
                        Total Amount:</div>
                    <span class="text-green-600">₹4,250</span>
                </div>
            </div>
        </div>

        <!-- Table -->
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-100 text-xs uppercase text-gray-500">
                <tr>
                    <th class="px-4 py-3 whitespace-nowrap">S/L</th>
                    <th class="px-4 py-3 whitespace-nowrap"> Placed On</th>
                    <th class="px-4 py-3 whitespace-nowrap">Items</th>
                    <th class="px-4 py-3 whitespace-nowrap">Payment Status</th>
                    <th class="px-4 py-3 whitespace-nowrap">Delivery Status</th>
                    <th class="px-4 py-3 whitespace-nowrap">Delivery man</th>
                    <th class="px-4 py-3 whitespace-nowrap">Amount</th>

                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm text-gray-800">
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 whitespace-nowrap">1</td>
                    <td class="px-4 py-3 whitespace-nowrap">2025-07-15</td>
                    <td class="px-4 py-3 whitespace-nowrap">3</td>
                    <td class="px-4 py-3 whitespace-nowrap">
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-medium">Paid</span>
                    </td>
                    <td class="px-4 py-3">
                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs font-medium">Out for
                            Delivery</span>
                    </td>
                    <td class="px-4 py-3">Rahul Sharma</td>
                    <td class="px-4 py-3 font-semibold">₹560</td>
                </tr>

                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">2</td>
                    <td class="px-4 py-3">2025-07-14</td>
                    <td class="px-4 py-3">5</td>
                    <td class="px-4 py-3">
                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs font-medium">Unpaid</span>
                    </td>
                    <td class="px-4 py-3">
                        <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-full text-xs font-medium">Pending</span>
                    </td>
                    <td class="px-4 py-3">N/A</td>
                    <td class="px-4 py-3 font-semibold">₹890</td>
                </tr>

                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">3</td>
                    <td class="px-4 py-3">2025-07-13</td>
                    <td class="px-4 py-3">2</td>
                    <td class="px-4 py-3">
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-medium">Paid</span>
                    </td>
                    <td class="px-4 py-3">
                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs font-medium">Delivered</span>
                    </td>
                    <td class="px-4 py-3">Ayesha Khan</td>
                    <td class="px-4 py-3 font-semibold">₹320</td>
                </tr>
            </tbody>

        </table>


    </div>





@endsection
