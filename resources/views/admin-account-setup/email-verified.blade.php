<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CaffeinatedPOS - Successfully Verified</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Barlow:wght@400;700&display=swap');

        body {
            font-family: 'Barlow', sans-serif;
            background-color: #f9f9f9;
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
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white shadow-sm rounded-lg p-8 sm:p-10 md:p-12 lg:p-14 w-full max-w-3xl text-center">
        <div class="mb-8 sm:mb-10 md:mb-12 lg:mb-14">
            <svg class="mx-auto w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 lg:w-28 lg:h-28 text-brown" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <rect width="20" height="14" x="2" y="5" rx="2" ry="2" stroke-width="2" stroke="currentColor" fill="none"/>
                <path d="M2 5l10 7 10-7" stroke="currentColor" stroke-width="2" fill="none"/>
            </svg>
        </div>
        <!-- Success Message -->
        <h2 class="text-2xl sm:text-2xl md:text-4xl lg:text-5xl font-semibold mb-4">Successfully Verified!</h2>
        <p class="text-base sm:text-lg md:text-xl lg:text-2xl text-gray-600 mb-6 sm:mb-8 md:mb-10">
            You have successfully verified your email address. Login now using your registered email and password.
        </p>
        
        <!-- Login Button -->
        <button class="mt-4 px-6 py-3 sm:px-8 sm:py-4 md:px-10 md:py-5 bg-brown hover:bg-brown-dark text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brown">
            Login
        </button>
    </div>
</body>
</html>