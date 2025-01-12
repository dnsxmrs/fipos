<!-- Confirm Delete Modal -->
<div id="confirm_delete_category_modal" tabindex="-1"
    class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 transition-opacity duration-300 z-50 overflow-y-auto overflow-x-hidden top-0 right-0 left-0 w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow">
            <button type="button" onclick="hideConfirmDeleteCategoryModal()"
                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <img class="mx-auto my-5 text-gray-400 w-12 h-12" src="{{ asset('Assets/icons-password.png') }}" />
                <h3 class="mb-3 text-base font-normal text-gray-500">Enter your password to delete this category</h3>
                <form action="{{ route('admin.inventory.category.destroy') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="" name="delete_category_id" id="delete_category_id">
                    <div class="mb-5 relative">
                        <input type="password" id="password" name="password"
                            class="border w-80 p-3 text-xs font-normal border-gray-200 bg-gray-100 rounded-lg text-gray-500"
                            placeholder="Type your password" required=""
                            @error('password') style="border-color: red" @enderror>

                        <span class="absolute inset-y-0 flex items-center cursor-pointer right-9" id="toggle-password">
                            <!-- Hidden Eye Slash icon (for password hidden) -->
                            <div id="eye-slash-icon" style="display: block;" class="w-5 h-5">
                                <img src="{{ asset('Assets/password_hide.png') }}" alt="hide password icon"
                                    class="filter grayscale opacity-50">
                            </div>

                            <!-- Show Eye icon (for password visible) -->
                            <div id="eye-show-icon" style="display: none;" class="w-5 h-5">
                                <img src="{{ asset('Assets/password_show.png') }}" alt="show password icon"
                                    class="filter grayscale opacity-50">
                            </div>
                        </span>
                    </div>
                    <div class="w-full pl-1">
                        @error('password')
                            <p class="text-xs mt-1 text-red-500">{{ $message }}</p>
                        @enderror
                        <div id="password-error" class=" text-red-500 w-80 text-xs mt-2 ml-1 block"></div>
                    </div>

                    <button type="submit"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Delete
                    </button>

                    <a onclick="hideConfirmDeleteCategoryModal()"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                        Cancel
                    </a>
                </form>

            </div>
        </div>
    </div>
</div>
