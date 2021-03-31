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
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Roboto&display=swap" rel="stylesheet">

    <!-- Style -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    <script type="text/javascript" src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="bg-gradient-to-r from-red-700 to-red-600 font-sans text-grey-100 antialiased">
<div class="lg:w-1/2 m-auto mt-10 mb-2">
    <x-title></x-title>
</div>
<div class="w-4/8 m-auto">
    {{ $slot }}
    <div class="lg:w-8/12 m-auto">
        <footer class="grid sm:grid-cols-3 p-5 pl-10 bg-white rounded-lg">
            <div>
                <a class="link" href="http://support.operationsmile.org/site/TR?pg=fund&fr_id=1030&pxfid=39223">To
                    donate, simply smile.</a>
            </div>
            <div>Mail <a class="link" href="mailto:support@whereiscl.com">Support</a></div>
            <div>
                <a class="link" href="https://www.youtube.com/t/terms">YouTube ToS</a>
            </div>
        </footer>
    </div>
</div>
</body>

</html>
