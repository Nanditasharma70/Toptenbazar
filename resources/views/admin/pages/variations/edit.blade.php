@extends('admin.pages.layout.main')
@section('title', 'Update Variation')
@section('content')
    <div class="">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">Update Variation</h1>
        </div>

        <!-- Main Form -->
        <div class="space-y-6">
            <!-- Basic Information Card -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Basic Information</h2>
                
                <!-- Product Name -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Variation Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" placeholder="Enter Variation Name"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" />
                </div>
                
                
            </div>
            
            <!-- Submit Button -->
            <div class="flex justify-start">
                <button type="submit"
                    class="bg-green  text-white font-medium py-3 px-8 rounded-lg ">
                    Save Product
                </button>
            </div>
        </div>
    </div>
    
   
@endsection