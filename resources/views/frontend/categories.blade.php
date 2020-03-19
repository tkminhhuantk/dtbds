@extends('frontend/master')

@section('title')
{{ $category->title }}
@endsection

@section('css')
@endsection

@section('content')
<div class="get-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="title">
                    <h1>{{ $category->title }}</h1>
                </div>
            </div>
            <div class="col-md-7">
                <div class="breadcrumb">
                    <ul>
                        <li>
                            <a href="{{ route('Home') }}">Trang chủ</a>
                        </li>
                        <li>
                            <a href="{{ route('Categories', $category_parent->slug) }}">{{ $category_parent->title }}</a>
                        </li>
                        <li class="current">
                            <a href="{{ route('Categories', $category->slug) }}">{{ $category->title }}</a>
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
                <h2 class="d-none">Dự án</h2>
                @foreach($projects as $project)
                <div class="blog-item d-flex align-items-start justify-content-start">
                    <div class="blog-avatar" style="position: relative;">
                        <a href="{{ route('Project',['slugCat' => $category->slug, 'slugPro' => $project->slug]) }}">
                            <img src="{{ asset($project->avatar) }}" alt="{{$project->title }}"  class="custom-image-cat">
                        </a>
                        <div class="single-p-price" style="margin: 10px 10px; text-align: center;">
                            Giá: <span>{{ $project->price }}</span>
                        </div>
                        <div class="blog-label-project  text-center" style="position: absolute; right: 5px; bottom: 64px; z-index: 1">{{ $project->statesProject->title }}</div>
                    </div>
                    <div class="blog-content">
                        <div class="blog-title">
                            <a href="{{ route('Project',['slugCat' => $category->slug, 'slugPro' => $project->slug]) }}" title="{{ $project->title }}">
                                {{ $project->title }}
                            </a>
                        </div>
                        <div class="blog-desc limit-line-3">
                            {{ $project->except }}
                        </div>
                        <div class="blog-desc limit-line-1" style="color: black; font-style: italic; font-weight: bold">
                            <i class="fas fa-map-marked-alt"></i> {{ $project->address }}
                        </div>
                        <div class="blog-bottom d-md-flex align-items-center justify-content-between">
                            <div class="blog-comment">
                                <i class="fa fa-calendar"></i> {{ $project->created_at->format('d/m/Y') }}
                            </div>
                            <div class="blog-comment">
                                <i class="fa fa-comments" aria-hidden="true"></i> {{ $project->count_comments }} bình luận
                            </div>
                            <div class="blog-comment">
                                <i class="fa fa-eye" aria-hidden="true"></i> {{ $project->view }} lượt xem
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-md-12">
                    {{ $projects->links() }}
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
                        <h4>TIN TỨC MỚI NHẤT</h4>
                    </div>
                    <div class="fast-news--right">
                        <ul>
                            
                            @foreach($news_relate as $new)
                            <li>
                                <a href="{{ route('SingleNews',$new->slug) }}">
                                    <img src="{{ asset($new->link_avatar) }}" alt="{{ $new->title }}" title="{{ $new->title }}" style="height: 60px">
                                </a>
                                <a href="{{ route('SingleNews',$new->slug) }}" style="line-height: 20px" title="{{ $new->title }}">{{ $new->title }}</a>
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
            <div class="col-12">
                
                
            </div>
        </div>
    </div>
</section>
@endsection

@section('jquery')

@endsection