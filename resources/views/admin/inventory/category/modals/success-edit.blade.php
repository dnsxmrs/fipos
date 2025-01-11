<!-- Successfully item update Modal -->
<div id="success_item_edit"
    class="hidden modal fixed inset-0 bg-black bg-opacity-75 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50"
    aria-hidden="true">
    <div class="bg-white shadow-md p-8 flex flex-col items-center w-96 h-auto py-10 px-5 rounded-[20px] overflow-hidden">
        <img src="{{ asset('Assets/icon-success.png') }}" alt="Success Icon" class="w-32 h-32">
        <h1 class="text-center text-2xl font-bold mb-2 font-barlow mt-2 text-wrap">Item Updated
            Successfully!</h1>
        <h2 class="text-center mb-4 font-barlow text-sm text-wrap">The item has been successfully updated</h2>
        <button onclick="hideSuccessEditModal()"
            class="mt-4 bg-yellow-600 text-sm text-white px-4 py-2  hover:bg-amber-700 w-[200px] rounded-full">
            Close
        </button>
    </div>
</div>
