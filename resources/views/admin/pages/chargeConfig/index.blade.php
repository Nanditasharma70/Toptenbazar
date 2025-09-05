@extends('admin.pages.layout.main')
@section('title', 'Charge config')
@section('content')
    <div class="flex flex-col md:flex-row justify-between items-center  mb-6">
        <h1 class="text-2xl font-semibold">Charge Config</h1>
        <div class="flex space-x-4 mt-4 md:mt-0">
            <a href="{{ route('charge.create') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">+
                Add charge Config</a>
        </div>
    </div>

    {{-- <div class="bg-white rounded-xl shadow-md p-4 w-full overflow-x-auto">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
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

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 data-table">
                <thead class="bg-gray-200 text-left text-sm font-semibold text-gray-700">
                    <tr>
                        <th class="px-6 py-3 whitespace-nowrap">S.No.</th>
                        <th class="px-6 py-3 whitespace-nowrap">Config Name</th>
                        <th class="px-6 py-3 whitespace-nowrap">Is Default</th>
                        <th class="px-6 py-3 whitespace-nowrap">Status</th>
                        <th class="px-6 py-3 whitespace-nowrap">Action</th>
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
                    "ordering": false,
                    "bLengthChange": true,
                    "stateSave": true,
                    "searching": true,
                    "info": true,
                    drawCallback: function() {
                        $('.data-table tbody tr td').addClass('border-b border-table');
                    },
                    "language": {
                        "searchPlaceholder": "Search Charge Config",
                        "processing": '<i class="fa fa-spinner" aria-hidden="true"></i>',
                    },
                    ajax: {
                        url: "{{ route('charge.index') }}",
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
                            data: "is_default",
                        },
                        {
                            data: "status"
                        },
                        {
                            data: "action"
                        }
                    ]
                });
            });

            //     function changeStatus(slug) {
            //     $.ajax({
            //         url: "{{ route('favourite-status') }}",
            //         method: "get",
            //         content: "json",
            //         data: {
            //             "_token": "{{ csrf_token() }}",
            //             "categorySlug": slug,
            //         },
            //         success: function(response) {
            //             if (response.status) {
            //                 table.draw(false);
            //                 toastr.success(response.success);
            //             } else {
            //                 toastr.error(response.error || "Something went wrong");
            //             }
            //         },
            //         error: function(xhr, request, status, errorsponse) {
            //             toastr.error(xhr.responseText);
            //         }
            //     });
            // }

            // function openModal(restSubCatArray) {
            //     console.log(restSubCatArray);
            //     const container = document.getElementById('subCatContainer');
            //     container.innerHTML = ''; // Clear existing items

            //     if (restSubCatArray && restSubCatArray.length > 0) {
            //         restSubCatArray.forEach(item => {
            //             const span = document.createElement('span');
            //             span.className = 'bg-gray-200 rounded-xl px-3 py-2 text-center block w-full';
            //             span.textContent = item ?? item;
            //             container.appendChild(span);
            //         });
            //     }
            //     document.getElementById('customModal').classList.remove('hidden');
            // }

            // function closeModal() {
            //     document.getElementById('customModal').classList.add('hidden');
            // }

            // // delete modal 
            // function openDeleteModal(slug) {
            //     $('#deleteModal').removeClass('hidden');
            //     $('#deleteModal').data('delete-id', slug);
            // }

            // function closeDeleteModal() {
            //     $('#deleteModal').addClass('hidden');
            // }

            // // Cancel button event
            // $(document).on('click', '#deleteModal .cancel-btn', function() {
            //     closeDeleteModal();
            // });

            // $(document).on('click', '#deleteModal .confirm-delete-btn', function() {
            //     let slug = $('#deleteModal').data('delete-id');
            //     const deleteUrlTemplate = "{{ route('category.delete', ['slug' => '___slug___']) }}";
            //     $.ajax({
            //         url: deleteUrlTemplate.replace('___slug___', slug),
            //         method: "post",
            //         content: "json",
            //         data: {
            //             "_token": "{{ csrf_token() }}",
            //         },
            //         success: function(response) {
            //             toastr.success(response.message || 'Deleted successfully');
            //             closeDeleteModal();
            //             table.draw();
            //         },
            //         error: function() {
            //             toastr.error('Failed to delete');
            //         }
            //     });
            // });
        </script>
    @endpush
@endsection
