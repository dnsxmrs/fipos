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
        <h1 class="text-2xl font-bold mb-4 text-center">Reset Password</h1>
        <p class="mb-6 text-gray-600 text-center">Enter your new password.</p>
        <form action="{{ route('password.update') }}" method="POST" class="w-full" id="passwordForm">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Email Input -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span
                        class="text-red-500">*</span></label>
                <input type="text" id="email" name="email" value="{{ old('email') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-brown"
                    placeholder="Enter your email" @error('email') style="border-color: red" @enderror>
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Input with Eye Toggle Icon -->
            <div class="mb-4 relative">
                <label class="block mb-1 text-gray-700">Password <span class="text-red-500">*</span></label>
                <input type="password" id="password" name="password"
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-gray-200"
                    placeholder="Enter password" @error('password') style="border-color: red" @enderror>
                <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer" id="toggle-password">
                    <!-- Hidden Eye Slash icon (for password hidden) -->
                    <div id="eye-slash-icon" style="display: block;" class="w-5 h-5">
                        <img src="{{ asset('Assets/hide_password.png') }}" alt="hide password icon"
                            class="filter grayscale">
                    </div>
                    <!-- Show Eye icon (for password visible) -->
                    <div id="eye-show-icon" style="display: none;" class="w-5 h-5">
                        <img src="{{ asset('Assets/show_password.png') }}" alt="show password icon"
                            class="filter grayscale">
                    </div>
                </span>
            </div>

            <!-- Confirm Password Input with Eye Toggle Icon -->
            <div class="mb-6 relative">
                <label class="block mb-1 text-gray-700">Confirm Password <span class="text-red-500">*</span></label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-gray-200"
                    placeholder="Confirm password" @error('password') style="border-color: red" @enderror>
                <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer" id="toggle-confirm-password">
                    <!-- Hidden Eye Slash icon (for confirm password hidden) -->
                    <div id="eye-slash-icon-confirm" style="display: block;" class="w-5 h-5">
                        <img src="{{ asset('Assets/hide_password.png') }}" alt="hide password icon"
                            class="filter grayscale">
                    </div>
                    <!-- Show Eye icon (for confirm password visible) -->
                    <div id="eye-show-icon-confirm" style="display: none;" class="w-5 h-5">
                        <img src="{{ asset('Assets/show_password.png') }}" alt="show password icon"
                            class="filter grayscale">
                    </div>
                </span>

                @error('password')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            @error('error')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror

            <!-- Submit Button -->
            <div class="mt-8 flex justify-center">
                <button type="submit"
                    class="mt-5 w-64 py-2 bg-[#451a03] text-white font-semibold rounded hover:bg-[#78350f]">Change
                    Password</button>
            </div>
        </form>
    </div>

    <script>
        // Toggle password visibility and icons for both password and confirm password
        function togglePasswordVisibility(inputId, eyeShowIconId, eyeSlashIconId) {
            const passwordField = document.getElementById(inputId);
            const eyeShowIcon = document.getElementById(eyeShowIconId);
            const eyeSlashIcon = document.getElementById(eyeSlashIconId);

            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;

            if (type === 'password') {
                // Password is hidden, show eye-slash icon
                eyeShowIcon.style.display = 'none';
                eyeSlashIcon.style.display = 'block';
            } else {
                // Password is visible, show eye icon
                eyeShowIcon.style.display = 'block';
                eyeSlashIcon.style.display = 'none';
            }
        }

        // Event listeners for password field and confirm password field
        document.getElementById('toggle-password').addEventListener('click', function() {
            togglePasswordVisibility('password', 'eye-show-icon', 'eye-slash-icon');
        });

        document.getElementById('toggle-confirm-password').addEventListener('click', function() {
            togglePasswordVisibility('password_confirmation', 'eye-show-icon-confirm', 'eye-slash-icon-confirm');
        });
    </script>
</body>

</html>
