@extends('admin.pages.layout.main')
@section('title', 'Unit')
@section('content')
<style>
    /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>
    <div class="flex flex-col xs:flex-row justify-between items-center  mb-6">
        <h1 class="text-2xl font-semibold">Update Coupon</h1>
        <div class="flex space-x-4 mt-4 md:mt-0">
            <a href="{{ route('coupon.index') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                back</a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-4 w-full overflow-x-auto">

        <form id="coupon_update_form" method="POST"  class="space-y-6 text-sm text-gray-900">
            @csrf
            <!-- Coupon Name -->
            <div>
                <label class="block font-medium mb-1">Coupon Name <span class="text-red-500">*</span></label>
                <input type="text" placeholder="Enter Coupon Name" name="name" id="name" value="{{ isset($coupon) ? $coupon->coupon_name  : "" }}"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>

            <!-- Coupon Code -->
            <div>
                <label class="block font-medium mb-1">Coupon Code <span class="text-red-500">*</span></label>
                <input type="text" placeholder="Enter Coupon Code" name="code" value="{{ isset($coupon) ? $coupon->coupon_code  : "" }}"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>
            <input type="hidden" name="slug" id="slug" value="{{ isset($coupon) ? $coupon->slug : '' }}">

            <!-- Coupon Type -->
            <div>
                <label class="block font-medium mb-1">Coupon Type <span class="text-red-500">*</span></label>
                <div class="flex items-center space-x-6 mt-2">
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="coupon_type"  value="0" class="form-radio text-green-600"
                            {{ (isset($coupon) && $coupon->coupon_type == 0) ? 'checked' : '' }} />
                        <span>Discount</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="coupon_type" value="1" class="form-radio text-green-600"
                            {{ (isset($coupon) && $coupon->coupon_type == 1) ? 'checked' : '' }} />
                        <span>Free Piece</span>
                    </label>
                </div>
            </div>

            <!-- Minimum Order Amount -->
            <div>
                <label class="block font-medium mb-1">Minimum Order Amount <span class="text-red-500">*</span></label>
                <input type="number" placeholder="Enter Minimum Order Amount" name="min_order_amount" min="0" value="{{ isset($coupon) ? $coupon->min_order_amount : "" }}"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>

            <!-- Capping -->
            <div>
                <label class="block font-medium mb-1">Capping <span class="text-red-500">*</span></label>
                <input type="number" placeholder="Enter Capping" name="capping" min="0" value="{{ isset($coupon) ? $coupon->capping : "" }}"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>

            <!-- Status -->
            <div>
                <label class="block font-medium mb-1">Status <span class="text-red-500">*</span></label>
                <select name="status" id="status"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="">Select Status</option>
                    <option value="0" {{ (isset($coupon) && $coupon->status == 0) ? 'selected' : '' }}>Inactive</option>
                    <option value="1" {{ (isset($coupon) && $coupon->status == 1) ? 'selected' : '' }}>Active</option>
                </select>
            </div>
   <!-- Submit Button -->
            <div class="flex justify-start">
                  <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-8 rounded-lg FormSubmitBtn flex items-center justify-center gap-2 relative">
                        <span>Update Coupon</span>
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
               // form submit
            $('#coupon_update_form').on('submit', function(e) {
                e.preventDefault();
                  let slug = $("#slug").val();
                    let baseUrl = "{{ url('admin/coupon/update') }}/";
                    let url = baseUrl + slug;
          
                var formData = new FormData(this);
                $.ajax({
                    url   : url,
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
                        toastr.success(response.message || "Coupon Updated successfully!");
                        $('#coupon_update_form')[0].reset();
                        window.location.href = "{{ route('coupon.index') }}"
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
    @endpush
@endsection
