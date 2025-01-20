<!-- resources/views/admin/reports.blade.php -->
@extends('layouts.admin-layout')

@section('admin_content')
    <!-- Top Header -->
    <div class="flex items-center justify-between">
        <div class="my-3 mb-7">
            <p class="text-xl font-medium text-gray-700">Audit logs</p>
            <p class="text-sm text-gray-500">Records of activities within the system</p>
        </div>
    </div>

    <div class="bg-white shadow-sm h-auto mb-10 py-5 px-7 rounded-lg ">
        <div class="flex items-center justify-between">
            <form autocomplete="off">
                <input type="text" placeholder="Search for category..."
                    class="p-3 h-10 w-64 focus:outline-none focus:ring-1 focus:ring-blue-500 bg-gray-100 border border-gray-200 text-sm text-gray-500 rounded-lg"
                    id="category_search" onkeyup="filterCategories()" />
            </form>
        </div>

        {{-- ORDERS TABLE --}}
        <div class="flex items-start my-7  justify-center rounded-lg w-full">
            <div class="w-full ">
                {{-- <table id="category_table" class="category_table w-full shadow rounded-lg table-auto"> --}}
                <table id="category_table" class="category_table w-full shadow rounded-lg table-auto">
                    <thead class="bg-slate-100 border-b-2 rounded-lg">
                        <tr>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Log date</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Generated</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">User Role</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Activity Scope</th>
                        </tr>
                    </thead>

                </table>
                <!-- No Categories Found Message -->
                <div id="no-categories-message" class="hidden text-center text-red-500 mt-4">
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
