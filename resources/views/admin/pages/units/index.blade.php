@extends('admin.pages.layout.main')
@section('title', 'Unit')
@section('content')

    <!-- Header Section -->
    <div class="flex flex-col xs:flex-row justify-between items-center  mb-6">
        <h1 class="text-2xl font-semibold">Units</h1>
        <div class="flex space-x-4 mt-4 md:mt-0">
            <a href="{{ route('unit.create') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">+
                Add Units</a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-4 w-full overflow-x-auto">

        <!-- Filters -->
        {{-- <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 ">
            <input type="text" placeholder="Search"
                class="w-full md:w-1/3 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" />
            <div class="flex gap-2">
                <select class="px-3 py-2 border border-gray-300 rounded-md text-sm"  name="selectStatus" id="selectStatus">
                    <option value="">Select Status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
                <select class="px-3 py-2 border border-gray-300 rounded-md text-sm">
                    <option>Newest</option>
                    <option>Oldest</option>
                </select>
            </div>
        </div> --}}

        <!-- Table -->
        <table class="min-w-full text-sm text-left text-black data-table">
            <thead class="bg-gray-200 text-xs uppercase text-black">
                <tr>
                    <th class="px-4 py-3">S/L</th>
                    <th class="px-4 py-3"> Name</th>
                    <th class="px-4 py-3">Active</th>
                    <th class="px-4 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="table_tbody">
            </tbody>
        </table>

        {{-- delete modal --}}
        <div id="deleteModal" class="fixed inset-0 flex items-center justify-center z-50  bg-opacity-40 hidden">
            <div class="absolute inset-0 bg-black opacity-75 backdrop-blur-sm transition-all duration-300"></div>
            <div class="bg-white rounded-xl w-full max-w-sm shadow-lg p-6 relative">
                <!-- Close Icon -->
                <button class="absolute top-4 right-4 cursor-pointer text-gray-500 hover:text-black text-2xl cancel-btn">
                    &times;
                </button>

                <!-- Title -->
                <h2 class="text-lg font-semibold text-gray-800 ">Delete Confirmation</h2>
                <hr class="my-4">

                <!-- Icon -->
                <div class="flex justify-center mb-4">
                    <div class="bg-red-600 w-20 h-20 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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
                    <button class="bg-gray-200 cursor-pointer text-gray-800 font-medium px-6 py-2 rounded-md hover:bg-gray-300 cancel-btn">
                        Cancel
                    </button>
                    <button
                        class="bg-red-600 cursor-pointer text-white font-medium px-6 py-2 rounded-md hover:bg-red-700 confirm-delete-btn">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            var table;
            $(document).ready(function() {
                var statusVal;
                $('#selectStatus').on('change', function(e) {
                    e.preventDefault();
                    statusVal = $("#selectStatus").val();
                    table.draw();
                });
                table = new $('.data-table').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ordering": true,
                    "bLengthChange": true,
                    "stateSave": true,
                    "searching": true,
                    "info": true,
                    drawCallback: function() {
                        $('.data-table tbody tr td').addClass('border-b border-gray-200');
                    },
                    "language": {
                        "searchPlaceholder": "Search unit",
                        "processing": '<i class="fa fa-spinner" aria-hidden="true"></i>',
                    },
                    ajax: {
                        url: "{{ route('unit.index') }}",
                        data: function(d) {
                            d.statusVal = statusVal
                        }
                    },
                    "columns": [{
                            "data": "id",
                            "render": function(data, type, row, meta) {
                                return meta.settings._iDisplayStart + meta.row + 1;
                            }
                        },
                        {
                            data: "name",
                            name: 'name'
                        },
                        {
                            data: "status",
                            name: "status"
                        },
                        {
                            data: "action"
                        }
                    ]
                });
            });


            function changeStatus(slug) {
                $.ajax({
                    url: "{{ route('change-unit-status') }}",
                    method: "get",
                    content: "json",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "unitSlug": slug,
                    },
                    success: function(response) {
                        if (response.status) {
                            table.draw(false);
                            toastr.success(response.success);
                        } else {
                            toastr.error(response.error || "Something went wrong");
                        }
                    },
                    error: function(xhr, request, status, errorsponse) {
                        toastr.error(xhr.responseText);
                    }
                });
            }

            // delete modal 
            function openDeleteModal(slug) {
                $('#deleteModal').removeClass('hidden');
                $('#deleteModal').data('delete-id', slug);
            }

            function closeDeleteModal() {
                $('#deleteModal').addClass('hidden');
            }

            // Cancel button event
            $(document).on('click', '#deleteModal .cancel-btn', function() {
                closeDeleteModal();
            });

            $(document).on('click', '#deleteModal .confirm-delete-btn', function() {
                let slug = $('#deleteModal').data('delete-id');
                const deleteUrlTemplate = "{{ route('unit.delete', ['slug' => '___slug___']) }}";
                $.ajax({
                    url: deleteUrlTemplate.replace('___slug___', slug),
                    method: "post",
                    content: "json",
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
