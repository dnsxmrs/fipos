<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Caffeinated</title>

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

<body>
    <!--mainframe-->
    <div class="flex h-screen w-screen bg-[rgb(243,243,243)]">
        <!--sidebar-->
        <div class="flex h-screen ">
            @include('navigation-sidebar.admin-sidebar')
        </div>


        <!--main content-->
        <main class="flex-1 p-5px overflow-y-auto w-5/6">

            {{-- header --}}
            <div class="fixed top-0 w-full bg-white shadow-md z-50">
                <x-header />
            </div>

            {{-- frame for content --}}
            <div class="flex h-screen mx-auto bg-gray-100 ">
                @yield('content')
            </div>

        </main>

    </div>
</body>

</html>
