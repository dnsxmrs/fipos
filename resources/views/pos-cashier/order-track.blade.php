<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caffeinated</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Barlow', sans-serif;
        }
    </style>
</head>

<body class="flex" bgcolor="#F3F3F3">

    <!-- Sidebar -->
    <nav class="w-20 bg-white border-r h-screen flex flex-col items-center py-6 fixed">
        <div class="mb-4">
            <img src="{{ asset('Assets/Caffeinated Logo 1.png') }}" alt="Caffeinated Logo" class="w-12 h-12">
        </div>

        <!-- Menu buttons -->
        <button aria-label="Menu" class="flex flex-col items-center mb-4">
            <div class="w-10 h-10 rounded-lg mb-2"></div>
            <img src="{{ asset('Assets/order.png') }}" alt="Menu Icon" class="w-6 h-6 mb-1">
            <span class="text-xs">Order</span>
        </button>
        <button aria-label="Reports" class="flex flex-col items-center mb-4">
            <div class="w-10 h-10 rounded-lg mb-2"></div>
            <img src="{{ asset('Assets/online-order.png') }}" alt="Reports Icon" class="w-6 h-6 mb-2">
            <span class="text-xs">Online</span>
            <span class="text-xs">Order</span>
        </button>
        <button aria-label="Order tracking" class="flex flex-col items-center">
            <div class="w-10 h-10 rounded-lg mb-2"></div>
            <img src="{{ asset('Assets/order report icon 1.png') }}" alt="Order Tracking Icon" class="w-6 h-6 mb-2">
            <span class="text-xs">Order</span>
            <span class="text-xs">Tracking</span>
        </button>
    </nav>

        <!-- Main Content Area -->
        <div class="flex-1 ml-20 w-[1460px]">
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
                    <button class="w-[179px] h-[40px] text-center font-regular text-white amber-900 bg-amber-900 border border-amber-900 hover:bg-gray-50 px-4 py-2 rounded-md mr-6 ml-5 hover:text-amber-900">
                        Walk-in
                    </button>
                    <button class="w-[179px] h-[40px] text-center font-regular text-amber-900 border border-amber-900 hover:bg-gray-300 px-4 py-2 rounded-md hover:text-black">
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
                                        <th class="py-2">Order #</th>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Order Type</th>
                                        <th>Order Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b">
                                        <td class="py-2">3</td>
                                        <td>123456789</td>
                                        <td>Shanella Cagulang</td>
                                        <td>Dine-in</td>
                                        <td>
                                            <span class="px-2 py-1 text-sm font-regular text-red-900 bg-red-100 rounded-md">IN-QUEUE</span>
                                        </td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-2">2</td>
                                        <td>9674572</td>
                                        <td>Miyuki Mharie Parocha</td>
                                        <td>Dine-in</td>
                                        <td>
                                            <span class="px-2 py-1 text-sm font-regular text-blue-900 bg-blue-100 rounded-md">READY</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2">1</td>
                                        <td>123456789</td>
                                        <td>Erice Michael Marial</td>
                                        <td>Dine-in</td>
                                        <td>
                                            <span class="px-2 py-1 text-sm font-regular text-green-900 bg-green-100 rounded-md">COMPLETE</span>
                                        </td>
                                    </tr>
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
                                        <th class="py-2">Order #</th>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Order Type</th>
                                        <th>Order Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b">
                                        <td class="py-2">3</td>
                                        <td>123456789</td>
                                        <td>Shanella Cagulang</td>
                                        <td>Dine-in</td>
                                        <td>
                                            <span class="px-2 py-1 text-sm font-regular text-red-900 bg-red-100 rounded-md">IN-QUEUE</span>
                                        </td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-2">2</td>
                                        <td>9674572</td>
                                        <td>Miyuki Mharie Parocha</td>
                                        <td>Dine-in</td>
                                        <td>
                                            <span class="px-2 py-1 text-sm font-regular text-blue-900 bg-blue-100 rounded-md">READY</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2">1</td>
                                        <td>123456789</td>
                                        <td>Erice Michael Marial</td>
                                        <td>Dine-in</td>
                                        <td>
                                            <span class="px-2 py-1 text-sm font-regular text-green-900 bg-green-100 rounded-md">COMPLETE</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>



            </div> <!--Main content closing tag-->
