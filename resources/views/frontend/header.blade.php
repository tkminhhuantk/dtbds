@php
    $config = App\Config::first();
    $projects_seo = App\Projects::with('categories')->where('status',1)->where('seo',1)->orderBy('id','desc')->limit(10)->get();
    $categories = App\Categories::where('category_id',0)->where('status',1)->get();
        foreach($categories as $category)
        {
            $category->sub = App\Categories::where('category_id',$category->id)->get();
        }
@endphp

<header class="nav-one" id="menufix"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <div class="container">
        <div class="row">
            <div class="grid-menu col-lg-12">
                <div class="grid-logo">
                    <div class="humburger"><span></span></div>
                    <a href="{{ route('Home') }}">
                        <img src="{{ asset($config->logo) }}" alt="Đầu tư bất động sản">
                    </a>
                </div>
                <nav class="grid-nav">
                    <ul>
                        <li class="d-none">
                            <div class="form-wrap">
                            </div>
                        </li>
                        <li>
                            <a href="{{ route('Home') }}">Trang Chủ</a>
                        </li>

                        @foreach($categories as $cat)
                        <li class="menu-item-has-children">
                            <a href="{{ route('Categories', $cat->slug) }}">{{ $cat->title }}</a>
                            <ul>
                                @foreach($cat->sub as $sub)
                                <li>
                                    <a href="{{ route('Categories', $sub->slug )}}">{{ $sub->title }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach

                        <li class="menu-item-has-children has-product">
                            <a href="{{ route('ProjectSeo') }}">Dự Án Nổi Bật</a>
                            <ul>
                                @foreach($projects_seo as $pr)
                                <li>
                                    <div class="menu-product">
                                        <a href="{{ route('Project',['slugCat'=>$pr->categories->slug, 'slugPro'=>$pr->slug]) }}">
                                            <div class="menu-avatar">
                                                <img src="{{ asset($pr->avatar) }}" alt="{{ $pr->title }}" class="custom-image-project-seo" title="{{ $pr->title }}">
                                            </div>
                                            <div class="menu-content">
                                                <div class="menu-content-title limit-line-2" title="{{ $pr->title }}">
                                                    {{ $pr->title }}
                                                </div>
                                                <div class="menu-content-price">
                                                    Giá: {{ $pr->price }}
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <!--<li>-->
                        <!--    <a href="{{ route('Investors') }}">Chủ đầu tư</a>-->
                        <!--</li>-->
                        <li>
                            <a href="{{ route('News') }}">tin tức</a>
                        </li>
                        <li>
                            <a href="{{ route('Contact') }}">liên hệ</a>
                        </li>
                        <li class="d-none">
                            <div class="form-wrap">
                                
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>

<div class="modal fade registerDriver" id="registerDriver">
    <div class="modal-dialog modal-dialog-zoom">
        <div class="modal-content">
            <form action="{{ route('ContactPostAdd') }}" method="post" id="frm-add-contact-popup">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Gửi thông tin liên hệ</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        @csrf
                        <label for="fullname"><i class="fas fa-user"></i></label>
                        <input type="text" name="name" placeholder="Họ tên" id="fullname" class="form-control">
                        <div class="red d-none" id="inp-name-error-popup"></div>
                    </div>
                    <div class="form-group">
                        <label for="email"><i class="fas fa-envelope"></i></label>
                        <input type="email" name="email" placeholder="Email" id="email" class="form-control">
                        <div class="red d-none" id="inp-email-error-popup"></div>
                    </div>
                    <div class="form-group">
                        <label for="phone"><i class="fas fa-mobile"></i></label>
                        <input type="text" name="phone" placeholder="Số điện thoại" id="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="title"><i class="fas fa-tags"></i></label>
                        <input type="text" name="title" placeholder="Tiêu đề" id="title" class="form-control">
                        <div class="red d-none" id="inp-title-error-popup"></div>
                    </div>
                    <div class="form-group">
                        <label for="content"><i class="fas fa-tags"></i></label>
                        <textarea name="content" class="form-control" rows="2" placeholder="Nội dung" id="content"></textarea>
                        <div class="red d-none" id="inp-content-error-popup"></div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="modal-button">Gửi</button>
                </div>
            </form>

        </div>
    </div>
</div>