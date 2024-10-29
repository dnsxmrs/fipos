<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CaffeinatedPOS - Sign Up Successful</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Barlow:wght@400;700&display=swap');

        body {
            font-family: 'Barlow', sans-serif;
            background-color: #f7f7f7;
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

        /* Background SVG styling */
        .background-svg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.05; /* Faint background */
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100 relative">

    <div class="bg-white shadow-lg rounded-lg p-6 sm:p-8 md:p-10 lg:p-12 w-11/12 sm:w-10/12 md:w-8/12 lg:w-6/12 xl:w-4/12 text-center">
        <!-- Email Icon -->
        <div class="mb-6">
            <svg class="mx-auto w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 text-brown" fill="currentColor" viewBox="0 0 24 24">
                <rect width="20" height="14" x="2" y="5" rx="2" ry="2" stroke-width="2" stroke="currentColor" fill="none"/>
                <path d="M2 5l10 7 10-7" stroke="currentColor" stroke-width="2" fill="none"/>
                <circle cx="17" cy="17" r="4" fill="green"/>
                <path d="M15.5 17l1.5 1.5 3-3" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

        <!-- Success Message -->
        <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold mb-4">Sign Up Successful!</h2>
        <p class="text-xs sm:text-sm md:text-base lg:text-lg text-gray-700 mb-6">
            Thank you for signing up. Login now using your registered email and password.
        </p>
        
        <!-- Login Button -->
        <button class="mt-4 px-6 py-2 sm:px-8 sm:py-3 md:px-10 md:py-4 bg-brown hover:bg-brown-dark text-white font-bold rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brown">
            Login
        </button>
    </div>
</body>
</html>