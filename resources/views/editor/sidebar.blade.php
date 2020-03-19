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

                            <li class="nav-item">
                                <a class="nav-link {{ Request::routeIs('EditorProjects') ? 'active' : '' }}" href="{{ route('EditorProjects') }}">
                                    <i class="fa fa-product-hunt" aria-hidden="true"></i>Dự án
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ Request::routeIs('EditorNews') ? 'active' : '' }}" href="{{ route('EditorNews') }}">
                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>Tin tức
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ Request::routeIs('EditorTags') ? 'active' : '' }}" href="{{ route('EditorTags') }}">
                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>Tags
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ Request::routeIs('EditorUtilities') ? 'active' : '' }}" href="{{ route('EditorUtilities') }}">
                                    <i class="fa fa-user fa-rocket"></i>Tiện ích
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ Request::routeIs('EditorDetails') ? 'active' : '' }}" href="{{ route('EditorDetails') }}">
                                    <i class="fa fa-th-list" aria-hidden="true"></i>Thông tin chi tiết
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                </nav>
            </div>
        </div>