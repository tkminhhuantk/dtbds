@extends('frontend/master')

@section('title')
Tìm Kiếm
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
            <div class="col-md-5">
                <div class="title">
                    <h1>Tìm kiếm</h1>
                </div>
            </div>
            <div class="col-md-7">
                <div class="breadcrumb">
                    <ul>
                        <li>
                            <a href="{{ route('Home') }}">Trang chủ</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Tìm kiếm</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<section>
    <div class="search" style="padding-top: 10px; padding-bottom: 20px">
        <div class="container" id="form-search">
            <form id="frm-search-realty" class="search-form">
                <div class="row">
                    <!--<h3 class="search-form-title p-3">Tìm kiếm</h3>-->
                </div>
                <div class="row">
                    <div class="d-flex flex-row bd-highlight p-1 select-category">
                        @foreach($categories as $cat)
                        <input type="radio" name="slugCat" value="all" id="{{ $cat->slug }}" class="d-none slugCat">
                        <label for="{{ $cat->slug }}" class="p-3 bd-highlight lable-radio-search mr-2 btn-cat" data-slug="{{ $cat->slug }}" data-url="{{ route('GetSubCategory', $cat->id) }}">{{ $cat->title }}</label>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 p-1 ">
                        <input type="text" id="inpt-search-realty" name="search" placeholder="Nhập nội dung tìm kiếm" class="form-control" value="{{ $search }}">
                    </div>
                    <div class="col-md-4 p-1 ">
                        <select name="slugCatSub" class="form-control" id="cat_sub">
                            <option value="all">Chọn danh mục</option>
                            @foreach($categories as $cat)
                            <optgroup label="{{ $cat->title }}">
                                @foreach($cat->sub as $sub)
                                @if($sub->slug == $slugCatSub)
                                <option value="{{ $sub->slug }}" selected="selected">{{ $sub->title }}</option>
                                @else
                                <option value="{{ $sub->slug }}">{{ $sub->title }}</option>
                                @endif
                                @endforeach
                            </optgroup>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 p-1 ">
                        <button type="submit" class="btn btn-submit-search">Tìm kiếm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<section class="main main-blog">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <h2 class="d-none">Tìm kiếm bất động sản</h2>
                    @foreach($projects as $project)
                    <div class="col-sm-6 col-md-4">
                        <div class="product-item p-0">
                            <div class="product-avatar">
                                <a href="{{ route('Project',['slugCat'=>$project->categories->slug, 'slugPro'=>$project->slug]) }}" title="Xem chi tiết">
                                    <img src="{{ asset($project->avatar) }}" alt="{{ $project->title }}" title="{{ $project->title }}" class="custom-image-cat">
                                </a>
                                <a href="{{ route('Project',['slugCat'=>$project->categories->slug, 'slugPro'=>$project->slug]) }}">
                                    <div class="product-hover">
                                        <span class="btn" style="position: absolute; z-index: 9999; top: 50%; left: 50%; transform: translate(-50%, -50%); background: var(--base-color); padding 5px 20px; color: white">Xem chi tiết</span>
                                   </div> </a>
                            </div>
                            <div class="product-content">
                                <div class="product--title">
                                    <a class="color-primary-hv" href="{{ route('Project',['slugCat'=>$project->categories->slug, 'slugPro'=>$project->slug]) }}" style="line-height: 24px">
                                        {{ $project->title }}
                                    </a>
                                </div>
                                <div class="product--price">
                                    <b>Giá: <span>{{ $project->price }}</span></b>
                                </div>

                            </div>
                            <div class="text-center limit-line-2" style="padding: 10px 10px; line-height: 24px; ">
                                <i class="fas fa-map-marked-alt"></i> {{ $project->address }}
                            </div>
                            <div class="product-action" style="padding: 10px 0 15px; text-align: center;">
                                <a href="{{ route('Project',['slugCat'=>$project->categories->slug, 'slugPro'=>$project->slug]) }}" style={}>
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
    <script>
        $('.select-category').on('click', '.btn-cat', function(e) {
            let url = $(this).attr('data-url');
            let data = [];
            let slug = $(this).attr('data-slug');
            $('.select-category > input').val(slug);
            axios.get(url, data).then(response => {
                let data = response.data;
                $('#cat_sub').empty().append('<option value="all">- Chọn danh mục -</option>');
                $.each(data, function (index, value){
                    $('#cat_sub').append(`<option value="${value.slug}">${value.title}</option>`)
                });

            }).catch(err => {
                $.notify('Không thể tải chuyên mục con!', 'error');
            });
        });

        $('#frm-search-realty').submit(function(e){
            e.preventDefault();
            let url = '{{ asset('tim-kiem') }}';
            let slugCat = $('.select-category > input').val();
            let slugCatSub = $('#cat_sub').val();
            let search = $('#inpt-search-realty').val();
            if(slugCat == 'all' && slugCatSub == 'all' && search.length == 0){
                $.notify('Chưa nhập thông tin tìm kiếm', 'error');
            }else{
                if(search.length){
                    window.location.href =  url +'/'+ slugCat + '/' + slugCatSub + '/' + search ;
                }else{
                    window.location.href =  url +'/'+ slugCat + '/' + slugCatSub + '/' + 'all' ;
                }
            }
                
        });
    </script>
@endsection