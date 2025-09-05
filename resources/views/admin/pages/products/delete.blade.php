<div class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-40">
        <div class="bg-white rounded-xl w-full max-w-sm shadow-lg p-6 relative">
            <!-- Close Icon -->
            <button class="absolute top-4 right-4 text-gray-500 hover:text-black text-2xl">
                &times;
            </button>

            <!-- Title -->
            <h2 class="text-lg font-semibold text-gray-800">Delete Confirmation</h2>
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
                <button class="bg-gray-200 text-gray-800 font-medium px-6 py-2 rounded-md hover:bg-gray-300">
                    Cancel
                </button>
                <button class="bg-red-600 text-white font-medium px-6 py-2 rounded-md hover:bg-red-700">
                    Delete
                </button>
            </div>
        </div>
    </div>