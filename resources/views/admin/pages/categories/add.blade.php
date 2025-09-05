@extends('admin.pages.layout.main')
@section('title', 'Add Category')
@section('content')
    <div>
        <!-- Header -->

        <div class="flex flex-col xs:flex-row justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">Add Category</h1>
            <a href="{{ route('category.index') }}"
                class="mt-2 md:mt-0 inline-block px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">
                &larr; Back
            </a>
        </div>

        <!-- Main Form -->
        <form id="cat_form" method="POST">
            @csrf
            <div class="space-y-6">
                <!-- Basic Information Card -->
                <div class="bg-white rounded-xl shadow-md p-4">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6">Basic Information</h2>

                    <!--Category Name * -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Category Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" placeholder="Enter Category Name" name="name" id="name"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" />
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Sub Category <span class="text-red-500">*</span>
                        </label>
                        <select id="multiple" class="js-states form-control w-full " name="sub_cat[]" multiple>
                            <option value="">Select Sub Categories</option>
                            @if(isset($subCats) && count($subCats) > 0)
                            @foreach ($subCats as $sub )
                            <option value="{{ $sub->slug }}">{{ $sub->name }}</option>
                            @endforeach
                            @endif
                        </select>
                     
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Category Description <span class="text-red-500">*</span>
                        </label>
                        <input type="text" placeholder="Enter Category Description" name="description"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" />
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Sorting Priority Number <span class="text-red-500">*</span>
                        </label>
                        <input type="number" placeholder="Enter Sorting Priority Number" name="sorting_p_num"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" />
                    </div>
                    <!-- Image Upload Section -->
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
                                <input id="hidden-input" type="file" name="images" id="images" multiple
                                    class="hidden" />
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


                <!-- Submit Button -->
            <div class="flex justify-start">
                  <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-8 rounded-lg FormSubmitBtn flex items-center justify-center gap-2 relative cursor-pointer">
                        <span>Save Categories</span>
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
      $("#multiple").select2({
          placeholder: "Select Sub Categories",
          allowClear: true
      });
        document.addEventListener("DOMContentLoaded", () => {
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
            $('#cat_form').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                filesArray.forEach((file, index) => {
                    formData.append('images[]', file);
                });
                $.ajax({
                    url: "{{ route('category.store') }}",
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
                        toastr.success(response.message || "Category saved successfully!");
                        $('#cat_form')[0].reset();
                        document.getElementById('gallery').innerHTML = '';
                        window.location.href = "{{ route('category.index') }}";
                        // document.getElementById('multiple').innerHTML = "";
                        // $('#multiple').val(null).trigger('change');
                        // $('#multiple').val([]).trigger('change');
                        // $(".select2-selection__clear").click();
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
