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
    <!-- Main container -->
    <div class="flex h-screen overflow-y-auto">

        <!-- Sidebar container -->
        <div class="sidebar top-0 bottom-0 left-0  w-20 bg-gray-800 text-black">
            {{-- Sidebar --}}
            <x-sidebar.cashier-sidebar />
        </div>

        <!-- Header and content container -->
        <div class="flex-1 flex flex-col">

            {{-- Header --}}
            <x-headers.header />

            <!-- Main content -->
            @yield('cashier_content')
        </div>

    </div>
</body>

<script src="{{ asset('js/cashier-order.js') }}"></script>

</html>
