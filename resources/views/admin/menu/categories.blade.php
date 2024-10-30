<!-- resources/views/admin/reports.blade.php -->
@extends('admin.menu')

@section('main-content')
    <div class="mb-4">
        <div class="flex justify-between items-center">
            <h2 class="font-barlow text-2xl font-bold">Category Management</h2>
            <!--Add Category-->
            <button onclick="showAddDialog()" class="text-white px-4 py-2 rounded-md focus:outline-none"
                style="background-color: #45A834"">
                + Add Category
            </button>
        </div>
        <!-- Search Bar -->
        <div class="flex items-center border border-gray-300 rounded-full w-[314px] p-2 mt-2">
            <img src="{{ asset('Assets/search-icon.png') }}" alt="Search Icon" class="w-6 h-6 mr-2 ml-2">
            <input type="text" placeholder="Search for category..."
                class="w-full focus:outline-none focus:border-gray-500 rounded-lg" name="category_search"
                id="category_search" autocomplete="off" onkeyup="filterCategories()" />
        </div>
    </div>

    <!-- Category Table -->
    <table class="border-collapse w-[1400px] mt-9" id="category_table">
        <thead>
            <tr class="border-b border-gray-300">
                <th class="text-left p-2">No.</th>
                <th class="text-left p-2">Category Name</th>
                <th class="text-left p-2">Total Products</th>
                <th class="text-left p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $index => $category)
                <tr class="border-b border-gray-300 category-row">
                    <td class="p-2">{{ $category->category_id }}</td>
                    <td class="p-2">{{ $category->category_name }}</td>
                    <td class="p-2">{{ $category->products_count }}</td>
                    <td class="py-2 px-4 flex space-x-2">
                        <button onclick="showEditDialog(this)" data-id="{{ $category->category_id }}"
                            data-name="{{ $category->category_name }}"
                            data-image="{{ $category->image ? asset('storage/' . $category->image) : '' }}"
                            class="flex items-right text-blue-500 hover:text-blue-700 transition duration-300 ease-in-out">
                            <img src="{{ asset('Assets/Edit.png') }}" alt="Edit Icon" class="ml-9">
                        </button>
                        <button onclick="showDeleteDialog({{ $category->category_id }})"
                            class="flex items-right text-red-500 hover:text-red-700 ml-2 transition duration-300 ease-in-out">
                            <img src="{{ asset('Assets/Delete.png') }}" alt="Delete Icon" class="mr-5 ml-5">
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

    <!-- Add Modal -->
    <div id="add-dialog"
        class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50"
        aria-hidden="true">
        <div class="bg-white shadow-md p-8 flex flex-col items-center rounded-lg" style="width: 455px; height: 750px;">
            <h1 class="text-center text-xl font-bold mb-4 text-black">Add New Category</h1>
            <form action="{{ route('admin.menu.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col items-center justify-center">
                    <label class="bg-white py-3 px-5 rounded text-black shadow-md text-center mt-4 ml-6 items-center"
                        style="width: 346px; height: 231px; border: 2px dashed black;">
                        <input type="file" name="image" accept="image/*" class="hidden">
                        <div class="text-center">
                            <div class="text-2xl">+</div>
                            <span class="block mt-2">Upload Image</span>
                        </div>
                    </label>
                    <div class="flex flex-col items-center mt-4">
                        <div class="relative w-[350px] mb-4">
                            <input id="itemName"
                                class="mb-1 peer w-full h-[42px] border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-opacity-70 placeholder-transparent text-xs"
                                type="text" placeholder=" " name="category_name" required>
                            <label
                                class="text-sm absolute left-2 top-2 transform transition-transform duration-300 ease-in-out scale-100 text-gray-500 origin-left peer-placeholder-shown:top-2 peer-placeholder-shown:left-2 peer-placeholder-shown:scale-100 peer-focus:-top-5 peer-focus:left-2 peer-focus:scale-75"
                                for="itemName">Category Name</label>
                            @error('category_name')
                                <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <button onclick="showAddedDialog()"
                            class="text-sm text-white rounded-lg h-[40px] w-[350px] hover:bg-amber-700 mt-8"
                            style="background-color: #45A834">
                            Add Category
                        </button>
                        <button onclick="hideAddDialog()"
                            class="bg-gray-200 text-sm text-black rounded-lg h-[40px] w-[350px] hover:bg-gray-300 mt-2 font-bold">
                            Cancel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Item Added Successfully Modal -->
    <div id="added-dialog"
        class="hidden modal fixed inset-0 bg-black bg-opacity-75 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50"
        aria-hidden="true">
        <div class="bg-white shadow-md p-8 flex flex-col items-center w-[500px] h-[370px] rounded-[20px] overflow-hidden">
            <img src="{{ asset('Assets/update-icon.png') }}" alt="Success Icon" class="w-[150px] h-[150px]">
            <h1 class="text-center text-2xl font-bold mb-4">Item Added Successfully</h1>
            <h2 class="text-center mb-2 font-barlow text-sm">The category has been successfully added
                to the list and is now available for viewing.</h2>
            <button onclick="hideAddedDialog()"
                class="mt-4 bg-yellow-600 text-sm text-white px-4 py-2 hover:bg-yellow-200 w-[200px] rounded-full">
                Close
            </button>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="edit-dialog"
        class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50"
        aria-hidden="true">
        <div class="bg-white shadow-md p-8 flex flex-col items-center rounded-lg" style="width: 455px; height: 750px;">
            <h1 class="text-center text-xl font-bold mb-4 text-black">Edit Category</h1>
            <form action="{{ route('admin.menu.categories.update') }}" method="POST" enctype="multipart/form-data"
                id="edit-category">
                @csrf
                @method('PUT')
                <input type="hidden" value="" name="editCategoryId" id="editCategoryId">
                <div class="flex flex-col items-center justify-center">
                    <label class="bg-white py-3 px-5 rounded text-black shadow-md text-center mt-4 ml-6 items-center"
                        style="width: 346px; height: 231px; border: 2px dashed black;" id="editImageLabel">
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

                    <div class="flex flex-col items-center mt-4">
                        <div class="relative w-[350px] mb-4">
                            <input id="editCategoryName"
                                class="mb-1 peer w-full h-[42px] border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-opacity-70 placeholder-transparent text-xs"
                                type="text" placeholder=" " name="editCategoryName" required>
                            <label
                                class="text-sm absolute left-2 top-2 transform transition-transform duration-300 ease-in-out scale-100 text-gray-500 origin-left peer-placeholder-shown:top-2 peer-placeholder-shown:left-2 peer-placeholder-shown:scale-100 peer-focus:-top-5 peer-focus:left-2 peer-focus:scale-75"
                                for="editCategoryName">Category Name</label>
                            @error('category_name')
                                <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" onclick="showEditedDialog()"
                            class="bg-[#45A834] text-sm text-white rounded-lg h-[40px] w-[350px] hover:bg-amber-700 mt-8">
                            Save Changes
                        </button>
                        <button onclick="hideEditDialog()"
                            class="bg-gray-200 text-sm text-black rounded-lg h-[40px] w-[350px] hover:bg-gray-300 mt-2 font-bold">
                            Cancel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Successfully item update Modal -->
    <div id="edited-dialog"
        class="hidden modal fixed inset-0 bg-black bg-opacity-75 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50"
        aria-hidden="true">
        <div class="bg-white shadow-md p-8 flex flex-col items-center w-[500px] h-[350px] rounded-[20px] overflow-hidden">
            <img src="{{ asset('Assets/icon-success.png') }}" alt="Success Icon" class="w-[150px] h-[150px]">
            <h1 class="text-center text-2xl font-bold mb-2 font-barlow mt-2">Item Updated
                Successfully!</h1>
            <h2 class="text-center mb-4 font-barlow text-sm">The category has been successfully added
                to the list</h2>
            <button onclick="hideEditedDialog()"
                class="mt-4 bg-yellow-600 text-sm text-white px-4 py-2  hover:bg-amber-700 w-[200px] rounded-full">
                Close
            </button>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="delete-dialog"
        class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50"
        aria-hidden="true">
        <div class="bg-white shadow-md p-8 flex flex-col items-center w-[500px] h-[350px] rounded-[20px] overflow-hidden">
            <img src="{{ asset('Assets/icons-delete.png') }}" alt="deleteIcon" class="w-[150px] h-[150px]">
            <h1 class="text-center text-xl font-bold mb-4">Delete Category</h1>
            <p class="text-center">Are you sure you want to delete this category?</p>
            <div class="flex space-x-4 mt-4">
                <button onclick="showConfirmDelete()"
                    class="rounded-full flex items-center justify-center text-center text-white hover:text-red-700 bg-red-600 px-4 py-2 h-[40px] w-[140px]">
                    Delete
                </button>
                <button onclick="hideDeleteDialog()"
                    class="bg-gray-200 text-sm text-black rounded-full h-[40px] w-[140px] hover:bg-gray-300 font-bold">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    <!--Confirm Delete-->
    <div id="confirm-delete-dialog"
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
            <button id="confirmButton" onclick="hideConfirmDelete"
                class="mt-4 bg-yellow-500 text-white px-4 py-2 rounded-full hover:bg-gray-100 w-[200px]">Confirm</button>
        </div>
    </div>

    <!-- Success Message Modal -->
    <div id="deleted-dialog" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75 hidden"
        aria-hidden="true">
        <div
            class="bg-white p-4 shadow-md text-center w-[500px] h-[350px] rounded-[20px] overflow-hidden flex flex-col items-center">
            <img src="{{ asset('Assets/icon-success.png') }}" alt="deleteIcon" class="w-[150px] h-[150px] mb-4">
            <h2 class="text-lg font-semibold">Success!</h2>
            <p class="mt-2">Category deleted successfully.</p>
            <button onclick="hideDeletedDialog()"
                class="mt-4 bg-yellow-500 text-white px-4 py-2 rounded-full hover:bg-gray-100 w-[258px]">Ok</button>
        </div>
    </div>



    <script>
        // dynamic table for searching
        function filterCategories() {
            // Get the value of the search bar
            const input = document.getElementById('category_search');
            const filter = input.value.toLowerCase();
            const table = document.getElementById('category_table');
            const rows = table.getElementsByClassName('category-row');
            const noCategoriesMessage = document.getElementById('no-categories-message');
            let hasVisibleRows = false;

            // Loop through all table rows and hide those that don't match the search query
            for (let i = 0; i < rows.length; i++) {
                const categoryName = rows[i].getElementsByTagName('td')[1].textContent.toLowerCase();

                if (categoryName.includes(filter)) {
                    rows[i].style.display = ''; // Show the row
                    hasVisibleRows = true; // There are visible rows
                } else {
                    rows[i].style.display = 'none'; // Hide the row
                }
            }

            // Show or hide the no categories message based on whether any rows are visible
            noCategoriesMessage.style.display = hasVisibleRows ? 'none' : 'block';
        }

        // Show the add dialog
        function showAddDialog() {
            const dialog = document.getElementById('add-dialog');
            dialog.classList.remove('hidden');
            setTimeout(() => dialog.classList.remove('opacity-0'), 0); // Use a timeout for the transition
        }
        // Hide the add dialog
        function hideAddDialog() {
            const dialog = document.getElementById('add-dialog');
            dialog.classList.add('opacity-0');
            setTimeout(() => {
                dialog.classList.add('hidden');
            }, 300); // Match the transition duration
        }
        // Show the added item dialog
        function showAddedDialog() {
            // Hide the Add Dialog
            hideAddDialog();
            // Show the Item Updated Dialog
            const dialog = document.getElementById('added-dialog');
            dialog.classList.remove('hidden');
            setTimeout(() => dialog.classList.remove('opacity-0'), 0);
        }
        // Hide the added item dialog
        function hideAddedDialog() {
            const dialog = document.getElementById('added-dialog');
            dialog.classList.add('opacity-0');
            setTimeout(() => {
                dialog.classList.add('hidden');
            }, 300);
        }

        // Show Edit Dialog
        function showEditDialog(button) {
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const imagePath = button.getAttribute('data-image');

            // Debugging: Check values in the console
            console.log({
                id,
                name,
                imagePath
            });

            document.getElementById('editCategoryId').value = id;
            document.getElementById('editCategoryName').value = name;

            // Set the image if it exists
            const imageLabel = document.getElementById('editImageLabel');
            const imgElement = imageLabel.querySelector('img'); // Select the image element

            if (imagePath) {
                console.log('Image Path:', imagePath); // Check what this logs

                imgElement.src = imagePath; // Set the source of the image
                imgElement.alt = 'Product Image'; // Set an alt text if needed
                imgElement.classList.remove('hidden'); // Make sure the image is visible

                // Hide the "+" and upload message
                const uploadMessage = imageLabel.querySelector('.upload-message');
                if (uploadMessage) {
                    uploadMessage.classList.add('hidden'); // Hide the upload message
                }
            } else {
                imgElement.src = ''; // Clear the image source if no image path
                imgElement.classList.add('hidden'); // Hide the image if there's no path

                // Show the "+" and upload message if needed
                const uploadMessage = imageLabel.querySelector('.upload-message');
                if (uploadMessage) {
                    uploadMessage.classList.remove('hidden'); // Show the upload message
                }
            }

            const dialog = document.getElementById('edit-dialog');
            dialog.classList.remove('hidden');
            setTimeout(() => dialog.classList.remove('opacity-0'), 0);
        }
        // Hide the edit dialog
        function hideEditDialog() {
            const dialog = document.getElementById('edit-dialog');
            dialog.classList.add('opacity-0');
            setTimeout(() => {
                dialog.classList.add('hidden');
            }, 300);
        }

        function showEditedDialog() {
            // Hide the Edit Dialog
            hideEditDialog();
            // Show the Item Updated Dialog
            const dialog = document.getElementById('edited-dialog');
            dialog.classList.remove('hidden');
            setTimeout(() => dialog.classList.remove('opacity-0'), 0);
        }

        function hideEditedDialog() {
            const dialog = document.getElementById('edited-dialog');
            dialog.classList.add('opacity-0');
            setTimeout(() => {
                dialog.classList.add('hidden');
            }, 300);
        }

        let categoryIdToDelete = null;

        function showDeleteDialog(cateogryId) {
            categoryIdToDelete = cateogryId; // Store the ID of the product to delete
            document.getElementById('delete-dialog').classList.remove('hidden', 'opacity-0');
            document.getElementById('delete-dialog').classList.add('opacity-100');
        }

        function hideDeleteDialog() {
            document.getElementById('delete-dialog').classList.add('hidden', 'opacity-0');
        }

        function showConfirmDelete() {
            hideDeleteDialog();
            document.getElementById('confirm-delete-dialog').classList.remove('hidden');
        }

        function hideConfirmDelete() {
            document.getElementById('confirm-delete-dialog').classList.add('hidden');
        }

        function showDeletedDialog() {
            hideConfirmDelete();
            document.getElementById('deleted-dialog').classList.remove('hidden');
        }

        function hideDeletedDialog() {
            document.getElementById('deleted-dialog').classList.add('hidden');
            window.location.reload(); // Reload the page to reflect deletion
        }
        document.getElementById('confirmButton').addEventListener('click', function() {
            // Assuming the password is always correct, directly call the delete function
            deleteItem();
        });

        function deleteItem() {
            fetch(`/admin/menu/categories/${categoryIdToDelete}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                })
                .then(response => {
                    if (response.ok || response.status === 204) {
                        showDeletedDialog(); // Show success modal if deletion was successful
                    } else if (response.status === 400) {
                        // Parse the JSON response to extract the error message
                        response.json().then(data => {
                            alert(data.message ||
                                'A product is linked in the category; cannot delete the category.');
                        });
                        hideConfirmDelete(); // Hide the confirm delete dialog
                    } else {
                        response.json().then(data => {
                            alert(data.message || 'Failed to delete the category. Please try again.');
                        });
                        hideConfirmDelete(); // Hide the confirm delete dialog
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An unexpected error occurred. Please try again.');
                    hideConfirmDelete();
                });
        }
    </script>
@endsection
