<!doctype html>
<html lang="vi-VN">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta name="robots" content="noindex" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{ asset('logo/logo-dtbds.ico') }}"/>
    
    @php
        $config = App\Config::first();
    @endphp
    
    @if( Request::routeIs('Project') )
        @stack('meta')
    @else
        <meta name="description" property="description" content="{{ $config->description }}">
        <meta name="keywords" property="keywords" content="{{ $config->keywords }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="iamge" property="image" content="{{ asset($config->logo) }}">
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

    <script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/lightbox.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/fonts/flaticon/flaticon.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600&display=swap" rel="stylesheet">

    <script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/js/lightbox.js') }}"></script>
    <script src="{{ asset('frontend/js/function.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/js/axios.min.js') }}"></script>
    <script src="{{ asset('frontend/js/notify.min.js') }}"></script>
    
    @if(Request::routeIs('Home'))
    <title>{{ $config->website_name }}</title>
    @else
    <title>@yield('title') - {{ $config->website_name }}</title>
    @endif
    @yield('css')
</head>
<body>

<script>
    $(document).ready(function () {
        $('.nav-one').addClass('fixed-main');
    })
</script>

@include('frontend/header')

@yield('content')

@include('frontend/footer')