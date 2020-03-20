@extends('frontend/master')

@section('title')
{{ $new->title }}
@endsection

@section('css')
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
                <div class="single-blog content-single-news">
                    <h1 class="title-content-new" style="line-height: 1.2; font-size: 24px; text-transform: uppercase; color: var(--base-color)">{{ $new->title }}</h1>
                    <div class="d-md-flex align-items-center justify-content-between" style="padding-bottom: 20px; padding-right: 20px; padding-left: 20px">
                        <div class="blog-comment">
                            <div class="fb-like mb-10" data-href="{{ route('SingleNews',$new->slug) }}" data-width="" data-layout="button" data-action="like" data-size="large" data-share="true"></div>
                        </div>
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
                    <img src="{{ asset($new->link_avatar) }}" style="padding-bottom: 20px" alt="{{ $new->title }}">
                    {!! $new->content !!}
                    <div id="tags" class="scroll-section">
                        <h3 style="font-size: 30px; margin-bottom: 15px; padding-bottom: 15px; position: relative; border-bottom: 4px solid #aaa; font-weight: 600;">Tags</h3>
                        <div class="d-flex align-content-start flex-wrap mb-10" id="single-tags">
                            @foreach($tags as $tag)
                            <a class="content-tag color-white mb-10 zoom" href="{{ route('TagNew', $tag->tags->slug) }}">{{ $tag->tags->title }}</a>
                            @endforeach
                        </div>
                    </div>
                    <div id="fb-root"></div>
                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v6.0"></script>
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
                                        <img src="{{ asset($related->link_avatar) }}" class="custom-image-cat">
                                    </a>
                                </div>
                                <div class="related-content">
                                    <div class="related-title limit-line-2">
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
                                    <img src="{{ asset($project->avatar) }}"  style="height: 70px" alt="{{ $project->title }}">
                                </a>
                                <a href="{{ route('Project',['slugCat' => $project->categories->slug, 'slugPro' => $project->slug]) }}" class="limit-line-3">{{ $project->title }}</a>
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