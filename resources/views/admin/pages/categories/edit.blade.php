@extends('admin.pages.layout.main')
@section('title', 'Update Category')
@section('content')
    <div>
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">Update Category</h1>
        </div>

        <!-- Main Form -->
        <div class="space-y-6">
            <!-- Basic Information Card -->
            <div class="bg-white rounded-xl shadow-md p-4">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Basic Information</h2>

                <!--Category Name * -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Category Name  <span class="text-red-500">*</span>
                    </label>
                    <input type="text" placeholder="Enter Category Name "
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" />
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                       Category Description  <span class="text-red-500">*</span>
                    </label>
                    <input type="text" placeholder="Enter Category Description  "
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" />
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Sorting Priority Number   <span class="text-red-500">*</span>
                    </label>
                    <input type="text" placeholder="Enter Sorting Priority Number  "
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" />
                </div>

            </div>

            <div class="bg-white rounded-xl shadow-md p-4">
                <!-- Product Image Upload -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Product Image <span class="text-red-500">*</span>
                    </label>
                    <div
                        class="border border-dashed border-gray-300 rounded-lg h-32 flex flex-col items-center justify-center text-gray-500 text-sm cursor-pointer hover:bg-gray-50 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        <p>Drop or Select File</p>
                        <p class="text-xs mt-1 text-gray-400">Supports JPG, PNG up to 5MB</p>
                    </div>
                </div>

                <p>Please upload a file of type JPG, PNG, or PDF and size less than 10MB.</p>

            </div>
            <!-- Submit Button -->
            <div class="flex justify-start">
                <button type="submit" class="bg-green  text-white font-medium py-3 px-8 rounded-lg ">
                    Save Product
                </button>
            </div>
        </div>
    </div>


@endsection
