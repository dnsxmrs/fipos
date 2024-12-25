@extends('admin.inventory.index')

@section('inventory_table')

    <div class="flex items-center justify-between mt-5">
        <input type="text" placeholder="Search items..."
            class="p-3 h-10 w-64 focus:outline-none focus:ring-1 focus:ring-blue-500 bg-gray-100 border border-gray-200 text-sm text-gray-500 rounded-lg">

        <!--ADD BUTTON-->
        <button onclick="showAddDialog()"
            class="bg-green-600 ml-3 text-white px-10 h-10 font-medium text-sm hover:bg-green-700 shadow-sm rounded-full">
            + Add Item
        </button>
    </div>

    {{-- ITEMS TABLE --}}
    <div class="flex items-start my-7  justify-center rounded-lg w-full">
        <div class="w-full ">
            <table class="w-full shadow rounded-lg table-auto">
                <thead class="bg-slate-100 border-b-2 rounded-lg">
                    <tr>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">No.</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Item Name</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Category</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Stocks</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Unit</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Last Restocked</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Expiry Date</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max">Status</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-center min-w-max"></th>
                    </tr>
                </thead>
                <tbody class="text-center text-xs">
                    @foreach ($items as $item)
                        @php
                            // Define color codes for statuses
                            $statusColors = [
                                'sufficient' => ['text' => 'text-green-500', 'bg' => '#DCF8F0'],
                                'low' => ['text' => 'text-yellow-500', 'bg' => '#FFF8DC'],
                                'expired' => ['text' => 'text-gray-500', 'bg' => '#F4F4F4'],
                                'critical' => ['text' => 'text-red-500', 'bg' => '#FFDFDF'],
                                'damaged' => ['text' => 'text-orange-500', 'bg' => '#FFE7C7'],
                                'discontinued' => ['text' => 'text-purple-500', 'bg' => '#F0E4FF'],
                            ];

                            // Fallback if status is not recognized
                            $statusStyle = $statusColors[$item['status']] ?? [
                                'text' => 'text-black',
                                'bg' => '#FFFFFF',
                            ];
                        @endphp

                        <tr class="border-b hover:bg-slate-50">
                            <td class="py-3 px-5">
                                {{ ($items->currentPage() - 1) * $items->perPage() + $loop->iteration }} </td>
                            <td class="py-3 px-5"> {{ ucfirst($item->item_name) }} </td>
                            <td class="p-3">{{ $item->category->category_name }}</td>
                            <td class="py-3 px-5">{{ $item->stock }}</td>
                            <td class="py-3 px-5">{{ $item->unit }}</td>
                            <td class="py-3 px-5">{{ $item->last_restocked }}</td>
                            <td class="py-3 px-5">{{ $item->expiry_date }}</td>
                            <td class="text-center p-3">
                                <span class="text-xs {{ $statusStyle['text'] }} rounded-md px-2 py-1"
                                    style="background-color: {{ $statusStyle['bg'] }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="flex py-3 px-5 space-x-2 items-center justify-end">
                                <button onclick="showEditDialog(this)" data-id="{{ $item->id }}"
                                    class="flex text-blue-500 transition duration-300 ease-in-out items-right hover:text-blue-700">
                                    <img src="{{ asset('Assets/Edit.png') }}" alt="Edit Icon" class="ml-9">
                                </button>
                                <button onclick="showDeleteDialog({{ $item->category_id }})"
                                    class="flex ml-2 text-red-500 transition duration-300 ease-in-out items-right hover:text-red-700">
                                    <img src="{{ asset('Assets/Delete.png') }}" alt="Delete Icon" class="ml-5 mr-5">
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-5">
                {{ $items->links() }}
            </div>
        </div>
    </div>

    {{-- ADD MODAL --}}
    <div id="add-dialog"
        class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50">

        <div class="">

        </div>

    </div>
@endsection
