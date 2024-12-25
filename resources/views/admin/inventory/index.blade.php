<!-- resources/views/admin/reports.blade.php -->
@extends('layouts.admin-layout')

@section('admin_content')
    <!-- Top Header -->
    <div class="flex items-center justify-between">
        <div class="my-3 mb-7">
            <p class="text-xl font-medium text-gray-700">Inventory</p>
        </div>
    </div>

    <div class="bg-white shadow-sm h-auto mb-10 py-5 px-7 rounded-lg ">

        {{-- NAVIGATION --}}
        <div class="flex w-full border-b border-b-gray-300 pb-3 space-x-1">
            <a class="text-center text-sm w-32 p-2 rounded-t-md text-gray-900 hover:border-b-4 hover:rounded-t-md  hover:bg-amber-900 hover:bg-opacity-30 border-b-amber-800
        {{ request()->routeIs('admin.inventory.show') ? 'bg-amber-900 bg-opacity-25 border-b-4 border-b-amber-800' : 'hover:bg-amber-900 hover:bg-opacity-25' }}"
                href="{{ route('admin.inventory.show') }}">
                Items
            </a>
            <a class="text-center text-sm w-32 p-2 rounded-t-md text-gray-900 hover:border-b-4 hover:rounded-t-md  hover:bg-amber-900 hover:bg-opacity-30 border-b-amber-800
        {{ request()->routeIs('admin.inventory.categories') ? 'bg-amber-900 bg-opacity-25 border-b-4 border-b-amber-800' : 'hover:bg-amber-900 hover:bg-opacity-25' }}"
                href="{{ route('admin.inventory.categories') }}">
                Category
            </a>
        </div>

        @yield('inventory_table')

    </div>
@endsection
