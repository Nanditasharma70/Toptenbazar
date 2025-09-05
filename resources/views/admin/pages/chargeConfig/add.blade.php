@extends('admin.pages.layout.main')
@section('title', 'Add Charge Config')
@section('content')

    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Add Charge Config</h1>
        <a href="{{ route('charge.index') }}"
            class="mt-2 md:mt-0 inline-block px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">
            &larr; Back
        </a>
    </div>
    <div class="space-y-6">
        <!-- Basic Information Card -->
        <form id="charge_config_form" method="POST">
            @csrf
        <div class="bg-white rounded-xl shadow-md p-4">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Basic Information</h2>
            <div class="space-y-6 w-full ">
                <!-- Config Name -->
                <div>
                    <label class="block mb-1 text-sm font-semibold text-gray-700">
                        Config Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" placeholder="Enter Config Name" name="name"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" />
                </div>
                <!-- Toggle Switch -->
                <div>
                    <!-- Toggle Label -->
                    <label class="flex items-center gap-3 cursor-pointer">
                        <!-- Toggle Switch -->
                        <div class="relative">
                            <input type="checkbox" id="toggleSwitch" class="sr-only peer" name="is_default" />
                            <div
                                class="w-11 h-6 bg-gray-300 rounded-full peer-checked:bg-green-500 transition-all duration-300">
                            </div>
                            <div
                                class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow-md transition-all duration-300 peer-checked:translate-x-full">
                            </div>
                        </div>
                             Is Default
                    </label>

                </div>

                <!-- Status -->
                <div>
                    <label class="block mb-1 text-sm font-semibold text-gray-700">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select name="status"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="">Select Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
        </div>
            <!-- Submit Button -->
            <div class="flex justify-start">
                  <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-8 rounded-lg FormSubmitBtn flex items-center justify-center gap-2 relative cursor-pointer">
                        <span>Save Charge Config</span>
                        <!-- Tailwind CSS Spinner -->
                        <svg id="loader" class="hidden w-5 h-5 text-white animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>
                    </button>
            </div>

            </form>
    </div>
    @push('scripts')
    <script>
        $(document).ready(function(){
             // form submit
            $('#charge_config_form').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('charge.store') }}",
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
                        $('#charge_config_form')[0].reset();
                        window.location.href = "{{ route('charge.index') }}";
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
        })
    </script>
        
    @endpush
 
@endsection
