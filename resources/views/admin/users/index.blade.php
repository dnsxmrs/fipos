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

    <div class="bg-white shadow-sm h-full mb-10 py-5 px-7 rounded-lg ">
        <div class="flex items-center justify-between">
            <input type="text" placeholder="Search for users..."
                class="p-3 h-10 w-64 focus:outline-none focus:ring-1 focus:ring-blue-500 bg-gray-100 border border-gray-200 text-sm text-gray-500 rounded-lg"
                id="user_search" autocomplete="off" onkeyup="" />

            <!--ADD BUTTON-->
            <button onclick="showAddUserModal()"
                class="block text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                type="button">
                + Add User
            </button>
        </div>


        {{-- Success Message --}}
        @if (session('success'))
            <div id="success-message" class="flex items-center justify-center">
                <div class="relative px-4 py-2 w-[500px] text-center mt-3 text-green-700 bg-green-100 border border-green-400 rounded"
                    role="alert">
                    <span class="block sm:inline text-sm">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        {{-- Error Message --}}
        @if (session('error'))
            <div id="error-message" class="flex items-center justify-center">
                <div class="relative px-4 py-2 w-[500px] text-center mt-3 text-red-700 bg-red-100 border border-red-400 rounded"
                    role="alert">
                    <span class="block sm:inline text-sm">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        {{-- USERS TABLE --}}
        <div class="flex items-start my-7  justify-center rounded-lg w-full">
            <div class="w-full h-auto">
                <table id="user_table" class="user_table w-full shadow rounded-lg table-auto">
                    <thead class="bg-slate-100 border-b-2 rounded-lg">
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
                    <tbody class="text-center text-xs">
                        @foreach ($users as $user)
                            <tr class="user_row border-b hover:bg-slate-50">
                                <td class="py-3 px-5">
                                    {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }} </td>
                                <td class="py-3 px-5"> {{ ucfirst($user->first_name) }} </td>
                                <td class="py-3 px-5">{{ ucfirst($user->last_name) }}</td>
                                <td class="py-3 px-5">{{ $user->email }}</td>
                                <td class="py-3 px-5">{{ ucfirst($user->role) }}</td>
                                <td class="py-3 px-5">
                                    <span
                                        class="text-xs {{ $user->is_activated ? 'text-green-500' : 'text-red-500' }} rounded-md px-2 py-1"
                                        style="background-color: {{ $user->is_activated ? '#DCF8F0' : '#FFDFDF' }}">
                                        {{ $user->is_activated ? 'Active' : 'Deactivated' }}
                                    </span>
                                </td>
                                <td class="flex py-3 px-5 space-x-2 items-center justify-end">
                                    <button onclick="showEditUserModal(this)" data-id="{{ $user->id }}"
                                        data-lastName="{{ $user->last_name }}" data-firstName="{{ $user->first_name }}"
                                        data-email="{{ $user->email }}" data-role="{{ $user->role }}"
                                        class="flex text-blue-500 transition duration-300 ease-in-out items-right hover:text-blue-700">
                                        <img src="{{ asset('Assets/Edit.png') }}" alt="Edit Icon">
                                    </button>
                                    <button onclick=""
                                        class="flex ml-2 text-red-500 transition duration-300 ease-in-out items-right hover:text-red-700">
                                        <img src="{{ asset('Assets/Delete.png') }}" alt="Delete Icon">
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- No Users Found Message -->
                <div id="no-users-message" class="hidden text-center text-red-500 mt-4">
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
    @include('admin.users.modals.deactivate-user')
    @include('admin.users.modals.edit-user')
@endsection
