<!-- Edit Modal -->
<div id="edit-modal-categories" tabindex="-1" aria-hidden="true"
class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
                <h3 class="text-lg font-semibold text-gray-900 ">
                    Edit Category
                </h3>
                <button type="button" onclick="hideEditDialog()"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center ">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="edit-form" class="p-4 md:p-5" action="{{ route('admin.inventory.category.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="" name="editCategoryId" id="editCategoryId">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="categoryName" class="block mb-2 text-sm font-medium text-gray-900"> Category Name
                            <span class="text-red-500">*</span></label>
                        <input type="text" name="categoryName" id="categoryName"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            placeholder="Type category name" required="">

                        @error('category_name')
                            <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                        @enderror
                        <div id="edit-error-name" class=" text-red-500 w-80 text-xs mt-2 ml-1 block"></div>
                    </div>
                    <div class="col-span-2">
                        <label for="editDescription"
                            class="block mb-2 text-sm font-medium text-gray-900 ">Description</label>
                        <textarea id="editDescription" rows="4" name="description"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 "
                            placeholder="Write category description here"></textarea>

                        @error('description')
                            <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit"
                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Save Changes
                </button>
            </form>
        </div>
    </div>
</div>

