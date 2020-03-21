<!doctype html>
<html lang="en">
<head>
    @php
        $config = App\Config::first();
    @endphp
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @if(Request::routeIs('Home'))
        <title>{{ $config->website_name }}</title>
    @else
        <title>@yield('title') - {{ $config->website_name }}</title>
    @endif
    @if( Request::routeIs('Project') )
        @stack('meta')
    @else
        <meta name="description" property="description" content="{{ $config->description }}">
        <meta name="keywords" property="keywords" content="{{ $config->keywords }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="image" property="image" content="{{ asset($config->logo) }}">
        <meta property="og:url" content="{{ asset('/') }}">

        <meta property="og:title" content="{{ $config->website_name }}">
        <meta property="og:description" content="{{ $config->description }}">
        <meta property="og:type" content="website">
        <meta property="og:image" content="{{ asset($config->logo) }}">
        <meta property="og:image:alt" content="{{ $config->website_name }}">
        <meta property="og:image:width" content="200">
        <meta property="og:image:height" content="200">

        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="{{ $config->website_name }}">
        <meta name="twitter:description" content="{{ $config->description }}">
        <meta name="twitter:creator" content="{{ $config->website_name }}">
        <meta name="twitter:image:src" content="{{ asset($config->logo) }}">
        <meta name="twitter:domain" content="{{ asset('/') }}">
    @endif
    <link rel="stylesheet dns-prefetch" href="{{ asset('assets/fonts/fontawesome/css/all.css') }}">
    <link rel="stylesheet dns-prefetch" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet dns-prefetch" href="{{ asset('assets/scss/main.css') }}">
    @stack('css')
</head>
<body class="bg-black text-sm mt-18">

<x-header/>
@yield('content')
@include('client.footer')

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
<script src="{{ asset('assets/js/actions.js') }}"></script>
@stack('script')
</body>
</html>