<!-- Add Modal -->
<div id="add-dialog-categories"
    class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50"
    aria-hidden="true">
    <div class="bg-white shadow-md p-8 flex flex-col items-center justify-center rounded-lg h-auto w-auto relative">
        <!-- Close Icon -->
        <img onclick="hideAddDialogCategories()" src="{{ asset('Assets/close.png') }}" alt="Close"
            class="absolute top-5 right-5 w-5 cursor-pointer hover:opacity-80">

        <!-- Title -->
        <h1 class="text-center text-xl font-semibold mb-4 text-black">Add New Category</h1>

        <hr class="text-gray-600 w-full mb-4">

        <!-- Form -->
        <form action="{{ route('admin.menu.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex items-center justify-center flex-wrap">
                <label
                    class="bg-white flex flex-col items-center mr-5 justify-center py-3 px-5 rounded text-black shadow-md mt-4"
                    style="width: 200px; height: 200px; border: 2px dashed gray;">
                    <input type="file" name="image" accept="image/*" class="hidden">
                    <div class="text-center">
                        <div class="text-2xl">+</div>
                        <span class="block mt-2">Upload Image</span>
                    </div>
                </label>
                <div class="flex flex-col items-center mt-5">
                    <div class="relative w-[350px] mb-4">
                        <label for="itemName" class="text-sm">Category Name <span class="text-red-500">*</span></label>
                        <input id="itemName"
                            class="mb-1 mt-2 peer w-full h-10 text-gray-600 border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:ring-opacity-70 text-xs"
                            type="text" placeholder="Enter category name" name="category_name">

                        @error('category_name')
                            <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex w-[350px] mb-4">
                        <div class="w-1/2 flex-col mr-2">
                            <label for="type" class="text-sm">Type <span class="text-red-500">*</span></label>
                            <select name="type" id="type"
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
                        <label for="description" class="text-sm">Category Description </label>
                        <textarea id="description"
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
                    Add Category
                </button>
            </div>
        </form>
    </div>
</div>
