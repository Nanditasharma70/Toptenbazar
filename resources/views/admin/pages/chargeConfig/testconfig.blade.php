@extends('admin.pages.layout.main')
@section('title', 'Unit')
@section('content')
    <div class="flex flex-col md:flex-row justify-between items-center  mb-6">
        <h1 class="text-2xl font-semibold"> Test Charge Config</h1>
        <div class="flex space-x-4 mt-4 md:mt-0">
            <a href="{{ route('charge-config.create') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">+
                Set Charge Config</a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-4 w-full overflow-x-auto">
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


        <div class="overflow-x-auto">
            <table class="min-w-full bg-white text-sm text-left text-gray-800 border border-gray-200">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-4 py-3 whitespace-nowrap">Config Name</th>
                        <th class="px-4 py-3 whitespace-nowrap">Type</th>
                        <th class="px-4 py-3 whitespace-nowrap">Mode</th>
                        <th class="px-4 py-3 whitespace-nowrap">Value</th>
                        <th class="px-4 py-3 whitespace-nowrap">Min</th>
                        <th class="px-4 py-3 whitespace-nowrap">Max</th>
                        <th class="px-4 py-3 whitespace-nowrap">Total</th>
                        <th class="px-4 py-3 whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 whitespace-nowrap">Test</td>
                        <td class="px-4 py-2 whitespace-nowrap">Handling Charge</td>
                        <td class="px-4 py-2 whitespace-nowrap">Percent</td>
                        <td class="px-4 py-2 whitespace-nowrap">80</td>
                        <td class="px-4 py-2 whitespace-nowrap">200</td>
                        <td class="px-4 py-2 whitespace-nowrap">500</td>
                        <td class="px-4 py-2 whitespace-nowrap">800</td>
                        <td class="px-4 py-2 flex flex-nowrap gap-2">
                            <button class="bg-sky-500 hover:bg-sky-600 text-white px-3 py-1 rounded text-xs">Edit</button>
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">Delete</button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">Test</td>
                        <td class="px-4 py-2">Delivery Charge</td>
                        <td class="px-4 py-2">Percent</td>
                        <td class="px-4 py-2">80</td>
                        <td class="px-4 py-2">200</td>
                        <td class="px-4 py-2">500</td>
                        <td class="px-4 py-2">800</td>
                        <td class="px-4 py-2 flex gap-2">
                            <button class="bg-sky-500 hover:bg-sky-600 text-white px-3 py-1 rounded text-xs">Edit</button>
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">Delete</button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">Test</td>
                        <td class="px-4 py-2">Handling Charge</td>
                        <td class="px-4 py-2">Fixed</td>
                        <td class="px-4 py-2">80</td>
                        <td class="px-4 py-2">NA</td>
                        <td class="px-4 py-2">500</td>
                        <td class="px-4 py-2">800</td>
                        <td class="px-4 py-2 flex gap-2">
                            <button class="bg-sky-500 hover:bg-sky-600 text-white px-3 py-1 rounded text-xs">Edit</button>
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">Delete</button>
                        </td>
                    </tr>
                    <!-- Repeat rows as needed -->
                </tbody>
            </table>
        </div>



    </div>
@endsection
