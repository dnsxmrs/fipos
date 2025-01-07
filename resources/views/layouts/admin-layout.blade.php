<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title> {{ env('APP_NAME') }} </title>
    <link rel="icon" href="{{ asset('Assets/logo.png') }}" type="image/png">
    <!-- Link to your admin CSS -->
    {{-- <link rel="stylesheet" href="https://fipos-production.up.railway.app/css/admin.css"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="{{ asset('js/cashier/cashier-header.js') }}"></script>
    <script defer src="{{ asset('js/admin/admin-sidebar.js') }}"></script>
    <script defer src="{{ asset('js/admin/admin-categories.js') }}"></script>
    <script defer src="{{ asset('js/admin/admin-products.js') }}"></script>
    <script defer src="{{ asset('js/inventory/inventory-categories.js') }}"></script>

    {{--  <script src="https://fipos-production.up.railway.app/js/admin/js/cashier/cashier-header.js"> </script>
    <script src="https://fipos-production.up.railway.app/js/admin/admin-sidebar.js"> </script>
    <script src="https://fipos-production.up.railway.app/js/admin/admin-categories.js"> </script>
    <script src="https://fipos-production.up.railway.app/js/admin/admin-products.js"> </script>
    <script src="https://fipos-production.up.railway.app/js/inventory/inventory-categories.js"> </script> --}}


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
    <div class="">
        @include('components.headers.admin-header')
    </div>

    <!-- Main content -->
    <div class="flex">
        <div class="fixed">
            {{-- Sidebar --}}
            <x-sidebar.admin-sidebar />
        </div>

        <div class="flex w-full px-5 mt-20 ml-64">
            <!-- Scrollable Cashier Content -->
            <div class="w-full">
                @yield('admin_content')
            </div>

        </div>
    </div>
</body>
</html>
