@extends('frontend/master')

@section('title')
{{ $new->title }}
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
                                                <img src="{{ asset($pr->url_avatar) }}" alt="{{ $pr->title }}" class="custom-image-project-seo">
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
                    <h2>Tin Tức Bất Động Sản </h2>
                </div>
            </div>
            <div class="col-md-5">
                <div class="breadcrumb">
                    <ul>
                        <li>
                            <a href="{{ route('Home') }}">Trang chủ</a>
                        </li>
                        <li class="current">
                            <a href="{{ route('News') }}">Tin tức</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="main main-single-blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 bg-white">
                <div class="single-blog">
                    <h1 class="title-content-new">{{ $new->title }}</h1>
                    <img src="{{ asset($new->link_avatar) }}">
                    {!! $new->content !!}
                    <div id="tags" class="scroll-section">
                        <h3 style="font-size: 30px; margin-bottom: 15px; padding-bottom: 15px; position: relative; border-bottom: 4px solid #aaa; font-weight: 600;">Tags</h3>
                        <div class="d-flex align-content-start flex-wrap mb-10" id="single-tags">
                            @foreach($tags as $tag)
                            <a class="content-tag color-white mb-10 zoom" href="{{ route('TagNew', $tag->tags->slug) }}">{{ $tag->tags->title }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="related-posts">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title">
                                Bài viết liên quan
                            </div>
                        </div>
                        @foreach($relateds as $related)
                        <div class="col-md-4">
                            <div class="related-item">
                                <div class="related-avatar">
                                    <a href="{{ route('SingleNews',$related->slug) }}">
                                        <img src="{{ asset($related->link_avatar) }}">
                                    </a>
                                </div>
                                <div class="related-content">
                                    <div class="related-title">
                                        {{ $related->title }}
                                    </div>
                                    <div class="related-day">
                                        Đăng ngày: {{ $related->created_at->format('d-m-y') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
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
                                <a href="{{ route('Project',['slugCat' => $project->categories->slug, 'slugPro' => $project->slug]) }}">{{ $project->title }}</a>
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