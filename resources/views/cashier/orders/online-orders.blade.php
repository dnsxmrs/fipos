@extends('layouts.cashier-layout')

@section('cashier_content')
    <!-- Header -->
    <div class="my-5">
        <p class="text-xl font-medium text-gray-700">Online Orders</p>
        <p class="text-sm text-gray-500">List of online orders from website.</p>
    </div>

    {{-- ORDERS TABLE --}}
    <div class="flex items-start justify-center p-5 h-screen bg-white rounded-lg w-full">
        <div class="w-full ">
            <table class="w-full shadow rounded-lg table-fixed">
                <thead class="bg-slate-100 border-b-2 rounded-lg">
                    <tr>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center w-[10%] min-w-max">No.</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center w-[10%] min-w-max">Order Number</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center w-[50%] min-w-max">Items Ordered</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center w-[10%] min-w-max">Order Type</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center w-[10%] min-w-max">Total Amount</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center w-[10%] min-w-max">Status</th>
                    </tr>
                </thead>
                <tbody class="text-center text-xs">

                </tbody>
            </table>
        </div>
    </div>
@endsection
