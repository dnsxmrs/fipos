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
                    id="category_search" />
            </form>

            <!-- Export Csv button -->
            <a href="{{ route('admin.audit-trails.export') }}"
                class="block text-white bg-yellow-600 hover:bg-yellow-700 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                <i class="fa-solid fa-download mr-2"></i>
                Export CSV
            </a>
        </div>

        {{-- ORDERS TABLE --}}
        <div class="flex items-start my-7  justify-center rounded-lg w-full">
            <div class="w-full ">
                {{-- <table id="category_table" class="category_table w-full shadow rounded-lg table-auto"> --}}
                <table id="category_table" class="category_table w-full shadow rounded-lg table-auto">
                    <thead class="bg-slate-100 border-b-2 rounded-lg">
                        <tr>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Log date</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Log Name</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Action</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Performed by</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($audit_trails as $audit_trail)
                            <tr class="text-center border-b border-gray-200">
                                <td class="p-3 text-sm">{{ $audit_trail->created_at->format('Y-m-d H:i:s') }}</td>
                                <td class="p-3 text-sm">{{ $audit_trail->log_name }}</td>
                                <td class="p-3 text-sm">{{ $audit_trail->description }}</td>
                                <td class="p-3 text-sm">{{ $audit_trail->user_name }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                <!-- No Categories Found Message -->
                <div id="no-audit-message" class="hidden text-center text-red-500 mt-4">
                    No record found matching your search criteria.
                </div>

                <div class="mt-5">
                    {{ $audit_trails->links() }}
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
