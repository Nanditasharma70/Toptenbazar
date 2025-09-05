@extends('admin.pages.layout.main')
@section('title', 'Order')
@section('content')

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-center  mb-6">
        <h1 class="text-2xl font-semibold">Order</h1>

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
                    <option>location</option>
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
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-800">
                <thead class="bg-gray-100 text-xs uppercase text-gray-500">
                    <tr>
                        <th class="px-4 py-3 whitespace-nowrap"></th>
                        <th class="px-4 py-3 whitespace-nowrap">S/L</th>
                        <th class="px-4 py-3 whitespace-nowrap">Order Code</th>
                        <th class="px-4 py-3 whitespace-nowrap">Customer</th>
                        <th class="px-4 py-3 whitespace-nowrap">Placed on</th>
                        <th class="px-4 py-3 whitespace-nowrap">Items</th>
                        <th class="px-4 py-3 whitespace-nowrap">Location</th>
                        <th class="px-4 py-3 whitespace-nowrap">Payment</th>
                        <th class="px-4 py-3 whitespace-nowrap">Status</th>
                        <th class="px-4 py-3 whitespace-nowrap">Assign Delivered</th>
                        <th class="px-4 py-3 whitespace-nowrap">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-4 py-3 whitespace-nowrap">
                            <input type="checkbox" class="form-checkbox text-blue-500 rounded" />
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">1</td>
                        <td class="px-4 py-3 whitespace-nowrap">ORD-202507</td>
                        <td class="px-4 py-3 whitespace-nowrap">John Doe</td>
                        <td class="px-4 py-3 whitespace-nowrap">2025-07-07</td>
                        <td class="px-4 py-3 whitespace-nowrap">4</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <span class="bg-gray-200 text-gray-700 text-xs px-2 py-1 rounded-full">Kirti Nagar</span>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <span class="text-red-500 font-medium">Unpaid</span>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <span class="text-yellow-600 font-semibold">Out for Delivery</span>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-left">
                            <select
                                class="border border-gray-400 rounded-md px-2 py-1 text-sm text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-400">
                                <option selected disabled>Choose</option>
                                <option value="edit">Edit</option>
                                <option value="delete">Delete</option>
                            </select>
                        </td>
                        <td class="text-left whitespace-nowrap">
                            <div class="border border-gray-400 rounded-md flex justify-center w-[80px]">
                                <a href=""
                                    class="text-blue-500 border-r border-gray-400 hover:text-blue-700 hover:border-blue-700 p-1">
                                    <img src="{{ asset('assets/images/edit.png') }}" alt="Edit"
                                        class="object-contain pr-2">
                                </a>
                                <a href=""
                                    class="text-red-500 hover:text-red-700 hover:border-red-700 rounded p-1 pl-2">
                                    <img src="{{ asset('assets/images/delete.png') }}" alt="Delete"
                                        class="object-contain">
                                </a>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

    </div>





@endsection
