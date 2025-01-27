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

    <div class="h-auto py-5 mb-10 bg-white rounded-lg shadow-sm px-7 ">
        <div class="flex items-center justify-between">
            <form autocomplete="off">
                <input type="text" placeholder="Search products..."
                    class="w-64 h-10 p-3 text-sm text-gray-500 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500"
                    name="product_search" id="product_search" autocomplete="off" onkeyup="filterProducts()" />
            </form>
            <div class="flex space-x-2">
                <!-- Export Csv button -->
                <a href="{{ route('admin.menu.products.export') }}"
                    class="block text-white bg-yellow-600 hover:bg-yellow-700 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <i class="fa-solid fa-download mr-2"></i>
                    Export CSV
                </a>
                <!--ADD BUTTON-->
                <button onclick="showAddDialogProducts()"
                    class="block text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                    type="button">
                    + Add Product
                </button>
            </div>

        </div>

        {{-- ORDERS TABLE --}}
        <div class="flex items-start justify-center w-full rounded-lg my-7">
            <div class="w-full ">

                <table id="products_table" class="w-full mb-5 rounded-lg shadow table-auto products_table">
                    <thead class="border-b-2 rounded-lg bg-slate-100">
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
                    <tbody class="text-xs text-center">
                        @foreach ($products as $index => $product)
                            <tr class="border-b product_row hover:bg-slate-50">
                                <td class="px-5 py-3">
                                    {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }} </td>
                                <td class="px-5 py-3"> {{ ucfirst($product->product_name) }} </td>
                                <td class="px-5 py-3"> {{ ucfirst($product->product_description) }} </td>
                                <td class="p-3">{{ $product->category ? $product->category->category_name : 'N/A' }}</td>
                                <td class="px-5 py-3">{{ $product->product_price }}</td>
                                <td class="px-5 py-3">
                                    <span
                                        class="text-xs {{ $product->isAvailable ? 'text-green-500' : 'text-red-500' }} rounded-md px-2 py-1"
                                        style="background-color: {{ $product->isAvailable ? '#DCF8F0' : '#FFDFDF' }}">
                                        {{ $product->isAvailable ? 'Available' : 'Not Available' }}
                                    </span>
                                </td>
                                <td class="flex items-center justify-end px-5 py-3 space-x-2">
                                    <button onclick="showEditDialogProducts(this)"
                                        class="flex items-center text-blue-500 transition duration-300 ease-in-out hover:text-blue-700"
                                        data-id="{{ $product->id }}" data-name="{{ $product->product_name }}"
                                        data-description="{{ $product->product_description }}"
                                        data-price="{{ $product->product_price }}"
                                        data-category="{{ $product->category_id }}"
                                        data-availability="{{ $product->isAvailable ? '1' : '0' }}"
                                        data-image="{{ $product->image }}">
                                        <img src="{{ asset('Assets/Edit.png') }}" alt="Edit Icon" class="ml-2 mr-2">
                                    </button>
                                    <button onclick="showDeleteDialogProducts({{ $product->id }})"
                                        class="flex items-center ml-2 text-red-500 transition duration-300 ease-in-out hover:text-red-700">
                                        <img src="{{ asset('Assets/Delete.png') }}" alt="Delete Icon" class="ml-2 mr-2">
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- No Products Found Message -->
                <div id="no-products-message" class="hidden mt-4 text-center text-red-500">
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



    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // success add modal
            @if (session('status_add'))
                Swal.fire({
                    title: "Success!",
                    text: "{{ session('status_add') }}",
                    icon: "success"
                });
                // handleSaveChangesProducts();
            @endif


            @if (session('status_edit'))
                Swal.fire({
                    title: "Success!",
                    text: "{{ session('status_edit') }}",
                    icon: "success"
                });
                // showItemUpdatedDialogProducts();
            @endif


            @if (session('status_deleted'))
                Swal.fire({
                    title: "Success!",
                    text: "{{ session('status_deleted') }}",
                    icon: "success"
                });
                // showSuccessMessage();
            @endif

        });
    </script>
@endsection
