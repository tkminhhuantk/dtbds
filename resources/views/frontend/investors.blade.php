@extends('frontend/master')

@section('title')
Chủ đầu tư
@endsection

@section('css')
@endsection

@section('categories')
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
@endsection

@section('project_seo')
                                @foreach($projects_seo as $project)
                                <li>
                                    <div class="menu-product">
                                        <a href="{{ route('Project',['slugCat'=>$project->categories->slug, 'slugPro'=>$project->slug]) }}">
                                            <div class="menu-avatar">
                                                <img src="{{ asset($project->avatar) }}" alt="{{ $project->title }}">
                                            </div>
                                            <div class="menu-content">
                                                <div class="menu-content-title">
                                                    {{ $project->title }}
                                                </div>
                                                <div class="menu-content-price">
                                                    Giá: {{ $project->price }}
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                @endforeach
@endsection

@section('content')
<div class="get-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="title">
                    Chủ đầu tư
                </div>
            </div>
            <div class="col-md-5">
                <div class="breadcrumb">
                    <ul>
                        <li>
                            <a href="{{ route('Home') }}">Trang chủ</a>
                        </li>
                        <li class="current">
                            <a href="{{ route('News') }}">Chủ đầu tư</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="main main-blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                @foreach($investors as $investor)
                <div class="blog-item d-flex align-items-start justify-content-start">
                    <div class="blog-avatar">
                        <a href="{{ $investor->link }}" target="_blank">
                            <img src="{{ asset($investor->url_logo) }}" alt="{{ $investor->full_name }}">
                        </a>
                    </div>
                    <div class="blog-content">
                        <div class="blog-title">
                            <a href="{{ $investor->link }}" target="_blank">
                                {{ $investor->full_name }}
                            </a>
                        </div>
                        <div class="blog-desc">
                            {{ $investor->description }}
                        </div>
                    </div>
                </div>
                @endforeach
                {!! $investors->links() !!}
            </div>
            <div class="col-lg-3">
                <div class="sidebar-search">
                    <form>
                        <div class="form-group">
                            <input type="text" placeholder="Tìm kiếm..." name="s-search" id="s-search"
                                   class="form-control">
                            <button type="submit"><i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="fast-news mb-3">
                    <div class="fast-news--title">
                        <h4>Dự án</h4>
                    </div>
                    <div class="fast-news--right">
                        <ul>
                            @foreach($projects as $project)
                            <li>
                                <a href="{{ route('Project',['slugCat' => $project->categories->slug, 'slugPro' => $project->slug]) }}">
                                    <img src="{{ asset('frontend/images/product/product01.jpg') }}" alt="{{ $project->title }}">
                                </a>
                                <a href="{{ route('Project',['slugCat' => $project->categories->slug, 'slugPro' => $project->slug]) }}">{{ $project->title }}</a>
                            </li>
                            @endforeach
                            
                        </ul>
                    </div>
                </div>
                <div class="fast-news mb-3">
                    <div class="fast-news--title">
                        <h4>Tin tức mới</h4>
                    </div>
                    <div class="fast-news--right">
                        <ul>
                            
                            @foreach($news as $new)
                            <li>
                                <a href="{{ route('SingleNews',$new->slug) }}">
                                    <img src="{{ asset($new->link_avatar) }}" alt="{{ $new->title }}">
                                </a>
                                <a href="{{ route('SingleNews',$new->slug) }}">{{ $new->title }}</a>
                            </li>
                            @endforeach
                            
                        </ul>
                    </div>
                </div>
                <div class="fast-news mb-3">
                    <div class="fast-news--title">
                        <h4>Liên kết website</h4>
                    </div>
                    <div class="fast-news--right">
                        <ul>
                            @foreach($links as $link)
                            <li>
                                <a href="{{ $link->link }}" target="_blank">
                                    <img src="{{ asset($link->url_logo) }}" alt="{{ $link->title }}">
                                </a>
                                <a href="{{ $link->link }}" target="_blank">{{ $link->title }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection