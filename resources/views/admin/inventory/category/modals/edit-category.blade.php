<!-- Edit Modal -->
<div id="edit-modal-categories"
class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50"
aria-hidden="true">
<div class="bg-white shadow-md p-8 flex flex-col items-center justify-center rounded-lg h-auto w-auto relative">
    <!-- Close Icon -->
    <a href="{{ route('admin.inventory.categories') }}">
        <img  src="{{ asset('Assets/close.png') }}" alt="Close"
        class="absolute top-5 right-5 w-5 cursor-pointer hover:opacity-80">
    </a>

    <!-- Title -->
    <h1 class="text-center text-xl font-semibold mb-4 text-black">Edit Category</h1>

    <hr class="text-gray-600 w-full mb-4">

    <!-- Form -->
    <form id="edit-form" action="{{ route('admin.inventory.category.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="" name="editCategoryId" id="editCategoryId">
        <div class="flex items-center justify-center flex-wrap">
            <div class="flex flex-col items-center mt-5">
                <div class="relative w-[350px] mb-4">
                    <label for="categoryName" class="text-sm">Category Name <span class="text-red-500">*</span></label>
                    <input id="categoryName"
                        class="mb-1 mt-2 peer w-full h-10 text-gray-600 border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:ring-opacity-70 text-xs"
                        type="text" placeholder="Enter category name" name="category_name">

                    @error('category_name')
                        <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                    @enderror
                    <div id="edit-error-name" class=" text-red-500 w-80 text-xs mt-2 ml-1 block"></div>
                </div>

                <div class="relative w-[350px] mb-4">
                    <label for="editDescription" class="text-sm">Category Description </label>
                    <textarea id="editDescription"
                        class="mb-1 mt-2 peer w-full h-20 text-gray-600 border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:ring-opacity-70 text-xs"
                        type="text" placeholder="Write short description about the category" name="description"></textarea>

                    @error('description')
                        <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="w-full flex items-center justify-center">
            <button type="submit"
                class="text-sm text-white rounded-lg h-[40px] w-1/2 hover:bg-green-700 bg-green-600">
                Save Changes
            </button>
        </div>
    </form>
</div>
</div>
