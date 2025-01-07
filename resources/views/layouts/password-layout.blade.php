<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{ env('APP_NAME') }} </title>
    <link rel="icon" href="{{ asset('Assets/logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script defer src="{{ asset('js/change-password.js') }}"></script>

    {{-- <script src="https://fipos-production.up.railway.app/js/change-password.js"> </script>

    <script src="https://cdn.tailwindcss.com"></script> --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-50" style="font-family:Poppins">

        <div class="mx-20">
            @yield('content')
        </div>

</body>
</html>
