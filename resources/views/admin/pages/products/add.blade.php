@extends('admin.pages.layout.main')
@section('title', 'Add Products')
@section('content')
    <div>
        <!-- Header -->

        <div class="flex flex-col xs:flex-row justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">Add Product</h1>
            <a href="{{ route('products.index') }}"
                class="mt-2 md:mt-0 inline-block px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">
                &larr; Back
            </a>
        </div>


        <!-- Main Form -->
        <div class="space-y-6">
            <!-- Basic Information Card -->
            <form id="product_form" method="POST">
                @csrf
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Basic Information</h2>

                <!-- Product Name -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Product Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" placeholder="Enter Product Name" name="name" id="name"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" />
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Description <span class="text-red-500">*</span>
                    </label>

                     <textarea id="summernote" name="description" class="border border-gray-300 rounded-lg overflow-hidden w-full"></textarea>
                    {{-- <div id="summernote" name="description" class="border border-gray-300 rounded-lg overflow-hidden w-full">
                        <p>Enter your product description here...</p>
                    </div> --}}
                </div>

                <!-- Product Image Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Upload Image <span class="text-red-500">*</span>
                    </label>

                    <!-- File Upload Modal -->
                    <article aria-label="File Upload Modal"
                        class="relative flex flex-col bg-white shadow-md rounded-md border border-dashed border-gray-400 p-6"
                        ondrop="dropHandler(event);" ondragover="dragOverHandler(event);"
                        ondragleave="dragLeaveHandler(event);" ondragenter="dragEnterHandler(event);">

                        <div id="overlay"
                            class="absolute inset-0 pointer-events-none z-50 flex flex-col items-center justify-center rounded-md hidden">
                            <svg class="fill-current w-12 h-12 mb-3 text-blue-700" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path
                                    d="M19.479 10.092c-.212-3.951-3.473-7.092-7.479-7.092-4.005 0-7.267 3.141-7.479 7.092-2.57.463-4.521 2.706-4.521 5.408 0 3.037 2.463 5.5 5.5 5.5h13c3.037 0 5.5-2.463 5.5-5.5 0-2.702-1.951-4.945-4.521-5.408zm-7.479-1.092l4 4h-3v4h-2v-4h-3l4-4z" />
                            </svg>
                            <p class="text-lg text-blue-700">Drop files to upload</p>
                        </div>

                        <header class="text-center">
                            <p class="mb-3 font-semibold text-gray-900">
                                Drag and drop your files or
                            </p>
                            <input id="hidden-input" type="file" name="images" id="images" multiple class="hidden" />
                            <button type="button" id="button"
                                class="mt-2 rounded px-4 py-2 bg-gray-200 hover:bg-gray-300 text-sm">
                                Upload a file
                            </button>
                        </header>

                        <!-- Preview Area -->
                        <div class="mt-4">
                            <ul id="gallery" class="flex flex-wrap gap-2">
                                <li id="empty" class="text-center w-full">
                                </li>
                            </ul>
                        </div>
                    </article>
                </div>
            </div>

            <!-- product Category -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <label for="product-category" class="block text-sm font-medium text-gray-700 mb-1">
                    Product Category <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <select id="category_id"  name="category_id"
                        class="block w-full appearance-none rounded-lg border border-gray-300 bg-white py-3 px-4 pr-10 text-gray-700 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition sm:text-sm">
                        <option value="" disabled selected>Select Categories</option>
                        @if (isset($categories) && count($categories) > 0)
                            @foreach ($categories as $cat )
                                  <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
            <!-- Sub Category -->

            <div class="bg-white rounded-xl shadow-md p-6">
                <label for="product-category" class="block text-sm font-medium text-gray-700 mb-1">
                    Sub Category <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <select id="sub_category_id" name="sub_category_id"
                        class="block w-full appearance-none rounded-lg border border-gray-300 bg-white py-3 px-4 pr-10 text-gray-700 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition sm:text-sm">
                        <option value="" disabled selected>Select Sub Categories</option>
                          @if (isset($subCats) && count($subCats) > 0)
                            @foreach ($subCats as $subCat )
                                  <option value="{{ $subCat->id }}">{{ $subCat->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
            <!-- Variations -->

            <div class="bg-white rounded-xl shadow-md p-6">
                <label for="product-category" class="block text-sm font-medium text-gray-700 mb-1">
                    Variations<span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <select id="variation_id" name="variation_id"
                        class="block w-full appearance-none rounded-lg border border-gray-300 bg-white py-3 px-4 pr-10 text-gray-700 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition sm:text-sm">
                        <option value="" disabled selected>Select Variation</option>
                        @if (isset($variations) && count($variations) > 0)
                            @foreach ($variations as $variation )
                                  <option value="{{ $variation->id }}">{{ $variation->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
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
                    <select id="product_tag_id" name="product_tag_id"
                        class="block w-full appearance-none rounded-lg border border-gray-300 bg-white py-3 px-4 pr-10 text-gray-700 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition sm:text-sm">
                        <option value="" disabled selected>Select Tags</option>
                       @if (isset($productTags) && count($productTags) > 0)
                            @foreach ($productTags as $tags )
                                  <option value="{{ $tags->id }}">{{ $tags->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pricing Card -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Product Price -->
                    <div>
                        <label for="product_price"  class="block text-sm font-medium text-gray-700 mb-1">
                            Product Price <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">₹</span>
                            </div>
                            <input type="number" id="product_price" name="product_price" placeholder="0.00"
                                class="pl-7 w-full rounded-lg border border-gray-300 bg-white py-3 px-4 text-gray-700 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition sm:text-sm" />
                        </div>
                    </div>

                    <!-- Product Unit -->
                    <div>
                        <label for="product-unit" class="block text-sm font-medium text-gray-700 mb-1">
                            Product Unit <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select id="unit_id" name="unit_id"
                                class="block w-full appearance-none rounded-lg border border-gray-300 bg-white py-3 px-4 pr-10 text-gray-700 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition sm:text-sm">
                                <option value="" disabled selected>Select Unit</option>
                                @if (isset($units) && count($units) > 0)
                                    @foreach ($units as $unit )
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
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
                    {{-- <div>
                        <label for="date-range" class="block text-sm font-medium text-gray-700 mb-1">
                            Date Range
                        </label>
                        <input type="text" id="date-range" placeholder="Start Date - End Date"
                            class="w-full rounded-lg border border-gray-300 bg-white py-3 px-4 text-gray-700 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition sm:text-sm" />
                    </div> --}}

                    <!-- Discount Amount -->
                    <div>
                        <label for="discount-amount" class="block text-sm font-medium text-gray-700 mb-1">
                            Discount Amount
                        </label>
                      
                        <input type="number" id="discount_amount" name="discount_amount" placeholder="Enter Amount"
                            class="w-full rounded-lg border border-gray-300 bg-white py-3 px-4 text-gray-700 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition sm:text-sm" />
                    </div>

                    <!-- Percent or Fixed -->
                    <div>
                        <label for="discount-type" class="block text-sm font-medium text-gray-700 mb-1">
                            Percent or Fixed
                        </label>
                        <div class="relative">
                            <select id="discount_type" name="discount_type"
                                class="block w-full appearance-none rounded-lg border border-gray-300 bg-white py-3 px-4 pr-10 text-gray-700 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition sm:text-sm">
                                <option disabled selected>Select Type</option>
                                <option value="percent">Percent (%)</option>
                                <option value="fixed">Fixed Amount</option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

           <!-- Submit Button -->
            <div class="flex justify-start">
                  <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-8 rounded-lg FormSubmitBtn flex items-center justify-center gap-2 relative cursor-pointer">
                        <span>Save Product</span>
                        <!-- Tailwind CSS Spinner -->
                        <svg id="loader" class="hidden w-5 h-5 text-white animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>
                    </button>
            </div>
        </div>
        </form>
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

          
            // Sidebar Toggle
            $('#toggleSidebar').on('click', function() {
                $('#sidebar').toggleClass('-translate-x-full');
            });

            const fileInput = document.getElementById("hidden-input");
            const uploadButton = document.getElementById("button");
            const gallery = document.getElementById("gallery");
            const emptyMessage = document.getElementById("empty");
            const overlay = document.getElementById("overlay");

            let filesArray = [];

            // Open file dialog
            uploadButton.addEventListener("click", () => fileInput.click());

            // On file input change
            fileInput.addEventListener("change", (e) => handleFiles(e.target.files));

            // Drag & Drop handlers
            window.dropHandler = function(e) {
                e.preventDefault();
                overlay.classList.add("hidden");
                if (e.dataTransfer.files.length) {
                    handleFiles(e.dataTransfer.files);
                }
            };

            window.dragOverHandler = function(e) {
                e.preventDefault();
                overlay.classList.remove("hidden");
            };

            window.dragLeaveHandler = function(e) {
                e.preventDefault();
                overlay.classList.add("hidden");
            };

            window.dragEnterHandler = function(e) {
                e.preventDefault();
                overlay.classList.remove("hidden");
            };
            // Handle files
            function handleFiles(files) {
                for (const file of files) {
                    // Only image types allowed
                    if (!file.type.startsWith("image/")) continue;
                    // Optional: avoid duplicate uploads
                    if (filesArray.some(f => f.name === file.name && f.size === file.size)) continue;
                    filesArray.push(file);
                    previewFile(file);
                }
                updateEmptyState();
            }

            // Preview a file
            function previewFile(file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const li = document.createElement("li");
                    li.className = "block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-24";

                    li.innerHTML = `
                <article class="group hasImage w-full h-full rounded-md bg-gray-100 relative shadow-sm overflow-hidden">
                    <img class="img-preview w-full h-full object-cover rounded-md" src="${e.target.result}" alt="${file.name}" />
                    <section class="absolute top-0 left-0 right-0 bottom-0 bg-black bg-opacity-30 opacity-0 group-hover:opacity-100 transition flex justify-end items-start p-1">
                        <button class="delete p-1 text-white hover:text-red-500" title="Remove">
                            <svg class="fill-current w-5 h-5 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M3 6l3 18h12l3-18h-18zm19-4v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z"/>
                            </svg>
                        </button>
                    </section>
                </article>
            `;

                    // Delete file event
                    li.querySelector(".delete").addEventListener("click", () => {
                        filesArray = filesArray.filter(f => f !== file);
                        li.remove();
                        updateEmptyState();
                    });
                    gallery.appendChild(li);
                };
                reader.readAsDataURL(file);
            }

             // Toggle "No files selected" message
            function updateEmptyState() {
                emptyMessage.style.display = filesArray.length ? "none" : "block";
            }
            // form submit
            $('#product_form').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                filesArray.forEach((file, index) => {
                    formData.append('images[]', file);
                });
                $.ajax({
                    url: "{{ route('products.store') }}",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                      beforeSend: function () {
                        $('#loader').show();
                        $('.FormSubmitBtn').prop('disabled', true);
                    },
                    success: function(response) {
                        $('#loader').hide();
                        $('.FormSubmitBtn').prop('disabled', false);
                        toastr.success(response.message || "Product saved successfully!");
                        $('#product_form')[0].reset();
                        document.getElementById('gallery').innerHTML = '';
                        window.location.href = "{{ route('products.index') }}"; 
                    },
                    error: function(xhr) {
                         $('#loader').hide();
                        $('.FormSubmitBtn').prop('disabled', false);
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            $.each(xhr.responseJSON.errors, function(key, error) {
                                toastr.error(error);
                            });
                        } else {
                            toastr.error("Something went wrong!");
                        }
                    }
                });
            });
        });
    </script>



@endsection
