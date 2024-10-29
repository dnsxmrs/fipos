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
            background-color: rgba(228, 228, 228, 0.5);
            /* Background for pop-up */
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
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span
                        class="text-red-500">*</span></label>
                <input type="text" id="email" name="email" value="{{ old('email') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-brown"
                    placeholder="Enter your email"
                    @error('email') style="border-color: red" @enderror>

                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Reset Password Button -->
            <div class="w-full flex justify-center">
                <button type="submit"
                    class="mt-4 w-64 py-3 bg-brown hover:bg-brown-dark text-white font-bold rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brown">
                    Send Password Reset Link
                </button>
            </div>
        </form>

</body>

</html>
