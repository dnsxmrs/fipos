@extends('admin.order-tracking.index')

@section('order_table')
    <div class="flex justify-between items-center mb-3">
        <input type="text" placeholder="Search for orders..."
            class="p-3 h-10 w-64 focus:outline-none focus:ring-1 focus:ring-blue-500 bg-gray-100 border border-gray-200 text-sm text-gray-500 rounded-lg">

        <!-- Export Csv button -->
        {{-- <a href="{{ route('admin.orders.export') }}"
            class="block text-white bg-yellow-600 hover:bg-yellow-700 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            <i class="fa-solid fa-download mr-2"></i>
            Export CSV
        </a> --}}

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
                        <th class="p-3 text-sm font-semibold tracking-wide text-center w-[10%] min-w-max">Action</th>
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
                                            return $product['product']['name']; // Replace with 'product_name' if available
                                        })->implode(', ');
                                    @endphp
                                    {{ $productNames }}
                                </td>
                                <td class="py-3 px-5">{{ ucfirst($onlineOrder['order_type']) }}</td>
                                <td class="py-3 px-5">₱{{ number_format($onlineOrder['total'], 2) }}</td>
                                <td class="py-3 px-5">
                                    @php
                                        $statusColors = [
                                            'pending' => 'text-yellow-500',    // Yellow for orders being validated
                                            'preparing' => 'text-blue-500',    // Blue for orders being prepared
                                            'ready' => 'text-purple-500',      // Purple for orders ready for dispatch
                                            'delivery' => 'text-orange-500',   // Orange for orders out for delivery
                                            'completed' => 'text-green-500',   // Green for completed orders
                                            'cancelled' => 'text-red-500',     // Red for cancelled orders
                                        ];
                                    @endphp

                                    <span class="{{ $statusColors[$onlineOrder['status']] ?? 'text-gray-500' }}">
                                        {{ ucfirst($onlineOrder['status']) }}
                                    </span>
                                </td>
                                <td>
                                    @if ($onlineOrder['status'] == 'delivery')
                                        <form action="{{ route('admin.orders.update-status', $onlineOrder['id']) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="px-3 py-1 text-white bg-blue-500 rounded-lg hover:bg-green-600">
                                                Complete
                                            </button>
                                        </form>
                                        {{-- <button class="px-3 py-1 text-white bg-blue-500 rounded-lg hover:bg-green-600">
                                            Complete
                                        </button> --}}
                                    @else
                                        <button class="px-3 py-1 text-gray-500 bg-gray-300 rounded-lg cursor-not-allowed" disabled>
                                            Not Applicable
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="py-3 px-5 text-center" colspan="6">No online orders found.</td>
                        </tr>
                    @endif
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
