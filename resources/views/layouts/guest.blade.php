<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Where is CL ?</title>
    <meta name="description" content="See cl latest concerts on youtube. Cherry Picked Videos & Fancams.">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

</head>

<body class="bg-red-600 font-sans text-grey-100 antialiased">
    <div class="lg:w-1/2 m-auto mt-10 mb-2">
        <x-title></x-title>
    </div>
    <div class="w-4/8 m-auto">
        {{ $slot }}
    </div>
</body>

</html>