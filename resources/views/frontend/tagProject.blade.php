@extends('frontend/master')

@section('title')
Tags Bất Động Sản
@endsection

@section('css')
@endsection

@section('content')
<div class="get-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="title">
                    <h1>Tags Bất động sản: {{ $tag->title }}</h1>
                </div>
            </div>
            <div class="col-md-5">
                <div class="breadcrumb">
                    <ul>
                        <li>
                            <a href="{{ route('Home') }}">Trang chủ</a>
                        </li>
                        <li class="current">
                            <a href="javascript:void(0)">Tags Bất Động Sản</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="main main-product">
    <div class="container">
        <div class="row">
            <h1 class="d-none">Tags Bất Động Sản: {{ $tag->title }}</h1>
            <div class="col-md-12">
                <div class="row">
                    @foreach($projects as $project)
                    <div class="col-sm-6 col-md-4">
                        <div class="product-item p-0">
                            <div class="product-avatar">
                                <a href="{{ route('Project',['slugCat'=>$project->categories->slug, 'slugPro'=>$project->slug]) }}" title="{{ $project->title }}">
                                    <img src="{{ asset($project->avatar) }}" alt="{{ $project->title }}" class="custom-image-cat">
                                </a>
                                <a href="{{ route('Project',['slugCat'=>$project->categories->slug, 'slugPro'=>$project->slug]) }}">
                                    <div class="product-hover">
                                        <span class="btn" style="position: absolute; z-index: 9999; top: 50%; left: 50%; transform: translate(-50%, -50%); background: var(--base-color); padding: 5px 20px; color: white">Xem chi tiết</span>
                                   </div> </a>
                            </div>
                            <div class="product-content">
                                <div class="product--title">
                                    <a class="color-primary-hv limit-line-2" href="{{ route('Project',['slugCat'=>$project->categories->slug, 'slugPro'=>$project->slug]) }}" style="line-height: 24px" title="{{ $project->title }}">
                                        {{ $project->title }}
                                    </a>
                                </div>
                                <div class="product--price">
                                    <b>Giá: <span>{{ $project->price }}</span></b>
                                </div>

                            </div>
                            <div class="text-center limit-line-2" style="margin: 10px 10px; line-height: 24px;" title="{{ $project->address }}">
                                <i class="fas fa-map-marked-alt"></i> {{ $project->address }}
                            </div>
                            <div class="product-action" style="padding: 10px 0 15px; text-align: center;">
                                <a href="{{ route('Project',['slugCat'=>$project->categories->slug, 'slugPro'=>$project->slug]) }}">
                                    {{ $project->statesProject->title }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-md-12">
                        {{ $projects->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('jquery')

@endsection