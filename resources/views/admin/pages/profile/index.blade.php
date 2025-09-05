@extends('admin.pages.layout.main')
@section('title', 'Unit')
@section('content')
    <div class="flex flex-col md:flex-row justify-between items-center  mb-6">
        <h1 class="text-2xl font-semibold">Update Porfile</h1>
        <div class="flex space-x-4 mt-4 md:mt-0">
            <a href="{{ route('unit.create') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                back</a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-4 w-full overflow-x-auto">


        <h2 class="text-xl font-semibold text-gray-800 mb-6">Basic Information</h2>

        <form class="space-y-6">
            <!-- Name -->
            <div>
                <label class="block mb-1 font-medium">Name <span class="text-red-500">*</span></label>
                <input type="text" value="Admin"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none" />
            </div>

            <!-- Email -->
            <div>
                <label class="block mb-1 font-medium">Email <span class="text-red-500">*</span></label>
                <input type="email" value="admin@gmail.com"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none" />
            </div>

            <!-- Phone -->
            <div>
                <label class="block mb-1 font-medium">Phone</label>
                <input type="text" placeholder="Enter Phone Number"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none" />
            </div>

            <!-- Avatar Upload -->
            <div>
                <label class="block mb-1 font-medium">Avatar</label>
                <div
                    class="w-full h-32 flex items-center justify-center border border-dashed border-gray-300 rounded-md text-gray-500">
                    Drop or Select File
                </div>
                <p class="text-sm text-gray-600 mt-1">Please upload a file of type JPG, PNG, or PDF and size less than
                    10MB.</p>
            </div>

            <!-- Password -->
            <div>
                <label class="block mb-1 font-medium">Password</label>
                <input type="password" placeholder="Type Password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label class="block mb-1 font-medium">Confirm Password</label>
                <input type="password" placeholder="Re-type Password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none" />
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md">
                    Save Profile
                </button>
            </div>
        </form>






    </div>
@endsection
