@extends('admin.pages.layout.main')
@section('title', 'Taxes')
@section('content')
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-center  mb-6">
        <h1 class="text-2xl font-semibold">Taxes</h1>
        <div class="flex space-x-4 mt-4 md:mt-0">
            <a href="{{ route('taxes.create') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">+
                Add Taxes</a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-4 w-full overflow-x-auto">


        <!-- Filters -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
            <input type="text" placeholder="Search"
                class="w-full md:w-1/3 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" />
            <div class="flex gap-2">
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
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-100 text-xs uppercase text-gray-500">
                <tr>
                    <th class="px-4 py-3">S/L</th>
                    <th class="px-4 py-3"> Name</th>
                    <th class="px-4 py-3">Active</th>
                    <th class="px-4 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <!-- Repeatable Row -->
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="px-4 py-3">1</td>
                    <td class="px-4 py-3 flex items-center gap-3">
                        <span>CGST</span>
                    </td>
                    <td class="px-4 py-3">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" checked>
                            <div
                                class="w-10 h-5 bg-gray-200 rounded-full peer-checked:bg-green-500 relative after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:after:translate-x-5">
                            </div>
                        </label>
                    </td>
                    <td class="px-4 py-3 text-center">
                        <div
                            class="flex justify-center items-center gap-2 border border-gray-300 rounded-md px-2 py-1 w-fit mx-auto">
                            <!-- Edit Button -->
                            <a href="{{ route('taxes.edit',['id' => 4]) }}" class="hover:text-blue-700 text-blue-500 border-r border-gray-300 pr-2">
                                <img src="{{ asset('assets/images/edit.png') }}" alt="Edit" class="object-contain pr-2">
                            </a>
                            <!-- Delete Button -->
                            <button type="button" class="hover:text-red-700 text-red-500 pl-2">
                                <img src="{{ asset('assets/images/delete.png') }}" alt="Delete" class="object-contain">
                            </button>
                        </div>
                    </td>
                </tr>
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="px-4 py-3">1</td>
                    <td class="px-4 py-3 flex items-center gap-3">
                        <span>SGST</span>
                    </td>
                    <td class="px-4 py-3">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" checked>
                            <div
                                class="w-10 h-5 bg-gray-200 rounded-full peer-checked:bg-green-500 relative after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:after:translate-x-5">
                            </div>
                        </label>
                    </td>
                    <td class="px-4 py-3 text-center">
                        <div
                            class="flex justify-center items-center gap-2 border border-gray-300 rounded-md px-2 py-1 w-fit mx-auto">
                            <!-- Edit Button -->
                            <button type="button" class="hover:text-blue-700 text-blue-500 border-r border-gray-300 pr-2">
                                <img src="{{ asset('assets/images/edit.png') }}" alt="Edit" class="object-contain pr-2">
                            </button>
                            <!-- Delete Button -->
                            <button type="button" class="hover:text-red-700 text-red-500 pl-2">
                                <img src="{{ asset('assets/images/delete.png') }}" alt="Delete" class="object-contain">
                            </button>
                        </div>
                    </td>
                </tr>
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="px-4 py-3">1</td>
                    <td class="px-4 py-3 flex items-center gap-3">
                        <span>IGST</span>
                    </td>
                    <td class="px-4 py-3">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" checked>
                            <div
                                class="w-10 h-5 bg-gray-200 rounded-full peer-checked:bg-green-500 relative after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:after:translate-x-5">
                            </div>
                        </label>
                    </td>
                    <td class="px-4 py-3 text-center">
                        <div
                            class="flex justify-center items-center gap-2 border border-gray-300 rounded-md px-2 py-1 w-fit mx-auto">
                            <!-- Edit Button -->
                            <button type="button" class="hover:text-blue-700 text-blue-500 border-r border-gray-300 pr-2">
                                <img src="{{ asset('assets/images/edit.png') }}" alt="Edit" class="object-contain pr-2">
                            </button>
                            <!-- Delete Button -->
                            <button type="button" class="hover:text-red-700 text-red-500 pl-2">
                                <img src="{{ asset('assets/images/delete.png') }}" alt="Delete" class="object-contain">
                            </button>
                        </div>
                    </td>
                </tr>
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="px-4 py-3">1</td>
                    <td class="px-4 py-3 flex items-center gap-3">
                        <span>VAT</span>
                    </td>
                    <td class="px-4 py-3">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" checked>
                            <div
                                class="w-10 h-5 bg-gray-200 rounded-full peer-checked:bg-green-500 relative after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:after:translate-x-5">
                            </div>
                        </label>
                    </td>
                    <td class="px-4 py-3 text-center">
                        <div
                            class="flex justify-center items-center gap-2 border border-gray-300 rounded-md px-2 py-1 w-fit mx-auto">
                            <!-- Edit Button -->
                            <button type="button" class="hover:text-blue-700 text-blue-500 border-r border-gray-300 pr-2">
                                <img src="{{ asset('assets/images/edit.png') }}" alt="Edit" class="object-contain pr-2">
                            </button>
                            <!-- Delete Button -->
                            <button type="button" class="hover:text-red-700 text-red-500 pl-2">
                                <img src="{{ asset('assets/images/delete.png') }}" alt="Delete" class="object-contain">
                            </button>
                        </div>
                    </td>
                </tr>
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="px-4 py-3">1</td>
                    <td class="px-4 py-3 flex items-center gap-3">
                        <span>IRB</span>
                    </td>
                    <td class="px-4 py-3">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" checked>
                            <div
                                class="w-10 h-5 bg-gray-200 rounded-full peer-checked:bg-green-500 relative after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:after:translate-x-5">
                            </div>
                        </label>
                    </td>
                    <td class="px-4 py-3 text-center">
                        <div
                            class="flex justify-center items-center gap-2 border border-gray-300 rounded-md px-2 py-1 w-fit mx-auto">
                            <!-- Edit Button -->
                            <button type="button"
                                class="hover:text-blue-700 text-blue-500 border-r border-gray-300 pr-2">
                                <img src="{{ asset('assets/images/edit.png') }}" alt="Edit"
                                    class="object-contain pr-2">
                            </button>
                            <!-- Delete Button -->
                            <button type="button" class="hover:text-red-700 text-red-500 pl-2">
                                <img src="{{ asset('assets/images/delete.png') }}" alt="Delete" class="object-contain">
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- Copy above row to add more -->
            </tbody>
        </table>


        <!-- Pagination -->
        <div class="flex flex-col md:flex-row md:justify-between items-center mt-4 text-sm text-gray-500">
            <span>Showing 1–15 of 21 results</span>
            <div class="flex items-center gap-2 mt-2 md:mt-0">
                <button class="text-gray-400 cursor-not-allowed" disabled>&lt; Previous</button>
                <button class="w-8 h-8 bg-green-500 text-white rounded-md">1</button>
                <button class="w-8 h-8 bg-gray-200 text-gray-800 rounded-md">2</button>
                <button class="w-8 h-8 bg-gray-200 text-gray-800 rounded-md">3</button>
                <button class="w-8 h-8 bg-gray-200 text-gray-800 rounded-md">4</button>
                <button class="text-green-600 hover:underline">Next &gt;</button>
            </div>
        </div>
    </div>
@endsection
