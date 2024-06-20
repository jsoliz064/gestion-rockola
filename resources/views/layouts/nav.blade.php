<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .nav {
            background: linear-gradient(90deg, #882121, #cc2f2f);
            padding: 0;
        }
    </style>
    <title>@yield('title')</title>
</head>

<body>
    <nav class="navbar nav">
        <div class="container">
            <div class="row py-1">
                <div class="col d-flex justify-content">
                    <img src="{{ asset('img/logoRockola.png') }}" width="45" height="40"
                        class="d-inline-block align-top">
                    <label class="px-2" style="color: white; align-content: center"><b>Rockola Digital</b></label>
                </div>
            </div>
        </div>
    </nav>
    @yield('content')
    @yield('js')
</body>

</html>
