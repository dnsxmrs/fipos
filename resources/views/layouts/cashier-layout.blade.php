<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caffeinated</title>
    <script src="https://cdn.tailwindcss.com"></script>

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
        <div class="fixed h-full bg-[#066543]">
            {{-- Sidebar --}}
            <x-sidebar.cashier-sidebar />
        </div>

        <div class="flex w-full mt-24 ml-20 mr-[510px] px-5  ">
            <!-- Scrollable Cashier Content -->
            <div class="h-full overflow-y-auto">
                @yield('cashier_content')
            </div>

            <!-- Cashier Panel -->
            <div class="fixed right-0">
                @yield('cashier_panel')
            </div>
        </div>
    </div>
    </div>
</body>

<script src="{{ asset('js/cashier-order.js') }}"></script>

</html>
