@extends('layouts.password-layout')

@section('content')
    <!-- Modal -->
    <div id="reset-modal" class="modal bg-white shadow-lg rounded-lg py-10 px-16 flex flex-col items-center text-center">
        <!-- Reset Password Header -->
        <h2 class="text-2xl font-semibold text-brown mb-4">Notice!</h2>
        <p class="text-sm text-gray-700 mb-8 text-wrap">
            It seems that this is your first time logging in <span class="font-semibold text-amber-900">{{ env('APP_NAME') . '.' }}</span> We recommend changing your password.
        </p>

        {{-- Continue button --}}
        <a href="{{ route('change.password') }}"
            class="w-64 py-3 bg-green-800 hover:bg-green-700 text-white font-bold rounded-xl">
            Continue
        </a>
        <a href="{{ route('password.skip') }}" class="mt-4 text-green-800 text-sm italic hover:underline">Skip for now</a>

    </div>

@endsection
