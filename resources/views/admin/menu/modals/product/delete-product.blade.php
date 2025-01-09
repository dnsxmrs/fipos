<!-- Delete Modal -->
<div id="delete-dialog-products"
    class="hidden fixed p-10 inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50"
    aria-hidden="true">
    <div
        class="bg-white p-4 shadow-md text-center w-[500px] h-[420px] rounded-[20px] overflow-hidden flex flex-col items-center">
        <img src="{{ asset('Assets/icons-delete.png') }}" alt="deleteIcon" class="w-[150px] h-[150px]">
        <h1 class="text-center text-xl font-bold mb-4">Delete Product</h1>
        <p class="text-center">Are you sure you want to delete this product?</p>
        <div class="flex space-x-4 mt-4">
            <button onclick="showConfirmDeleteModalProducts()"
                class="rounded-full flex items-center justify-center text-center text-white hover:text-red-700 bg-red-600 px-4 py-2 h-[40px] w-[140px]">
                Delete
            </button>
            <button onclick="hideDeleteDialogProducts()"
                class="bg-gray-200 text-sm text-black rounded-full h-[40px] w-[140px] hover:bg-gray-300 font-bold">
                Cancel
            </button>
        </div>
    </div>
</div>
