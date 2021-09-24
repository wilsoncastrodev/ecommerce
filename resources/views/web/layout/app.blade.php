<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Rubik|Work+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="w-100 d-none d-xl-block">
        @if (request()->route()->getName() == "form.customer.login")
            @include('web.layout.headers.header-login')
        @elseif (request()->route()->getName() == "form.customer.register")
            @include('web.layout.headers.header-register')
        @else
            @include('web.layout.headers.header')
        @endif    

        <main class="py-4">
            @yield('content')
        </main>
        <img src="{{ asset('images/bg-gray.png') }}" class="d-none" id="img-fallback"/>
    </div>

    <div id="app" class="w-100 text-center d-block d-xl-none">
        <h1 class="h1">Responsivo em Construção</h1>
    </div>
</body>
</html>
