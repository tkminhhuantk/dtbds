        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand fs-19 color-primary" href="{{ route('Home') }}" target="_blank">ĐẦU TƯ BẤT ĐỘNG SẢN</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item">
                            <div id="custom-search" class="top-search-bar">
                                <input class="form-control" type="text" placeholder="Tìm kiếm">
                            </div>
                        </li>
                        <li class="nav-item dropdown notification">
                            <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-bell"></i> <span class="indicator"></span></a>
                            <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                                <li>
                                    <div class="notification-title"> Thông báo</div>
                                    <div class="notification-list">
                                        <div class="list-group">
                                            <!--<a href="#" class="list-group-item list-group-item-action active">-->
                                            <!--    <div class="notification-info">-->
                                            <!--        <div class="notification-list-user-img"><img src="{{ asset('backend/assets/images/avatar-2.jpg') }}" alt="" class="user-avatar-md rounded-circle"></div>-->
                                            <!--        <div class="notification-list-user-block"><span class="notification-list-user-name">Jeremy Rakestraw</span>accepted your invitation to join the team.-->
                                            <!--            <div class="notification-date">2 min ago</div>-->
                                            <!--        </div>-->
                                            <!--    </div>-->
                                            <!--</a>-->
                                            <!--<a href="#" class="list-group-item list-group-item-action">-->
                                            <!--    <div class="notification-info">-->
                                            <!--        <div class="notification-list-user-img"><img src="{{ asset('backend/assets/images/avatar-3.jpg') }}" alt="" class="user-avatar-md rounded-circle"></div>-->
                                            <!--        <div class="notification-list-user-block"><span class="notification-list-user-name">John Abraham </span>is now following you-->
                                            <!--            <div class="notification-date">2 days ago</div>-->
                                            <!--        </div>-->
                                            <!--    </div>-->
                                            <!--</a>-->
                                            <!--<a href="#" class="list-group-item list-group-item-action">-->
                                            <!--    <div class="notification-info">-->
                                            <!--        <div class="notification-list-user-img"><img src="{{ asset('backend/assets/images/avatar-4.jpg') }}" alt="" class="user-avatar-md rounded-circle"></div>-->
                                            <!--        <div class="notification-list-user-block"><span class="notification-list-user-name">Monaan Pechi</span> is watching your main repository-->
                                            <!--            <div class="notification-date">2 min ago</div>-->
                                            <!--        </div>-->
                                            <!--    </div>-->
                                            <!--</a>-->
                                            <!--<a href="#" class="list-group-item list-group-item-action">-->
                                            <!--    <div class="notification-info">-->
                                            <!--        <div class="notification-list-user-img"><img src="{{ asset('backend/assets/images/avatar-5.jpg') }}" alt="" class="user-avatar-md rounded-circle"></div>-->
                                            <!--        <div class="notification-list-user-block"><span class="notification-list-user-name">Jessica Caruso</span>accepted your invitation to join the team.-->
                                            <!--            <div class="notification-date">2 min ago</div>-->
                                            <!--        </div>-->
                                            <!--    </div>-->
                                            <!--</a>-->
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="list-footer"> <a href="#">Xem toàn bộ thông báo</a></div>
                                </li>
                            </ul>
                        </li>
                        {{-- <li class="nav-item dropdown connection">
                            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-fw fa-th"></i> </a>
                            <ul class="dropdown-menu dropdown-menu-right connection-dropdown">
                                <li class="connection-list">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="{{ asset('backend/assets/images/github.png') }}" alt="" > <span>Github</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="{{ asset('backend/assets/images/dribbble.png') }}" alt="" > <span>Dribbble</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="{{ asset('backend/assets/images/dropbox.png') }}" alt="" > <span>Dropbox</span></a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="{{ asset('backend/assets/images/bitbucket.png') }}" alt=""> <span>Bitbucket</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="{{ asset('backend/assets/images/mail_chimp.png') }}" alt="" ><span>Mail chimp</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="{{ asset('backend/assets/images/slack.png') }}" alt="" > <span>Slack</span></a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="conntection-footer"><a href="#">Xem thêm</a></div>
                                </li>
                            </ul>
                        </li> --}}
                        @php
                        $user = Auth::user();
                        if($user->url_avatar == null){
                            $user->url_avatar = 'images/avatar/no-image.jpg';
                        }
                        @endphp
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="javascript:void(0)" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset($user->url_avatar) }}" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">{{ $user->name }}</h5>
                                    <span class="status"></span><span class="ml-2">( {{ $user->permissions->title }} )</span><br>
                                    <span class="status"></span><span class="ml-2">{{ $user->email }}</span>
                                </div>
                                <a class="dropdown-item" href="{{ route('UsersGetMyAccountEditor') }}"><i class="fas fa-user mr-2"></i>Thông tin cá nhân</a>
                                <a class="dropdown-item" href="{{ route('admin.logout') }}"><i class="fas fa-power-off mr-2"></i>Đăng xuất</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>