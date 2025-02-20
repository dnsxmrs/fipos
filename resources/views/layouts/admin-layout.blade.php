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
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="{{ asset('Assets/js/cashier/cashier-header.js') }}"></script>
    <script defer src="{{ asset('Assets/js/admin/admin-sidebar.js') }}"></script>
    <script defer src="{{ asset('Assets/js/admin/admin-categories.js') }}"></script>
    <script defer src="{{ asset('Assets/js/admin/admin-products.js') }}"></script>
    <script defer src="{{ asset('Assets/js/inventory/inventory-categories.js') }}"></script>
    <script defer src="{{ asset('Assets/js/admin/user.js') }}"></script>
    <script defer src="{{ asset('Assets/js/inventory/inventory-items.js') }}"></script>
    <script defer src="{{ asset('Assets/js/password-toggle.js') }}"></script>

    {{--
    <script defer src="https://fipos-production.up.railway.app/Assets/js/cashier/cashier-header.js"> </script>
    <script defer src="https://fipos-production.up.railway.app/Assets/js/admin/admin-sidebar.js"> </script>
    <script defer src="https://fipos-production.up.railway.app/Assets/js/admin/admin-categories.js"> </script>
    <script defer src="https://fipos-production.up.railway.app/Assets/js/admin/admin-products.js"> </script>
    <script defer src="https://fipos-production.up.railway.app/Assets/js/inventory/inventory-categories.js"> </script> --}}


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
        @include('components.headers.header')
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
