<!-- resources/views/admin/reports.blade.php -->
@extends('layouts.admin-layout')

@section('admin_content')
    <!-- Top Header -->
    <div class="flex items-center justify-between">
        <div class="my-3 mb-7">
            <p class="text-xl font-medium text-gray-700">Staff Management</p>
            <p class="text-sm text-gray-500">A list of all staffs.</p>
        </div>
    </div>

    <div class="bg-white shadow-sm h-auto mb-10 py-5 px-7 rounded-lg ">
        <div class="flex items-center justify-between">
            <input type="text" placeholder="Search staff..." class="p-3 h-10 w-64 focus:outline-none focus:ring-1 focus:ring-blue-500 bg-gray-100 border border-gray-200 text-sm text-gray-500 rounded-lg">

            <!--ADD BUTTON-->
            <button onclick="showAddDialog()" class="bg-green-600 ml-3 text-white px-10 h-10 font-medium text-sm hover:bg-green-700 shadow-sm rounded-full">
                + Add Staff
            </button>
        </div>

        {{-- STAFFS TABLE --}}
        <div class="flex items-start my-7  justify-center rounded-lg w-full">
            <div class="w-full ">
                <table class="w-full shadow rounded-lg table-auto">
                    <thead class="bg-slate-100 border-b-2 rounded-lg">
                        <tr>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">No.</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Name</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Email</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Phone Number</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Address</th>
                            <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max"></th>
                        </tr>
                    </thead>
                    <tbody class="text-center text-xs">
                        @foreach ($staffs as $staff)
                            <tr class="border-b hover:bg-slate-50">
                                <td class="py-3 px-5"> {{ ($staffs->currentPage() - 1) * $staffs->perPage() + $loop->iteration }} </td>
                                <td class="py-3 px-5"> {{ ucfirst($staff->first_name) . ucfirst($staff->last_name) }} </td>
                                <td class="p-3">{{ $staff->email }}</td>
                                <td class="py-3 px-5">{{ $staff->phone_number }}</td>
                                <td class="py-3 px-5">{{ $staff->address }}</td>
                                <td class="flex py-3 px-5 space-x-2 items-center justify-end">
                                    <button onclick="showEditDialog(this)" data-id="{{ $staff->id }}"
                                        class="flex text-blue-500 transition duration-300 ease-in-out items-right hover:text-blue-700">
                                        <img src="{{ asset('Assets/Edit.png') }}" alt="Edit Icon" class="ml-9">
                                    </button>
                                    <button onclick="showDeleteDialog({{ $staff->id }})"
                                        class="flex ml-2 text-red-500 transition duration-300 ease-in-out items-right hover:text-red-700">
                                        <img src="{{ asset('Assets/Delete.png') }}" alt="Delete Icon" class="ml-5 mr-5">
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-5">
                    {{ $staffs->links() }}
                </div>
            </div>
        </div>

    </div>

@endsection
