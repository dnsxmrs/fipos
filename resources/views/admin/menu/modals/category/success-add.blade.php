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
