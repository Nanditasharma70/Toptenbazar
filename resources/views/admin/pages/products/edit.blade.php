@extends('admin.pages.layout.main')
@section('title', 'Update Products')
@section('content')
    <div class="">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">Edit Product</h1>
        </div>

        <!-- Main Form -->
        <div class="space-y-6">
            <!-- Basic Information Card -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Basic Information</h2>
                
                <!-- Product Name -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Product Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" placeholder="Enter Product Name"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" />
                </div>
                
                <!-- Description -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Description <span class="text-red-500">*</span>
                    </label>
                    <div id="summernote" class="border border-gray-300 rounded-lg overflow-hidden">
                        <p>Enter your product description here...</p>
                    </div>
                </div>
                
                <!-- Product Image Upload -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Product Image <span class="text-red-500">*</span>
                    </label>
                    <div class="border border-dashed border-gray-300 rounded-lg h-32 flex flex-col items-center justify-center text-gray-500 text-sm cursor-pointer hover:bg-gray-50 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        <p>Drop or Select File</p>
                        <p class="text-xs mt-1 text-gray-400">Supports JPG, PNG up to 5MB</p>
                    </div>
                </div>
            </div>
            
            <!-- Category Card -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <label for="product-category" class="block text-sm font-medium text-gray-700 mb-1">
                    Product Category <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <select id="product-category"
                        class="block w-full appearance-none rounded-lg border border-gray-300 bg-white py-3 px-4 pr-10 text-gray-700 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition sm:text-sm">
                        <option disabled selected>Select Categories</option>
                        <option>Electronics</option>
                        <option>Clothing</option>
                        <option>Home & Kitchen</option>
                        <option>Books</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Tags Card -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <label for="product-tags" class="block text-sm font-medium text-gray-700 mb-1">
                    Product Tags <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <select id="product-tags"
                        class="block w-full appearance-none rounded-lg border border-gray-300 bg-white py-3 px-4 pr-10 text-gray-700 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition sm:text-sm">
                        <option disabled selected>Select Tags</option>
                        <option>New Arrival</option>
                        <option>Featured</option>
                        <option>Best Seller</option>
                        <option>Clearance</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Pricing Card -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Product Price -->
                    <div>
                        <label for="product-price" class="block text-sm font-medium text-gray-700 mb-1">
                            Product Price <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input type="text" id="product-price" placeholder="0.00"
                                class="pl-7 w-full rounded-lg border border-gray-300 bg-white py-3 px-4 text-gray-700 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition sm:text-sm" />
                        </div>
                    </div>
                    
                    <!-- Product Unit -->
                    <div>
                        <label for="product-unit" class="block text-sm font-medium text-gray-700 mb-1">
                            Product Unit <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select id="product-unit"
                                class="block w-full appearance-none rounded-lg border border-gray-300 bg-white py-3 px-4 pr-10 text-gray-700 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition sm:text-sm">
                                <option disabled selected>Select Unit</option>
                                <option>Piece</option>
                                <option>Kg</option>
                                <option>Liter</option>
                                <option>Box</option>
                                <option>Set</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Discount Card -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Product Discount</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Date Range -->
                    <div>
                        <label for="date-range" class="block text-sm font-medium text-gray-700 mb-1">
                            Date Range
                        </label>
                        <input type="text" id="date-range" placeholder="Start Date - End Date"
                            class="w-full rounded-lg border border-gray-300 bg-white py-3 px-4 text-gray-700 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition sm:text-sm" />
                    </div>
                    
                    <!-- Discount Amount -->
                    <div>
                        <label for="discount-amount" class="block text-sm font-medium text-gray-700 mb-1">
                            Discount Amount
                        </label>
                        <input type="text" id="discount-amount" placeholder="Enter Amount"
                            class="w-full rounded-lg border border-gray-300 bg-white py-3 px-4 text-gray-700 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition sm:text-sm" />
                    </div>
                    
                    <!-- Percent or Fixed -->
                    <div>
                        <label for="discount-type" class="block text-sm font-medium text-gray-700 mb-1">
                            Percent or Fixed
                        </label>
                        <div class="relative">
                            <select id="discount-type"
                                class="block w-full appearance-none rounded-lg border border-gray-300 bg-white py-3 px-4 pr-10 text-gray-700 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition sm:text-sm">
                                <option disabled selected>Select Type</option>
                                <option>Percent (%)</option>
                                <option>Fixed Amount</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Taxes Card -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Product Taxes</h2>
                <div class="space-y-4">
                    <!-- CGST -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="w-full">
                            <label for="cgst" class="block text-sm font-medium text-gray-700 mb-1">CGST</label>
                            <input type="number" id="cgst" value="0"
                                class="w-full rounded-lg border border-gray-300 bg-white py-3 px-4 text-gray-700 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition sm:text-sm" />
                        </div>
                        <div class="w-full">
                            <label for="cgst-type" class="block text-sm font-medium text-gray-700 mb-1">Percent or Fixed</label>
                            <select id="cgst-type"
                                class="w-full rounded-lg border border-gray-300 bg-white py-3 px-4 pr-10 text-gray-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition sm:text-sm">
                                <option disabled selected>Select Type</option>
                                <option>Percent (%)</option>
                                <option>Fixed Amount</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- SGST -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="w-full">
                            <label for="sgst" class="block text-sm font-medium text-gray-700 mb-1">SGST</label>
                            <input type="number" id="sgst" value="0"
                                class="w-full rounded-lg border border-gray-300 bg-white py-3 px-4 text-gray-700 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition sm:text-sm" />
                        </div>
                        <div class="w-full">
                            <label for="sgst-type" class="block text-sm font-medium text-gray-700 mb-1">Percent or Fixed</label>
                            <select id="sgst-type"
                                class="w-full rounded-lg border border-gray-300 bg-white py-3 px-4 pr-10 text-gray-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition sm:text-sm">
                                <option disabled selected>Select Type</option>
                                <option>Percent (%)</option>
                                <option>Fixed Amount</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- IGST -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="w-full">
                            <label for="igst" class="block text-sm font-medium text-gray-700 mb-1">IGST</label>
                            <input type="number" id="igst" value="0"
                                class="w-full rounded-lg border border-gray-300 bg-white py-3 px-4 text-gray-700 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition sm:text-sm" />
                        </div>
                        <div class="w-full">
                            <label for="igst-type" class="block text-sm font-medium text-gray-700 mb-1">Percent or Fixed</label>
                            <select id="igst-type"
                                class="w-full rounded-lg border border-gray-300 bg-white py-3 px-4 pr-10 text-gray-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition sm:text-sm">
                                <option disabled selected>Select Type</option>
                                <option>Percent (%)</option>
                                <option>Fixed Amount</option>
                            </select>
                        </div>
                    </div>
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
    
    <script>
        $(document).ready(function() {
            // Initialize Summernote with minimal configuration
            $('#summernote').summernote({
                height: 200,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
            
            // Add border styling to Summernote container after initialization
            $('.note-editor').addClass('border border-gray-300 rounded-lg');
            
            // Prevent Summernote from disrupting other elements
            $('.note-modal').each(function() {
                $(this).css('z-index', '9999');
            });
        });
    </script>
@endsection