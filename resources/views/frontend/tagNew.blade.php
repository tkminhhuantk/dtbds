@extends('frontend/master')

@section('title')
Tags Tin Tức
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
                                @foreach($projects_seo as $pr)
                                <li>
                                    <div class="menu-product">
                                        <a href="{{ route('Project',['slugCat'=>$pr->categories->slug, 'slugPro'=>$pr->slug]) }}">
                                            <div class="menu-avatar">
                                                <img src="{{ asset($pr->avatar) }}" alt="{{ $pr->title }}" class="custom-image-project-seo">
                                            </div>
                                            <div class="menu-content">
                                                <div class="menu-content-title limit-line-2">
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
@endsection

@section('content')
<div class="get-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="title">
                    <h1>Tags Tin Tức: {{ $tag->title }}</h1>
                </div>
            </div>
            <div class="col-md-5">
                <div class="breadcrumb">
                    <ul>
                        <li>
                            <a href="{{ route('Home') }}">Trang chủ</a>
                        </li>
                        <li class="current">
                            <a href="javascript:void(0)">Tags Tin Tức</a>
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
                <h2 class="d-none">Tin tức</h2>
            	@foreach($news as $new)
                <div class="blog-item d-flex align-items-start justify-content-start">
                    <div class="blog-avatar">
                        <a href="{{ route('SingleNews',$new->slug) }}">
                            <img src="{{ asset($new->link_avatar) }}" alt="{{ $new->title }}">
                        </a>
                    </div>
                    <div class="blog-content">
                        <!--<div class="blog-label">Người đăng: {{ $new->users->name }}</div>-->
                        <div class="blog-title">
                            <a href="{{ route('SingleNews',$new->slug) }}">
                                {{ $new->title }}
                            </a>
                        </div>
                        <div class="blog-desc limit-line-3">
                            {{ $new->except }}
                        </div>

                        <div class="blog-bottom d-md-flex align-items-center justify-content-between">
                            <div class="blog-comment">
                                <i class="fas fa-user"></i> {{ $new->users->name }}
                            </div>
                            <div class="blog-comment">
                                <i class="fas fa-eye"></i> {{ $new->view }} lượt xem
                            </div>
                            <div class="blog-day">
                                <i class="fa fa-calendar"></i> <span>{{ $new->created_at->format('d-m-Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                {!! $news->links() !!}
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
                        <h4>DỰ ÁN BẤT ĐỘNG SẢN</h4>
                    </div>
                    <div class="fast-news--right">
                        <ul>
                            @foreach($projects as $project)
                            <li>
                                <a href="{{ route('Project',['slugCat' => $project->categories->slug, 'slugPro' => $project->slug]) }}">
                                    <img src="{{ asset($project->avatar) }}" alt="{{ $project->title }}" style="height: 70px">
                                </a>
                                <a href="{{ route('Project',['slugCat' => $project->categories->slug, 'slugPro' => $project->slug]) }}" title="{{ $project->title }}">{{ $project->title }}</a>
                            </li>
                            @endforeach
                            
                        </ul>
                    </div>
                </div>
                <div class="fast-news mb-3">
                    <div class="fast-news--title">
                        <h4>LIÊN KẾT WEBSITE</h4>
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

@section('jquery')
@endsection