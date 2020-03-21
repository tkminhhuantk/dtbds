@php
    $config = App\Config::first();
    $projects_seo = App\Projects::with('categories')->where('status',1)->where('seo',1)->orderBy('id','desc')->limit(10)->get();
    $categories = App\Categories::where('category_id',0)->where('status',1)->get();
        foreach($categories as $category)
        {
            $category->sub = App\Categories::where('category_id',$category->id)->get();
        }
@endphp
<header class="bg-black fixed top-0 left-0 right-0 z-50">
    <div class="bg-dark">
        <div class="container relative mx-auto px-3">
            <a href="{{ route('Home') }}" class="absolute bg-white top-0 block w-24 h-18 overflow-hidden">
                <img class="h-full mx-auto" src="{{ asset($config->logo) }}" alt="{{ $config->website_name }}">
            </a>
            <div class="flex justify-end md:justify-between items-center ml-32">
                <p class="hidden md:block md:opacity-100 transition-none uppercase text-gray-300 font-bold mb-0">
                    Trang đầu tư bất động sản hàng đầu
                </p>
                <div class="social-icons social-icons-colored-hover">
                    <ul>
                        <li class="social-facebook">
                            <a href="" target="_blank">
                                <i class="fab fa-facebook-square"></i>
                            </a>
                        </li>
                        <li class="social-instagram">
                            <a href="" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li class="social-youtube">
                            <a href="" target="_blank">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-black">
        <div class="container mx-auto px-3">
            <div class="flex items-center justify-end">
                <nav class="hidden md:block md:opacity-100 transition-none">
                    <ul class="list-none flex items-center p-0 m-0">
                        <li>
                            <a href="{{ route('News') }}" class="block px-4 py-2 text-white font-bold uppercase hover:bg-main-100 transition duration-200 ease-in">
                                Tin tức bất động sản
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('News') }}" class="block px-4 py-2 text-white font-bold uppercase hover:bg-main-100 transition duration-200 ease-in">
                                Dự án bất động sản
                            </a>
                        </li>
                    </ul>
                </nav>
                <nav>
                    <ul class="flex items-center list-none p-0 m-0">
                        <li>
                            <a href="javascript:void('Mở rộng')" class="header-toggle block px-4 py-2 text-main-100">
                                <i class="far fa-bars"></i>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle block px-4 py-2 text-main-100">
                                    <i class="fa fa-user"></i>
                                </a>
                                <div class="dropdown-menu shadow-xl">
                                    <a href="" class="dropdown-item">
                                        Tiếng Việt
                                    </a>
                                    <a href="" class="dropdown-item">
                                        Tiếng Anh
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle flex items-center justify-center px-2 py-2 text-main-100">
                                    <span class="flag flag-vn"></span>
                                </a>
                                <div class="dropdown-menu shadow-xl">
                                    <a href="" class="dropdown-item">
                                        Tiếng Việt
                                    </a>
                                    <a href="" class="dropdown-item">
                                        Tiếng Anh
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
<nav class="main-menu">
    <div class="header-dismiss">
        <button>
            <i class="fal fa-times"></i>
        </button>
    </div>
    <ul>
        @foreach($categories as $cat)
            <li class="menu-item-has-children">
                <a href="{{ route('Categories', $cat->slug) }}">{{ $cat->title }}</a>
                <button class="menu-dropdown"><i class="far fa-plus"></i></button>
                <ul class="sub-menu">
                    @foreach($cat->sub as $sub)
                        <li>
                            <a href="{{ route('Categories', $sub->slug )}}">{{ $sub->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endforeach

{{--        <li class="menu-item-has-children has-product">--}}
{{--            <a href="{{ route('ProjectSeo') }}">Dự Án Nổi Bật</a>--}}
{{--            <ul>--}}
{{--                @foreach($projects_seo as $pr)--}}
{{--                    <li>--}}
{{--                        <div class="menu-product">--}}
{{--                            <a href="{{ route('Project',['slugCat'=>$pr->categories->slug, 'slugPro'=>$pr->slug]) }}">--}}
{{--                                <div class="menu-avatar">--}}
{{--                                    <img src="{{ asset($pr->avatar) }}" alt="{{ $pr->title }}" class="custom-image-project-seo" title="{{ $pr->title }}">--}}
{{--                                </div>--}}
{{--                                <div class="menu-content">--}}
{{--                                    <div class="menu-content-title limit-line-2" title="{{ $pr->title }}">--}}
{{--                                        {{ $pr->title }}--}}
{{--                                    </div>--}}
{{--                                    <div class="menu-content-price">--}}
{{--                                        Giá: {{ $pr->price }}--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </li>--}}
        <li>
            <a href="{{ route('News') }}">Tin tức</a>
        </li>
        <li>
            <a href="{{ route('Contact') }}">Liên hệ</a>
        </li>
    </ul>
</nav>