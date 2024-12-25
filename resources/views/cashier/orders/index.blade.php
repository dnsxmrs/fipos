@extends('layouts.cashier-layout')

@section('cashier_content')
    <!-- Header -->
    <div class="my-5">
        <p class="text-xl font-medium text-gray-700">Order Tracking</p>
        <p class="text-sm text-gray-500">A list of all orders.</p>
    </div>

    <div class="bg-white shadow-sm h-screen mb-10 px-5 rounded-lg">

        <div class="flex flex-col items-start justify-center">
            <div class="flex items-center justify-between w-full px-3 flex-wrap">
                <input type="text" placeholder="Search orders" class="p-3 mt-2 h-10 w-52 focus:outline-none focus:ring-1 focus:ring-blue-500 bg-gray-100 border border-gray-200 text-sm text-gray-500 rounded-lg">
                <!-- Buttons -->
                <div class="flex flex-wrap items-center justify-start space-x-2 my-5" id="orderButtons">
                    <a id="all-orders" href="{{ route('orders.show') }}" onclick="activeButton('all-orders', event)"
                        class="order-button text-sm h-10 ml-3 text-center mt-2 font-normal text-orange-600 {{ request()->is('orders') ? ' text-orange-600' : 'bg-white text-orange-600' }} border border-orange-300 px-4 py-2 rounded-full hover:bg-orange-100">
                        All Orders
                    </a>
                    <a id="dine-in" href="{{ route('orders.dine-in') }}" onclick="activeButton('dine-in', event)"
                        class="order-button text-sm h-10 ml-3 text-center mt-2 font-normal text-orange-600 {{ request()->is('orders/dine-in') ? 'bg-orange-200 text-orange-600' : 'bg-white text-orange-600' }} border border-orange-300 px-4 py-2 rounded-full hover:bg-orange-100">
                        Dine In
                    </a>
                    <a id="take-out" href="{{ route('orders.take-out') }}" onclick="activeButton('take-out', event)"
                        class="order-button text-sm h-10 ml-3 text-center mt-2 font-normal text-orange-600 {{ request()->is('orders/take-out') ? 'bg-orange-200 text-orange-600' : 'bg-white text-orange-600' }} border border-orange-300 px-4 py-2 rounded-full hover:bg-orange-100">
                        Take Out
                    </a>
                </div>
            </div>

            {{-- ORDERS TABLE --}}
            <div class="flex items-center justify-center px-3 h-full rounded-lg w-full">
                <div class="w-full ">
                    @yield('orders_table')
                </div>
            </div>
        </div>
    </div>
@endsection
