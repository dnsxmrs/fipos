@extends('layouts.admin-layout')

@section('admin_content')
    <div class="">
        <h3 class="text-lg">Inventory</h3>
        <p class="text-sm text-gray-500">Welcome, {{ Auth::user()->first_name }}</p>
        <p class="text-sm text-gray-500">{{ now()->setTimezone('Asia/Manila')->format('l, g:i A') }}</p>

    </div>

    <div class="flex flex-col mt-10 mx-auto max-w-7xl">
        {{-- CATEGORY HEADER --}}
        <div class="space-x-1">
            <a href="{{ route('admin.inventory.show') }}" class="px-5 py-5 bg-[#FFC107] rounded-t-xl">All items</a>

            @foreach ($categories as $category)
                <a href="{{ route('admin.inventory.categorized', ['name' => $category->category_name]) }}"
                    class="px-5 py-5 bg-[#FFC107] rounded-t-xl"> {{ $category->category_name }} </a>
            @endforeach
        </div>


        <div class="bg-white rounded-3xl px-8 pb-8 flex flex-col items-center justify-center">

            <div class="flex items-center justify-between px-4 mt-7 w-full py-5 border-b border-gray-200">
                <h3 class="text-3xl text-[#00754A] font-medium">Inventory Items</h3>
                <button
                    class="flex items-center justify-center shadow-md hover:bg-[#005C39] transition text-white bg-[#00754A] px-4 py-2 rounded-lg text-sm"><span><img
                            class="w-5 mr-2" src="{{ asset('images/add.png') }}" alt="add icon"></span> Add item
                </button>
            </div>

            <div class="flex items-center justify-between px-4 w-full py-9 border-b border-gray-200">
                <div class="flex w-72 border border-gray-200 p-2 rounded-lg ">
                    <img class="w-[24px]" src="{{ asset('images/search.png') }}" alt="search icon">
                    <input type="text" placeholder="Search item"
                        class="ml-2 outline-none bg-transparent w-full focus:border-transparent">
                </div>
                <div class="flex w-70 py-2 px-3 rounded-3xl bg-[#E5E5E5] text-gray-500">
                    <img class="w-[24px]" src="{{ asset('images/filter.png') }}" alt="search icon">
                    <select name="filter" id="filter"
                        class="ml-2 outline-none bg-transparent w-full focus:border-transparent">
                        <option value="" selected disabled>Select a category</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- TABULAR CONTENT FOR ITEMS --}}
            <div class="px-8 w-full">
                <table class="table-auto w-full mt-7" id="products_table">
                    <thead>
                        <tr class="border-b border-gray-300 text-base">
                            <th class="text-center p-2">No.</th>
                            <th class="text-center p-2">Item Name</th>
                            <th class="text-center p-2">Category</th>
                            <th class="text-center p-2">Stocks</th>
                            <th class="text-center p-2">Unit</th>
                            <th class="text-center p-2">Last Restocked</th>
                            <th class="text-center p-2">Expiry Date</th>
                            <th class="text-center p-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorizedItems as $item)
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

                            <tr class="border-b border-gray-300 text-sm">
                                <td class="text-center p-3">{{ $loop->iteration }}</td>
                                <td class="text-center p-3">{{ ucfirst($item->item_name) }}</td>
                                <td class="text-center p-3">{{ $item->category->category_name }}</td>
                                <td class="text-center p-3">{{ $item->stock }}</td>
                                <td class="text-center p-3">{{ $item->unit }}</td>
                                <td class="text-center p-3">{{ $item->last_restocked }}</td>
                                <td class="text-center p-3">{{ $item->expiry_date }}</td>
                                <td class="text-center p-3">
                                    <span class="text-xs {{ $statusStyle['text'] }} rounded-md px-2 py-1"
                                        style="background-color: {{ $statusStyle['bg'] }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
