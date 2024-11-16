<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ env('APP_NAME') }} </title>

    <!-- Importing the Poppins font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

    <!-- Link to your admin CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        function showConfirmationModal() {
            document.getElementById("confirmation-modal").style.display = "flex";
        }

        function closeModal() {
            document.getElementById("confirmation-modal").style.display = "none";
        }

        function handleFormSubmission(event) {
            event.preventDefault(); // Prevent actual form submission
            showConfirmationModal(); // Show confirmation modal
        }
    </script>

    <style>
        * {
            font-family: "Poppins", sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen w-screen">
        {{-- Sidebar --}}
        <div>
            {{-- @include('navigation-sidebar.admin-sidebar') --}}
            <x-admin-sidebar/>
        </div>

        <div class="block">
            {{-- Header --}}
            <div>
                <x-header/>
            </div>

            {{-- Content --}}
            <div>
                @yield('admin_content')
            </div>

        </div>
    </div>
</body>
</html>
