@extends('layouts.auth-layout')

@section('content')
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

        {{-- success message --}}
        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('status') }}</span>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('login') }}" method="POST" id="login-form" class="space-y-6">
            @csrf
            <div class="text-left">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span
                        class="text-red-500">*</span></label>
                <input type="text" id="email" name="email" value="{{ old('email') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-brown"
                    placeholder="Enter your email" @error('email') style="border-color: red" @enderror>
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="text-left">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password <span
                        class="text-red-500">*</span></label>
                <div class="relative">
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-brown"
                        placeholder="Enter your password" @error('password') style="border-color: red" @enderror>
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
                @error('password')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Forgot Password -->
            <div class="text-right">
                <a href="{{ route('password.request') }}" class="text-sm text-gray-500 hover:underline">Forgot your
                    password?</a>
            </div>

            {{-- Error message for invalid credentials --}}
            @error('failed')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror

            <!-- Login Button -->
            <div>
                <button type="submit"
                    class="mt-4 w-64 h-15 py-3 bg-brown hover:bg-brown-dark text-white font-bold rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brown">
                    Login
                </button>
            </div>

        </form>
    </div>

    <script>
        // Toggle password visibility and icons
        const togglePassword = document.getElementById('toggle-password');
        const passwordField = document.getElementById('password');
        const eyeShowIcon = document.getElementById('eye-show-icon');
        const eyeSlashIcon = document.getElementById('eye-slash-icon');

        togglePassword.addEventListener('click', function() {
            // Toggle the type attribute
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;

            // Toggle the icons visibility
            if (type === 'password') {
                // Password is hidden, show eye-slash icon
                eyeShowIcon.style.display = 'none';
                eyeSlashIcon.style.display = 'block';
            } else {
                // Password is visible, show eye icon
                eyeShowIcon.style.display = 'block';
                eyeSlashIcon.style.display = 'none';
            }
        });
    </script>
@endsection
