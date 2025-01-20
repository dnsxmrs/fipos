<!-- resources/views/admin/reports.blade.php -->
@extends('layouts.admin-layout')

@section('admin_content')
    <!-- Top Header -->
    <div class="flex items-center justify-between">
        <div class="my-3 mb-7">
            <p class="text-xl font-medium text-gray-700">Invoice</p>
            <p class="text-sm text-gray-500">Receipts and record for payments</p>
        </div>
    </div>

    <div class="h-auto py-5 mb-10 bg-white rounded-lg shadow-sm px-7 ">
        <div class="flex items-center justify-between">
            <form autocomplete="off">
                <input type="text" placeholder="Search for category..."
                    class="w-64 h-10 p-3 text-sm text-gray-500 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500"
                    id="category_search" onkeyup="filterCategories()" />
            </form>
        </div>

        {{-- ORDERS TABLE --}}
        <div class="flex items-start justify-center w-full rounded-lg my-7">
            <div class="w-full ">
                {{-- <table id="category_table" class="w-full rounded-lg shadow table-auto category_table"> --}}
                <table id="category_table" class="w-full rounded-lg shadow table-auto category_table">
                    <thead class="border-b-2 rounded-lg bg-slate-100">
                        <tr>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Reference</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Customer</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">User</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Date </th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Total</th>
                        </tr>
                    </thead>

                </table>
                <!-- No Categories Found Message -->
                <div id="no-categories-message" class="hidden mt-4 text-center text-red-500">
                    No record found matching your search criteria.
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
