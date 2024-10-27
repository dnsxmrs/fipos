<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Barlow:wght@400;600&display=swap');
        body {
            font-family: 'Barlow', sans-serif;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-white">
    <div class="bg-[#F3F3F3] p-8 rounded-md w-[595px] h-[495px] shadow-lg flex flex-col justify-center items-center">
        <h1 class="text-2xl font-bold mb-4 text-center">Change your password</h1>
        <p class="mb-6 text-gray-600 text-center">Enter a new password.</p>
        <form class="w-full" id="passwordForm">
            <div class="mb-4">
                <label class="block mb-1 text-gray-700">Password <span class="text-red-500">*</span></label>
                <input type="password" id="password" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-gray-200" placeholder="Enter password" required>
                <p id="passwordError" class="text-red-500 text-sm mt-1 hidden">Password must be at least 8 characters, including one uppercase, one lowercase, a number, and a special character.</p>
            </div>
            <div class="mb-6">
                <label class="block mb-1 text-gray-700">Confirm Password <span class="text-red-500">*</span></label>
                <input type="password" id="confirmPassword" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-gray-200" placeholder="Confirm password" required>
                <p id="confirmError" class="text-red-500 text-sm mt-1 hidden">Passwords do not match.</p>
            </div>

            <div class="mt-8 flex justify-center">
                <button type="submit" class="mt-5 w-64 py-2 bg-[#451a03] text-white font-semibold rounded hover:bg-[#78350f]">Login</button>
            </div>
        </form>
    </div>

    <script>
        const form = document.getElementById('passwordForm');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirmPassword');
        const passwordError = document.getElementById('passwordError');
        const confirmError = document.getElementById('confirmError');

        form.addEventListener('submit', function(event) {
            let valid = true;
            passwordError.classList.add('hidden');
            confirmError.classList.add('hidden');

            // Updated password validation regex for requirements
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            if (!passwordRegex.test(password)) {
                passwordError.classList.remove('hidden');
                valid = false;
            }

            if (password !== confirmPassword) {
                confirmError.classList.remove('hidden');
                valid = false;
            }

            if (!valid) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>