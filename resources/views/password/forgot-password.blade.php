@extends('layouts.password-layout')

@section('content')

    <!-- Modal -->
    <div id="reset-modal" class="modal bg-white shadow-lg rounded-lg p-10 flex flex-col items-center text-center">
        <!-- Reset Password Header -->
        <img class="h-20 mb-5 opacity-80 object-cover" src="{{ asset('Assets/Caffeinated Logo 1.png') }}" alt="logo">
        <h2 class="text-xl font-semibold text-gray-600 mb-4">Reset Password</h2>
        <p class="text-sm text-gray-700 mb-5">
            Please enter the email address you used to register your account.
        </p>

        {{-- success message --}}
        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('status') }}</span>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('password.request') }}" method="POST" id="reset-form" class="space-y-6 w-full flex flex-col items-center">
            @csrf
            <div class="w-full flex flex-col items-start">
                <label class="mb-1 text-sm text-gray-600">Email <span class="text-red-500">*</span></label>
                <input type="text" id="email" name="email" value="{{ old('email') }}"
                    class="w-full px-4 py-2 bg-gray-50 text-sm text-gray-600 border border-gray-300 rounded-md focus:outline-none focus:border-brown"
                    placeholder="Enter your email"
                    @error('email') style="border-color: red" @enderror>

                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Reset Password Button -->
            <div class="w-full flex justify-center">
                <button type="submit"
                    class="mt-4 w-64 py-3 bg-green-600 text-white font-bold rounded-full hover:bg-green-700 text-sm">
                    Send Password Reset Link
                </button>
            </div>

            <a href="{{ route('login') }}" class="hover:underline italic text-xs font-medium text-green-800 text-opacity-70">Go back to Login</a>
        </form>
    </div>

@endsection
