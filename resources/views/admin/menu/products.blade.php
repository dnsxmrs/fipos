<!-- resources/views/admin/reports.blade.php -->
@extends('layouts.admin-layout')

@section('admin_content')
    <!-- Top Header -->
    <div class="flex items-center justify-between">
        <div class="my-3 mb-7">
            <p class="text-xl font-medium text-gray-700">Products</p>
            <p class="text-sm text-gray-500">A list of all products that the restaurant offers.</p>
        </div>
    </div>

    <div class="bg-white shadow-sm h-auto mb-10 py-5 px-7 rounded-lg ">
        <div class="flex items-center justify-between">
            <input type="text" placeholder="Search products..."
                class="p-3 h-10 w-64 focus:outline-none focus:ring-1 focus:ring-blue-500 bg-gray-100 border border-gray-200 text-sm text-gray-500 rounded-lg"
                name="product_search" id="product_search" autocomplete="off" onkeyup="filterProducts()" />

            <!--ADD BUTTON-->
            <button onclick="showAddDialogProducts()"
                class="block text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                type="button">
                + Add Product
            </button>
        </div>

        {{-- ORDERS TABLE --}}
        <div class="flex items-start my-7  justify-center rounded-lg w-full">
            <div class="w-full ">

                <table id="products_table" class="products_table w-full shadow rounded-lg table-auto mb-5">
                    <thead class="bg-slate-100 border-b-2 rounded-lg">
                        <tr>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">No.</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Product Name</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Description</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Category</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Price</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Status</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max"></th>
                        </tr>
                    </thead>
                    <tbody class="text-center text-xs">
                        @foreach ($products as $index => $product)
                            <tr class="product_row border-b hover:bg-slate-50">
                                <td class="py-3 px-5">
                                    {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }} </td>
                                <td class="py-3 px-5"> {{ ucfirst($product->product_name) }} </td>
                                <td class="py-3 px-5"> {{ ucfirst($product->product_description) }} </td>
                                <td class="p-3">{{ $product->category ? $product->category->category_name : 'N/A' }}</td>
                                <td class="py-3 px-5">{{ $product->product_price }}</td>
                                <td class="py-3 px-5">
                                    <span
                                        class="text-xs {{ $product->isAvailable ? 'text-green-500' : 'text-red-500' }} rounded-md px-2 py-1"
                                        style="background-color: {{ $product->isAvailable ? '#DCF8F0' : '#FFDFDF' }}">
                                        {{ $product->isAvailable ? 'Available' : 'Not Available' }}
                                    </span>
                                </td>
                                <td class="flex py-3 px-5 space-x-2 items-center justify-end">
                                    <button onclick="showEditDialogProducts(this)"
                                        class="flex items-center text-blue-500 hover:text-blue-700 transition duration-300 ease-in-out"
                                        data-id="{{ $product->id }}" data-name="{{ $product->product_name }}"
                                        data-description="{{ $product->product_description }}"
                                        data-price="{{ $product->product_price }}"
                                        data-category="{{ $product->category_id }}"
                                        data-availability="{{ $product->isAvailable ? '1' : '0' }}"
                                        data-image="{{ $product->image }}">
                                        <img src="{{ asset('Assets/Edit.png') }}" alt="Edit Icon" class="mr-2 ml-2">
                                    </button>
                                    <button onclick="showDeleteDialogProducts({{ $product->id }})"
                                        class="flex items-center text-red-500 hover:text-red-700 ml-2 transition duration-300 ease-in-out">
                                        <img src="{{ asset('Assets/Delete.png') }}" alt="Delete Icon" class="mr-2 ml-2">
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- No Products Found Message -->
                <div id="no-products-message" class="hidden text-center text-red-500 mt-4">
                    No products found matching your search criteria.
                </div>

                <div class="mt-5">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>


    <!-- INCLUDE MODALS -->
    @include('admin.menu.modals.product.add-product')
    @include('admin.menu.modals.product.confirm-delete')
    @include('admin.menu.modals.product.delete-product')
    @include('admin.menu.modals.product.edit-product')
    @include('admin.menu.modals.product.success-add')
    @include('admin.menu.modals.product.success-delete')
    @include('admin.menu.modals.product.success-edit')


    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // success add modal
            @if (session('status_add'))
                handleSaveChangesProducts();
            @endif


            @if (session('status_edit'))
                showItemUpdatedDialogProducts();
            @endif


            @if (session('status_deleted'))
                showSuccessMessage();
            @endif

        });
    </script>
@endsection
