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

    <div class="h-auto py-5 mb-10 bg-white rounded-lg shadow-sm px-7 ">
        <div class="flex items-center justify-between">
            <input type="text" placeholder="Search for category..."
                class="w-64 h-10 p-3 text-sm text-gray-500 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500"
                id="category_search" autocomplete="off" onkeyup="filterCategories()" />

            <!--ADD BUTTON-->
            <button onclick="showAddDialogCategories()"
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
                    <span class="block text-sm sm:inline">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        {{-- ORDERS TABLE --}}
        <div class="flex items-start justify-center w-full rounded-lg my-7">
            <div class="w-full ">
                {{-- <table id="category_table" class="w-full rounded-lg shadow table-auto category_table"> --}}
                <table id="category_table" class="w-full rounded-lg shadow table-auto category_table">
                    <thead class="border-b-2 rounded-lg bg-slate-100">
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
                    <tbody class="text-xs text-center">
                        @foreach ($categories as $index => $category)
                            <tr class="border-b category_row hover:bg-slate-50">
                                <td class="px-5 py-3">
                                    {{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }} </td>
                                <td class="px-5 py-3"> {{ ucfirst($category->category_name) }} </td>
                                <td class="p-3">{{ ucfirst($category->description) }}</td>
                                <td class="px-5 py-3">{{ ucfirst($category->type) }}</td>
                                <td class="px-5 py-3">{{ ucfirst($category->beverage_type) }}</td>
                                <td class="px-5 py-3">{{ $category->products_count }}</td>
                                <td class="flex items-center justify-end px-5 py-3 space-x-2">
                                    <button onclick="showEditDialogCategories(this)" data-id="{{ $category->category_id }}"
                                        data-name="{{ $category->category_name }}"
                                        data-description="{{ $category->description }}" data-image="{{ $category->image }}"
                                        data-type="{{ $category->type }}"
                                        data-beverageType="{{ $category->beverage_type }}"
                                        class="flex text-blue-500 transition duration-300 ease-in-out items-right hover:text-blue-700">
                                        <img src="{{ asset('Assets/Edit.png') }}" alt="Edit Icon" class="mr-5">
                                    </button>
                                    <button onclick="showDeleteDialogCategories({{ $category->category_id }})"
                                        class="flex ml-2 text-red-500 transition duration-300 ease-in-out items-right hover:text-red-700">
                                        <img src="{{ asset('Assets/Delete.png') }}" alt="Delete Icon" class="mr-5">
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- No Categories Found Message -->
                <div id="no-categories-message" class="hidden mt-4 text-center text-red-500">
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


    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // success add modal
            @if (session('status_add'))
                Swal.fire({
                    title: "Success!",
                    text: "{{ session('status_add') }}",
                    icon: "success"
                });
            @endif


            @if (session('status_edit'))
                Swal.fire({
                    title: "Success!",
                    text: "{{ session('status_edit') }}",
                    icon: "success"
                });
            @endif


            @if (session('status_deleted'))
                Swal.fire({
                    title: "Success!",
                    text: "{{ session('status_deleted') }}",
                    icon: "success"
                });
            @endif

            // @if (session('status_add'))
            //     showAddedDialogCategories();
            // @endif


            // @if (session('status_edit'))
            //     showEditedDialogCategories();
            // @endif


            // @if (session('status_deleted'))
            //     showDeletedDialogCategories();
            // @endif

        });
    </script>
@endsection
