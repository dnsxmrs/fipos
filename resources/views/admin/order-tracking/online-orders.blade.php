@extends('admin.order-tracking.index')

@section('order_table')
    <!-- Header -->
    <div class="my-5">
        <p class="text-xl font-medium text-gray-700">Online Orders</p>
        <p class="text-sm text-gray-500">List of online orders from website.</p>
    </div>

    {{-- ORDERS TABLE --}}
    <div class="flex items-start justify-center p-5 h-screen bg-white rounded-lg w-full">
        <div class="w-full mb-2">
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
                    @if ($ordersPaginated && $ordersPaginated->isNotEmpty())
                        @foreach ($ordersPaginated as $onlineOrder)
                            <tr class="border-b hover:bg-slate-50">
                                <td class="py-3 px-5"> {{ $loop->iteration }} </td>
                                <td class="p-3">{{ $onlineOrder['order_number'] }}</td>
                                <td class="py-3 px-5">
                                    @php
                                        $productNames = collect($onlineOrder['order_products'])->map(function($product) {
                                            return $product['product_id']; // Replace with 'product_name' if available
                                        })->implode(', ');
                                    @endphp
                                    {{ $productNames }}
                                </td>
                                <td class="py-3 px-5">{{ ucfirst($onlineOrder['order_type']) }}</td>
                                <td class="py-3 px-5">₱{{ number_format($onlineOrder['total'], 2) }}</td>
                                <td class="py-3 px-5">
                                    @if ($onlineOrder['status'] == 'pending')
                                        <span class="text-yellow-500">{{ ucfirst($onlineOrder['status']) }}</span>
                                    @elseif ($onlineOrder['status'] == 'completed')
                                        <span class="text-green-500">{{ ucfirst($onlineOrder['status']) }}</span>
                                    @else
                                        <span class="text-red-500">{{ ucfirst($onlineOrder['status']) }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="py-3 px-5 text-center" colspan="6">No online orders found.</td>
                        </tr>
                    @endif
                    {{-- @if (!empty($ordersData) && count($ordersData) > 0)
                        @foreach ($ordersData as $onlineOrder)
                            <tr class="border-b hover:bg-slate-50">
                                <td class="py-3 px-5"> {{ $loop->iteration }} </td>
                                <td class="p-3">{{ $onlineOrder['order_number'] }}</td>
                                <td class="py-3 px-5">
                                    @php
                                        $productNames = collect($onlineOrder['order_products'])->map(function($product) {
                                            return $product['product_id']; // Replace with 'product_name' if available
                                        })->implode(', ');
                                    @endphp
                                    {{ $productNames }}
                                </td>
                                <td class="py-3 px-5">{{ ucfirst($onlineOrder['order_type']) }}</td>
                                <td class="py-3 px-5">₱{{ number_format($onlineOrder['total'], 2) }}</td>
                                <td class="py-3 px-5">
                                    @if ($onlineOrder['status'] == 'pending')
                                        <span class="text-yellow-500">{{ ucfirst($onlineOrder['status']) }}</span>
                                    @elseif ($onlineOrder['status'] == 'completed')
                                        <span class="text-green-500">{{ ucfirst($onlineOrder['status']) }}</span>
                                    @else
                                        <span class="text-red-500">{{ ucfirst($onlineOrder['status']) }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <!-- No Online Orders Found Message -->
                        <tr>
                            <td class="py-3 px-5 text-center" colspan="6">No online orders found.</td>
                        </tr>
                    @endif --}}
                    {{-- @foreach ($ordersPaginated['data'] as $onlineOrder)
                        <tr class="border-b hover:bg-slate-50">
                            <td class="py-3 px-5"> {{ $loop->iteration }} </td>
                            <td class="p-3">{{ $onlineOrder['order_number'] }}</td>
                            <td class="py-3 px-5">
                                @php
                                    $productNames = collect($onlineOrder['order_products'])->map(function($product) {
                                        return $product['product_id']; // Replace 'product_id' with 'product_name' if available
                                    })->implode(', ');
                                @endphp
                                {{ $productNames }}
                            </td>
                            <td class="py-3 px-5">{{ ucfirst($onlineOrder['order_type']) }}</td>
                            <td class="py-3 px-5">₱{{ number_format($onlineOrder['total'], 2) }}</td>
                            <td class="py-3 px-5">
                                @if ($onlineOrder['status'] == 'pending')
                                    <span class="text-yellow-500">{{ ucfirst($onlineOrder['status']) }}</span>
                                @elseif ($onlineOrder['status'] == 'completed')
                                    <span class="text-green-500">{{ ucfirst($onlineOrder['status']) }}</span>
                                @else
                                    <span class="text-red-500">{{ ucfirst($onlineOrder['status']) }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    <!-- No Online Orders Found Message -->
                    @if (count($ordersPaginated['data']) == 0)
                        <tr>
                            <td class="py-3 px-5" colspan="6">No online orders found.</td>
                        </tr>
                    @endif --}}
                </tbody>
            </table>
                {{-- PAGINATION --}}
            <div >
                @if ($ordersPaginated->isNotEmpty())
                    <div class="mt-5">
                        {{ $ordersPaginated->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    </div>
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
            {{-- @foreach ($orders as $order)
                <tr class="border-b hover:bg-slate-50">
                    <td class="py-3 px-5"> {{ $loop->iteration }} </td>
                    <td class="p-3">{{ $order->order_number }}</td>
                    <td class="py-3 px-5">
                        <!-- Concatenate product names for this order -->
                        @php
                            $productNames = $order->products
                                ->map(function ($orderProduct) {
                                    return $orderProduct->product->product_name;
                                })
                                ->implode(', ');
                        @endphp
                        {{ $productNames }}
                    </td>
                    <td class="py-3 px-5">{{ ucfirst($order->order_type) }}</td>
                    <td class="py-3 px-5">PHP {{ $order->total_price }}</td>
                    <td class="py-3 px-5">
                        <span class="px-2 py-1 text-xs font-normal text-orange-900 bg-orange-100 rounded-md">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                </tr>
            @endforeach --}}
        </tbody>
    </table>

    {{-- <div class="mt-5">
        {{ $orders->links() }}
    </div> --}}
@endsection
