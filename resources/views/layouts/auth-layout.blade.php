<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{ env('APP_NAME') }} </title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script defer src="{{ asset('js/login.js') }}"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cover bg-center min-h-screen" style="background-image: url('{{ asset('Assets/background.png') }}'); font-family:Poppins">

    <div class="flex items-center justify-center min-h-screen bg-[#1C3D34] bg-opacity-80 w-full">
        <div class="mx-20">
            @yield('auth_content')
        </div>
    </div>

</body>
</html>
