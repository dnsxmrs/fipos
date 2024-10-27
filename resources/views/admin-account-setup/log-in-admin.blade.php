<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CaffeinatedPOS - Login</title>
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

        /* Modal styling */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 400px;
            text-align: center;
        }

        /* Spinner styling */
        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #451a03;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto 10px;
            display: none;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100 relative">
    <div class="bg-white shadow-lg rounded-lg p-8 md:p-10 lg:p-12 w-full max-w-md md:max-w-xl lg:max-w-2xl text-center">
        <!-- Logo -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800">Caffeinated<span style="color: #451a03">POS</span></h1>
            <p class="text-xl text-gray-600">POINT OF SALE</p>
        </div>

        <!-- Message for attempts -->
        <p id="attempt-message" class="text-sm text-gray-600 mb-4">
            You have 3 attempts to log in before your account is locked.
        </p>

        <!-- Form -->
        <form id="login-form" class="space-y-6">
            <div class="text-left">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                <input type="email" id="email" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-brown" placeholder="Enter your email">
            </div>
            <div class="text-left">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password <span class="text-red-500">*</span></label>
                <div class="relative">
                    <input type="password" id="password" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-brown" placeholder="Enter your password">
                    <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer">
                        <!-- Eye icon for show/hide password -->
                        <svg id="toggle-password" class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7-4.477 7-9.542 7-8.268-2.943-9.542-7z"/>
                        </svg>
                    </span>
                </div>
            </div>

            <!-- Error Message -->
            <div id="error-message" class="text-red-500 text-sm mt-2" style="display: none;">
                Invalid credentials. Please check your email and password.
            </div>

            <!-- Forgot Password -->
            <div class="text-right">
                <a href="#" class="text-sm text-gray-500 hover:underline">Forgot your password?</a>
            </div>

            <!-- Login Button -->
            <div>
                <button type="submit" class="mt-4 w-64 h-15 py-3 bg-brown hover:bg-brown-dark text-white font-bold rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brown">
                    Login
                </button>
            </div>

            <!-- Sign Up Link -->
            <div class="mt-4 text-center">
                <p class="text-sm text-gray-700">
                    Don't have an account yet? 
                    <a href="#" class="text-brown font-medium hover:underline">Sign up</a>
                </p>
            </div>
        </form>
    </div>

    <!-- Modal for Account Recovery -->
    <div id="recovery-modal" class="modal flex">
        <div class="modal-content">
            <div id="spinner" class="spinner"></div> <!-- Spinner element -->
            <h2 class="text-xl font-semibold mb-4">Account Locked</h2>
            <p>Your account is locked for 15 minutes.</p>
            <p>If you need immediate access, you can reset your password.</p>
            <button id="reset-password" class="mt-4 w-full bg-brown hover:bg-brown-dark text-white font-semibold py-2 rounded-lg">Reset Your Password</button>
            <button id="close-modal" class="mt-4 w-full bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold py-2 rounded-lg">Close</button>
        </div>
    </div>

    <!-- JavaScript for front-end validation -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('login-form');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const errorMessage = document.getElementById('error-message');
            const togglePassword = document.getElementById('toggle-password');
            const attemptMessage = document.getElementById('attempt-message');
            const recoveryModal = document.getElementById('recovery-modal');
            const closeModalButton = document.getElementById('close-modal');
            const resetPasswordButton = document.getElementById('reset-password');
            const spinner = document.getElementById('spinner');
            let attemptsLeft = 3;
            const lockDuration = 15 * 60 * 1000; // 15 minutes in milliseconds
            let lockEndTime;

            // Show/hide password functionality
            togglePassword.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
            });

            // Form submission event
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                const email = emailInput.value.trim();
                const password = passwordInput.value.trim();

                if (attemptsLeft > 0) {
                    if (email === "" || password === "") {
                        showError("Both fields are required.");
                    } else if (!validateEmail(email)) {
                        showError("Please enter a valid email address.");
                    } else {
                        if (email !== "user@example.com" || password !== "password123") {
                            attemptsLeft--;
                            showError(`Invalid credentials. You have ${attemptsLeft} attempt(s) left.`);
                            if (attemptsLeft === 0) {
                                lockAccount();
                            }
                        } else {
                            errorMessage.style.display = "none";
                            alert("Login successful!");
                        }
                    }
                }
            });

            function lockAccount() {
                lockEndTime = Date.now() + lockDuration;

                const unlockTime = new Date(lockEndTime).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                attemptMessage.innerHTML = `Your account is locked for 15 minutes. It will be unlocked at approximately ${unlockTime}.`;
                form.querySelector('button[type="submit"]').disabled = true;

                // Show the spinner and modal
                spinner.style.display = "block";
                recoveryModal.style.display = "flex";

                setTimeout(unlockAccount, lockDuration);
            }

            function unlockAccount() {
                attemptsLeft = 3;
                attemptMessage.textContent = "You have 3 attempts to log in before your account is locked.";
                form.querySelector('button[type="submit"]').disabled = false;
                recoveryModal.style.display = "none";
                spinner.style.display = "none"; // Hide the spinner once unlocked
            }

            function showError(message) {
                errorMessage.textContent = message;
                errorMessage.style.display = "block";
            }

            function validateEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            closeModalButton.addEventListener('click', () => {
                recoveryModal.style.display = "none";
            });

            resetPasswordButton.addEventListener('click', () => {
                window.location.href = "/reset-password"; // Redirect to reset password page
            });
        });
    </script>
</body>
</html>