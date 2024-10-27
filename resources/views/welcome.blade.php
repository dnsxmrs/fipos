<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CaffeinatedPOS - Account Setup</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Import the Barlow font */
        @import url('https://fonts.googleapis.com/css2?family=Barlow:wght@400;700&display=swap');

        body {
        font-family: 'Barlow', sans-serif;
        }
        /* Initially hide the password requirements */
        #password-requirements {
            display: none;
        }
        /* Styles for password requirement items */
        .requirement {
            display: flex;
            align-items: center;
        }
        .requirement span {
            margin-right: 8px;
        }
        /* Custom button styles */
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
<body class="flex items-center justify-center min-h-screen relative">
    <!-- Background image using img tag -->
    <img src="public/assets/coffee-picture-bg.png" alt="Background Image" class="absolute inset-0 w-full h-full object-cover z-0">

    <!-- Content Container -->
    <div class="bg-white shadow-lg rounded-lg w-full max-w-screen-lg p-12 relative z-10">
        <!-- Logo and Title -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold text-gray-800">Caffeinated<span style="color: #451a03;">POS</span></h1>
            <p class="text-2xl font-medium text-gray-800">ADMIN</p>
            <p class="text-xl text-gray-800">ACCOUNT SETUP</p>
        </div>

        <!-- Form -->
        <form id="account-form" class="space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div>
                    <label class="block text-base font-medium text-[#4b2e16] mb-2" for="first-name">
                        First Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="first-name" required class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:border-[#4b2e16]">
                    <p class="mt-1 text-sm text-red-500" id="first-name-error"></p>
                </div>
                <div>
                    <label class="block text-base font-medium text-[#4b2e16] mb-2" for="last-name">
                        Last Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="last-name" required class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:border-[#4b2e16]">
                    <p class="mt-1 text-sm text-red-500" id="last-name-error"></p>
                </div>
                <div class="md:col-span-2 lg:col-span-1">
                    <label class="block text-base font-medium text-[#4b2e16] mb-2" for="email">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="email" required class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:border-[#4b2e16]">
                    <p class="mt-1 text-sm text-red-500" id="email-error"></p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-base font-medium text-[#4b2e16] mb-2" for="password">
                        Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" id="password" required class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:border-[#4b2e16]">
                        <span class="absolute inset-y-0 right-3 flex items-center">
                            <!-- Eye Icon -->
                            <svg id="toggle-password" class="w-6 h-6 text-gray-500 cursor-pointer" fill="none" viewBox="0 0 24 24">
                                <path id="eye-icon" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path id="eye-icon-path" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7-4.477 7-9.542 7-8.268-2.943-9.542-7z"/>
                            </svg>
                        </span>
                    </div>
                    <!-- Password requirements (Initially hidden) -->
                    <ul class="mt-2 text-xs" id="password-requirements">
                        <li class="requirement" id="req-length">
                            <span>&#10060;</span>Password must be at least 8 characters long.
                        </li>
                        <li class="requirement" id="req-uppercase">
                            <span>&#10060;</span>Include at least one uppercase letter.
                        </li>
                        <li class="requirement" id="req-lowercase">
                            <span>&#10060;</span>Include at least one lowercase letter.
                        </li>
                        <li class="requirement" id="req-number">
                            <span>&#10060;</span>Include at least one number.
                        </li>
                        <li class="requirement" id="req-special">
                            <span>&#10060;</span>Include at least one special character.
                        </li>
                    </ul>
                    <!-- Password strength indicator -->
                    <p class="mt-1 text-sm" id="password-strength-text"></p>
                </div>
                <div>
                    <label class="block text-base font-medium text-[#4b2e16] mb-2" for="confirm-password">
                        Confirm Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" id="confirm-password" required class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:border-[#4b2e16]">
                        <span class="absolute inset-y-0 right-3 flex items-center">
                            <!-- Eye Icon -->
                            <svg id="toggle-confirm-password" class="w-6 h-6 text-gray-500 cursor-pointer" fill="none" viewBox="0 0 24 24">
                                <path id="eye-icon-confirm" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path id="eye-icon-path-confirm" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7-4.477 7-9.542 7-8.268-2.943-9.542-7z"/>
                            </svg>
                        </span>
                    </div>
                    <p class="mt-1 text-sm text-red-500" id="confirm-password-error"></p>
                </div>
            </div>

            <!-- Checkbox -->
            <div class="flex justify-center mt-6">
                <input type="checkbox" id="terms" required class="h-5 w-5 text-[#4b2e16] focus:ring-[#4b2e16] border-gray-300 rounded">
                <label for="terms" class="ml-3 block text-base text-[#4b2e16]">
                    I have fully read, understood, and agree to the Data Privacy Policy, Terms & Conditions.
                </label>
            </div>

            <!-- Submit Button -->
            <!-- Account Setup Form -->
            <form id="account-form" method="POST" action="{{ route('account-setup') }}" class="space-y-8">
            @csrf
            <!-- Submit Button -->
            <div class="mt-8 flex justify-center"> 
                    <button type="submit" class="mt-2 w-64 h-15 py-4 bg-brown hover:bg-brown-dark text-white text-lg font-bold rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brown text-center">
                    Create Account
                    </button>
                </div>
            </form>

            <!-- Sign In Link -->
            <div class="mt-4 text-center">
                <p class="text-base text-gray-700">
                    Already have an account?
                    <a href="#" class="text-[#4b2e16] font-medium hover:underline">Sign in</a>
                </p>
            </div>
        </form>
    </div>

    <!-- JavaScript for form validation and show/hide password -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('account-form');
            const firstNameInput = document.getElementById('first-name');
            const lastNameInput = document.getElementById('last-name');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirm-password');
            const togglePassword = document.getElementById('toggle-password');
            const toggleConfirmPassword = document.getElementById('toggle-confirm-password');
            const passwordStrengthText = document.getElementById('password-strength-text');
            const emailError = document.getElementById('email-error');
            const firstNameError = document.getElementById('first-name-error');
            const lastNameError = document.getElementById('last-name-error');
            const confirmPasswordError = document.getElementById('confirm-password-error');
            const passwordRequirements = document.getElementById('password-requirements');

            const reqLength = document.getElementById('req-length');
            const reqUppercase = document.getElementById('req-uppercase');
            const reqLowercase = document.getElementById('req-lowercase');
            const reqNumber = document.getElementById('req-number');
            const reqSpecial = document.getElementById('req-special');

            // Show/hide password functionality
            togglePassword.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                // Toggle eye icon
                toggleEyeIcon(togglePassword, type);
            });

            toggleConfirmPassword.addEventListener('click', function () {
                const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPasswordInput.setAttribute('type', type);

                // Toggle eye icon
                toggleEyeIcon(toggleConfirmPassword, type);
            });

            function toggleEyeIcon(iconElement, type) {
                if (type === 'password') {
                    // Show eye icon
                    iconElement.innerHTML = `
                        <path id="eye-icon" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path id="eye-icon-path" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7-4.477 7-9.542 7-8.268-2.943-9.542-7z"/>
                    `;
                } else {
                    // Show eye-off icon
                    iconElement.innerHTML = `
                        <path id="eye-off-icon" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.269-2.944-9.543-7a10.06 10.06 0 012.167-3.272M6.281 6.281A9.955 9.955 0 0112 5c4.478 0 8.269 2.944 9.543 7a10.06 10.06 0 01-1.302 2.418M9.88 9.88a3 3 0 104.24 4.24"/>
                        <line x1="3" y1="3" x2="21" y2="21" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                    `;
                }
            }

            // Show password requirements when password field is focused
            passwordInput.addEventListener('focus', function () {
                passwordRequirements.style.display = 'block';
            });

            // Hide password requirements when password field loses focus
            passwordInput.addEventListener('blur', function () {
                passwordRequirements.style.display = 'none';
            });

            // Name validation (numbers not allowed)
            function validateName(inputField, errorField) {
                inputField.addEventListener('input', function () {
                    const nameRegex = /^[A-Za-z\s'-]+$/;
                    if (!nameRegex.test(inputField.value)) {
                        errorField.textContent = 'Numbers are not allowed in names.';
                    } else {
                        errorField.textContent = '';
                    }
                });
            }

            validateName(firstNameInput, firstNameError);
            validateName(lastNameInput, lastNameError);

            // Email format validation
            emailInput.addEventListener('input', function () {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailInput.value)) {
                    emailError.textContent = 'Please enter a valid email address.';
                } else {
                    emailError.textContent = '';
                }
            });

            // Password validation
            passwordInput.addEventListener('input', function () {
                const password = passwordInput.value;
                const errors = validatePassword(password);

                // Update requirement list
                updateRequirement(reqLength, password.length >= 8);
                updateRequirement(reqUppercase, /[A-Z]/.test(password));
                updateRequirement(reqLowercase, /[a-z]/.test(password));
                updateRequirement(reqNumber, /[0-9]/.test(password));
                updateRequirement(reqSpecial, /[^A-Za-z0-9]/.test(password));

                // Update password strength
                const strength = calculatePasswordStrength(password);
                passwordStrengthText.textContent = `Password Strength: ${strength}`;
                if (strength === 'Weak') {
                    passwordStrengthText.style.color = 'red';
                } else if (strength === 'Medium') {
                    passwordStrengthText.style.color = 'orange';
                } else {
                    passwordStrengthText.style.color = 'green';
                }
            });

            function updateRequirement(element, isValid) {
                const icon = element.querySelector('span');
                if (isValid) {
                    icon.textContent = '✔️';
                    icon.style.color = 'green';
                    element.style.color = 'green';
                } else {
                    icon.textContent = '❌';
                    icon.style.color = 'red';
                    element.style.color = 'red';
                }
            }

            // Confirm password validation
            confirmPasswordInput.addEventListener('input', function () {
                if (confirmPasswordInput.value !== passwordInput.value) {
                    confirmPasswordError.textContent = 'Passwords do not match.';
                } else {
                    confirmPasswordError.textContent = '';
                }
            });

            // Form submission
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                // Check for errors before submission
                const passwordErrors = validatePassword(passwordInput.value);
                const firstNameValid = /^[A-Za-z\s'-]+$/.test(firstNameInput.value);
                const lastNameValid = /^[A-Za-z\s'-]+$/.test(lastNameInput.value);

                if (
                    emailError.textContent ||
                    confirmPasswordError.textContent ||
                    passwordErrors.length > 0 ||
                    !firstNameValid ||
                    !lastNameValid
                ) {
                    alert('Please fix the errors in the form before submitting.');
                    return;
                }

                // If all validations pass, redirect to the confirmation page
                window.location.href = 'resources/views/sign-up-confirmation.php';
            });

            function calculatePasswordStrength(password) {
                let strength = 'Weak';
                const patterns = [
                    '[A-Z]', // Uppercase
                    '[a-z]', // Lowercase
                    '[0-9]', // Numbers
                    '[^A-Za-z0-9]' // Special characters
                ];
                let score = 0;

                patterns.forEach(pattern => {
                    if (new RegExp(pattern).test(password)) {
                        score++;
                    }
                });

                if (password.length >= 8 && score === 4) {
                    strength = 'Strong';
                } else if (password.length >= 8 && score >= 3) {
                    strength = 'Medium';
                }

                return strength;
            }

            function validatePassword(password) {
                const errors = [];
                if (password.length < 8) {
                    errors.push('Password must be at least 8 characters long.');
                }
                if (!/[A-Z]/.test(password)) {
                    errors.push('Include at least one uppercase letter.');
                }
                if (!/[a-z]/.test(password)) {
                    errors.push('Include at least one lowercase letter.');
                }
                if (!/[0-9]/.test(password)) {
                    errors.push('Include at least one number.');
                }
                if (!/[^A-Za-z0-9]/.test(password)) {
                    errors.push('Include at least one special character.');
                }
                return errors;
            }
        });
    </script>
</body>
</html>
