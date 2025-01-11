<!-- Add modal -->
<div id="edit-item" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 transition-opacity duration-200 overflow-y-auto overflow-x-hidden top-0 right-0 left-0 z-50 w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
                <h3 class="text-lg font-semibold text-gray-900">
                    Edit Item
                </h3>
                <button type="button" onclick="hideEditItemModal()"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                    data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" id="edit_item_form" action="{{route('admin.inventory.item.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="" name="edit_item_id" id="edit_item_id" name="edit_item_id">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="edit_item_name" class="block mb-2 text-sm font-medium text-gray-900">Item Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="edit_item_name" id="edit_item_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            placeholder="Type item name" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="edit_category" class="block mb-2 text-sm font-medium text-gray-900 ">Category <span
                                class="text-red-500">*</span></label>
                        <select id="edit_category" name="edit_category"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 ">
                            <option selected="">Select category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="edit_stock" class="block mb-2 text-sm font-medium text-gray-900">Stock <span
                                class="text-red-500">*</span></label>
                        <input disabled type="text" name="edit_stock" id="edit_stock"
                            class="bg-gray-50 cursor-not-allowed border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            placeholder="123" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="edit_unit" class="block mb-2 text-sm font-medium text-gray-900 ">Unit <span
                                class="text-red-500">*</span></label>
                        <select disabled id="edit_unit" name="edit_unit"
                            class="bg-gray-50 cursor-not-allowed border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 ">
                            <option selected="">Select unit</option>
                            <option value="kg">Kilograms (kg)</option>
                            <option value="liters">Liters (L)</option>
                            <option value="pcs">Pieces (pcs)</option>
                        </select>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="edit_reorder_level" class="block mb-2 text-sm font-medium text-gray-900">Reorder Level
                            <span class="text-red-500">*</span></label>
                        <input disabled type="number" name="edit_reorder_level" id="edit_reorder_level"
                            class="bg-gray-50 cursor-not-allowed border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            placeholder="123" required="">
                    </div>
                    <div class=" col-span-2 sm:col-span-1">
                        <label for="edit_expiration_date" class="block mb-2 text-sm font-medium text-gray-900">Expiration
                            Date</label>
                        <div class="relative max-w-sm">
                            <div
                                class="absolute inset-y-0 start-0 flex items-center justify-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input disabled id="edit_expiration_date" name="edit_expiration_date" datepicker datepicker-autohide data-date-format="yyyy-mm-dd"
                                type="text"
                                class="bg-gray-50 cursor-not-allowed border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 "
                                placeholder="Select date">
                        </div>
                    </div>
                </div>
                <button type="submit"
                    class="text-white inline-flex items-center bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Save Changes
                </button>
            </form>
        </div>
    </div>
</div>
