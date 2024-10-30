<button onclick="showDeleteDialog()" class="flex items-center text-red-500 hover:text-red-700 ml-2 transition duration-300 ease-in-out">
    <img src="{{ asset('Assets/Delete.png') }}" alt="Delete Icon" class="mr-2 ml-2">
</button>


  <!-- Delete Modal for product -->
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

<script>
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
    const dialog = document.getElementById('delete-dialog');
    dialog.classList.add('opacity-0');
    setTimeout(() => {
        dialog.classList.add('hidden');
        successModal();
    }, 300);
}
    function successModal() {
        const dialog = document.getElementById('success-modal');
        dialog.classList.remove('hidden');
        setTimeout(() => dialog.classList.remove('opacity-0'), 0);
    }

    function hideSuccessModal() {
        const dialog = document.getElementById('success-modal');
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

document.getElementById('confirmButton').addEventListener('click', function() {
    document.getElementById('success-modal').classList.add('hidden');
    document.getElementById('item-deleted-modal').classList.remove('hidden');
});
function hideSuccessMessage() {
    document.getElementById('item-deleted-modal').classList.add('hidden');
}
</script>
