@extends('admin.pages.layout.main')
@section('title', 'Customer')
@section('content')

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-center  mb-6">
        <h1 class="text-2xl font-semibold">Customer</h1>

    </div>

    <div class="bg-white rounded-xl shadow-md p-4 w-full overflow-x-auto">
        <!-- Filters -->
        {{-- <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
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
        </div> --}}

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-800 data-table">
                <thead class="bg-gray-100 text-xs uppercase text-gray-500">
                    <tr>
                        <th class="px-4 py-3">S/L</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Phone</th>
                        <th class="px-4 py-3">Action</th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>

   @push('scripts')
        <script>
            var table;
            $(document).ready(function() {

                table = new $('.data-table').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ordering": true,
                    "bLengthChange": true,
                    "stateSave": true,
                    "searching": true,
                    "info": true,
                    drawCallback: function() {
                        $('.data-table tbody tr td').addClass('border-b border-table');
                    },
                    "language": {
                        "searchPlaceholder": "Search Customers",
                        "processing": '<i class="fa fa-spinner" aria-hidden="true"></i>',
                    },
                    ajax: {
                        url: "{{ route('customer.index') }}",
                    },
                    "columns": [{
                            "data": "id",
                            "render": function(data, type, row, meta) {
                                return meta.settings._iDisplayStart + meta.row + 1;
                            }
                        },
                        {
                            data: "name",
                        },
                        {
                            data: "email",
                        },
                        {
                            data: "mobile"
                        },
                        {
                            data: "action"
                        }
                    ]
                });
            });

                function changeStatus(slug) {
                $.ajax({
                    url: "{{ route('change-customer-status') }}",
                    method: "get",
                    content: "json",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "customerSlug": slug,
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
        </script>
    @endpush



@endsection
