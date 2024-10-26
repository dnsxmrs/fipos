<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caffeinated</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Barlow', sans-serif;
        }
    </style>
</head>
<body>

<!-- MainFrame -->
<div class="flex h-screen bg-[rgb(243,243,243)]">

    <!-- Sidebar -->
    <nav class="w-20 bg-white border-r flex flex-col items-center py-6">
        <div class="mb-1">
            <img src="{{ asset('Assets/Caffeinated Logo 1.png') }}" alt="Caffeinated Logo" class="w-12 h-12">
        </div>
        <!-- Menu buttons -->
        <button aria-label="Menu" class="flex flex-col items-center">
            <div class="w-10 h-10 rounded-lg mb-2"></div>
            <img src="{{ asset('Assets/food menu icon 1.png') }}" alt="Menu Icon" class="w-6 h-6 mb-1">
            <span class="text-xs">Menu</span>
        </button>
        <button aria-label="Reports" class="flex flex-col items-center">
            <div class="w-10 h-10 rounded-lg mb-2"></div>
            <img src="{{ asset('Assets/Graph.png') }}" alt="Reports Icon" class="w-6 h-6 mb-2">
            <span class="text-xs">Reports</span>
        </button>
        <button aria-label="Order tracking" class="flex flex-col items-center">
            <div class="w-10 h-10 rounded-lg mb-2"></div>
            <img src="{{ asset('Assets/order report icon 1.png') }}" alt="Order Tracking Icon" class="w-6 h-6 mb-2">
            <span class="text-xs">Order</span>
            <span class="text-xs">Tracking</span>
        </button>
        <button aria-label="Staff Management" class="flex flex-col items-center">
            <div class="w-10 h-10 rounded-lg mb-2"></div>
            <img src="{{ asset('Assets/staff-icon.png') }}" alt="Staff Management Icon" class="w-6 h-6 mb-2">
            <div class="text-xs">Staff</div>
            <div class="text-xs">Management</div>
        </button>
        <button aria-label="Audit Trails" class="flex flex-col items-center">
            <div class="w-10 h-10 rounded-lg mb-2"></div>
            <img src="{{ asset('Assets/audit-icon.png') }}" alt="Audit Trails Icon" class="w-6 h-6 mb-2">
            <span class="text-xs">Audit</span>
            <div class="text-xs">Trails</div>
        </button>
        <button aria-label="Settings" class="flex flex-col items-center">
            <div class="w-10 h-10 rounded-lg mb-2"></div>
            <img src="{{ asset('Assets/Setting.png') }}" alt="Settings Icon" class="w-6 h-6 mb-2">
            <span class="text-xs">Settings</span>
        </button>
    </nav>

    <!-- Main Content Wrapper -->
    <main class="flex-1 p-8 overflow-y-auto">
        <div class="mb-2">
            <h1 class="font-barlow text-4xl font-bold mr-0">Caffeinated <span class="text-4xl font-bold font-barlow ml-0 text-amber-950">POS</span></h1>
            <p class="font-barlow text-lg mt-2">current-date</p>
        </div>
