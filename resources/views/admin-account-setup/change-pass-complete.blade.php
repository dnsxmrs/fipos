<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Change Success</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Barlow:wght@400;600&display=swap');
        body {
            font-family: 'Barlow', sans-serif;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <!-- Pop-up container -->
    <div class="bg-white w-[90%] max-w-[605px] h-auto sm:h-[405px] rounded-lg shadow-lg flex flex-col justify-center items-center p-6 sm:p-8">
        <!-- success check icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 sm:w-16 sm:h-16 mb-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        <!-- Success message -->
        <h2 class="text-xl sm:text-2xl font-semibold mb-2 text-center">Password changed successfully!</h2>
        <p class="text-gray-600 mb-6 text-center text-sm sm:text-base">You may now access your account with your new password.</p>
        <!-- Login button -->
        <button class="w-full sm:w-64 py-2 bg-[#451a03] text-white font-semibold rounded hover:bg-[#78350f]">Login</button>
    </div>
</body>
</html>