<!-- resources/views/admin/reports.blade.php -->
@extends('admin.menu')

@section('main-content')
    <!-- Header ng Product Management -->
    <div class="mb-4">
        <div class="flex justify-between items-center">
            <h2 class="font-barlow text-2xl font-bold">Product Management</h2>
            <button onclick="showAddDialog()" class="text-white px-4 py-2 rounded-md focus:outline-none"
                style="background-color: #45A834">
                + Add Product
            </button>
        </div>

        <!-- Search Bar -->
        <div class="flex items-center border border-gray-300 rounded-full w-[314px] p-2 mt-2 mb-4">
            <img src="{{ asset('Assets/search-icon.png') }}" alt="Search Icon" class="w-6 h-6 mr-2 ml-2">
            <input type="text" placeholder="Search for coffee, food..."
                class="w-full focus:outline-none focus:border-gray-500 rounded-lg" name="product_search" id="product_search"
                autocomplete="off" onkeyup="filterProducts()" />
        </div>
    </div>

    <!-- Add Modal -->
    <div id="add-dialog"
        class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50"
        aria-hidden="true">
        <div class="bg-white shadow-md p-8 flex flex-col items-center rounded-lg" style="width: 455px; height: 750px;">
            <h1 class="text-center text-xl font-bold mb-4 text-black">Add new item</h1>
            <form action="{{ route('admin.menu.products.store') }}" method="POST" enctype="multipart/form-data">
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
                    <select class="mt-4 w-[350px] h-[42px] border border-gray-300 rounded-md p-2" name="category_id"
                        required>
                        <option value="" disabled selected>Category</option>
                        <!-- Display categories from the model/db 'categories' -->
                        @foreach ($categories as $category)
                            <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    <div class="flex flex-col items-center mt-4">
                        <div class="relative w-[350px] mb-4">
                            <input id="itemName"
                                class="mb-1 peer w-full h-[42px] border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-opacity-70 placeholder-transparent text-xs"
                                type="text" placeholder=" " name="product_name" required>
                            <label
                                class="text-sm absolute left-2 top-2 transform transition-transform duration-300 ease-in-out scale-100 text-gray-500 origin-left peer-placeholder-shown:top-2 peer-placeholder-shown:left-2 peer-placeholder-shown:scale-100 peer-focus:-top-5 peer-focus:left-2 peer-focus:scale-75"
                                for="itemName">Item Name</label>
                            @error('product_name')
                                <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="relative w-[350px] mb-4">
                            <input id="itemPrice"
                                class="mb-1 peer w-full h-[42px] border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-opacity-70 placeholder-transparent"
                                type="text" placeholder=" " name="product_price" required>
                            <label
                                class="text-sm absolute left-2 top-2 transform transition-transform duration-300 ease-in-out scale-100 text-gray-500 origin-left peer-placeholder-shown:top-2 peer-placeholder-shown:left-2 peer-placeholder-shown:scale-100 peer-focus:-top-5 peer-focus:left-2 peer-focus:scale-75"
                                for="itemPrice">Item Price</label>
                            @error('product_price')
                                <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="relative w-[350px] mb-4">
                            <input id="itemDescription"
                                class="peer w-full h-[42px] border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-opacity-70 placeholder-transparent"
                                type="text" placeholder=" " name="product_description" required>
                            <label
                                class="text-sm absolute left-2 top-2 transform transition-transform duration-300 ease-in-out scale-100 text-gray-500 origin-left peer-placeholder-shown:top-2 peer-placeholder-shown:left-2 peer-placeholder-shown:scale-100 peer-focus:-top-5 peer-focus:left-2 peer-focus:scale-75"
                                for="itemDescription">Item Description</label>
                            @error('product_description')
                                <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" onclick="handleSaveChanges()"
                            class="bg-[#45A834] text-sm text-white rounded-lg h-[40px] w-[350px] hover:bg-amber-700 mt-8">
                            Add Item
                        </button>
                        <button type="button" onclick="hideAddDialog()"
                            class="bg-gray-200 text-sm text-black rounded-lg h-[40px] w-[350px] hover:bg-gray-300 mt-2 font-bold">
                            Cancel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Successfully item add Modal -->
    <div id="added-dialog"
        class="hidden modal fixed inset-0 bg-black bg-opacity-75 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50"
        aria-hidden="true">
        <div class="bg-white shadow-md p-8 flex flex-col items-center w-[500px] h-[370px] rounded-[20px] overflow-hidden">
            <img src="{{ asset('Assets/update-icon.png') }}" alt="Success Icon" class="w-[150px] h-[150px]">
            <h1 class="text-center text-2xl font-bold mb-4">Item Added Successfully</h1>
            <h2 class="text-center mb-2 font-barlow text-sm">The product has been successfully added to
                the list and is now available for viewing.</h2>
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
                                class="mb-1 peer w-full h-[42px] border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-opacity-70 placeholder-transparent text-xs"
                                type="text" name="editProductName" required>
                            <label
                                class="text-sm absolute left-2 top-2 transform transition-transform duration-300 ease-in-out scale-100 text-gray-500 origin-left peer-placeholder-shown:top-2 peer-placeholder-shown:left-2 peer-placeholder-shown:scale-100 peer-focus:-top-5 peer-focus:left-2 peer-focus:scale-75"
                                for="itemName">Item Name</label>
                        </div>

                        <div class="relative w-[350px] mb-4">
                            <input id="editProductPrice" name="editProductPrice"
                                class="mb-1 peer w-full h-[42px] border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-opacity-70 placeholder-transparent"
                                type="text" required>
                            <label
                                class="text-sm absolute left-2 top-2 transform transition-transform duration-300 ease-in-out scale-100 text-gray-500 origin-left peer-placeholder-shown:top-2 peer-placeholder-shown:left-2 peer-placeholder-shown:scale-100 peer-focus:-top-5 peer-focus:left-2 peer-focus:scale-75"
                                for="itemPrice">Item Price</label>
                        </div>

                        <div class="relative w-[350px] mb-4">
                            <input id="editProductDescription"
                                class="peer w-full h-[42px] border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-opacity-70 placeholder-transparent"
                                type="text" name="editProductDescription" required>
                            <label
                                class="text-sm absolute left-2 top-2 transform transition-transform duration-300 ease-in-out scale-100 text-gray-500 origin-left peer-placeholder-shown:top-2 peer-placeholder-shown:left-2 peer-placeholder-shown:scale-100 peer-focus:-top-5 peer-focus:left-2 peer-focus:scale-75"
                                for="itemDescription">Item Description</label>
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

                        <button onclick="showItemUpdatedDialog()" type="submit"
                            class="bg-[#45A834] text-sm text-white rounded-lg h-[40px] w-[350px] hover:bg-amber-700 mt-8 font-bold">
                            Save Changes
                        </button>
                        <button type="button" onclick="hideEditDialog()"
                            class="bg-gray-200 text-sm text-black rounded-lg h-[40px] w-[350px] hover:bg-gray-300 mt-2 font-bold">
                            Cancel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Item Updated Successfully Modal -->
    <div id="updated-dialog"
        class="hidden modal fixed inset-0 bg-black bg-opacity-75 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50"
        aria-hidden="true">
        <div class="bg-white shadow-md p-8 flex flex-col items-center w-[500px] h-[350px] rounded-[20px] overflow-hidden">
            <img src="{{ asset('Assets/icon-success.png') }}" alt="Success Icon" class="w-[150px] h-[150px]">
            <h1 class="text-center text-2xl font-bold mb-2 font-barlow mt-2">Item Updated Successfully!
            </h1>
            <h2 class="text-center mb-4 font-barlow text-sm">The product has been successfully added to
                the list</h2>
            <button onclick="hideItemUpdatedDialog()"
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
            <h1 class="text-center text-xl font-bold mb-4">Delete Product</h1>
            <p class="text-center">Are you sure you want to delete this product?</p>
            <div class="flex space-x-4 mt-4">
                <button onclick="showConfirmDeleteModal()"
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
    <div id="confirm-delete-modal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75 hidden"
        aria-hidden="true">
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


            <button id="confirmButton"
                class="mt-4 bg-yellow-500 text-white px-4 py-2 rounded-full hover:bg-gray-100 w-[200px]">Confirm</button>
        </div>
    </div>

    <!-- Success Message Deleted Modal -->
    <div id="item-deleted-modal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75 hidden"
        aria-hidden="true">
        <div
            class="bg-white p-4 shadow-md text-center w-[500px] h-[350px] rounded-[20px] overflow-hidden flex flex-col items-center">
            <img src="{{ asset('Assets/icon-success.png') }}" alt="deleteIcon" class="w-[150px] h-[150px] mb-4">
            <h2 class="text-lg font-semibold">Success!</h2>
            <p class="mt-2">Item deleted successfully.</p>
            <button onclick="hideSuccessMessage()"
                class="mt-4 bg-yellow-500 text-white px-4 py-2 rounded-full hover:bg-gray-100 w-[258px]">Ok</button>
        </div>
    </div>

    <!-- Products Table -->
    <table class="border-collapse w-[1400px] mt-7" id="products_table">
        <thead>
            <tr class="border-b border-gray-300">
                <th class="text-left p-2">No.</th>
                <th class="text-left p-2">Product Name</th>
                <th class="text-left p-2">Category</th>
                <th class="text-left p-2">Price</th>
                <th class="text-left p-2">Status</th>
                <th class="text-left p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $index => $product)
                <tr class="border-b border-gray-300 product-row">
                    <td class="p-2">{{ $product->id }}</td>
                    <td class="p-2">{{ $product->product_name }}</td>
                    <td class="p-2">{{ $product->category ? $product->category->category_name : 'N/A' }}</td>
                    <td class="p-2">{{ $product->product_price }}</td>
                    <td class="p-2">
                        <span
                            class="text-xs {{ $product->isAvailable ? 'text-green-500' : 'text-red-500' }} rounded-md px-2 py-1"
                            style="background-color: {{ $product->isAvailable ? '#DCF8F0' : '#FFDFDF' }}">
                            {{ $product->isAvailable ? 'Available' : 'Not Available' }}
                        </span>
                    </td>
                    <td class="py-2 px-4 flex space-x-2">
                        <button onclick="showEditDialog(this)"
                            class="flex items-center text-blue-500 hover:text-blue-700 transition duration-300 ease-in-out"
                            data-id="{{ $product->id }}" data-name="{{ $product->product_name }}"
                            data-description="{{ $product->product_description }}"
                            data-price="{{ $product->product_price }}" data-category="{{ $product->category_id }}"
                            data-availability="{{ $product->isAvailable ? '1' : '0' }}"
                            data-image="{{ $product->image ? asset('storage/' . $product->image) : '' }}">
                            <img src="{{ asset('Assets/Edit.png') }}" alt="Edit Icon" class="mr-2 ml-2">
                        </button>
                        <button onclick="showDeleteDialog({{ $product->id }})"
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

    <script>
        // dynamic table for searching
        function filterProducts() {
            // Get the value of the search bar
            const input = document.getElementById('product_search');
            const filter = input.value.toLowerCase();
            const table = document.getElementById('products_table');
            const rows = table.getElementsByClassName('product-row');
            const noProductsMessage = document.getElementById('no-products-message');
            let hasVisibleRows = false;

            // Loop through all table rows and hide those that don't match the search query
            for (let i = 0; i < rows.length; i++) {
                const productName = rows[i].getElementsByTagName('td')[1].textContent.toLowerCase();
                const categoryName = rows[i].getElementsByTagName('td')[2].textContent.toLowerCase();

                if (productName.includes(filter) || categoryName.includes(filter)) {
                    rows[i].style.display = ''; // Show the row
                    hasVisibleRows = true; // There are visible rows
                } else {
                    rows[i].style.display = 'none'; // Hide the row
                }
            }

            // Show or hide the no products message based on whether any rows are visible
            noProductsMessage.style.display = hasVisibleRows ? 'none' : 'block';
        }

        // Show the Add Dialog
        function showAddDialog() {
            const dialog = document.getElementById('add-dialog');
            dialog.classList.remove('hidden');
            setTimeout(() => dialog.classList.remove('opacity-0'), 0); // Use a timeout for the transition
        }
        // Show the Item Successfully Added Modal
        function handleSaveChanges() {
            // Show the "added-dialog" modal
            const addedDialog = document.getElementById('added-dialog');
            addedDialog.classList.remove('hidden');
            setTimeout(() => addedDialog.classList.remove('opacity-0'), 0); // Use a timeout for the transition
        }
        // Hide the Add Dialog
        function hideAddDialog() {
            const dialog = document.getElementById('add-dialog');
            dialog.classList.add('opacity-0');
            setTimeout(() => {
                dialog.classList.add('hidden');
            }, 300); // Match the transition duration
        }
        // Hide the Item Successfully Added Modal
        function hideAddedDialog() {
            const addedDialog = document.getElementById('added-dialog');
            addedDialog.classList.add('hidden');
        }

        function showEditDialog(button) {
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const description = button.getAttribute('data-description');
            const price = button.getAttribute('data-price');
            const category = button.getAttribute('data-category');
            const availability = button.getAttribute('data-availability') === '1';
            const imagePath = button.getAttribute('data-image');

            // Debugging: Check values in the console
            console.log({
                id,
                name,
                description,
                price,
                category,
                availability,
                imagePath
            });

            document.getElementById('editProductId').value = id;
            document.getElementById('editProductName').value = name;
            document.getElementById('editProductDescription').value = description;
            document.getElementById('editProductPrice').value = price;
            document.getElementById('editCategoryId').value = category;
            document.getElementById('editIsAvailable').checked = availability;

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

        function hideEditDialog() {
            const dialog = document.getElementById('edit-dialog');
            dialog.classList.add('opacity-0');
            setTimeout(() => {
                dialog.classList.add('hidden');
            }, 300);
        }

        function showItemUpdatedDialog() {
            // Hide the Add Dialog
            hideAddDialog();
            // Show the Item Updated Dialog
            const dialog = document.getElementById('updated-dialog');
            dialog.classList.remove('hidden');
            setTimeout(() => dialog.classList.remove('opacity-0'), 0);
        }

        function hideItemUpdatedDialog() {
            const dialog = document.getElementById('updated-dialog');
            dialog.classList.add('opacity-0');
            setTimeout(() => {
                dialog.classList.add('hidden');
            }, 300);
        }


        let productIdToDelete = null;

        function showDeleteDialog(productId) {
            productIdToDelete = productId; // Store the ID of the product to delete
            document.getElementById('delete-dialog').classList.remove('hidden', 'opacity-0');
            document.getElementById('delete-dialog').classList.add('opacity-100');
        }

        function hideDeleteDialog() {
            document.getElementById('delete-dialog').classList.add('hidden', 'opacity-0');
        }

        function showConfirmDeleteModal() {
            hideDeleteDialog();
            document.getElementById('confirm-delete-modal').classList.remove('hidden');
        }

        function hideConfirmDeleteModal() {
            document.getElementById('confirm-delete-modal').classList.add('hidden');
        }

        function showSuccessMessage() {
            hideConfirmDeleteModal();
            document.getElementById('item-deleted-modal').classList.remove('hidden');
        }

        function hideSuccessMessage() {
            document.getElementById('item-deleted-modal').classList.add('hidden');
            window.location.reload(); // Reload the page to reflect deletion
        }

        document.getElementById('confirmButton').addEventListener('click', function() {
            // Assuming the password is always correct, directly call the delete function
            deleteItem();
        });

        function deleteItem() {
            fetch(`/admin/menu/products/${productIdToDelete}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                })
                .then(response => {
                    if (response.ok || response.status === 204) { // Include check for 204 status
                        showSuccessMessage(); // Show success modal if deletion was successful
                    } else {
                        console.error('Error:', response);
                        alert('Failed to delete the product. Please try again.'); // Error handling
                        console.error('Error:', response);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        // Function to hide the confirmation modal and show success modal
        document.getElementById('confirmButton').addEventListener('click', function() {
            // Close the confirmation modal
            document.getElementById('confirm-delete-modal').classList.add('hidden');
            // Show the success modal
            document.getElementById('item-deleted-modal').classList.remove('hidden');
        });

        // Function to hide the success message modal
        function hideSuccessMessage() {
            document.getElementById('item-deleted-modal').classList.add('hidden'); // Hide success modal
        }
    </script>
@endsection
