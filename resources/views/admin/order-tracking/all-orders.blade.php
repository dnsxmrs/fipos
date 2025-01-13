@extends('admin.order-tracking.index')

@section('order_table')
    <input type="text" placeholder="Search for orders..."
        class="p-3 mb-3 h-10 w-64 focus:outline-none focus:ring-1 focus:ring-blue-500 bg-gray-100 border border-gray-200 text-sm text-gray-500 rounded-lg">

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
            @foreach ($orders as $order)
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
            @endforeach
        </tbody>
    </table>

    <div class="mt-5">
        {{ $orders->links() }}
    </div>
@endsection
