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
            background-color: rgba(228, 228, 228, 0.5); /* Background for pop-up */
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
        <h2 class="text-2xl font-bold text-brown mb-4">Reset Password</h2>
        <p class="text-sm text-gray-700 mb-8">
            Please enter the email address you used to register your account.
        </p>

        <!-- Form -->
        <form id="reset-form" class="space-y-6 w-full flex flex-col items-center">
            <div class="w-full flex flex-col items-start">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                <input type="email" id="email" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-brown" placeholder="Enter your email">
                <p id="email-error" class="text-red-500 text-sm mt-1" style="display: none;">Invalid email address.</p>
                <p id="no-account-error" class="text-red-500 text-sm mt-1" style="display: none;">No account found with that email address.</p>
            </div>

            <!-- Reset Password Button -->
            <div class="w-full flex justify-center">
                <button type="submit" class="mt-4 w-64 py-3 bg-brown hover:bg-brown-dark text-white font-bold rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brown">
                    Reset Password
                </button>
            </div>
        </form>

        <!-- Back to Login Link -->
        <div class="mt-8 text-center">
            <a href="#" class="text-brown text-sm font-medium hover:underline">Back to login</a>
        </div>
    </div>

    <!-- JavaScript for Front-End Validation -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('reset-form');
            const emailInput = document.getElementById('email');
            const emailError = document.getElementById('email-error');
            const noAccountError = document.getElementById('no-account-error');

            // Sample list of registered emails (for simulation purposes)
            const registeredEmails = ["user1@example.com", "user2@example.com", "user3@example.com"];

            form.addEventListener('submit', function (e) {
                e.preventDefault();
                const emailValue = emailInput.value.trim();

                // Validate email format
                if (!validateEmail(emailValue)) {
                    emailError.textContent = "Invalid email address.";
                    emailError.style.display = "block";
                    noAccountError.style.display = "none"; // Hide the no-account error if email format is invalid
                } else if (!registeredEmails.includes(emailValue)) {
                    // Simulate checking if email exists
                    emailError.style.display = "none";
                    noAccountError.textContent = "No account found with that email address.";
                    noAccountError.style.display = "block";
                } else {
                    // Email is valid and exists
                    emailError.style.display = "none";
                    noAccountError.style.display = "none";
                    alert("If this email is registered, a password reset link will be sent.");
                }
            });

            // Email validation function using regex
            function validateEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }
        });
    </script>
</body>
</html>