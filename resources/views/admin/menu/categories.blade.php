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
                                        date-type="{{ $category->type }}"
                                        data-beverageType="{{ $category->beverage_type }}"
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
                                <input class="text-sm ml-2 disabled:accent-gray-400 disabled:cursor-not-allowed"
                                    type="radio" id="hot" name="beverage_type" value="hot" disabled>
                                <label
                                    class="text-sm ml-2 text-gray-600 disabled:text-gray-400 disabled:cursor-not-allowed"
                                    for="hot">Hot</label><br>
                                <input class="text-sm ml-2 disabled:accent-gray-400 disabled:cursor-not-allowed"
                                    type="radio" id="iced" name="beverage_type" value="iced" disabled>
                                <label
                                    class="text-sm ml-2 text-gray-600 disabled:text-gray-400 disabled:cursor-not-allowed"
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
                                <label
                                    class="text-sm ml-2 text-gray-600 disabled:text-gray-400 disabled:cursor-not-allowed"
                                    for="hot">Hot</label><br>
                                <input class="text-sm ml-2 disabled:accent-gray-400 disabled:cursor-not-allowed"
                                    type="radio" id="iced" name="beverage_type" value="iced" disabled>
                                <label
                                    class="text-sm ml-2 text-gray-600 disabled:text-gray-400 disabled:cursor-not-allowed"
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

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            filterCategories();
        });

        // dynamic table for searching
        function filterCategories() {
            // Get the value of the search bar
            const input = document.getElementById("category_search");
            const filter = input.value.toLowerCase();
            const table = document.getElementById("category_table");
            const rows = table.getElementsByClassName("category_row");
            const noCategoriesMessage = document.getElementById(
                "no-categories-message"
            );
            let hasVisibleRows = false;

            // Loop through all table rows and hide those that don't match the search query
            for (let i = 0; i < rows.length; i++) {
                const categoryName = rows[i]
                    .getElementsByTagName("td")[1]
                    .textContent.toLowerCase();

                if (categoryName.includes(filter)) {
                    rows[i].style.display = ""; // Show the row
                    hasVisibleRows = true; // There are visible rows
                } else {
                    rows[i].style.display = "none"; // Hide the row
                }
            }

            // Show or hide the no categories message based on whether any rows are visible
            noCategoriesMessage.style.display = hasVisibleRows ? "none" : "block";
        }

        // Show the add dialog
        function showAddDialogCategories() {
            const dialog = document.getElementById("add-dialog-categories");
            dialog.classList.remove("hidden");
            setTimeout(() => dialog.classList.remove("opacity-0"), 0); // Use a timeout for the transition
        }

        // Hide the add dialog
        function hideAddDialogCategories() {
            const dialog = document.getElementById("add-dialog-categories");
            dialog.classList.add("opacity-0");
            setTimeout(() => {
                dialog.classList.add("hidden");
            }, 300); // Match the transition duration
        }

        // Show the added item dialog
        function showAddedDialogCategories() {
            // Hide the Add Dialog
            hideAddDialogCategories();
            // Show the Item Updated Dialog
            const dialog = document.getElementById("added-dialog-categories");
            dialog.classList.remove("hidden");
            setTimeout(() => dialog.classList.remove("opacity-0"), 0);
        }

        // Hide the added item dialog
        function hideAddedDialogCategories() {
            const dialog = document.getElementById("added-dialog-categories");
            dialog.classList.add("opacity-0");
            setTimeout(() => {
                dialog.classList.add("hidden");
            }, 300);
        }


        // Show Edit Dialog
        function showEditDialogCategories(button) {
            const id = button.getAttribute("data-id");
            const name = button.getAttribute("data-name");
            const description = button.getAttribute("data-description");
            const imagePath = button.getAttribute("data-image");
            const type = button.getAttribute("data-type");
            const beverageType = button.getAttribute("data-beverageType");

            // Debugging: Check values in the console
            console.log({
                id,
                name,
                description,
                imagePath,
                type,
                beverageType,
            });

            // Set values to the form fields
            document.getElementById("editCategoryId").value = id;
            document.getElementById("editCategoryName").value = name;
            document.getElementById("editCategoryDescription").value = description;

            // Set the dropdown (Type) value
            const typeDropdown = document.getElementById("editType");
            if (typeDropdown) {
                typeDropdown.value = type; // Set the selected value of the dropdown
                console.log("Type dropdown value set to:", typeDropdown.value);
            } else {
                console.error("Dropdown 'editType' not found");
            }

            // Set the radio buttons (Beverage Type)
            const hotRadio = document.getElementById("hot");
            const icedRadio = document.getElementById("iced");

            if (hotRadio && icedRadio) {
                // Check the correct radio button based on the beverageType
                if (beverageType === "hot") {
                    hotRadio.checked = true; // Check the "Hot" radio button
                    icedRadio.checked = false; // Uncheck the "Iced" radio button
                } else if (beverageType === "iced") {
                    icedRadio.checked = true; // Check the "Iced" radio button
                    hotRadio.checked = false; // Uncheck the "Hot" radio button
                }
                console.log("Beverage Type selected:", beverageType);
            } else {
                console.error("Radio buttons not found");
            }

            // Set the image if it exists
            const imageLabel = document.getElementById("editImageLabel");
            const imgElement = imageLabel.querySelector("img"); // Select the image element

            if (imagePath && imgElement) {
                imgElement.src = imagePath; // Set the source of the image
                imgElement.alt = "Category Image"; // Set an alt text if needed
                imgElement.classList.remove("hidden"); // Make sure the image is visible

                // Hide the "+" and upload message
                const uploadMessage = imageLabel.querySelector(".upload-message");
                if (uploadMessage) {
                    uploadMessage.classList.add("hidden"); // Hide the upload message
                }
            } else {
                if (imgElement) {
                    imgElement.src = ""; // Clear the image source if no image path
                    imgElement.classList.add("hidden"); // Hide the image if there's no path
                }

                // Show the "+" and upload message if needed
                const uploadMessage = imageLabel.querySelector(".upload-message");
                if (uploadMessage) {
                    uploadMessage.classList.remove("hidden"); // Show the upload message
                }
            }

            // Show the modal
            const dialog = document.getElementById("edit-dialog-categories");
            if (dialog) {
                dialog.classList.remove("hidden");
                setTimeout(() => dialog.classList.remove("opacity-0"), 0);
            } else {
                console.error("Dialog 'edit-dialog-categories' not found");
            }
        }



        // Hide the edit dialog
        function hideEditDialogCategories() {
            const dialog = document.getElementById("edit-dialog-categories");
            dialog.classList.add("opacity-0");
            setTimeout(() => {
                dialog.classList.add("hidden");
            }, 300);
        }


        function showEditedDialogCategories() {
            // Hide the Edit Dialog
            hideEditDialogCategories();
            // Show the Item Updated Dialog
            const dialog = document.getElementById("edited-dialog-categories");
            dialog.classList.remove("hidden");
            setTimeout(() => dialog.classList.remove("opacity-0"), 0);
        }

        function hideEditedDialogCategories() {
            const dialog = document.getElementById("edited-dialog-categories");
            dialog.classList.add("opacity-0");
            setTimeout(() => {
                dialog.classList.add("hidden");
            }, 300);
        }

        let categoryIdToDelete = null;

        function showDeleteDialogCategories(cateogryId) {
            categoryIdToDelete = cateogryId; // Store the ID of the product to delete
            document
                .getElementById("delete-dialog-categories")
                .classList.remove("hidden", "opacity-0");
            document.getElementById("delete-dialog-categories").classList.add("opacity-100");
        }

        function hideDeleteDialogCategories() {
            document
                .getElementById("delete-dialog-categories")
                .classList.add("hidden", "opacity-0");
        }


        //button sa first delete modal- confirm
        function showConfirmDeleteCategories() {
            hideDeleteDialogCategories();
            document.getElementById("confirm-delete-dialog-categories").classList.remove("hidden");
        }

        // button sa confirm delete pagka input ng password - confirm
        function hideConfirmDeleteCategories() {
            document.getElementById("confirm-delete-dialog-categories").classList.add("hidden");
        }

        // shows success popup kapag category is deleted
        function showDeletedDialogCategories() {
            hideConfirmDeleteCategories();
            document.getElementById("deleted-dialog-categories").classList.remove("hidden");
        }

        // button sa popup na success
        function hideDeletedDialogCategories() {
            document.getElementById("deleted-dialog-categories").classList.add("hidden");
            window.location.reload(); // Reload the page to reflect deletion
        }
        document.getElementById("confirmButtonCategory").addEventListener("click", function() {
            // Assuming the password is always correct, directly call the delete function
            deleteItemCategory();
        });


        function deleteItemCategory() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(`/admin/menu/categories/${categoryIdToDelete}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                        "Content-Type": "application/json",
                    },
                })
                .then((response) => {
                    if (response.status === 204) {
                        // No Content response, deletion successful
                        showDeletedDialogCategories(); // Show success modal
                    } else if (response.status === 200) {
                        showDeletedDialogCategories(); // Show success modal
                    } else {
                        alert(`Failed to delete category. Please try again. Status Code: ${response.status}`);
                    }
                })
                .catch((error) => {
                    console.error("Error:", error.message);
                    alert(error.message || "catch An unexpected error occurred. Please try again.");
                    alert(`An unexpected error occurred. Please try again. Status Code: ${response.status}`);
                    hideConfirmDeleteCategories(); // Hide confirmation dialog
                });
        }


        function toggleBeverageType(selectElement) {
            // Get the selected value
            const selectedValue = selectElement.value;

            // Get the beverage type radio buttons
            const hotRadio = document.getElementById('hot');
            const icedRadio = document.getElementById('iced');

            // Enable or disable the radio buttons based on the selected value
            if (selectedValue === 'beverage') {
                hotRadio.disabled = false;
                icedRadio.disabled = false;
            } else {
                hotRadio.disabled = true;
                icedRadio.disabled = true;
                hotRadio.checked = false;
                icedRadio.checked = false;
            }
        }
    </script>
@endsection
