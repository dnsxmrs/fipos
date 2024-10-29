<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Barlow:wght@400;700&display=swap');

        body {
            font-family: 'Barlow', sans-serif;
            background-color: rgba(0, 0, 0, 0.5); /* Background for pop-up */
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
            width: 600px;
            height: 400px;
            max-width: 100%;
            max-height: 100%;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <!-- Modal -->
    <div class="modal bg-white shadow-lg rounded-lg p-10 text-center">
        <!-- Icon -->
        <div class="mb-6">
            <svg class="mx-auto w-16 h-16 text-brown" fill="currentColor" viewBox="0 0 24 24">
                <rect x="2" y="6" width="20" height="12" rx="2" ry="2"></rect>
                <path d="M2 6l10 6 10-6" stroke="currentColor" stroke-width="1" fill="none"></path>
                <circle cx="18" cy="8" r="3" fill="currentColor"></circle>
                <line x1="17" y1="7" x2="19" y2="9" stroke="#fff" stroke-width="2" stroke-linecap="round"></line>
            </svg>
        </div>

        <!-- Confirmation Message -->
        <h2 class="text-2xl font-bold text-brown mb-4">You're on your way to a new password!</h2>
        <p class="text-sm text-gray-700 mb-8">
            Check your registered email and click on the provided link so you can reset your password and resume ordering your favorites!
        </p>
        
        <!-- Back to Login Button -->
        <button class="mt-4 w-64 py-3 bg-brown hover:bg-brown-dark text-white font-bold rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brown">
            Back to login
        </button>
    </div>
</body>
</html>