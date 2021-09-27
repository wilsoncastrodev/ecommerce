<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <script src="{{ asset('js/app.js') }}" defer></script>

        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="app-admin">
        <div class="d-none d-xl-block w-100">
            @auth
                <div class="vertical-menu position-fixed z-index-100">
                    @include('layouts.navbars.sidebar')
                </div>
                <div>
                    @include('layouts.headers.header')
                </div>
            @endauth

            <div class="main-content {{ request()->route()->getName() == 'login' ? 'main-content-login' : '' }}">
                <div class="page-content">
                    <div class="content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <div class="d-block d-xl-none">
            <h1 class="h1">Responsivo em Construção</h1>
        </div>
    </body>
</html>
