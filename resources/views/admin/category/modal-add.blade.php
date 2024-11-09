

<!--Add Category Container-->
 <div id="add-dialog" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50" aria-hidden="true">
    <div class="bg-white shadow-md p-8 flex flex-col items-center rounded-lg" style="width: 455px; height: 750px;">

<!--Add Category Modal-->
        <h1 class="text-center text-xl font-bold mb-4 text-black">Add new item</h1> <!--Header ng Modal-->

        <!--Upload Image Container-->
        <div class="flex flex-col items-center justify-center">
            <button class="bg-white py-3 px-5 rounded text-black shadow-md text-center mt-4 ml-6 items-center" style="width: 346px; height: 231px; border: 2px dashed black;">
                <div class="text-center">
                    <div class="text-2xl">+</div>
                    <span class="block mt-2">Upload Image</span>
                </div>
            </button>

            <!--Dropdown Options for Category-->
            <select class="mt-4 w-[350px] h-[42px] border border-gray-300 rounded-md p-2 text-sm mb-1">
                <option value="" disabled selected>Category name</option>
                <option value="Coffee">Coffee</option>
                <option value="Non-Coffee">Non-Coffee</option>
                <option value="Meal">Meal</option>
                <option value="Snacks">Snacks</option>
                <option value="Dessert">Dessert</option>
            </select>

      <!--Input Fields-->
            <div class="flex flex-col items-center mt-4">
        <div class="relative w-[350px] mb-4"> <!--Category No.-->
            <input id="itemName" class="mb-1 peer w-full h-[42px] border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-opacity-70 placeholder-transparent text-xs" type="text" placeholder=" ">
            <label class="text-sm absolute left-2 top-2 transform transition-transform duration-300 ease-in-out scale-100 text-gray-500 origin-left peer-placeholder-shown:top-2 peer-placeholder-shown:left-2 peer-placeholder-shown:scale-100 peer-focus:-top-5 peer-focus:left-2 peer-focus:scale-75" for="itemName">Category no.</label>
        </div>

        <!--Category name-->
        <div class="relative w-[350px] mb-4">
            <input id="itemPrice" class="mb-1 peer w-full h-[42px] border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-opacity-70 placeholder-transparent" type="text" placeholder=" ">
            <label class="text-sm absolute left-2 top-2 transform transition-transform duration-300 ease-in-out scale-100 text-gray-500 origin-left peer-placeholder-shown:top-2 peer-placeholder-shown:left-2 peer-placeholder-shown:scale-100 peer-focus:-top-5 peer-focus:left-2 peer-focus:scale-75" for="itemPrice">Category name</label>
        </div>

        <!--Add item button in modal-->
    <button onclick="showItemUpdatedDialog()" class="text-sm text-white rounded-lg h-[40px] w-[350px] hover:bg-amber-700 mt-8" style="background-color: #45A834">
        Add Item
    </button>

      <!-- Category Added Successfully Modal -->
        <div id="item-updated-dialog" class="hidden modal fixed inset-0 bg-black bg-opacity-75 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50" aria-hidden="true">
            <div class="bg-white shadow-md p-8 flex flex-col items-center w-[500px] h-[350px] rounded-[20px] overflow-hidden">
            <img src="{{ asset('Assets/icon-success.png') }}" alt="Success Icon" class="w-[150px] h-[150px]">
            <h1 class="text-center text-2xl font-bold mb-2 font-barlow mt-2">Category added successfully!</h1>
            <h2 class="text-center mb-4 font-barlow text-sm">The category has been successfully added to the list</h2>

        <!--Close button for added successfully modal-->
        <button onclick="hideItemUpdatedDialog()" class="mt-4 bg-yellow-600 text-sm text-white px-4 py-2  hover:bg-amber-700 w-[200px] rounded-full">
            Close
            </button>
        </div>
    </div>

    <!--Cancel button in modal-->
    <button onclick="hideAddDialog()" class="bg-gray-200 text-sm text-black rounded-lg h-[40px] w-[350px] hover:bg-gray-300 mt-2 font-bold">
        Cancel
    </button>

            </div>
        </div>
    </div>
</div>

<script>
    function showAddDialog() {
        const dialog = document.getElementById('add-dialog');
        dialog.classList.remove('hidden');
        setTimeout(() => dialog.classList.remove('opacity-0'), 0);
    }

    function hideAddDialog() {
        const dialog = document.getElementById('add-dialog');
        dialog.classList.add('opacity-0');
        setTimeout(() => {
            dialog.classList.add('hidden');
        }, 300);
    }

    function showItemUpdatedDialog() {
    hideAddDialog();
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

</script>
</body>
</html>
