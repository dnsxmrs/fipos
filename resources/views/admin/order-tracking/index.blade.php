@extends('layouts.admin-layout')

@section('admin_content')
    <!-- Top Header -->
    <div class="flex items-center justify-between">
        <div class="my-3 mb-7">
            <p class="text-xl font-medium text-gray-700">Order Tracking</p>
        </div>
    </div>

    <div class="bg-white shadow-sm h-full mb-10 py-5 px-7 rounded-lg ">

        {{-- NAVIGATION --}}
        <div class="flex w-full border-b border-b-gray-300 pb-3 space-x-2 mb-4 flex-wrap">
            <a class="text-center text-sm w-32 p-2 rounded-t-md text-gray-900 hover:border-b-4 hover:rounded-t-md  hover:bg-amber-900 hover:bg-opacity-30 border-b-amber-800
                {{ Route::is('admin.orders.all') ? 'bg-amber-900 bg-opacity-25 border-b-4 border-b-amber-800' : 'hover:bg-amber-900 hover:bg-opacity-25' }}"
                href="{{ route('admin.orders.all') }}">
                All orders
            </a>
            <a class="text-center text-sm w-32 p-2 rounded-t-md text-gray-900 hover:border-b-4 hover:rounded-t-md  hover:bg-amber-900 hover:bg-opacity-30 border-b-amber-800
                {{ Route::is('admin.orders.walk-in') ? 'bg-amber-900 bg-opacity-25 border-b-4 border-b-amber-800' : 'hover:bg-amber-900 hover:bg-opacity-25' }}"
                href="{{ route('admin.orders.walk-in') }}">
                Walk-in Orders
            </a>
            <a class="text-center text-sm w-32 p-2 rounded-t-md text-gray-900 hover:border-b-4 hover:rounded-t-md  hover:bg-amber-900 hover:bg-opacity-30 border-b-amber-800
                {{ Route::is('admin.orders.online-orders') ? 'bg-amber-900 bg-opacity-25 border-b-4 border-b-amber-800' : 'hover:bg-amber-900 hover:bg-opacity-25' }}"
                href="{{ route('admin.orders.online-orders') }}">
                Online Orders
            </a>
        </div>

        @yield('order_table')

    </div>
@endsection
