<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Where is CL ?</title>
    <meta name="description" content="See cl latest concerts on youtube. Cherry Picked Videos & Fancams.">

    <!-- Fonts -->
    <link rel="preload" as="font" href="fonts/playfair-display-regular.ttf" type="font/ttf" crossorigin="anonymous">
    <link rel="preload" as="font" href="fonts/roboto-regular.ttf" type="font/ttf" crossorigin="anonymous">

    <!-- Style -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    <script type="text/javascript" src="{{ mix('js/app.js') }}" defer></script>
    <script type="text/javascript" src="{{ mix('js/manifest.js') }}" defer></script>
    <script type="text/javascript" src="{{ mix('js/vendor.js') }}" defer></script>

    <!-- Start Open Web Analytics Tracker -->
    <script type="text/javascript" defer>
        //<![CDATA[
        var owa_baseUrl = 'https://analytics.whereiscl.com/';
        var owa_cmds = owa_cmds || [];
        owa_cmds.push(['setSiteId', 'e1bacd0c2a5934d9c1a3205b9dc8e8bf']);
        owa_cmds.push(['trackPageView']);
        owa_cmds.push(['trackClicks']);

        (function() {
            var _owa = document.createElement('script'); _owa.type = 'text/javascript'; _owa.async = true;
            owa_baseUrl = ('https:' == document.location.protocol ? window.owa_baseSecUrl || owa_baseUrl.replace(/http:/, 'https:') : owa_baseUrl );
            _owa.src = owa_baseUrl + 'modules/base/js/owa.tracker-combined-min.js';
            var _owa_s = document.getElementsByTagName('script')[0]; _owa_s.parentNode.insertBefore(_owa, _owa_s);
        }());
        //]]>
    </script>
    <!-- End Open Web Analytics Code -->
</head>

<body class="bg-gradient-to-r from-red-700 to-red-600 font-sans text-grey-100 antialiased">
<div class="lg:w-1/2 m-auto mt-10 mb-2">
    <x-title></x-title>
    <div>
        <a href="/world-map">World-map</a>
    </div>
</div>
<div class="w-4/8 m-auto">
    {{ $slot }}
    <div class="fixed bottom-0 right-0">
        <footer class="grid p-5 pl-10 bg-gray-100 rounded-tl-lg text-right">
            <div>
                <a class="link" href="http://support.operationsmile.org/site/TR?pg=fund&fr_id=1030&pxfid=39223">To
                    donate, simply smile.
                </a>
            </div>
            <div>Mail <a class="link" href="mailto:support@whereiscl.com">Support</a></div>
            <div>
                @if(request()->routeIs('privacy-policy'))
                    {{ __('Privacy Policy') }}
                @else
                    <a href="{{ route('privacy-policy')  }}" class="link">
                        {{ __('Privacy Policy') }}
                    </a>
                @endif
            </div>
        </footer>
    </div>
</div>
</body>

</html>