<!--Sidebar-for-products&categories-->
        <div class="flex space-x-6 h-[870px]">
            <div class="bg-white border rounded-md shadow-md w-[285px]">
                <button class="flex items-center text-left font-barlow text-xl mb-1 mt-9 w-[268px] h-[76px] text-black">
                    <img src="{{ asset('Assets/category-icon.png') }}" alt="Category Icon" class="w-6 h-6 mr-2 ml-3">
                    <span class="">Categories</span>
                </button>
                <button class="flex items-center text-left rounded-lg font-barlow text-xl mb-4 ml-2 w-[268px] h-[76px] text-black" style="background-color: #E8C9B2;">
                    <img src="{{ asset('Assets/product-icon.png') }}" alt="Product Icon" class="w-6 h-6 mr-2 ml-2">
                    <span class="">Products</span>
                </button>
                <div class="grid grid-cols-2 gap-4">
                </div>
            </div>

                        <!-- Menu Products part -->
            <div class="bg-white border rounded-md shadow-md p-6 w-[1450px]">

                        <!-- Header ng Product Management -->
        <div class="mb-4">
            <div class="flex justify-between items-center">
                <h2 class="font-barlow text-2xl font-bold">Product Management</h2>
                <button onclick="showAddDialog()" class="text-white px-4 py-2 rounded-md focus:outline-none" style="background-color: #45A834">
                    + Add Product
                </button>
            </div>

            <!-- Search Bar -->
            <div class="flex items-center border border-gray-300 rounded-full w-[314px] p-2 mt-2 mb-4">
                <img src="{{ asset('Assets/search-icon.png') }}" alt="Search Icon" class="w-6 h-6 mr-2 ml-2">
                <input
                    type="text"
                    placeholder="Search for coffee, food.."
                    class="w-full focus:outline-none focus:border-gray-500 rounded-lg"
                />
            </div>
        </div>



                <!-- Add Modal -->
                <div id="add-dialog" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50" aria-hidden="true">
                    <div class="bg-white shadow-md p-8 flex flex-col items-center rounded-lg" style="width: 455px; height: 750px;">
                        <h1 class="text-center text-xl font-bold mb-4 text-black">Add new item</h1>
                        <div class="flex flex-col items-center justify-center">
                            <button class="bg-white py-3 px-5 rounded text-black shadow-md text-center mt-4 ml-6 items-center" style="width: 346px; height: 231px; border: 2px dashed black;">
                                <div class="text-center">
                                    <div class="text-2xl">+</div>
                                    <span class="block mt-2">Upload Image</span>
                                </div>
                            </button>
                            <select class="mt-4 w-[350px] h-[42px] border border-gray-300 rounded-md p-2 text-sm mb-1">
                                <option value="" disabled selected>Category</option>
                                <option value="Coffee">Coffee</option>
                                <option value="Non-Coffee">Non-Coffee</option>
                                <option value="Meal">Meal</option>
                                <option value="Snacks">Snacks</option>
                                <option value="Dessert">Dessert</option>
                            </select>
                           <div class="flex flex-col items-center mt-4">
                    <div class="relative w-[350px] mb-4">
                        <input id="itemName" class="mb-1 peer w-full h-[42px] border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-opacity-70 placeholder-transparent text-xs" type="text" placeholder=" ">
                        <label class="text-sm absolute left-2 top-2 transform transition-transform duration-300 ease-in-out scale-100 text-gray-500 origin-left peer-placeholder-shown:top-2 peer-placeholder-shown:left-2 peer-placeholder-shown:scale-100 peer-focus:-top-5 peer-focus:left-2 peer-focus:scale-75" for="itemName">Item Name</label>
                    </div>

                    <div class="relative w-[350px] mb-4">
                        <input id="itemPrice" class="mb-1 peer w-full h-[42px] border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-opacity-70 placeholder-transparent" type="text" placeholder=" ">
                        <label class="text-sm absolute left-2 top-2 transform transition-transform duration-300 ease-in-out scale-100 text-gray-500 origin-left peer-placeholder-shown:top-2 peer-placeholder-shown:left-2 peer-placeholder-shown:scale-100 peer-focus:-top-5 peer-focus:left-2 peer-focus:scale-75" for="itemPrice">Item Price</label>
                    </div>

                    <div class="relative w-[350px] mb-4">
                        <input id="itemDescription" class="peer w-full h-[42px] border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-opacity-70-opacity-50 placeholder-transparent" type="text" placeholder=" ">
                        <label class="text-sm absolute left-2 top-2 transform transition-transform duration-300 ease-in-out scale-100 text-gray-500 origin-left peer-placeholder-shown:top-2 peer-placeholder-shown:left-2 peer-placeholder-shown:scale-100 peer-focus:-top-5 peer-focus:left-2 peer-focus:scale-75" for="itemDescription">Item Description</label>
                    </div>

                    <button onclick="showItemUpdatedDialog()" class="text-sm text-white rounded-lg h-[40px] w-[350px] hover:bg-amber-700 mt-8" style="background-color: #45A834">
                        Add Item
                    </button>
                    <button onclick="hideAddDialog()" class="bg-gray-200 text-sm text-black rounded-lg h-[40px] w-[350px] hover:bg-gray-300 mt-2 font-bold">
                        Cancel
                    </button>
                </div>
                        </div>
                    </div>
                </div>

                                <!-- Item Added Successfully Modal -->
                            <div id="item-updated-dialog" class="hidden modal fixed inset-0 bg-black bg-opacity-75 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50" aria-hidden="true">
                                <div class="bg-white shadow-md p-8 flex flex-col items-center w-[500px] h-[350px] rounded-[20px] overflow-hidden">
                                <img src="{{ asset('Assets/icon-success.png') }}" alt="Success Icon" class="w-[150px] h-[150px]">
                            <h1 class="text-center text-2xl font-bold mb-2 font-barlow mt-2">Item Added Successfully!</h1>
                            <h2 class="text-center mb-4 font-barlow text-sm">The product has been successfully added to the list</h2>
                <button onclick="hideItemUpdatedDialog()" class="mt-4 bg-yellow-600 text-sm text-white px-4 py-2  hover:bg-amber-700 w-[200px] rounded-full">
                    Close
                </button>
            </div>
        </div>


                <!-- Edit Modal -->
                <div id="edit-dialog" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50" aria-hidden="true">
                    <div class="bg-white rounded shadow-md p-8 flex flex-col items-center" style="width: 455px; height: 814px;">
                        <h1 class="text-center text-xl font-bold mb-4">Edit item</h1>
                        <div class="flex flex-col items-center justify-center">
                            <button class="bg-white py-3 px-5 rounded text-black shadow-md text-center mt-4 ml-6 items-center" style="width: 346px; height: 231px; border: 2px dashed black;">
                                <div class="text-center">
                                    <div class="text-2xl">+</div>
                                    <span class="block mt-2">Upload Image</span>
                                </div>
                            </button>
                            <select class="mt-4 w-[350px] h-[42px] border border-gray-300 rounded-md p-2">
                                <option value="Coffee">Coffee</option>
                                <option value="Non-Coffee">Non-Coffee</option>
                                <option value="Meal">Meal</option>
                                <option value="Snacks">Snacks</option>
                                <option value="Dessert">Dessert</option>
                            </select>
                            <div class="flex flex-col items-center mt-4">
                                <div class="relative w-[350px] mb-4">
                                <input id="itemName" class="mb-1 peer w-full h-[42px] border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-opacity-70 placeholder-transparent text-xs" type="text" placeholder=" ">
                              <label class="text-sm absolute left-2 top-2 transform transition-transform duration-300 ease-in-out scale-100 text-gray-500 origin-left peer-placeholder-shown:top-2 peer-placeholder-shown:left-2 peer-placeholder-shown:scale-100 peer-focus:-top-5 peer-focus:left-2 peer-focus:scale-75" for="itemName">Item Name</label>
                    </div>

                    <div class="relative w-[350px] mb-4">
                        <input id="itemPrice" class="mb-1 peer w-full h-[42px] border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-opacity-70 placeholder-transparent" type="text" placeholder=" ">
                        <label class="text-sm absolute left-2 top-2 transform transition-transform duration-300 ease-in-out scale-100 text-gray-500 origin-left peer-placeholder-shown:top-2 peer-placeholder-shown:left-2 peer-placeholder-shown:scale-100 peer-focus:-top-5 peer-focus:left-2 peer-focus:scale-75" for="itemPrice">Item Price</label>
                    </div>

                    <div class="relative w-[350px] mb-4">
                        <input id="itemDescription" class="peer w-full h-[42px] border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-opacity-70-opacity-50 placeholder-transparent" type="text" placeholder=" ">
                        <label class="text-sm absolute left-2 top-2 transform transition-transform duration-300 ease-in-out scale-100 text-gray-500 origin-left peer-placeholder-shown:top-2 peer-placeholder-shown:left-2 peer-placeholder-shown:scale-100 peer-focus:-top-5 peer-focus:left-2 peer-focus:scale-75" for="itemDescription">Item Description</label>
                                </div>

                                <div class="relative w-[350px] mb-4">
                                    <div class="flex items-center">
                                        <label class="mr-2 text-gray-700 font-bold">Status:</label> <!-- Moved label inside flex -->
                                        <span class="mr-2 text-gray-700">Not Available</span>
                                        <input type="checkbox" id="availabilityToggle" class="toggle-checkbox hidden" />
                                        <label for="availabilityToggle" class="toggle-label cursor-pointer w-12 h-6 flex items-center bg-gray-300 rounded-full p-1 transition duration-300 ease-in-out">
                                            <span class="toggle-dot w-4 h-4 bg-white rounded-full shadow-md transform transition duration-300 ease-in-out"></span>
                                        </label>
                                        <span class="ml-2 text-gray-700">Available</span>
                                    </div>
                                </div>

                                <button onclick="handleSaveChanges()" class="text-sm text-white rounded-lg h-[40px] w-[350px] hover:bg-amber-700 mt-8 font-bold" style="background-color: #45A834">
                                    Save Changes
                                </button>
                                <button onclick="hideEditDialog()" class="bg-gray-200 text-sm text-black rounded-lg h-[40px] w-[350px] hover:bg-gray-300 mt-2 font-bold">
                                    Cancel
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

                                <!-- Successfully item update Modal -->
                <div id="added-dialog" class="hidden modal fixed inset-0 bg-black bg-opacity-75 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50" aria-hidden="true">
                    <div class="bg-white shadow-md p-8 flex flex-col items-center w-[500px] h-[370px] rounded-[20px] overflow-hidden">
                        <img src="{{ asset('Assets/update-icon.png') }}" alt="Success Icon" class="w-[150px] h-[150px]">
                        <h1 class="text-center text-2xl font-bold mb-4">Item Updated Successfully</h1>
                        <h2 class="text-center mb-2 font-barlow text-sm">The product has been successfully added to the list and is now available for viewing.</h2>
                        <button onclick="hideAddedDialog()" class="mt-4 bg-yellow-600 text-sm text-white px-4 py-2 hover:bg-yellow-200 w-[200px] rounded-full">
                            Close
                        </button>
                    </div>
                </div>

                <!--Confirm Delete-->
                <div id="success-modal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75 hidden" aria-hidden="true">
                    <div class="bg-white p-4 shadow-md text-center w-[500px] h-[380px] rounded-[20px] overflow-hidden flex flex-col items-center">
                        <img src="{{ asset('Assets/icons-password.png') }}" alt="Password Icon" class="w-[150px] h-[150px] mb-4">
                        <h2 class="text-lg font-semibold">Confirm Delete</h2>
                        <p class="mt-1 mb-1">Enter your password below:</p>

                        <!-- Password input section -->
                        <div class="relative mt-4">
                            <input type="password" id="password" class="peer w-[250px] h-[42px] border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-opacity-70 placeholder-transparent" placeholder=" ">
                            <label class="text-sm absolute left-2 top-2 transform transition-transform duration-300 ease-in-out scale-100 text-gray-500 origin-left peer-placeholder-shown:top-2 peer-placeholder-shown:left-2 peer-placeholder-shown:scale-100 peer-focus:-top-5 peer-focus:left-2 peer-focus:scale-75" for="password">Input Password</label>
                        </div>


                        <button id="confirmButton" class="mt-4 bg-yellow-500 text-white px-4 py-2 rounded-full hover:bg-gray-100 w-[200px]">Confirm</button>
                    </div>
                </div>

                <!-- Success Message Modal -->
                <div id="item-deleted-modal"  class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75 hidden" aria-hidden="true">
                    <div class="bg-white p-4 shadow-md text-center w-[500px] h-[350px] rounded-[20px] overflow-hidden flex flex-col items-center">
                        <img src="{{ asset('Assets/icon-success.png') }}" alt="deleteIcon" class="w-[150px] h-[150px] mb-4">
                        <h2 class="text-lg font-semibold">Success!</h2>
                        <p class="mt-2">Item deleted successfully.</p>
                        <button onclick="hideSuccessMessage()" class="mt-4 bg-yellow-500 text-white px-4 py-2 rounded-full hover:bg-gray-100 w-[258px]">Ok</button>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div id="delete-dialog" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50" aria-hidden="true">
                    <div class="bg-white shadow-md p-8 flex flex-col items-center w-[500px] h-[350px] rounded-[20px] overflow-hidden">
                        <img src="{{ asset('Assets/icons-delete.png') }}" alt="deleteIcon" class="w-[150px] h-[150px]">
                        <h1 class="text-center text-xl font-bold mb-4">Delete item</h1>
                        <p class="text-center">Are you sure you want to delete this item?</p>
                        <div class="flex space-x-4 mt-4">
                            <button onclick="deleteItem()" class="rounded-full flex items-center justify-center text-center text-white hover:text-red-700 bg-red-600 px-4 py-2 h-[40px] w-[140px]">
                                Delete
                            </button>

                            <button onclick="hideDeleteDialog()" class="bg-gray-200 text-sm text-black rounded-full h-[40px] w-[140px] hover:bg-gray-300 font-bold">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>




                 <!-- Category Table -->
                 <table class="border-collapse w-[1400px] mt-7">
                    <thead>
                        <tr class="border-b border-gray-300">
                            <th class="text-left p-2">No.</th>
                            <th class="text-left p-2">Product Name</th>
                            <th class="text-left p-2">Category</th>
                            <th class="text-left p-2">Price</th>
                            <th class="text-left p-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-300">
                            <td class="p-2">75</td>
                            <td class="p-2">Fries</td>
                            <td class="p-2">Snacks</td>
                            <td class="p-2">89</td>
                            <td class="p-2">
                                <span class="text-xs text-green-500 rounded-md px-2 py-1" style="background-color: #DCF8F0">Available</span>
                            </td>
                            <td class="py-2 px-4 flex space-x-2">
                                <button onclick="showEditDialog()" class="flex items-center text-blue-500 hover:text-blue-700 transition duration-300 ease-in-out">
                                    <img src="{{ asset('Assets/Edit.png') }}" alt="Edit Icon" class="mr-2 ml-2">
                                </button>
                                <button onclick="showDeleteDialog()" class="flex items-center text-red-500 hover:text-red-700 ml-2 transition duration-300 ease-in-out">
                                    <img src="{{ asset('Assets/Delete.png') }}" alt="Delete Icon" class="mr-2 ml-2">
                                </button>
                            </td>
                        </tr>
                        <!-- New row added below -->
                        <tr class="border-b border-gray-300">
                            <td class="p-2">75</td>
                            <td class="p-2">Fries</td>
                            <td class="p-2">Snacks</td>
                            <td class="p-2">89</td>
                            <td class="p-2">
                                <span class="text-xs text-red-500 rounded-md px-2 py-1" style="background-color: #FFDFDF">Not Available</span>
                            </td>
                            <td class="py-2 px-4 flex space-x-2">
                                <button onclick="showEditDialog()" class="flex items-center text-blue-500 hover:text-blue-700">
                                    <img src="{{ asset('Assets/Edit.png') }}" alt="Edit Icon" class="mr-2 ml-2">
                                </button>
                                <button onclick="showDeleteDialog()" class="flex items-center text-red-500 hover:text-red-700 ml-2">
                                    <img src="{{ asset('Assets/Delete.png') }}" alt="Delete Icon" class="mr-2 ml-2">
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

