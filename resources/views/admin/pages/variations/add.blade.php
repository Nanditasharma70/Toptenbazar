@extends('admin.pages.layout.main')
@section('title', 'Add Variation')
@section('content')
    <div class="">
        <!-- Header -->
       

          <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">Add Variation</h1>
            <a href="{{ route('variation.index') }}"
                class="mt-2 md:mt-0 inline-block px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">
                &larr; Back
            </a>
        </div>

        <!-- Main Form -->
        <form id="var_form" method="POST">
            @csrf
        <div class="space-y-6">
            <!-- Basic Information Card -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Basic Information</h2>
                
                <!-- Product Name -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Variation Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" placeholder="Enter Variation Name" name="var_name" id="var_name"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" />
                </div>
                
                
            </div>
            
            <!-- Submit Button -->
            <div class="flex justify-start">
                  <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-8 rounded-lg FormSubmitBtn flex items-center justify-center gap-2 relative cursor-pointer">
                        <span>Save Variation</span>
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
        $('#var_form').on('submit', function(e) {
            e.preventDefault(); 
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('variation.store') }}",
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
                    toastr.success(response.message || "Variation saved successfully!");
                    $('#var_form')[0].reset();
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

   </script>
    
   
@endsection