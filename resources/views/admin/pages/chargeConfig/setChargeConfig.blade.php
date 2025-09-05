@extends('admin.pages.layout.main')
@section('title', 'Unit')
@section('content')

    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Set Charge </h1>
        <a href="{{ route('category.index') }}"
            class="mt-2 md:mt-0 inline-block px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">
            &larr; Back
        </a>
    </div>
    <div class="space-y-6">
        <!-- Basic Information Card -->
        <div class="bg-white rounded-xl shadow-md p-4">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Basic Information</h2>

            <div class="space-y-6 w-full ">
                <!-- Config Name -->
                <div>
                    <label class="block mb-1 text-sm font-semibold text-gray-700">
                        Charge Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" placeholder="Enter Charge Name"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" />
                </div>

                <!-- Charge Type -->
                <div>
                    <label class="block mb-1 text-sm font-semibold text-gray-700">
                        Charge Type <span class="text-red-500">*</span>
                    </label>

                    <div class="flex items-center gap-4">
                        <label class="inline-flex items-center">
                            <input type="radio" name="charge_type" value="NEW YEAR"
                                class="text-blue-600 focus:ring-blue-400" checked>
                            <span class="ml-2 text-sm text-gray-700">NEW YEAR</span>
                        </label>

                        <label class="inline-flex items-center">
                            <input type="radio" name="charge_type" value="CHRISTMAS"
                                class="text-blue-600 focus:ring-blue-400">
                            <span class="ml-2 text-sm text-gray-700">CHRISTMAS</span>
                        </label>

                        <label class="inline-flex items-center">
                            <input type="radio" name="charge_type" value="OTHER"
                                class="text-blue-600 focus:ring-blue-400">
                            <span class="ml-2 text-sm text-gray-700">OTHER</span>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-semibold text-gray-700">
                        Calculation Type <span class="text-red-500">*</span>
                    </label>
                    <div class="flex items-center gap-4">
                        <label class="flex items-center space-x-2">
                            <input type="radio" name="calculation_type" value="percentage" class="text-blue-500">
                            <span>Percentage</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="radio" name="calculation_type" value="fixed" class="text-blue-500">
                            <span>Fixed Amount</span>
                        </label>
                    </div>
                </div>

                 <div>
                    <label class="block mb-1 text-sm font-semibold text-gray-700">
                        Rate <span class="text-red-500">*</span>
                    </label>
                    <input type="text" placeholder="Enter Rate"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" />
                </div>

                  <div>
                    <label class="block mb-1 text-sm font-semibold text-gray-700">
                       Capping <span class="text-red-500">*</span>
                    </label>
                    <input type="text" placeholder="Enter Capping"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" />
                </div>







            </div>


        </div>


        <div class="flex justify-start">
            <button type="submit" class="bg-green  text-white font-medium py-3 px-8 rounded-lg ">
                Save Product
            </button>
        </div>
    </div>
@endsection
