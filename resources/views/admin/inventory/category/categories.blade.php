@extends('admin.inventory.index')

@section('inventory_table')
    <div class="flex items-center justify-between mt-5">
        <input type="text" placeholder="Search category..."
            class="p-3 h-10 w-64 focus:outline-none focus:ring-1 focus:ring-blue-500 bg-gray-100 border border-gray-200 text-sm text-gray-500 rounded-lg">

        <!--ADD BUTTON-->
        <button onclick="showAddDialog()"
            class="block text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
            type="button">
            + Add Category
        </button>
    </div>

    {{-- Error Message --}}
    @if (session('error'))
        <div id="error-message" class="flex items-center justify-center">
            <div class="relative px-4 py-2 w-[500px] text-center mt-3 text-red-700 bg-red-100 border border-red-400 rounded"
                role="alert">
                <span class="block sm:inline text-sm">{{ session('error') }}</span>
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
                                    data-name="{{ $category->category_name }}"
                                    data-description="{{ $category->description }}"
                                    class="flex text-blue-500 transition duration-300 ease-in-out items-right hover:text-blue-700">
                                    <img src="{{ asset('Assets/Edit.png') }}" alt="Edit Icon">
                                </button>
                                <button onclick="showDeleteCategoryDialog({{ $category->id }})"
                                    class="flex ml-2 text-red-500 transition duration-300 ease-in-out items-right hover:text-red-700">
                                    <img src="{{ asset('Assets/Delete.png') }}" alt="Delete Icon">
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


    {{-- MODALS --}}
    @include('admin.inventory.category.modals.add-category')
    @include('admin.inventory.category.modals.edit-category')
    @include('admin.inventory.category.modals.confirm-delete')
    @include('admin.inventory.category.modals.delete-category')
    @include('admin.inventory.category.modals.success-add')
    @include('admin.inventory.category.modals.success-delete')
    @include('admin.inventory.category.modals.success-edit')


    <script>
        document.addEventListener('DOMContentLoaded', function() {

            @if (session('status_add'))
                showSuccessAddCategoryModal();
            @endif


            @if (session('status_edit'))
                showSuccessEditCategoryModal();
            @endif


            @if (session('status_deleted'))
                showSuccessDeleteCategoryModal();
            @endif

        });
    </script>
@endsection
