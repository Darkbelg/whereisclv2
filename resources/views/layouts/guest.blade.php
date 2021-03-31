<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Where is CL ?</title>
    <meta name="description" content="See cl latest concerts on youtube. Cherry Picked Videos & Fancams.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Roboto&display=swap" rel="stylesheet">     <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="bg-gradient-to-r from-red-700 to-red-600 font-sans text-grey-100 antialiased">
<div class="lg:w-1/2 m-auto mt-10 mb-2">
    <x-title></x-title>
</div>
<div class="w-4/8 m-auto">
    {{ $slot }}
</div>
</body>

</html>
