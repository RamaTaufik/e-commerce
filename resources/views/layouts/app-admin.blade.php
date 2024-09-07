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
</head>
<body>
    <div id="app">
        @include('layouts.components.navbar-admin')

        <main class="py-4">
            <div class="row w-100">
                <div class="col-md-3 border-end">
                    @include('layouts.components.sidebar-admin')
                </div>
                <div class="col-12 col-md-9">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    <script src="{{ asset('script/fa.js') }}"></script>
    <script src="{{ asset('script/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('script/chart.js') }}"></script>
</body>
</html>
