@extends('layouts.cashier-layout')

@section('cashier_content')
    <!-- Main Content Area -->
    <div class="flex-1 ml-20 w-[1460px]">
        <!-- Header -->
        <header class="mb-4 rounded p-4">
            <div>
                <h1 class="font-barlow text-4xl font-bold">
                    <span class="mr-0">Online</span>
                    <span class="text-amber-700">Orders</span>
                </h1>
                <p class="font-barlow text-m mt-2">{{ now()->setTimezone('Asia/Manila')->format('l, g:i A') }}</p>
            </div>
        </header>

        <!-- Tables Container -->
        <div class="flex justify-start mt-10 space-x-6">
            <!-- Dine-in Section -->
            <div>
                <div class="font-bold text-lg font-barlow">
                    <p class="text-amber-800">Dine-in</p>
                </div>
                <div class="w-[1700px] h-auto bg-white mt-5 rounded-md shadow-md p-4">
                    <table class="table-auto w-[1700px] text-left border-collapse">
                        <thead>
                            <tr class="border-b">
                                <th class="py-2">Order #</th>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Contact No.</th>
                                <th>Duration</th>
                                <th>Orders</th>
                                <th>Amount</th>
                                <th>Order Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr class="border-b">
                                <td class="py-2">3</td>
                                <td>123456789</td>
                                <td>Shanella Cagulang</td>
                                <td>09123456789</td>
                                <td>1:00 - 2:00</td>
                                <td class="py-2 px-4">
                                    <ul class="list-inside">
                                        <li>Cappuccino</li>
                                        <li>Siomai</li>
                                        <li>Croffles</li>
                                    </ul>
                                </td>
                                <td>Php 1,500.00</td>
                                <td>
                                    <span
                                        class="px-2 py-1 text-sm font-regular text-red-900 bg-red-100 rounded-md">IN-QUEUE</span>
                                </td>
                            </tr>

                            <tr class="border-b">
                                <td class="py-2">2</td>
                                <td>9674572</td>
                                <td>Miyuki Mharie Parocha</td>
                                <td>09123456789</td>
                                <td>1:00 - 2:00</td>
                                <td class="py-2 px-4">
                                    <ul class="list-inside">
                                        <li>Cappuccino</li>
                                        <li>Siomai</li>
                                        <li>Croffles</li>
                                    </ul>
                                </td>
                                <td>Php 1,500.00</td>
                                <td>
                                    <span
                                        class="px-2 py-1 text-sm font-regular text-blue-900 bg-blue-100 rounded-md">READY</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2">1</td>
                                <td>123456789</td>
                                <td>Erice Michael Marial</td>
                                <td>09123456789</td>
                                <td>1:00 - 2:00</td>
                                <td class="py-2 px-4">
                                    <ul class="list-inside">
                                        <li>Cappuccino</li>
                                        <li>Siomai</li>
                                        <li>Croffles</li>
                                    </ul>
                                </td>
                                <td>Php 1,500.00</td>
                                <td>
                                    <span
                                        class="px-2 py-1 text-sm font-regular text-green-900 bg-green-100 rounded-md">COMPLETE</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
