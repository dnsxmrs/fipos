<!-- resources/views/admin/reports.blade.php -->
@extends('layouts.admin-layout')

@section('admin_content')
    <!-- Top Header -->
    <div class="flex items-center justify-between">
        <div class="my-3 mb-7">
            <p class="text-xl font-medium text-gray-700">Users</p>
            <p class="text-sm text-gray-500">A list of all registered users of this system.</p>
        </div>
    </div>

    <div class="h-full py-5 mb-10 bg-white rounded-lg shadow-sm px-7 ">
        <div class="flex items-center justify-between">
            <input type="text" placeholder="Search for users..."
                class="w-64 h-10 p-3 text-sm text-gray-500 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500"
                id="user_search" autocomplete="off" onkeyup="" />

            <!--ADD BUTTON-->
            <button onclick="showAddUserModal()"
                class="block text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                type="button">
                + Add User
            </button>
        </div>

        {{-- USERS TABLE --}}
        <div class="flex items-start justify-center w-full rounded-lg my-7">
            <div class="w-full h-auto">
                <table id="user_table" class="w-full rounded-lg shadow table-auto user_table">
                    <thead class="border-b-2 rounded-lg bg-slate-100">
                        <tr>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">No.</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">First Name</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Last Name</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Email</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Role</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Status</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max"></th>
                        </tr>
                    </thead>
                    <tbody class="text-xs text-center">
                        @foreach ($users as $user)
                            <tr class="border-b user_row hover:bg-slate-50">
                                <td class="px-5 py-3">
                                    {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }} </td>
                                <td class="px-5 py-3"> {{ ucfirst($user->first_name) }} </td>
                                <td class="px-5 py-3">{{ ucfirst($user->last_name) }}</td>
                                <td class="px-5 py-3">{{ $user->email }}</td>
                                <td class="px-5 py-3">{{ ucfirst($user->role) }}</td>
                                <td class="px-5 py-3">
                                    <span
                                        class="text-xs {{ $user->status === 'active' ? 'text-green-500' : 'text-red-500' }} rounded-md px-2 py-1"
                                        style="background-color: {{ $user->status === 'active' ? '#DCF8F0' : '#FFDFDF' }};">
                                        {{ ucfirst($user->status) }}
                                    </span>
                                </td>
                                <td class="flex items-center justify-end px-5 py-3 space-x-2">
                                    <button onclick="showEditUserModal(this)" data-id="{{ $user->id }}"
                                        data-lastName="{{ $user->last_name }}" data-firstName="{{ $user->first_name }}"
                                        data-email="{{ $user->email }}" data-role="{{ $user->role }}" data-status="{{ $user->status }}"
                                        class="flex text-blue-500 transition duration-300 ease-in-out items-right hover:text-blue-700">
                                        <img src="{{ asset('Assets/Edit.png') }}" alt="Edit Icon" class="h-9"> <!-- Fixed icon size -->
                                    </button>
                                    <button onclick="showDeleteDialogUsers({{ $user->id }})"
                                        class="flex ml-2 text-red-500 transition duration-300 ease-in-out items-right hover:text-red-700">
                                        <img src="{{ asset('Assets/Delete.png') }}" alt="Delete Icon" class="h-9 w-9"> <!-- Fixed icon size -->
                                    </button>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- No Users Found Message -->
                <div id="no-users-message" class="hidden mt-4 text-center text-red-500">
                    No users found matching your search criteria.
                </div>

                <div class="mt-5">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>


    <!-- INCLUDE MODALS -->
    @include('admin.users.modals.add-user')
    @include('admin.users.modals.delete-user')
    @include('admin.users.modals.edit-user')
    @include('admin.users.modals.confirm-delete')


    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // error Message
            @if (session('error'))
                Swal.fire({
                    title: "Error!",
                    text: "{{ session('error') }}",
                    icon: "error"
                });
            @endif

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

            @if (session('status_deactivated'))
                Swal.fire({
                    title: "Success!",
                    text: "{{ session('status_deactivated') }}",
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
