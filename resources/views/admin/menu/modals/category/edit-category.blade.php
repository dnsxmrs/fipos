<!-- Edit Modal -->
<div id="edit-dialog-categories"
    class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50"
    aria-hidden="true">
    <div class="bg-white shadow-md p-8 flex flex-col items-center justify-center rounded-lg h-auto w-auto relative">
        <!-- Close Icon -->
        <img onclick="hideEditDialogCategories()" src="{{ asset('Assets/close.png') }}" alt="Close"
            class="absolute top-5 right-5 w-5 cursor-pointer hover:opacity-80">

        <!-- Title -->
        <h1 class="text-center text-xl font-semibold mb-4 text-black">Edit Category</h1>

        <hr class="text-gray-600 w-full mb-4">

        <form action="{{ route('admin.menu.categories.update') }}" method="POST" enctype="multipart/form-data"
            id="edit-category">
            @csrf
            @method('PUT')
            <input type="hidden" value="" name="editCategoryId" id="editCategoryId">
            <div class="flex items-center justify-center flex-wrap">
                <label
                    class="bg-white py-3 px-5 rounded text-black shadow-md text-center mt-4 mr-5 flex justify-center items-center"
                    style="width: 200px; height: 200px; border: 2px dashed gray;" id="editImageLabel">
                    <input type="file" value='' id='editImage' name="editImage" accept="image/*"
                        class="hidden">
                    <div class="text-center">
                        <img id="categoryImage" src="" alt="Category Image"
                            class="w-full h-full object-cover rounded hidden" />
                        <div class="upload-message">
                            <div class="text-2xl">+</div>
                            <span class="block mt-2">Upload Image</span>
                        </div>
                    </div>
                </label>

                <div class="flex flex-col items-center mt-5">
                    <div class="relative w-[350px] mb-4">
                        <label for="editCategoryName" class="text-sm">Category Name <span
                                class="text-red-500">*</span></label>
                        <input id="editCategoryName"
                            class="mb-1 mt-2 peer w-full h-10 text-gray-600 border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:ring-opacity-70 text-xs"
                            type="text" placeholder="Enter category name" name="category_name">

                        @error('category_name')
                            <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex w-[350px] mb-4">
                        <div class="w-1/2 flex-col mr-2">
                            <label for="editType" class="text-sm">Type <span class="text-red-500">*</span></label>
                            <select name="type" id="editType"
                                class="mb-1 mt-2 peer w-full h-10 text-gray-600 border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:ring-opacity-70 text-xs"
                                onchange="toggleBeverageType(this)">
                                <option value="" disabled selected>Select category type</option>
                                <option value="food">Food</option>
                                <option value="beverage">Beverage</option>
                            </select>

                            @error('type')
                                <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-1/2 flex-col ml-2">
                            <p class="text-sm mb-1">Beverage Type </p>
                            <input class="text-sm ml-2 disabled:accent-gray-400 disabled:cursor-not-allowed"
                                type="radio" id="hot" name="beverage_type" value="hot" disabled>
                            <label class="text-sm ml-2 text-gray-600 disabled:text-gray-400 disabled:cursor-not-allowed"
                                for="hot">Hot</label><br>
                            <input class="text-sm ml-2 disabled:accent-gray-400 disabled:cursor-not-allowed"
                                type="radio" id="iced" name="beverage_type" value="iced" disabled>
                            <label class="text-sm ml-2 text-gray-600 disabled:text-gray-400 disabled:cursor-not-allowed"
                                for="iced">Iced</label><br>

                            @error('beverage_type')
                                <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="relative w-[350px] mb-4">
                        <label for="editCategoryDescription" class="text-sm">Category Description </label>
                        <textarea id="editCategoryDescription"
                            class="mb-1 mt-2 peer w-full h-20 text-gray-600 border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:ring-opacity-70 text-xs"
                            type="text" placeholder="Write short description about the category" name="description"></textarea>

                        @error('description')
                            <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="w-full flex items-center justify-center">
                <button type="submit"
                    class="text-sm text-white rounded-lg h-[40px] w-1/2 hover:bg-green-700 bg-green-600">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
