@php
    App::setLocale(Session::get('locale'))
@endphp
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- TODO cambiar ruta en despliegue -->
    <base href="http://localhost/FINAL-SOX/sox/public/"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SOX') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Snap.svg -->
    <script src="{{ asset('snap.svg-min.js') }}"></script>
</head>
<body>

<div class="container">
    <div class="col-12 text-center my-auto">
        <svg width="600px" height="600px" id="svgoops"></svg>
    </div>
</div>

<script>
    window.onload = function () {
        var s = Snap("#svgoops");
        s.attr({viewBox: "0 0 800 600"});

        var r = s.rect(100, 100, 600, 400).attr({fill: '#343A40'});
        var t = s.text(150, 275, 'Ooops').attr({fontSize: '6rem', fontFamily: 'Bebas Neue', fill: '#F9F9F9'});
        var dot = s.text(350, 275, '.').attr({fontSize: '7rem', fontFamily: 'Bebas Neue', fill: '#F9F9F9'});
        var dot2 = s.text(375, 275, '.').attr({fontSize: '7rem', fontFamily: 'Bebas Neue', fill: '#F9F9F9'});

        function blink() {
            var dota = s.text(400, 275, '.').attr({fontSize: '8rem', fontFamily: 'Bebas Neue', fill: '#F9F9F9'});
            dota.animate({opacity: 1}, 200, function () {
                dota.animate({opacity: 0}, 200);
            });
        };

        setInterval(blink, 1000);

        var sox = s.text(350, 450, 'Sox not').attr({fontSize: '3rem', fontFamily: 'Bebas Neue', fill: '#f7db01'});
        var found = s.text(495, 450, 'found').attr({fontSize: '5rem', fontFamily: 'Bebas Neue', fill: '#f7db01'});

        found.hover(function hoverIn() {
            found.animate({
                transform: "s1.2,t"
            }, 100);

        }, function hoverOut() {
            found.animate({
                transform: "s1,t"
            }, 100);

        });

        found.click(function () {
            // TODO: cambiar url final
            window.location = "http://localhost/sox/public/";
        });

        found.node.id = "found404";
    }
</script>
</body>
</html>
