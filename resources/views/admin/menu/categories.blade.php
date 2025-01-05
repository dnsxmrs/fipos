<!-- resources/views/admin/reports.blade.php -->
@extends('layouts.admin-layout')

@section('admin_content')
    <!-- Top Header -->
    <div class="flex items-center justify-between">
        <div class="my-3 mb-7">
            <p class="text-xl font-medium text-gray-700">Categories</p>
            <p class="text-sm text-gray-500">A list of all categories of products.</p>
        </div>
    </div>

    <div class="bg-white shadow-sm h-auto mb-10 py-5 px-7 rounded-lg ">
        <div class="flex items-center justify-between">
            <input type="text" placeholder="Search for category..."
                class="p-3 h-10 w-64 focus:outline-none focus:ring-1 focus:ring-blue-500 bg-gray-100 border border-gray-200 text-sm text-gray-500 rounded-lg"
                id="category_search" autocomplete="off" onkeyup="filterCategories()" />

            <!--ADD BUTTON-->
            <button onclick="showAddDialogCategories()"
                class="bg-green-600 ml-3 text-white px-10 h-10 font-medium text-sm hover:bg-green-700 shadow-sm rounded-full">
                + Add Category
            </button>
        </div>

        {{-- ORDERS TABLE --}}
        <div class="flex items-start my-7  justify-center rounded-lg w-full">
            <div class="w-full ">
                {{-- <table id="category_table" class="category_table w-full shadow rounded-lg table-auto"> --}}
                <table id="category_table" class="category_table w-full shadow rounded-lg table-auto">
                    <thead class="bg-slate-100 border-b-2 rounded-lg">
                        <tr>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">No.</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Category Name</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Description</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Type</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Beverage Type</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Total Products</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max"></th>
                        </tr>
                    </thead>
                    <tbody class="text-center text-xs">
                        @foreach ($categories as $index => $category)
                            <tr class="category_row border-b hover:bg-slate-50">
                                <td class="py-3 px-5">
                                    {{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }} </td>
                                <td class="py-3 px-5"> {{ ucfirst($category->category_name) }} </td>
                                <td class="p-3">{{ ucfirst($category->description) }}</td>
                                <td class="py-3 px-5">{{ ucfirst($category->type) }}</td>
                                <td class="py-3 px-5">{{ ucfirst($category->beverage_type) }}</td>
                                <td class="py-3 px-5">{{ $category->products_count }}</td>
                                <td class="flex py-3 px-5 space-x-2 items-center justify-end">
                                    <button onclick="showEditDialogCategories(this)" data-id="{{ $category->category_id }}"
                                        data-name="{{ $category->category_name }}"
                                        data-description="{{ $category->description }}" data-image="{{ $category->image }}"
                                        date-type="{{ $category->type }}" data-beverageType="{{ $category->beverage_type }}"
                                        class="flex text-blue-500 transition duration-300 ease-in-out items-right hover:text-blue-700">
                                        <img src="{{ asset('Assets/Edit.png') }}" alt="Edit Icon" class="ml-9">
                                    </button>
                                    <button onclick="showDeleteDialogCategories({{ $category->category_id }})"
                                        class="flex ml-2 text-red-500 transition duration-300 ease-in-out items-right hover:text-red-700">
                                        <img src="{{ asset('Assets/Delete.png') }}" alt="Delete Icon" class="ml-5 mr-5">
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- No Categories Found Message -->
                <div id="no-categories-message" class="hidden text-center text-red-500 mt-4">
                    No categories found matching your search criteria.
                </div>

                <div class="mt-5">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>

    </div>



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
                                <input class="text-sm ml-2 disabled:accent-gray-400 disabled:cursor-not-allowed" type="radio" id="hot"
                                    name="beverage_type" value="hot" disabled>
                                <label class="text-sm ml-2 text-gray-600 disabled:text-gray-400 disabled:cursor-not-allowed"
                                    for="hot">Hot</label><br>
                                <input class="text-sm ml-2 disabled:accent-gray-400 disabled:cursor-not-allowed" type="radio" id="iced"
                                    name="beverage_type" value="iced" disabled>
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

    <!-- Item Added Successfully Modal -->
    <div id="added-dialog-categories"
        class="hidden modal fixed inset-0 bg-black bg-opacity-75 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50"
        aria-hidden="true">
        <div class="bg-white shadow-md p-8 flex flex-col items-center w-[500px] h-[370px] rounded-[20px] overflow-hidden">
            <img src="{{ asset('Assets/update-icon.png') }}" alt="Success Icon" class="w-[150px] h-[150px]">
            <h1 class="text-center text-2xl font-bold mb-4">Item Added Successfully</h1>
            <h2 class="text-center mb-2 font-barlow text-sm">The category has been successfully added
                to the list and is now available for viewing.</h2>
            <button onclick="hideAddedDialogCategories()"
                class="mt-4 bg-yellow-600 text-sm text-white px-4 py-2 hover:bg-yellow-200 w-[200px] rounded-full">
                Close
            </button>
        </div>
    </div>

    
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
                            <label for="editCategoryName" class="text-sm">Category Name <span class="text-red-500">*</span></label>
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
                                <input class="text-sm ml-2 disabled:accent-gray-400 disabled:cursor-not-allowed" type="radio" id="hot"
                                    name="beverage_type" value="hot" disabled>
                                <label class="text-sm ml-2 text-gray-600 disabled:text-gray-400 disabled:cursor-not-allowed"
                                    for="hot">Hot</label><br>
                                <input class="text-sm ml-2 disabled:accent-gray-400 disabled:cursor-not-allowed" type="radio" id="iced"
                                    name="beverage_type" value="iced" disabled>
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

    <!-- Successfully item update Modal -->
    <div id="edited-dialog-categories"
        class="hidden modal fixed inset-0 bg-black bg-opacity-75 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50"
        aria-hidden="true">
        <div class="bg-white shadow-md p-8 flex flex-col items-center w-[500px] h-[350px] rounded-[20px] overflow-hidden">
            <img src="{{ asset('Assets/icon-success.png') }}" alt="Success Icon" class="w-[150px] h-[150px]">
            <h1 class="text-center text-2xl font-bold mb-2 font-barlow mt-2">Item Updated
                Successfully!</h1>
            <h2 class="text-center mb-4 font-barlow text-sm">The category has been successfully added
                to the list</h2>
            <button onclick="hideEditedDialogCategories()"
                class="mt-4 bg-yellow-600 text-sm text-white px-4 py-2  hover:bg-amber-700 w-[200px] rounded-full">
                Close
            </button>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="delete-dialog-categories"
        class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50"
        aria-hidden="true">
        <div class="bg-white shadow-md p-8 flex flex-col items-center w-[500px] h-[350px] rounded-[20px] overflow-hidden">
            <img src="{{ asset('Assets/icons-delete.png') }}" alt="deleteIcon" class="w-[150px] h-[150px]">
            <h1 class="text-center text-xl font-bold mb-4">Delete Category</h1>
            <p class="text-center">Are you sure you want to delete this category?</p>
            <div class="flex space-x-4 mt-4">
                <button onclick="showConfirmDeleteCategories()"
                    class="rounded-full flex items-center justify-center text-center text-white hover:text-red-700 bg-red-600 px-4 py-2 h-[40px] w-[140px]">
                    Delete
                </button>
                <button onclick="hideDeleteDialogCategories()"
                    class="bg-gray-200 text-sm text-black rounded-full h-[40px] w-[140px] hover:bg-gray-300 font-bold">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    <!--Confirm Delete-->
    <div id="confirm-delete-dialog-categories"
        class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75 hidden" aria-hidden="true">
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
            <button id="confirmButtonCategory"
                class="mt-4 bg-yellow-500 text-white px-4 py-2 rounded-full hover:bg-gray-100 w-[200px]">Confirm</button>
        </div>
    </div>

    <!-- Success Message Modal -->
    <div id="deleted-dialog-categories"
        class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75 hidden" aria-hidden="true">
        <div
            class="bg-white p-4 shadow-md text-center w-[500px] h-[350px] rounded-[20px] overflow-hidden flex flex-col items-center">
            <img src="{{ asset('Assets/icon-success.png') }}" alt="deleteIcon" class="w-[150px] h-[150px] mb-4">
            <h2 class="text-lg font-semibold">Success!</h2>
            <p class="mt-2">Category deleted successfully.</p>
            <button onclick="hideDeletedDialogCategories()"
                class="mt-4 bg-yellow-500 text-white px-4 py-2 rounded-full hover:bg-gray-100 w-[258px]">Ok</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // success add modal
            @if (session('status_add'))
                showAddedDialogCategories();
            @endif


            @if (session('status_edit'))
                showEditedDialogCategories();
            @endif


            @if (session('status_deleted'))
                showDeletedDialogCategories();
            @endif

        });
    </script>
@endsection
