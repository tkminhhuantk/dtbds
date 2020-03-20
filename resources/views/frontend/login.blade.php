@php
    $config = App\Config::first();
@endphp
<!doctype html>
<html lang="vi-VN">
 
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta name="robots" content="noindex" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Đăng nhập - {{ $config->website_name }}</title>
    
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
    
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ asset('backend/assets/vendor/fonts/circular-std/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/assets/libs/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    .card-footer-item a:hover{
        color: #ae0101!important;
    }
    .color-red{ color: red; }
    </style>
</head>

<body>
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center">
                <a href="{{ route('Home') }}">
                    <h2 style='font-family: "Google-sans",sans-serif !important; font-weight: bold; color: #ae0101!important;'>ĐẦU TƯ BĐS</h2>
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('postLogin') }}" method="post" id="frm-login">
                    @csrf
                    <div class="form-group">
                        <input name="email" class="form-control form-control-lg" id="email" type="text" placeholder="Email" autocomplete="off" style='font-family: "Google-sans",sans-serif !important;' value="{{  old('email') }}">
                    </div>
                    @error('email')
                    <div class="form-group">
                        <div class="color-red" style='font-family: "Google-sans",sans-serif !important;'>
                            {{ $message }}
                        </div>
                    </div>
                    @enderror
                    <div class="form-group">
                        <input name="password" class="form-control form-control-lg" id="password" type="password" placeholder="Mật khẩu" style='font-family: "Google-sans",sans-serif !important;' value="{{ old('password') }}">
                    </div>
                    @error('password')
                    <div class="form-group">
                        <div class="color-red" style='font-family: "Google-sans",sans-serif !important;'>
                            {{ $message }}
                        </div>
                    </div>
                    @enderror
                    @if(session()->has('error'))
                    <div class="form-group">
                        <div class="color-red" style='font-family: "Google-sans",sans-serif !important;'>
                        {{ session()->get('error') }}
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox"><span class="custom-control-label" style='font-family: "Google-sans",sans-serif !important;'>Lưu tài khoản</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block" style='font-family: "Google-sans",sans-serif !important; font-weight: bold;'>Đăng nhập</button>
                </form>
            </div>
            <div class="card-footer bg-white p-0 d-none">
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="javascript:void(0)" class="footer-link" style='font-family: "Google-sans",sans-serif !important;'>Tạo tài khoản</a></div>
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="javascript:void(0)" class="footer-link" style='font-family: "Google-sans",sans-serif !important;'>Quên mật khẩu</a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('backend/assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
</body>
 
</html>