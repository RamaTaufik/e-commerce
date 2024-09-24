<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('image/icon.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('style/style.css') }}">
    <link rel="stylesheet" href="{{ asset('style/flickity.css') }}">

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
            <a href="{{ route('cart') }}" class="z-1 btn btn-secondary position-fixed bottom-0 end-0 m-4 border-0 rounded-circle" style="padding:20px;" title="Keranjang">
                <i class="fa-solid fa-cart-shopping"></i>
            </a>
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('script/fa.js') }}"></script>
    <script src="{{ asset('script/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('script/flickity.pkgd.min.js') }}"></script>
    @yield('script')
</body>
</html>
