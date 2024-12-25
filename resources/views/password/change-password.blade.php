@extends('layouts.password-layout')

@section('content')
    <div class="bg-white py-10 px-16 rounded-md w-[500px] h-full shadow-lg flex flex-col justify-center items-center">
        <img class="h-20 mb-4 opacity-80 object-cover" src="{{ asset('Assets/Caffeinated Logo 1.png') }}" alt="logo">
        <h1 class="text-xl font-semibold text-gray-600 mb-10 text-center">Change your password</h1>
        <form action="{{ route('change.password') }}" method="POST" class="w-full" id="passwordForm">
            @csrf

            {{-- CURRENT PASSWORD --}}
            <div class="my-2">
                <label class="block mb-1 text-sm text-gray-700">Current Password <span class="text-red-500">*</span></label>
                <div class="mt-1 relative">
                    <input type="password" id="current_password" name="current_password" value="{{ old('current_password') }}"
                        class="border w-full p-3 text-xs font-normal border-gray-200 bg-gray-50 rounded-lg focus:outline-blue-200 text-gray-500"
                        placeholder="Password" @error('current_password') style="border-color: red" @enderror>
                    <span class="absolute inset-y-0 flex items-center cursor-pointer right-3" id="icon-current-password">
                        <img src="{{ asset('Assets/password_hide.png') }}" id="eye-slash-icon-current" class="w-5 h-5 filter grayscale opacity-50">
                        <img src="{{ asset('Assets/password_show.png') }}" id="eye-show-icon-current" class="w-5 h-5 filter grayscale opacity-50 hidden">
                    </span>
                </div>
                @error('current_password')
                    <p class="text-xs mt-1 text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- NEW PASSWORD --}}
            <div class="my-2">
                <label class="block mb-1 text-sm text-gray-700">New Password <span class="text-red-500">*</span></label>
                <div class="mt-1 relative">
                    <input type="password" id="password" name="password"
                        class="border w-full p-3 text-xs font-normal border-gray-200 bg-gray-50 rounded-lg focus:outline-blue-200 text-gray-500"
                        placeholder="Password" @error('password') style="border-color: red" @enderror>
                    <span class="absolute inset-y-0 flex items-center cursor-pointer right-3" id="icon-new-password">
                        <img src="{{ asset('Assets/password_hide.png') }}" id="eye-slash-icon" class="w-5 h-5 filter grayscale opacity-50">
                        <img src="{{ asset('Assets/password_show.png') }}" id="eye-show-icon" class="w-5 h-5 filter grayscale opacity-50 hidden">
                    </span>
                </div>
            </div>

            {{-- CONFIRM PASSWORD --}}
            <div class="my-2">
                <label class="block mb-1 text-sm text-gray-700">Confirm Password <span class="text-red-500">*</span></label>
                <div class="mt-1 relative">
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="border w-full p-3 text-xs font-normal border-gray-200 bg-gray-50 rounded-lg focus:outline-blue-200 text-gray-500"
                        placeholder="Confirm Password" @error('password') style="border-color: red" @enderror>
                    <span class="absolute inset-y-0 flex items-center cursor-pointer right-3" id="icon-confirm-password">
                        <img src="{{ asset('Assets/password_hide.png') }}" id="eye-slash-icon-confirm" class="w-5 h-5 filter grayscale opacity-50">
                        <img src="{{ asset('Assets/password_show.png') }}" id="eye-show-icon-confirm" class="w-5 h-5 filter grayscale opacity-50 hidden">
                    </span>
                </div>
                @error('password')
                    <p class="text-xs mt-1 text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-8 flex justify-center">
                <button type="submit"
                    class=" w-64 py-2 bg-green-700 text-white font-medium text-sm rounded-full hover:bg-green-800">Save
                    Changes</button>
            </div>
        </form>
    </div>

    {{-- SUCCESS MODAL --}}
    <div id="success-modal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50">
        <div class="bg-white rounded-lg p-8 w-80 text-center">
            <h2 class="text-lg font-bold text-green-600 mb-4">Success!</h2>
            <p class="text-sm text-gray-600 mb-6">Your password has been changed successfully.</p>
            <a href="{{ route('password.skip') }}"
                class="bg-green-700 text-white py-2 px-7 rounded-full hover:bg-green-800">Close</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('success-modal');
            const closeModal = document.getElementById('close-modal');

            @if (session('status'))
                modal.classList.remove('hidden');
            @endif

            closeModal.addEventListener('click', () => {
                modal.classList.add('hidden');
            });
        });
    </script>
@endsection
