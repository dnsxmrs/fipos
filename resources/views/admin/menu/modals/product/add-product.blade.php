<!-- Add Modal -->
<div id="add-dialog-products"
    class="hidden fixed p-10 inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50"
    aria-hidden="true">
    <div class="bg-white shadow-md p-8 flex flex-col items-center justify-center rounded-lg w-[500px] h-auto">
        <h1 class="text-center text-xl font-bold mb-4 text-black">Add new item</h1>
        <form action="{{ route('admin.menu.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col items-center justify-center">
                <label class="bg-white py-3 px-5 rounded text-black shadow-md text-center mt-4 ml-6 items-center"
                    style="width: 346px; height: 231px; border: 2px dashed gray;">
                    <input type="file" name="image" accept="image/*" class="hidden">
                    <div class="text-center">
                        <div class="text-2xl">+</div>
                        <span class="block mt-2 mb-5">Upload Image</span>
                    </div>
                </label>
                <select
                    class="w-[350px] h-[42px] text-gray-500 border hover:bg-slate-100 border-gray-300 rounded-md p-2 mb-2 mt-3"
                    name="category_id" required>
                    <option value="" disabled selected>Select a category</option>
                    <!-- Display categories from the model/db 'categories' -->
                    @foreach ($categories as $category)
                        <option class="text-gray-500 " value="{{ $category->category_id }}">
                            {{ $category->category_name }}</option>
                    @endforeach
                </select>
                <div class="flex flex-col items-center mt-4">
                    <!--Item name for revision-->
                    <div class="relative w-[350px] mb-4">
                        <input id="itemName"
                            class="mb-2 peer w-full h-[42px] border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-opacity-70 placeholder-transparent"
                            type="text" placeholder="Item name " name="product_name" required>
                        <label class="text-sm absolute left-2 -top-4 scale-75 text-gray-500 origin-left"
                            for="itemName">Item Name</label>
                        @error('product_name')
                            <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <!--Item price for revision-->
                    <div class="relative w-[350px] mb-4">
                        <input id="itemPrice"
                            class="mb-2 peer w-full h-[42px] border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-opacity-70 placeholder-transparent"
                            type="text" placeholder="Item price " name="product_price" required>
                        <label class="text-sm absolute left-2 -top-4 scale-75 text-gray-500 origin-left"
                            for="itemPrice">Item Price</label>
                        @error('product_price')
                            <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--end-->
                    <div class="relative w-[350px] mb-4">
                        <input id="itemDescription"
                            class="mb-2 peer w-full h-[42px] border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-opacity-70 placeholder-transparent"
                            type="text" placeholder=" " name="product_description" required>
                        <label class="text-xs absolute left-2 -top-4 text-gray-500" for="itemDescription">Item
                            Description</label>
                        @error('product_description')
                            <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>


                    <button type="submit"
                        class="bg-[#45A834] text-sm text-white rounded-lg h-[40px] w-[350px] hover:bg-amber-700 mt-8">
                        Add Item
                    </button>
                    <button type="button" onclick="hideAddDialogProducts()"
                        class="bg-gray-200 text-sm text-black rounded-lg h-[40px] w-[350px] hover:bg-gray-300 mt-2 font-bold">
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
