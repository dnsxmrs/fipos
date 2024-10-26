<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caffeinated</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>

      body {
        font-family: 'Barlow', sans-serif;
      }
    </style>
</head>
<body>
    @include("navigation.admin-sidebar")
    <main>
        <!--maindiv-->
       <div>
        <div> <!--product-content-->
            @yield("content")
        </div>
       </div>
    </main>
</body>
</html>
