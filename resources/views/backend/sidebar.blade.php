        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                DASHBOARD
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ Request::routeIs('AdminConfig') ? 'active' : '' }}" href="{{ route('AdminConfig') }}" >
                                    <i class="fa fa-cog" aria-hidden="true"></i>Cấu hình
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ Request::routeIs('AdminSlider') ? 'active' : '' }}" href="{{ route('AdminSlider') }}">
                                    <i class="fa fa-picture-o" aria-hidden="true"></i>Trình chiếu
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ Request::routeIs('AdminProjects') ? 'active' : '' }}" href="{{ route('AdminProjects') }}">
                                    <i class="fa fa-product-hunt" aria-hidden="true"></i>Dự án
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ Request::routeIs('AdminNews') ? 'active' : '' }}" href="{{ route('AdminNews') }}">
                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>Tin tức
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ Request::routeIs('AdminCategories') ? 'active' : '' }}" href="{{ route('AdminCategories') }}">
                                    <i class="fa fa-list" aria-hidden="true"></i>Danh mục
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ Request::routeIs('AdminTags') ? 'active' : '' }}" href="{{ route('AdminTags') }}">
                                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>Tags
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ Request::routeIs('AdminUtilities') ? 'active' : '' }}" href="{{ route('AdminUtilities') }}">
                                    <i class="fa fa-user fa-rocket"></i>Tiện ích
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ Request::routeIs('AdminDetails') ? 'active' : '' }}" href="{{ route('AdminDetails') }}">
                                    <i class="fa fa-th-list" aria-hidden="true"></i>Thông tin chi tiết
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ Request::routeIs('CommentsGetIndex') ? 'active' : '' }}" href="{{ route('CommentsGetIndex') }}">
                                    <i class="fa fa-comments-o" aria-hidden="true"></i>Bình luận
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ Request::routeIs('LinksGetIndex') ? 'active' : '' }}" href="{{ route('LinksGetIndex') }}">
                                    <i class="fas fa-link"></i>Liên kết
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ Request::routeIs('ContactsGetIndex') ? 'active' : '' }}" href="{{ route('ContactsGetIndex') }}">
                                    <i class="fas fa-handshake-o"></i>Liên hệ
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                </nav>
            </div>
        </div>