<!DOCTYPE html>
<html lang="vi-VN">
 
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta name="robots" content="noindex" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{ asset('logo/logo-dtbds.ico') }}"/>
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ asset('backend/assets/vendor/fonts/circular-std/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/assets/libs/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/charts/morris-bundle/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/fonts/flag-icon-css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/libs/css/bootstrap4-toggle.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    @php
        $config = App\Config::first();
    @endphp
    <link rel="stylesheet" href="{{ asset('backend/assets/libs/css/custom-style.css') }}">
    <title>@yield('title') - Admin {{ $config->website_name }}</title>
    @yield('css')
</head>

<body>
    <div class="dashboard-main-wrapper">
        @include('backend/topheader')
        @include('backend/sidebar')
        @yield('content')
    </div>
    <script src="{{ asset('backend/assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/js/main-js.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/js/bootstrap4-toggle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/js/app.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/js/main-js.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/multi-select/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/js/axios.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('frontend/js/notify.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    @yield('jquery')
</body>
 
</html>