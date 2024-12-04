<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ env('APP_NAME') }} </title>

    <!-- Importing the Poppins font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

    <!-- Link to your admin CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        * {
            font-family: "Poppins", sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Main container -->
    <div class="flex h-screen overflow-y-auto">

        <!-- Sidebar container -->
        <div class="sidebar top-0 bottom-0 left-0  w-20 bg-gray-800 text-black">
            {{-- Sidebar --}}
            <x-sidebar.admin-sidebar/>
        </div>

        <!-- Header and content container -->
        <div class="flex-1 flex flex-col">
            {{-- <!-- Header -->
            <div class="shadow-md">
                <x-header/>
            </div> --}}

            <!-- Main content -->
            <div class="flex-1 p-6">
                @yield('admin_content')
            </div>
        </div>

    </div>
</body>
</html>
