<!-- Edit Modal -->
<div id="edit-dialog-products"
    class="hidden fixed p-10 inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50"
    aria-hidden="true">
    <div class="bg-white rounded shadow-md p-8 flex flex-col items-center" style="width: 455px; height: 814px;">
        <h1 class="text-center text-xl font-bold mb-4">Edit Item</h1>
        <form action="{{ route('admin.menu.products.update') }}" method="POST" enctype="multipart/form-data"
            id="edit-form">
            @csrf
            @method('PUT')
            <input type="hidden" value="" name="editProductId" id="editProductId">
            <div class="flex flex-col items-center justify-center">
                <label class="bg-white py-3 px-5 rounded text-black shadow-md text-center mt-4 items-center"
                    style="width: 346px; height: 231px; border: 2px dashed black;" id="editImageLabel">
                    <input type="file" value='' id='editImage' name="editImage" accept="image/*"
                        class="hidden">
                    <div class="text-center">
                        <img id="productImage" src="" alt="Product Image"
                            class="w-full h-full object-cover rounded hidden" />
                        <div class="upload-message">
                            <div class="text-2xl">+</div>
                            <span class="block mt-2">Upload Image</span>
                        </div>
                    </div>
                </label>

                <select class="mt-4 w-[350px] h-[42px] border border-gray-300 rounded-md p-2" name="editCategoryId"
                    id="editCategoryId" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>

                <div class="flex flex-col items-center mt-4">

                    <div class="relative w-[350px] mb-4">
                        <input id="editProductName"
                            class="mb-2 peer w-full h-[42px] border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-opacity-70 placeholder-transparent"
                            type="text" name="editProductName" required>
                        <label class="text-sm absolute left-2 -top-4 scale-75 text-gray-500 origin-left"
                            for="itemName">Item Name</label>
                    </div>

                    <div class="relative w-[350px] mb-4">
                        <input id="editProductPrice" name="editProductPrice"
                            class="mb-2 peer w-full h-[42px] border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-opacity-70 placeholder-transparent"
                            type="text" required>
                        <label class="text-sm absolute left-2 -top-4 scale-75 text-gray-500 origin-left"
                            for="itemPrice">Item Price</label>
                    </div>

                    <div class="relative w-[350px] mb-4">
                        <input id="editProductDescription"
                            class="mb-2 peer w-full h-[42px] border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-opacity-70 placeholder-transparent"
                            type="text" name="editProductDescription" required>
                        <label class="text-xs absolute left-2 -top-4 text-gray-500" for="itemDescription">Item
                            Description</label>
                    </div>

                    {{-- toggle status --}}
                    <div class="relative w-[350px] mb-4">
                        <div class="flex items-center">
                            <label class="mr-2 text-gray-700 font-bold">Status:</label>
                            <span class="mr-2 text-gray-700">Not Available</span>
                            {{-- this is a toggle button for the system --}}
                            <div class="relative inline-block w-11 h-5">
                                <input id="editIsAvailable" type="checkbox" name="editIsAvailable"
                                    class="peer appearance-none w-11 h-5 bg-slate-100 rounded-full checked:bg-green-600 cursor-pointer transition-colors duration-300" />
                                <label for="editIsAvailable"
                                    class="absolute top-0 left-0 w-5 h-5 bg-white rounded-full border border-slate-300 shadow-sm transition-transform duration-300 peer-checked:translate-x-6 peer-checked:border-green-600 cursor-pointer">
                                </label>
                            </div>
                            <span class="ml-2 text-gray-700">Available</span>
                        </div>
                    </div>

                    <button type="submit"
                        class="bg-[#45A834] text-sm text-white rounded-lg h-[40px] w-[350px] hover:bg-amber-700 mt-8 font-bold">
                        Save Changes
                    </button>
                    <button type="button" onclick="hideEditDialogProducts()"
                        class="bg-gray-200 text-sm text-black rounded-lg h-[40px] w-[350px] hover:bg-gray-300 mt-2 font-bold">
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
