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
