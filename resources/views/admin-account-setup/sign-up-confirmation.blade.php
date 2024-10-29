<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CaffeinatedPOS - Email Confirmation</title>
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
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white shadow-lg rounded-lg p-8 md:p-12 lg:p-16 w-full max-w-md md:max-w-2xl lg:max-w-4xl text-center">
        <!-- Email Icon -->
        <div class="mb-6 md:mb-8 lg:mb-10">
            <img src = "public/assets/Caffeinated Logo 1.png">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m0 0l-4 4m4-4l4-4m0 0H4m12 0l4 4m-4-4l4 4M2 12a10 10 0 1010-10"/>
            </img>
        </div>

        <!-- Thank You Message -->
        <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-4 md:mb-5 lg:mb-6">Thank you for signing up!</h2>
        <p class="text-base md:text-lg lg:text-xl text-gray-700 mb-6 md:mb-8 lg:mb-10">
            Check your registered email and click on the link provided to activate your account.
        </p>
        
        <!-- Resend Verification Button -->
        <button class="mt-4 px-6 py-2 md:px-8 md:py-3 lg:px-10 lg:py-4 bg-brown hover:bg-brown-dark text-white font-bold rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brown">
            Resend verification email
        </button>
    </div>
</body>
</html>