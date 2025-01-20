<!-- resources/views/admin/reports.blade.php -->
@extends('layouts.admin-layout')

@section('admin_content')
    <!-- Top Header -->
    <div class="flex items-center justify-between">
        <div class="my-3 mb-7">
            <p class="text-xl font-medium text-gray-700">Categories</p>
            <p class="text-sm text-gray-500">A list of all categories of products.</p>
        </div>
    </div>

    <div class="bg-white shadow-sm h-auto mb-10 py-5 px-7 rounded-lg ">
        <div class="flex items-center justify-between">
            <form autocomplete="off">
            <input type="text" placeholder="Search for category..."
                class="p-3 h-10 w-64 focus:outline-none focus:ring-1 focus:ring-blue-500 bg-gray-100 border border-gray-200 text-sm text-gray-500 rounded-lg"
                id="category_search" autocomplete="off" onkeyup="filterCategories()" />
            </form>
            <!--ADD BUTTON-->
            <button onclick="showAddDialogCategories()"
                class="block text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                type="button">
                + Add Category
            </button>
        </div>

        {{-- ORDERS TABLE --}}
        <div class="flex items-start my-7  justify-center rounded-lg w-full">
            <div class="w-full ">
                {{-- <table id="category_table" class="category_table w-full shadow rounded-lg table-auto"> --}}
                <table id="category_table" class="category_table w-full shadow rounded-lg table-auto">
                    <thead class="bg-slate-100 border-b-2 rounded-lg">
                        <tr>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">No.</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Category Name</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Description</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Type</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Beverage Type</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Total Products</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max"></th>
                        </tr>
                    </thead>
                    <tbody class="text-center text-xs">
                        @foreach ($categories as $index => $category)
                            <tr class="category_row border-b hover:bg-slate-50">
                                <td class="py-3 px-5">
                                    {{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }} </td>
                                <td class="py-3 px-5"> {{ ucfirst($category->category_name) }} </td>
                                <td class="p-3">{{ ucfirst($category->description) }}</td>
                                <td class="py-3 px-5">{{ ucfirst($category->type) }}</td>
                                <td class="py-3 px-5">{{ ucfirst($category->beverage_type) }}</td>
                                <td class="py-3 px-5">{{ $category->products_count }}</td>
                                <td class="flex py-3 px-5 space-x-2 items-center justify-end">
                                    <button onclick="showEditDialogCategories(this)" data-id="{{ $category->category_id }}"
                                        data-name="{{ $category->category_name }}"
                                        data-description="{{ $category->description }}" data-image="{{ $category->image }}"
                                        date-type="{{ $category->type }}"
                                        data-beverageType="{{ $category->beverage_type }}"
                                        class="flex text-blue-500 transition duration-300 ease-in-out items-right hover:text-blue-700">
                                        <img src="{{ asset('Assets/Edit.png') }}" alt="Edit Icon" class="ml-9">
                                    </button>
                                    <button onclick="showDeleteDialogCategories({{ $category->category_id }})"
                                        class="flex ml-2 text-red-500 transition duration-300 ease-in-out items-right hover:text-red-700">
                                        <img src="{{ asset('Assets/Delete.png') }}" alt="Delete Icon" class="ml-5 mr-5">
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- No Categories Found Message -->
                <div id="no-categories-message" class="hidden text-center text-red-500 mt-4">
                    No categories found matching your search criteria.
                </div>

                <div class="mt-5">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>


    <!-- INCLUDE MODALS -->
    @include('admin.menu.modals.category.add-category')
    @include('admin.menu.modals.category.confirm-delete')
    @include('admin.menu.modals.category.delete-category')
    @include('admin.menu.modals.category.edit-category')
    @include('admin.menu.modals.category.success-add')
    @include('admin.menu.modals.category.success-delete')
    @include('admin.menu.modals.category.success-edit')

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // success add modal
            @if (session('status_add'))
                showAddedDialogCategories();
            @endif


            @if (session('status_edit'))
                showEditedDialogCategories();
            @endif


            @if (session('status_deleted'))
                showDeletedDialogCategories();
            @endif

        });
    </script>
@endsection
