<!-- resources/views/admin/reports.blade.php -->
@extends('layouts.admin-layout')

@section('admin_content')
    <div class="flex flex-col block min-h-screen ml-16 lg:ml-64"> <!-- Added left margin for responsive sidebar space -->

        <!-- Right Panel -->
        <div class="p-6 right-panel"> <!-- Added padding for spacing -->
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h1 class="text-xl font-bold">Staff Management</h1>
                <a href="{{ route('admin.add.user') }}" class="px-4 py-2 text-white transition bg-green-500 rounded-md hover:bg-green-600">+ Add User</a>
            </div>

            <!-- Staff Management Table Container -->
            <div class="mt-6 overflow-hidden bg-white rounded-lg shadow-lg w-[1300px]">
                <!-- Container for the table -->
                <div class="p-4 overflow-x-auto">
                    <table class="min-w-full border-collapse table-auto">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-4 text-lg font-semibold text-left border">Name</th>
                                <th class="px-6 py-4 text-lg font-semibold text-left border">Email</th>
                                <th class="px-6 py-4 text-lg font-semibold text-left border">Role</th>
                                <th class="px-6 py-4 text-lg font-semibold text-left border">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm border">{{ ucfirst($user->first_name) . ' ' . ucfirst($user->last_name) }}</td>
                                    <td class="px-6 py-4 text-sm border">{{ $user->email }}</td>
                                    <td class="px-6 py-4 text-sm border">{{ ucfirst($user->role) }}</td>
                                    <td class="px-6 py-4 text-sm border">
                                        <span class="text-blue-600 cursor-pointer icon-edit hover:text-blue-800" title="Edit User">&#9998;</span>
                                        <span class="ml-4 text-red-600 cursor-pointer icon-delete hover:text-red-800" title="Delete User">&#10060;</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
