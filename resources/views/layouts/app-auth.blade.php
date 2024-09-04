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
            background-image: url("{{ asset('image/background-nav.jpg') }}");
            background-attachment: fixed;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body>
    <div id="app">
        <main class="py-4">
            <div class="container d-flex-column align-items-center justify-content-center pt-1">
                <div class="d-flex align-items-center justify-content-center my-3">
                    <img src="{{ asset('image/icon.png') }}" class="img-fluid me-2" style="width:75px;" alt="Logo">
                    <h1 class="text-head">
                        PLUS-H
                    </h1>
                </div>
                <div class="mx-auto" style="width:40%;min-width:300px;">
                    @yield('alert')
                </div>
                <div class="position-relative container card py-3" style="width:40%;min-width:300px;">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    <script src="{{ asset('script/fa.js') }}"></script>
    @yield('script')
</body>
</html>
