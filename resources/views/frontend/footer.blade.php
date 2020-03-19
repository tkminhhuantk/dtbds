<div class="zalo d-none">
    <a href="#">
        <img src="{{ asset('frontend/images/zalo.png') }}" width="45" height="45" alt="Zalo">
    </a>
    <div class="number-zalo">0333.123.234</div>
</div>
<div class="call d-none">
    <a href="#">
        <span class="boom">
            <i class="fas fa-phone"></i>
        </span>
    </a>
    <div class="number-phone">0333.123.234</div>
</div>

<div class="footer">
    <div class="footer-overlay"></div>
    <div class="container">
        <div class="d-md-flex align-items-center justify-content-center container-footer">
            <div class="row">
                <div class="footer-menu">
                    <ul>
                        <li>
                            <a href="{{ route('Home') }}">Trang Chủ</a>
                        </li>
                        <li>
                            <a href="{{ route('Categories', 'nha-dat-ban') }}">Nhà Đất Bán</a>
                        </li>
                        <li>
                            <a href="{{ route('Categories', 'nha-dat-cho-thue') }}">Nhà Đất Cho Thuê</a>
                        </li>
                        <li>
                            <a href="{{ route('News') }}">Tin tức</a>
                        </li>
                        <li>
                            <a href="{{ route('Contact') }}">Liên hệ</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="footer-logo">
                    <a href="{{ route('Home') }}">
                        <img src="{{ asset('logo/logo-dtbds.jpg') }}" alt="Đầu tư bất động sản">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@yield('jquery')

</body>
</html>