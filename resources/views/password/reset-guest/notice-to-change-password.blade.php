<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Barlow:wght@400;700&display=swap');

        body {
            font-family: 'Barlow', sans-serif;
            background-color: rgba(228, 228, 228, 0.5);
            /* Background for pop-up */
        }

        .bg-brown {
            background-color: #451a03;
        }

        .hover\:bg-brown-dark:hover {
            background-color: #78350f;
        }

        .focus\:ring-brown:focus {
            ring-color: #451a03;
        }

        /* Modal Styles */
        .modal {
            width: 100%;
            max-width: 700px;
            max-height: 100%;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen">
    <!-- Modal -->
    <div id="reset-modal" class="modal bg-white shadow-lg rounded-lg p-10 flex flex-col items-center text-center">
        <!-- Reset Password Header -->
        <h2 class="text-2xl font-semibold text-brown mb-4">Notice!</h2>
        <p class="text-sm text-gray-700 mb-8">
            It seems that this is your first time logging in {{ env('APP_NAME').'.' }} We recommend to change your password.
        </p>

        {{-- Continue button --}}
        <a href="{{ route('change.password') }}" class="mt-4 w-64 py-3 bg-green-800 hover:bg-green-700 text-white font-bold rounded-lg ">
            Continue
        </a>
        {{-- <a href="{{ route('admin.dashboard') }}" class="mt-4 text-blue-800 underline">Go to Dashboard</a> --}}
</body>

</html>