<script>
    function showAddDialog() {
        const dialog = document.getElementById('add-dialog');
        dialog.classList.remove('hidden');
        setTimeout(() => dialog.classList.remove('opacity-0'), 0); // Use a timeout for the transition
    }

    function hideAddDialog() {
        const dialog = document.getElementById('add-dialog');
        dialog.classList.add('opacity-0');
        setTimeout(() => {
            dialog.classList.add('hidden');
        }, 300); // Match the transition duration
    }

    function showEditDialog() {
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

    function showDeleteDialog() {
        const dialog = document.getElementById('delete-dialog');
        dialog.classList.remove('hidden');
        setTimeout(() => dialog.classList.remove('opacity-0'), 0);
    }

    function hideDeleteDialog() {
        const dialog = document.getElementById('delete-dialog');
        dialog.classList.add('opacity-0');
        setTimeout(() => {
            dialog.classList.add('hidden');
        }, 300);
    }

    function deleteItem() {
    // Hide the delete dialog immediately
    const dialog = document.getElementById('delete-dialog');
    dialog.classList.add('opacity-0');
    setTimeout(() => {
        dialog.classList.add('hidden');
        successModal(); // Show success modal after hiding delete dialog
    }, 300); // Duration for opacity transition
}


    function successModal() {
        const dialog = document.getElementById('success-modal');
        dialog.classList.remove('hidden'); // Show the modal
        setTimeout(() => dialog.classList.remove('opacity-0'), 0); // Fade in
    }

    function hideSuccessModal() {
        const dialog = document.getElementById('success-modal');
        dialog.classList.add('opacity-0');
        setTimeout(() => {
            dialog.classList.add('hidden');
        }, 300); // Hide with fade out
    }

    function handleSaveChanges() {
    // Show the "added-dialog" modal
    const addedDialog = document.getElementById('added-dialog');
    addedDialog.classList.remove('hidden');
    setTimeout(() => addedDialog.classList.remove('opacity-0'), 0); // Use a timeout for the transition


    // Optionally, hide the "edit-dialog" modal
    hideEditDialog();
}

function hideEditDialog() {
    const editDialog = document.getElementById('edit-dialog');
    editDialog.classList.add('hidden');
}

function hideAddedDialog() {
    const addedDialog = document.getElementById('added-dialog');
    addedDialog.classList.add('hidden');
}

function showItemUpdatedDialog() {
    // Hide the Add Dialog
    hideAddDialog();

    // Show the Item Updated Dialog
    const dialog = document.getElementById('item-updated-dialog');
    dialog.classList.remove('hidden');
    setTimeout(() => dialog.classList.remove('opacity-0'), 0);
}

function hideItemUpdatedDialog() {
    const dialog = document.getElementById('item-updated-dialog');
    dialog.classList.add('opacity-0');
    setTimeout(() => {
        dialog.classList.add('hidden');
    }, 300);
}

 // Function to hide the confirmation modal and show success modal
document.getElementById('confirmButton').addEventListener('click', function() {
    // Close the confirmation modal
    document.getElementById('success-modal').classList.add('hidden');
    // Show the success modal
    document.getElementById('item-deleted-modal').classList.remove('hidden');
});

// Function to hide the success message modal
function hideSuccessMessage() {
    document.getElementById('item-deleted-modal').classList.add('hidden'); // Hide success modal
}

</script>

</body>
</html>
