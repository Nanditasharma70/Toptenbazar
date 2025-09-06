@extends('admin.pages.layout.main')
@section('title', 'Category')
@section('content')

<!-- Header Section -->
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-semibold">Category</h1>
    <div class="flex space-x-4 mt-4 md:mt-0">
        <a href="{{ route('category.create') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">+
            Add Category</a>
    </div>
</div>

<div class="bg-white rounded-xl shadow-md p-4 w-full overflow-x-auto">
    <!-- Filters and Search -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">

        <!-- Search Input -->
        <div class="relative w-full md:w-[70%]">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                <i class="fas fa-search"></i> <!-- Font Awesome search icon -->
            </span>
            <input type="text" id="searchInput" placeholder="Search"
                class="w-full px-4 py-1 pl-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" />
        </div>
        <!-- Filters -->
        <div class="flex gap-4">

            <!-- Category Select -->
            <select id="categoryFilter"
                class="border border-gray-300 rounded-md px-4 py-1 focus:outline-none focus:ring-2 focus:ring-blue-400 w-1/2">
                <option value="">Select Category Name</option>
                {{-- Dynamically populate categories here --}}
                <option value="1">Category 1</option>
                <option value="2">Category 2</option>
            </select>

            <!-- Sort Select -->
            <select id="sortFilter"
                class="border border-gray-300 rounded-md px-4 py-1 focus:outline-none focus:ring-2 focus:ring-blue-400 w-1/2">
                <option value="">Sort By</option>
                <option value="desc">Newest</option>
                <option value="asc">Oldest</option>
            </select>

        </div>

    </div>


    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-800 data-table">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 font-semibold whitespace-nowrap">S/L</th>
                    <th class="px-4 py-3 font-semibold whitespace-nowrap">Category Name</th>
                    <th class="px-4 py-3 font-semibold whitespace-nowrap">Sub Category</th>
                    <th class="px-4 py-3 font-semibold whitespace-nowrap">Description</th>
                    <th class="px-4 py-3 font-semibold whitespace-nowrap">Priority</th>
                    <th class="px-4 py-3 font-semibold whitespace-nowrap">Favourite</th>
                    <th class="px-4 py-3 font-semibold whitespace-nowrap">Action</th>
                </tr>
            </thead>

        </table>
    </div>
</div>
{{-- delete modal --}}
<div id="deleteModal" class="fixed inset-0 flex items-center justify-center z-50  bg-opacity-40 hidden">
    <div class="absolute inset-0 bg-black opacity-75 backdrop-blur-sm transition-all duration-300"></div>

    <div class="bg-white rounded-xl w-full max-w-sm shadow-lg p-6 relative">
        <!-- Close Icon -->
        <button class="absolute top-4 right-4 text-gray-500 hover:text-black text-2xl cancel-btn cursor-pointer">
            &times;
        </button>

        <!-- Title -->
        <h2 class="text-lg font-semibold text-gray-800">Delete Confirmation</h2>
        <hr class="my-4">

        <!-- Icon -->
        <div class="flex justify-center mb-4">
            <div class="bg-red-600 w-20 h-20 rounded-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3m5 0H6" />
                </svg>
            </div>
        </div>

        <!-- Text -->
        <p class="text-center text-lg font-semibold text-gray-800 mb-6">
            Are you sure to delete this?
        </p>

        <!-- Buttons -->
        <div class="flex justify-center gap-4">
            <button
                class="bg-gray-200 text-gray-800 font-medium px-6 py-2 rounded-md hover:bg-gray-300 cancel-btn cursor-pointer">
                Cancel
            </button>
            <button
                class="bg-red-600 text-white font-medium px-6 py-2 rounded-md hover:bg-red-700 confirm-delete-btn cursor-pointer">
                Delete
            </button>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="customModal" class="fixed inset-0 z-50 hidden b bg-opacity-40 flex items-center justify-center">
    <div class="absolute inset-0 bg-black opacity-75 backdrop-blur-sm transition-all duration-300"></div>

    <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 relative">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-bold text-gray-800">Sub Categories</h2>
            <button onclick="closeModal()" class="text-gray-500 text-2xl leading-none hover:text-black">&times;</button>
        </div>

        <!-- Subcategory Grid -->
        <div id="subCatContainer"
            class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-3 justify-center items-center">

        </div>

    </div>
</div>

@push('scripts')
<script>
var table;

$(document).ready(function() {
    table = $('.data-table').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "bLengthChange": true,
        "stateSave": true,
        "searching": false, // We'll handle search manually
        "info": true,
        drawCallback: function() {
            $('.data-table tbody tr td').addClass('border-b border-table');
        },
        "language": {
            "searchPlaceholder": "Search Categories",
            "processing": '<i class="fa fa-spinner" aria-hidden="true"></i>',
        },
        ajax: {
            url: "{{ route('category.index') }}",
            data: function(d) {
                d.search = $('#searchInput').val();
                d.category_id = $('#categoryFilter').val();
                d.sort = $('#sortFilter').val();
            }
        },
        "columns": [{
                "data": "id",
                "render": function(data, type, row, meta) {
                    return meta.settings._iDisplayStart + meta.row + 1;
                }
            },
            {
                "data": "name"
            },
            {
                "data": "sub_cat"
            },
            {
                "data": "description"
            },
            {
                "data": "sorting_priority_number"
            },
            {
                "data": "status"
            },
            {
                "data": "action"
            }
        ]
    });

    // Trigger reload when filters change
    $('#searchInput, #categoryFilter, #sortFilter').on('input change', function() {
        table.draw();
    });
});

function changeStatus(slug) {
    $.ajax({
        url: "{{ route('favourite-status') }}",
        method: "get",
        contentType: "application/json",
        data: {
            "_token": "{{ csrf_token() }}",
            "categorySlug": slug,
        },
        success: function(response) {
            if (response.status) {
                table.draw(false);
                toastr.success(response.success);
            } else {
                toastr.error(response.error || "Something went wrong");
            }
        },
        error: function(xhr, request, status, errorResponse) {
            toastr.error(xhr.responseText);
        }
    });
}

function openModal(restSubCatArray) {
    console.log(restSubCatArray);
    const container = document.getElementById('subCatContainer');
    container.innerHTML = ''; // Clear existing items

    if (restSubCatArray && restSubCatArray.length > 0) {
        restSubCatArray.forEach(item => {
            const span = document.createElement('span');
            span.className = 'bg-gray-200 rounded-xl px-3 py-2 text-center block w-full';
            span.textContent = item;
            container.appendChild(span);
        });
    }
    document.getElementById('customModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('customModal').classList.add('hidden');
}

// Delete modal
function openDeleteModal(slug) {
    $('#deleteModal').removeClass('hidden');
    $('#deleteModal').data('delete-id', slug);
}

function closeDeleteModal() {
    $('#deleteModal').addClass('hidden');
}

$(document).on('click', '#deleteModal .cancel-btn', function() {
    closeDeleteModal();
});

$(document).on('click', '#deleteModal .confirm-delete-btn', function() {
    let slug = $('#deleteModal').data('delete-id');
    const deleteUrlTemplate = "{{ route('category.delete', ['slug' => '___slug___']) }}";
    $.ajax({
        url: deleteUrlTemplate.replace('___slug___', slug),
        method: "post",
        contentType: "application/json",
        data: {
            "_token": "{{ csrf_token() }}",
        },
        success: function(response) {
            toastr.success(response.message || 'Deleted successfully');
            closeDeleteModal();
            table.draw();
        },
        error: function() {
            toastr.error('Failed to delete');
        }
    });
});
</script>

@endpush
@endsection