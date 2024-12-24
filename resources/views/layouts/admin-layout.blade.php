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
    <main class="flex ">

        <!-- Sidebar container -->
        <div class="h-full  max-w-20">
            {{-- Sidebar --}}
            <x-sidebar.admin-sidebar/>
        </div>

        <!-- Header and content container -->
        <div class="flex flex-col">
            <!-- Header -->
            <div class="shadow-md">
                <x-headers.header/>
            </div>

            <!-- Main content -->
            <div class="p-6">
                @yield('admin_content')
            </div>
        </div>

    </main>
</body>
</html>
