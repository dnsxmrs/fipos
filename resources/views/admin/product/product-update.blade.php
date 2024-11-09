
  <!-- Edit Modal -->
  <div id="edit-dialog" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50" aria-hidden="true">
    <div class="bg-white rounded shadow-md p-8 flex flex-col items-center" style="width: 455px; height: 814px;">

        <!--Header Modal-->
        <h1 class="text-center text-xl font-bold mb-4">Edit item</h1>
        <div class="flex flex-col items-center justify-center">

            <!--Upload Image-->
            <button class="bg-white py-3 px-5 rounded text-black shadow-md text-center mt-4 ml-6 items-center" style="width: 346px; height: 231px; border: 2px dashed black;">
                <div class="text-center">
                    <div class="text-2xl">+</div>
                    <span class="block mt-2">Upload Image</span>
                </div>
            </button>

            <!--Dropdown options-->
            <select class="mt-4 w-[350px] h-[42px] border border-gray-300 rounded-md p-2">
                <option value="Coffee">Coffee</option>
                <option value="Non-Coffee">Non-Coffee</option>
                <option value="Meal">Meal</option>
                <option value="Snacks">Snacks</option>
                <option value="Dessert">Dessert</option>
            </select>

            <!--Input fields-->
            <div class="flex flex-col items-center mt-4">

                 <!--Item name-->
                <div class="relative w-[350px] mb-4">
                <input id="itemName" class="mb-1 peer w-full h-[42px] border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-opacity-70 placeholder-transparent text-xs" type="text" placeholder=" ">
              <label class="text-sm absolute left-2 top-2 transform transition-transform duration-300 ease-in-out scale-100 text-gray-500 origin-left peer-placeholder-shown:top-2 peer-placeholder-shown:left-2 peer-placeholder-shown:scale-100 peer-focus:-top-5 peer-focus:left-2 peer-focus:scale-75" for="itemName">Item Name</label>
    </div>

    <!--Item price-->
    <div class="relative w-[350px] mb-4">
        <input id="itemPrice" class="mb-1 peer w-full h-[42px] border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-opacity-70 placeholder-transparent" type="text" placeholder=" ">
        <label class="text-sm absolute left-2 top-2 transform transition-transform duration-300 ease-in-out scale-100 text-gray-500 origin-left peer-placeholder-shown:top-2 peer-placeholder-shown:left-2 peer-placeholder-shown:scale-100 peer-focus:-top-5 peer-focus:left-2 peer-focus:scale-75" for="itemPrice">Item Price</label>
    </div>

    <!--Item description-->
    <div class="relative w-[350px] mb-4">
        <input id="itemDescription" class="peer w-full h-[42px] border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-opacity-70-opacity-50 placeholder-transparent" type="text" placeholder=" ">
        <label class="text-sm absolute left-2 top-2 transform transition-transform duration-300 ease-in-out scale-100 text-gray-500 origin-left peer-placeholder-shown:top-2 peer-placeholder-shown:left-2 peer-placeholder-shown:scale-100 peer-focus:-top-5 peer-focus:left-2 peer-focus:scale-75" for="itemDescription">Item Description</label>
                </div>

                <!--Toggle for available and not available-->
                <div class="relative w-[350px] mb-4">
                    <div class="flex items-center">
                        <label class="mr-2 text-gray-700 font-bold">Status:</label>
                        <span class="mr-2 text-gray-700">Not Available</span>
                        <input type="checkbox" id="availabilityToggle" class="toggle-checkbox hidden" />
                        <label for="availabilityToggle" class="toggle-label cursor-pointer w-12 h-6 flex items-center bg-gray-300 rounded-full p-1 transition duration-300 ease-in-out">
                            <span class="toggle-dot w-4 h-4 bg-white rounded-full shadow-md transform transition duration-300 ease-in-out"></span>
                        </label>
                        <span class="ml-2 text-gray-700">Available</span>
                    </div>
                </div>

                <!--Save changes button for modal-->
                <button onclick="handleSaveChanges()" class="text-sm text-white rounded-lg h-[40px] w-[350px] hover:bg-amber-700 mt-8 font-bold" style="background-color: #45A834">
                    Save Changes
                </button>
                <button onclick="hideEditDialog()" class="bg-gray-200 text-sm text-black rounded-lg h-[40px] w-[350px] hover:bg-gray-300 mt-2 font-bold">
                    Cancel
                </button>
            </div>

             <!-- Successfully item update Modal -->
             <div id="added-dialog" class="hidden modal fixed inset-0 bg-black bg-opacity-75 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50" aria-hidden="true">
                <div class="bg-white shadow-md p-8 flex flex-col items-center w-[500px] h-[370px] rounded-[20px] overflow-hidden">
                    <img src="{{ asset('Assets/update-icon.png') }}" alt="Success Icon" class="w-[150px] h-[150px]">
                    <h1 class="text-center text-2xl font-bold mb-4">Item Updated Successfully</h1>
                    <h2 class="text-center mb-2 font-barlow text-sm">The Category has been successfully added to the list and is now available for viewing.</h2>
                    <button onclick="hideAddedDialog()" class="mt-4 bg-yellow-600 text-sm text-white px-4 py-2 hover:bg-yellow-200 w-[200px] rounded-full">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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

    function handleSaveChanges() {
    const addedDialog = document.getElementById('added-dialog');
    addedDialog.classList.remove('hidden');
    setTimeout(() => addedDialog.classList.remove('opacity-0'), 0);
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
</script>
