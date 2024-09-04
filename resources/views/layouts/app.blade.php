<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('style/style.css') }}">

    <style>
        body {
            background-image: url("{{ asset('image/background.png') }}");
            background-attachment: fixed;
            background-size: 35%;
        }
    </style>
</head>
<body>
    <div id="app">
        @include('layouts.components.navbar')

        <main class="py-4">
            <div class="btn-group dropup">
                <button type="button" class="z-1 btn btn-secondary position-fixed bottom-0 end-0 m-4 border-0 rounded-circle" data-bs-toggle="dropdown" aria-expanded="false" style="width:60px;height:60px;">
                    <i class="fa-solid fa-plus"></i>
                </button>
                <div class="dropdown-menu border-0" style="background-color:rgba(0,0,0,0)!important;">
                    <button type="button" class="z-1 float-end btn btn-primary border-0 rounded-circle" style="width:60px;height:60px;" title="Tracking">
                        <i class="fa-solid fa-location-crosshairs"></i>
                    </button><br>
                    <button type="button" class="z-1 float-end btn btn-primary border-0 rounded-circle" style="width:60px;height:60px;" title="Keranjang">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </button>
                </div>
            </div>
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('script/fa.js') }}"></script>
    <script src="{{ asset('script/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
