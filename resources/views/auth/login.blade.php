@extends('layouts.auth-layout')

@section('auth_content')
    <div class="bg-white rounded-lg p-10 shadow-md">
        <div class="w-full h-full flex flex-col items-center justify-evenly">
            <img class="h-24 object-cover" src="{{ asset('Assets/Caffeinated Logo 1.png') }}" alt="logo">

            {{-- success message --}}
            @if (session('status'))
                <div class="relative px-4 py-3 text-green-700 bg-green-100 border border-green-400 rounded" role="alert">
                    <span class="block sm:inline">{{ session('status') }}</span>
                </div>
            @endif

            <!-- Form -->
            <form class="w-full p-5 flex flex-col items-center justify-center" action="{{ route('login') }}" method="POST"
                id="login-form">
                @csrf

                <div class="mt-10">
                    <input type="text" id="email" name="email" value="{{ old('email') }}"
                        class="border w-80 p-3 text-xs font-normal border-gray-200 bg-gray-100 rounded-lg focus:border-blue-400 outline-1 text-gray-500 focus:ring-0"
                        placeholder="Email" @error('email') style="border-color: red" @enderror>
                    @error('email')
                        <p class="text-xs pl-1 mt-1 text-red-500">{{ $message }}</p>
                    @enderror
                    <div id="email-error" class=" text-red-500 w-80 text-xs mt-2 ml-1 block"></div>
                </div>
                <div class="mt-5 relative">
                    <input type="password" id="password" name="password"
                        class="border w-80 p-3 text-xs font-normal border-gray-200 bg-gray-100 rounded-lg focus:border-blue-400 outline-1 text-gray-500 focus:ring-0"
                        placeholder="Password" @error('password') style="border-color: red" @enderror>

                    <span class="absolute inset-y-0 flex items-center cursor-pointer right-3" id="toggle-password">
                        <!-- Hidden Eye Slash icon (for password hidden) -->
                        <div id="eye-slash-icon" style="display: block;" class="w-5 h-5">
                            <img src="{{ asset('Assets/password_hide.png') }}" alt="hide password icon"
                                class="filter grayscale opacity-50">
                        </div>

                        <!-- Show Eye icon (for password visible) -->
                        <div id="eye-show-icon" style="display: none;" class="w-5 h-5">
                            <img src="{{ asset('Assets/password_show.png') }}" alt="show password icon"
                                class="filter grayscale opacity-50">
                        </div>
                    </span>
                </div>
                <div class="w-full pl-1">
                    @error('password')
                        <p class="text-xs mt-1 text-red-500">{{ $message }}</p>
                    @enderror
                    <div id="password-error" class=" text-red-500 w-80 text-xs mt-2 ml-1 block"></div>
                </div>

                <div class="w-full  text-right mr-2 mt-2">
                    <a href="{{ route('password.request') }}"
                        class="hover:underline italic text-xs font-medium text-green-800 text-opacity-70" href="">Forgot
                        password?</a>
                </div>

                {{-- Error message for invalid credentials --}}
                @error('failed')
                    <p class="text-xs mt-2 text-red-500">{{ $message }}</p>
                @enderror

                <button
                    class="text-white w-60 px-10 py-2 text-center text-sm mt-6 rounded-full bg-green-900 bg-opacity-90 hover:bg-opacity-100 shadow-lg"
                    type="submit">Login</button>

            </form>
        </div>
    </div>
@endsection
