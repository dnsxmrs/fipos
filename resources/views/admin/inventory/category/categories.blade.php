@extends('admin.inventory.index')

@section('inventory_table')
    <div class="flex items-center justify-between mt-5">
        <input type="text" placeholder="Search category..."
            class="p-3 h-10 w-64 focus:outline-none focus:ring-1 focus:ring-blue-500 bg-gray-100 border border-gray-200 text-sm text-gray-500 rounded-lg">

        <!--ADD BUTTON-->
        <button onclick="showAddDialog()"
            class="bg-green-600 ml-3 text-white px-10 h-10 font-medium text-sm hover:bg-green-700 shadow-sm rounded-full">
            + Add Category
        </button>
    </div>

    {{-- Success Message --}}
    @if (session('status'))
        <div id="success-message" class="flex items-center justify-center">
            <div class="relative px-4 py-2 w-[500px] text-center mt-3 text-green-700 bg-green-100 border border-green-400 rounded"
                role="alert">
                <span class="block sm:inline text-sm">{{ session('status') }}</span>
            </div>
        </div>
    @endif

    {{-- CATEGORIES TABLE --}}
    <div class="flex items-start my-7  justify-center rounded-lg w-full">
        <div class="w-full ">
            <table class="w-full shadow rounded-lg table-auto">
                <thead class="bg-slate-100 border-b-2 rounded-lg">
                    <tr>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">No.</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Category Name</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Description</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Total Items </th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max"></th>
                    </tr>
                </thead>
                <tbody class="text-center text-xs">
                    @foreach ($categories as $category)
                        <tr class="border-b hover:bg-slate-50">
                            <td class="py-3 px-5">
                                {{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }} </td>
                            <td class="py-3 px-5"> {{ ucfirst($category->category_name) }} </td>
                            <td class="p-3">{{ $category->description }}</td>
                            <td class="py-3 px-5">{{ $category->items_count }}</td>
                            <td class="flex py-3 px-5 space-x-2 items-center justify-end">
                                <button onclick="showEditDialog(this)" data-id="{{ $category->id }}"
                                    data-name="{{ $category->category_name }}" data-description="{{ $category->description }}"
                                    class="flex text-blue-500 transition duration-300 ease-in-out items-right hover:text-blue-700">
                                    <img src="{{ asset('Assets/Edit.png') }}" alt="Edit Icon" class="ml-9">
                                </button>
                                <button onclick="showDeleteDialog({{ $category->id }})"
                                    class="flex ml-2 text-red-500 transition duration-300 ease-in-out items-right hover:text-red-700">
                                    <img src="{{ asset('Assets/Delete.png') }}" alt="Delete Icon" class="ml-5 mr-5">
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-5">
                {{ $categories->links() }}
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div id="add-dialog-categories"
        class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50"
        aria-hidden="true">
        <div class="bg-white shadow-md p-8 flex flex-col items-center justify-center rounded-lg h-auto w-auto relative">
            <!-- Close Icon -->
            <img onclick="hideAddModal()" src="{{ asset('Assets/close.png') }}" alt="Close"
                class="absolute top-5 right-5 w-5 cursor-pointer hover:opacity-80">

            <!-- Title -->
            <h1 class="text-center text-xl font-semibold mb-4 text-black">Add New Category</h1>

            <hr class="text-gray-600 w-full mb-4">

            <!-- Form -->
            <form action="{{ route('admin.inventory.category.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex items-center justify-center flex-wrap">
                    <div class="flex flex-col items-center mt-5">
                        <div class="relative w-[350px] mb-4">
                            <label for="itemName" class="text-sm">Category Name <span class="text-red-500">*</span></label>
                            <input id="itemName"
                                class="mb-1 mt-2 peer w-full h-10 text-gray-600 border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:ring-opacity-70 text-xs"
                                type="text" placeholder="Enter category name" name="category_name">

                            @error('category_name')
                                <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="relative w-[350px] mb-4">
                            <label for="description" class="text-sm">Category Description </label>
                            <textarea id="description"
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
                        Add Category
                    </button>
                </div>
            </form>
        </div>
    </div>


    <!-- Edit Modal -->
    <div id="edit-modal-categories"
        class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50"
        aria-hidden="true">
        <div class="bg-white shadow-md p-8 flex flex-col items-center justify-center rounded-lg h-auto w-auto relative">
            <!-- Close Icon -->
            <img onclick="hideEditDialog()" src="{{ asset('Assets/close.png') }}" alt="Close"
                class="absolute top-5 right-5 w-5 cursor-pointer hover:opacity-80">

            <!-- Title -->
            <h1 class="text-center text-xl font-semibold mb-4 text-black">Edit Category</h1>

            <hr class="text-gray-600 w-full mb-4">

            <!-- Form -->
            <form action="{{ route('admin.inventory.category.update') }}" method="POST" enctype="multipart/form-data">
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
@endsection
