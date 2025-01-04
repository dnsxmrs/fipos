<!-- resources/views/admin/reports.blade.php -->
@extends('layouts.admin-layout')

@section('admin_content')
    <!-- Top Header -->
    <div class="flex items-center justify-between">
        <div class="my-3 mb-7">
            <p class="text-xl font-medium text-gray-700">Products</p>
            <p class="text-sm text-gray-500">A list of all products that the restaurant offers.</p>
        </div>
    </div>

    <div class="bg-white shadow-sm h-auto mb-10 py-5 px-7 rounded-lg ">
        <div class="flex items-center justify-between">
            <input type="text" placeholder="Search products..."
                class="p-3 h-10 w-64 focus:outline-none focus:ring-1 focus:ring-blue-500 bg-gray-100 border border-gray-200 text-sm text-gray-500 rounded-lg"
                name="product_search" id="product_search" autocomplete="off" onkeyup="filterProducts()" />

            <!--ADD BUTTON-->
            <button onclick="showAddDialogProducts()"
                class="bg-green-600 ml-3 text-white px-10 h-10 font-medium text-sm hover:bg-green-700 shadow-sm rounded-full">
                + Add Product
            </button>
        </div>

        {{-- ORDERS TABLE --}}
        <div class="flex items-start my-7  justify-center rounded-lg w-full">
            <div class="w-full ">

                <table id="products_table" class="products_table w-full shadow rounded-lg table-auto mb-5">
                    <thead class="bg-slate-100 border-b-2 rounded-lg">
                        <tr>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">No.</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Product Name</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Description</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Category</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Price</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Status</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max"></th>
                        </tr>
                    </thead>
                    <tbody class="text-center text-xs">
                        @foreach ($products as $index => $product)
                            <tr class="product_row border-b hover:bg-slate-50">
                                <td class="py-3 px-5">
                                    {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }} </td>
                                <td class="py-3 px-5"> {{ ucfirst($product->product_name) }} </td>
                                <td class="py-3 px-5"> {{ ucfirst($product->product_description) }} </td>
                                <td class="p-3">{{ $product->category ? $product->category->category_name : 'N/A' }}</td>
                                <td class="py-3 px-5">{{ $product->product_price }}</td>
                                <td class="py-3 px-5">
                                    <span
                                        class="text-xs {{ $product->isAvailable ? 'text-green-500' : 'text-red-500' }} rounded-md px-2 py-1"
                                        style="background-color: {{ $product->isAvailable ? '#DCF8F0' : '#FFDFDF' }}">
                                        {{ $product->isAvailable ? 'Available' : 'Not Available' }}
                                    </span>
                                </td>
                                <td class="flex py-3 px-5 space-x-2 items-center justify-end">
                                    <button onclick="showEditDialogProducts(this)"
                                        class="flex items-center text-blue-500 hover:text-blue-700 transition duration-300 ease-in-out"
                                        data-id="{{ $product->id }}" data-name="{{ $product->product_name }}"
                                        data-description="{{ $product->product_description }}"
                                        data-price="{{ $product->product_price }}"
                                        data-category="{{ $product->category_id }}"
                                        data-availability="{{ $product->isAvailable ? '1' : '0' }}"
                                        data-image="{{ $product->image }}">
                                        <img src="{{ asset('Assets/Edit.png') }}" alt="Edit Icon" class="mr-2 ml-2">
                                    </button>
                                    <button onclick="showDeleteDialogProducts({{ $product->id }})"
                                        class="flex items-center text-red-500 hover:text-red-700 ml-2 transition duration-300 ease-in-out">
                                        <img src="{{ asset('Assets/Delete.png') }}" alt="Delete Icon" class="mr-2 ml-2">
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- No Products Found Message -->
                <div id="no-products-message" class="hidden text-center text-red-500 mt-4">
                    No products found matching your search criteria.
                </div>

                <div class="mt-5">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>



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

    <!-- Successfully item add Modal -->
    <div id="added-dialog-products"
        class="hidden modal p-10 fixed inset-0 bg-black bg-opacity-75 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50"
        aria-hidden="true">
        <div class="bg-white shadow-md p-8 flex flex-col items-center w-[500px] h-[370px] rounded-[20px] overflow-hidden">
            <img src="{{ asset('Assets/update-icon.png') }}" alt="Success Icon" class="w-[150px] h-[150px]">
            <h1 class="text-center text-2xl font-bold mb-4">Item Added Successfully</h1>
            <h2 class="text-center mb-2 font-barlow text-sm">The product has been successfully added to
                the list and is now available for viewing.</h2>
            <button onclick="hideAddedDialogProducts()"
                class="mt-4 bg-yellow-600 text-sm text-white px-4 py-2 hover:bg-yellow-200 w-[200px] rounded-full">
                Close
            </button>
        </div>
    </div>

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
                    <label class="bg-white py-3 px-5 rounded text-black shadow-md text-center mt-4 ml-6 items-center"
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

    <!-- Item Updated Successfully Modal -->
    <div id="updated-dialog-products"
        class="hidden modal fixed p-10 inset-0 bg-black bg-opacity-75 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50"
        aria-hidden="true">
        <div class="bg-white shadow-md p-8 flex flex-col items-center w-[500px] h-[350px] rounded-[20px] overflow-hidden">
            <img src="{{ asset('Assets/icon-success.png') }}" alt="Success Icon" class="w-[150px] h-[150px]">
            <h1 class="text-center text-2xl font-bold mb-2 font-barlow mt-2">Item Updated Successfully!
            </h1>
            <h2 class="text-center mb-4 font-barlow text-sm">The product has been successfully added to
                the list</h2>
            <button onclick="hideItemUpdatedDialogProducts()"
                class="mt-4 bg-yellow-600 text-sm text-white px-4 py-2  hover:bg-amber-700 w-[200px] rounded-full">
                Close
            </button>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="delete-dialog-products"
        class="hidden fixed p-10 inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50"
        aria-hidden="true">
        <div class="bg-white p-4 shadow-md text-center w-[500px] h-[420px] rounded-[20px] overflow-hidden flex flex-col items-center">
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

    <!--Confirm Delete-->
    <div id="confirm-delete-modal-products"
        class="fixed inset-0 p-10 flex items-center justify-center bg-gray-500 bg-opacity-75 hidden" aria-hidden="true">
        <div
            class="bg-white p-4 shadow-md text-center w-[500px] h-[380px] rounded-[20px] overflow-hidden flex flex-col items-center">
            <img src="{{ asset('Assets/icons-password.png') }}" alt="Password Icon" class="w-[150px] h-[150px] mb-4">
            <h2 class="text-lg font-semibold">Confirm Delete</h2>
            <p class="mt-1 mb-1">Enter your password below:</p>
            <!-- Password input section -->
            <div class="relative mt-4">
                <input type="password" id="password"
                    class="peer w-[250px] h-[42px] border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-opacity-70 placeholder-transparent"
                    placeholder=" ">
                <label
                    class="text-sm absolute left-2 top-2 transform transition-transform duration-300 ease-in-out scale-100 text-gray-500 origin-left peer-placeholder-shown:top-2 peer-placeholder-shown:left-2 peer-placeholder-shown:scale-100 peer-focus:-top-5 peer-focus:left-2 peer-focus:scale-75"
                    for="password">Input Password</label>
            </div>
            <button id="confirmButtonProduct" onclick="hideConfirmDeleteModalProducts()"
                class="mt-4 bg-yellow-500 text-white px-4 py-2 rounded-full hover:bg-gray-100 w-[200px]">Confirm</button>
        </div>
    </div>

    <!-- Success Message Deleted Modal -->
    <div id="item-deleted-modal-products"
        class="fixed inset-0 flex items-center justify-center p-10 bg-gray-500 bg-opacity-75 hidden" aria-hidden="true">
        <div
            class="bg-white p-4 shadow-md text-center w-[500px] h-[350px] rounded-[20px] overflow-hidden flex flex-col items-center">
            <img src="{{ asset('Assets/icon-success.png') }}" alt="deleteIcon" class="w-[150px] h-[150px] mb-4">
            <h2 class="text-lg font-semibold">Success!</h2>
            <p class="mt-2">Item deleted successfully.</p>
            <button onclick="hideSuccessMessage()"
                class="mt-4 bg-yellow-500 text-white px-4 py-2 rounded-full hover:bg-gray-100 w-[258px]">Ok</button>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // success add modal
            @if (session('status_add'))
                handleSaveChangesProducts();
            @endif


            @if (session('status_edit'))
            showItemUpdatedDialogProducts();
            @endif


            @if (session('status_deleted'))
                showSuccessMessage();
            @endif

        });
    </script>
@endsection
