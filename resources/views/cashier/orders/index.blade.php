@extends('layouts.cashier-layout')

@section('cashier_content')
    <!-- Main Content Area -->
    <div class="flex-1 ml-20 w-full">
        <!-- Header -->
        <header class="mb-4 rounded p-4">
            <div>
                <h1 class="font-barlow text-4xl font-bold">
                    <span class="mr-0">Order</span>
                    <span class="text-amber-700">Tracking</span>
                </h1>
                <p class="font-barlow text-m mt-2">Sunday, October 20, 2024</p>
            </div>
        </header>

        <!--Header Buttons-->
        <div class="flex flex-col items-start ml-10">
            <!-- Buttons -->
            <div class="flex space-x-4">
                <button
                    class="w-[179px] h-[40px] text-center font-regular text-white amber-900 bg-amber-900 border border-amber-900 hover:bg-gray-50 px-4 py-2 rounded-md mr-6 ml-5 hover:text-amber-900">
                    Walk-in
                </button>
                <button
                    class="w-[179px] h-[40px] text-center font-regular text-amber-900 border border-amber-900 hover:bg-gray-300 px-4 py-2 rounded-md hover:text-black">
                    Online order
                </button>
            </div>

            <!-- Tables Container -->
            <div class="flex justify-start mt-10 space-x-6">
                <!-- Dine-in Section -->
                <div>
                    <div class="font-bold text-lg font-barlow">
                        <p class="text-amber-800">Dine-in</p>
                    </div>
                    <div class="w-[800px] h-[318px] bg-white mt-5 rounded-md shadow-md p-4">
                        <table class="table-auto w-[800px] text-left border-collapse">
                            <thead>
                                <tr class="border-b">
                                    <th class="py-2">No.</th>
                                    <th>Order Number</th>
                                    <th>Items</th>
                                    <th>Order Type</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dineInOrders as $dineInOrder)
                                    <tr class="border-b">
                                        <td class="py-2"> {{ $loop->iteration }} </td>
                                        <td>{{ $dineInOrder->order_number }}</td>
                                        <td>
                                            <!-- Concatenate product names for this order -->
                                            @php
                                                $productNames = $dineInOrder->products
                                                    ->map(function ($orderProduct) {
                                                        return $orderProduct->product->product_name;
                                                    })
                                                    ->implode(', ');
                                            @endphp
                                            {{ $productNames }}
                                        </td>
                                        <td>{{ $dineInOrder->order_type }}</td>
                                        <td>
                                            <span
                                                class="px-2 py-1 text-sm font-regular text-orange-900 bg-orange-100 rounded-md">
                                                {{ $dineInOrder->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Take-out Section -->
                <div>
                    <div class="font-bold text-lg font-barlow">
                        <p class="text-amber-800">Take-out</p>
                    </div>
                    <div class="w-[800px] h-[318px] bg-white mt-5 rounded-md shadow-md p-4">
                        <table class="table-auto w-[800px] text-left border-collapse">
                            <thead>
                                <tr class="border-b">
                                    <th class="py-2">No.</th>
                                    <th>Order Number</th>
                                    <th>Items</th>
                                    <th>Order Type</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($takeOutOrders as $takeOutOrder)
                                    <tr class="border-b">
                                        <td class="py-2"> {{ $loop->iteration }} </td>
                                        <td>{{ $takeOutOrder->order_number }}</td>
                                        <td>
                                            <!-- Concatenate product names for this order -->
                                            @php
                                                $productNames = $takeOutOrder->products
                                                    ->map(function ($orderProduct) {
                                                        return $orderProduct->product->product_name;
                                                    })
                                                    ->implode(', ');
                                            @endphp
                                            {{ $productNames }}
                                        </td>
                                        <td>{{ $takeOutOrder->order_type }}</td>
                                        <td>
                                            <span
                                                class="px-2 py-1 text-sm font-regular text-orange-900 bg-orange-100 rounded-md">
                                                {{ $takeOutOrder->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
