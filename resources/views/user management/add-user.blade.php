@extends('layouts.auth-layout')

@section('content')
    <div class="bg-white shadow-lg rounded-lg p-8 md:p-10 lg:p-12 w-full max-w-md md:max-w-xl lg:max-w-2xl text-center">
        <!-- Logo -->

        <!-- Message for attempts -->
        <p id="attempt-message" class="text-sm text-gray-600 mb-4">
            Add new user
        </p>

        <!-- Form -->
        <form action="{{ route('add.user') }}" method="POST" id="login-form" class="space-y-6">
            @csrf
            <div class="text-left">
                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name <span
                        class="text-red-500">*</span></label>
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-brown"
                    placeholder="Enter your email" @error('first_name') style="border-color: red" @enderror>
                @error('first_name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="text-left">
                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name <span
                        class="text-red-500">*</span></label>
                <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-brown"
                    placeholder="Enter your email" @error('last_name') style="border-color: red" @enderror>
                @error('last_name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
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
            {{-- success message --}}
            @if (session('success'))
                <p class="text-green-500 text-sm">{{ session('success') }}</p>
            @endif

            <!-- Add Button -->
            <div>
                <button type="submit"
                    class="mt-4 w-64 h-15 py-3 bg-brown hover:bg-brown-dark text-white font-bold rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brown">
                    Add user
                </button>
            </div>
        @endsection
