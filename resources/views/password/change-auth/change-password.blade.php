<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Barlow:wght@400;600&display=swap');
        body {
            font-family: 'Barlow', sans-serif;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-white">
    <div class="bg-[#F3F3F3] p-8 rounded-md w-[595px] h-[495px] shadow-lg flex flex-col justify-center items-center">
        <h1 class="text-2xl font-bold mb-4 text-center">Change your password</h1>
        <form action="{{route('change.password')}}" method="POST" class="w-full" id="passwordForm">
            @csrf
            <div class="mb-4">
                <label class="block mb-1 text-gray-700">Current Password <span class="text-red-500">*</span></label>
                <input type="password" id="current_password" name="current_password" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-gray-200" placeholder="Enter your current password" @error('current_password') style="border-color: red" @enderror>
                @error('current_password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block mb-1 text-gray-700">New Password <span class="text-red-500">*</span></label>
                <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-gray-200" placeholder="Enter password" @error('password') style="border-color: red" @enderror>
            </div>
            <div class="mb-6">
                <label class="block mb-1 text-gray-700">Confirm Password <span class="text-red-500">*</span></label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-gray-200" placeholder="Confirm password" @error('password') style="border-color: red" @enderror>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-8 flex justify-center">
                <button type="submit" class="mt-5 w-64 py-2 bg-[#451a03] text-white font-semibold rounded hover:bg-[#78350f]">Save Changes</button>
            </div>
        </form>
    </div>

</body>
</html>
