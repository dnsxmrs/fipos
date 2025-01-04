<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta lang="en">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>
    <script defer src="{{ asset('js/cashier/cashier-order.js') }}"></script>
    <script defer src="{{ asset('js/cashier/orders.js') }}"></script>
    <script defer src="{{ asset('js/cashier/cashier-header.js') }}"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">
    {{-- Header --}}
    @include('components.headers.cashier-header')

    <!-- Main content -->
    <div class="flex">
        <div class="fixed">
            {{-- Sidebar --}}
            <x-sidebar.cashier-sidebar />
        </div>

        <div class="flex w-full mt-20 ml-24 px-5  ">
            <!-- Scrollable Cashier Content -->
            <div class="overflow-y-auto">
                @yield('cashier_content')
            </div>

        </div>
    </div>
</body>

</html>
