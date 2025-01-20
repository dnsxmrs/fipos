@extends('layouts.cashier-layout')

@section('cashier_content')
    <!-- Header -->
    <div class="my-5">
        <p class="text-xl font-medium text-gray-700">Order Tracking</p>
        <p class="text-sm text-gray-500">A list of all orders.</p>
    </div>

    <div class="h-screen px-5 mb-10 bg-white rounded-lg shadow-sm">

        <div class="flex flex-col items-start justify-center">
            <div class="flex flex-wrap items-center justify-between w-full px-3">
                <input type="text" placeholder="Search orders" class="h-10 p-3 mt-2 text-sm text-gray-500 bg-gray-100 border border-gray-200 rounded-lg w-52 focus:outline-none focus:ring-1 focus:ring-blue-500">
                <!-- Buttons -->
                <div class="flex flex-wrap items-center justify-start my-5 space-x-2" id="orderButtons">
                    <a id="all-orders" href="{{ route('orders.show') }}"
                        class="order-button text-sm h-10 ml-3 text-center mt-2 font-normal {{ Route::is('orders.show') ? ' text-orange-600 bg-orange-100' : 'bg-white text-orange-600 hover:bg-orange-100'  }} border border-orange-300 px-4 py-2 rounded-full ">
                        All Orders
                    </a>
                    <a id="dine-in" href="{{ route('orders.dine-in') }}"
                        class="order-button text-sm h-10 ml-3 text-center mt-2 font-normal {{ Route::is('orders.dine-in') ? ' text-orange-600 bg-orange-100' : 'bg-white text-orange-600 hover:bg-orange-100'  }} border border-orange-300 px-4 py-2 rounded-full ">
                        Dine In
                    </a>
                    <a id="take-out" href="{{ route('orders.take-out') }}"
                        class="order-button text-sm h-10 ml-3 text-center mt-2 font-normal {{ Route::is('orders.take-out') ? ' text-orange-600 bg-orange-100' : 'bg-white text-orange-600 hover:bg-orange-100'  }} border border-orange-300 px-4 py-2 rounded-full ">
                        Take Out
                    </a>
                </div>
            </div>

            {{-- ORDERS TABLE --}}
            <div class="flex items-center justify-center w-full h-full px-3 rounded-lg">
                <div class="w-full ">
                    @yield('orders_table')
                </div>
            </div>
        </div>
    </div>
@endsection
