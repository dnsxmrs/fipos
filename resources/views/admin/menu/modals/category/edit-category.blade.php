<!-- Edit Modal -->
<div id="edit-dialog-categories" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center transition-opacity duration-200 z-50 overflow-y-auto overflow-x-hidden top-0 right-0 left-0 w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-lg max-h-full p-4 min-w-fit">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5">
                <h3 class="text-lg font-semibold text-gray-900">
                    Edit Category
                </h3>
                <button type="button" onclick="hideEditDialogCategories()"
                    class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" action="{{ route('admin.menu.categories.update') }}" method="POST"
                enctype="multipart/form-data" id="edit-category">
                @csrf
                @method('PUT')
                <input type="hidden" value="" name="editCategoryId" id="editCategoryId">
                <div class="grid grid-cols-2 gap-4 mb-4">

                    <div class="flex items-center justify-center col-span-2">
                        <label
                            class="flex flex-col items-center justify-center px-5 py-3 mt-4 text-center text-black bg-white rounded shadow-md "
                            style="width: 346px; height: 231px; border: 2px dashed gray;" id="editImageLabel">
                            <input type="file" value='' id='editImage' name="editImage" accept="image/*"
                                class="hidden">
                                <div class="text-center">
                                    <img id="categoryImage" src="" alt="Category Image"
                                        class="hidden object-cover w-full h-full rounded" />
                                    <div class="upload-message">
                                        <div class="text-2xl">+</div>
                                        <span class="block mt-2">Upload Image</span>
                                    </div>
                                </div>
                        </label>
                    </div>

                    <div class="col-span-2">
                        <label for="editCategoryName" class="block mb-2 text-sm font-medium text-gray-900">Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="category_name" id="editCategoryName"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Type category name" required="">

                        @error('category_name')
                            <span class="mt-1 text-xs text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="editType" class="block mb-2 text-sm font-medium text-gray-900">Category Type <span
                                class="text-red-500">*</span></label>
                        <select id="editType" name="type" required onchange="editToggleBeverageType(this)"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                            <option id="default" selected="">Select category type</option>
                            <option value="food">Food</option>
                            <option value="beverage">Beverage</option>
                        </select>

                        @error('type')
                            <span class="mt-1 text-xs text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="beverage_type" class="block mb-2 text-sm font-medium text-gray-900">Beverage Type
                        </label>
                        <select id="edit_beverage_type" name="beverage_type" disabled
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                            <option selected>Select beverage type</option>
                            <option value="hot">Hot</option>
                            <option value="iced">Iced</option>
                        </select>

                        @error('beverage_type')
                            <span class="mt-1 text-xs text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                        <textarea id="editCategoryDescription" rows="4" name="description"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Write category description here"></textarea>

                        @error('description')
                            <span class="mt-1 text-xs text-red-600">{{ $message }}</span>
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
