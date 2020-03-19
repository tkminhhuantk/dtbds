@extends('frontend/master')

@push('meta')
    <meta property="og:url"           content="{{ route('Project',['slugCat'=>$project->categories->slug, 'slugPro'=>$project->slug]) }}" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="{{ $project->title }}" />
	<meta property="og:description"   content="{{ $project->except }}" />
	<meta property="og:image"         content="{{ asset($project->url_avatar) }}" />
@endpush

@section('title')
{{ $project->title }}
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
                    <h2>{{ $category->title }}</h2>
                </div>
            </div>
            <div class="col-md-5">
                <div class="breadcrumb">
                    <ul>
                        <li>
                            <a href="{{ route('Home') }}">Trang chủ</a>
                        </li>
                        @if($category_parent != null)
                        <li>
                            <a href="{{ route('Categories', $category_parent->slug) }}">{{ $category_parent->title }}</a>
                        </li>
                        @endif
                        <li class="current">
                            <a href="{{ route('Categories', $category->slug) }}">{{ $category->title }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="main main-single-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="bg-white">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="single-p-name" style="padding: 20px 20px; margin-bottom: 10px">
                                        <h1 style="text-align: left">
                                            {{ $project->title }}
                                        </h1>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="single-p-avatar d-flex align-items-center">
                                        <div class="single-p-avatar-child">
                                            <img src="{{ asset($project->url_avatar) }}" alt="{{ $project->title }}">
                                            <div class="single-p-price">
                                                Giá từ: <span>{{ $project->price }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="single-p-content">
                                        <div class="single-p-uudai">
                                            <ul>
                                                <li><b>Thể loại:</b> {{ $cat_parent->title }}</li>
                                                <li><b>Danh mục:</b> {{ $project->categories->title }}</li>
                                                <li><b>Diện tích:</b> {{ $project->acreage }} m<sup style="font-size: 12px">2</sup></li>
                                                <li><b>Địa chỉ:</b> {{ $project->address }}</li>
                                                
                                                <li><b>Ngày đăng:</b> {{ $project->created_at->format('d/m/Y') }}</li>
                                                <li><b>Tình trạng:</b> {{ $project->statesProject->title }}</li>
                                                <li><div class="fb-like mb-10" data-href="{{ route('Project',['slugCat'=>$project->categories->slug, 'slugPro'=>$project->slug]) }}" data-width="" data-layout="button" data-action="like" data-size="large" data-share="true"></div></li>
                                            </ul>
                                        </div>
                                        
                                        <div class="single-p-action">
                                            <a href="#" data-toggle="modal" data-target="#registerDriver"
                                               class="action-item" style="border-radius: 5px">
                                                <i class="flaticon-email" style="padding-right:5px;"></i>
                                                Gửi thông tin liên hệ
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div id="fb-root"></div>
                                <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v6.0"></script>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="single-product-link d-none d-md-block">
                                <ul>
                                    <li>
                                        <a href="#tongquan">
                                            Tổng quan
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#mota">
                                            Mô tả
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#thongtin">
                                            Thông tin chi tiết
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tienich">
                                            Tiện ích
                                        </a>
                                    </li>
                                    <!--<li>-->
                                    <!--    <a href="#chudautu">-->
                                    <!--        Chủ đầu tư-->
                                    <!--    </a>-->
                                    <!--</li>-->
                                    <li>
                                        <a href="#vitri">
                                            Vị trí dự án
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#hinhanh">
                                            Hình ảnh
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tags">
                                            Tags
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#binhluan">
                                            Bình luận
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="single-product-link-fixed d-block d-md-none">
                                <ul>
                                    <li>
                                        <a href="#tongquan">
                                            <div class="link-fixed-icon"></div>
                                            <span>Tổng quan</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#mota">
                                            <div class="link-fixed-icon"></div>
                                            <span>Mô tả</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#thongtin">
                                            <div class="link-fixed-icon"></div>
                                            <span>Thông tin chi tiết</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tienich">
                                            <div class="link-fixed-icon"></div>
                                            <span>Tiện ích</span>
                                        </a>
                                    </li>
                                    <!--<li>-->
                                    <!--    <a href="#chudautu">-->
                                    <!--        <div class="link-fixed-icon"></div>-->
                                    <!--        <span>Chủ đầu tư</span>-->
                                    <!--    </a>-->
                                    <!--</li>-->
                                    <li>
                                        <a href="#vitri">
                                            <div class="link-fixed-icon"></div>
                                            <span>Vị trí dự án</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tags">
                                            <div class="link-fixed-icon"></div>
                                            <span>Vị trí dự án</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#hinhanh">
                                            <div class="link-fixed-icon"></div>
                                            <span>Hình ảnh</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#binhluan">
                                            <div class="link-fixed-icon"></div>
                                            <span>Bình luận</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="single-product-scroll">
                                <div id="tongquan" class="scroll-section">
                                    <h3 class="title-content-project">Tổng quan</h3>
                                    {!! $project->overview !!}
                                </div>
                                <div id="mota" class="scroll-section">
                                    <h3 class="title-content-project">Mô tả</h3>
                                    <p>
                                        {!! $project->except !!}
                                    </p>
                                    
                                </div>
                                <div id="thongtin" class="scroll-section">
                                    <h3 class="title-content-project">Thông tin chi tiết</h3>
                                    <div class="content-detail">
                                        <ul class="detail-more row">
                                            @foreach($details as $detail)
                                            <li class="col-md-6 d-flex justify-content-between item-detail">
                                                <p>- {{ $detail->details->title }}</p>
                                                <p>{{ $detail->value }}</p>
                                            </li>
                                            @endforeach                                            
                                        </ul>
                                    </div>
                                </div>
                                <div id="tienich" class="scroll-section">
                                    <h3 class="title-content-project">Tiện ích</h3>
                                    <div id="list-utitlties">
                                        <ul>
                                            @foreach($utilities as $utiliti)
                                            <li>- {{ $utiliti->utilities->title }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    
                                </div>
                                <!--<div id="chudautu" class="scroll-section">-->
                                <!--    <h3 class="title-content-project">Chủ đầu tư</h3>-->
                                <!--    <div class="row">-->
                                <!--        <div class="col-sm-12 col-md-4">-->
                                <!--            <a href="#" >-->
                                <!--                <img src="" alt=""/>-->
                                <!--            </a>-->
                                <!--        </div>-->
                                <!--        <div class="col-md-8 col-sm-12 info-vestor">-->
                                <!--            <span></span>-->
                                <!--            <p class="blog-desc"></p>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                        
                                <!--</div>-->
                                <div id="vitri" class="scroll-section ifm-google-map">
                                    <h3 class="title-content-project">Vị trí dự án</h3>
                                    {!! $project->map !!}
                                </div>
                                <div id="tags" class="scroll-section">
                                    <h3 class="title-content-project">Tags</h3>
                                    <div class="d-flex align-content-start flex-wrap mb-10" id="single-tags">
                                        @foreach($tags as $tag)
                                        <a class="content-tag color-white mb-10 zoom" href="#">{{ $tag->tags->title }}</a>
                                        @endforeach
                                    </div>
                                </div>
                                <div id="hinhanh" class="scroll-section" style="margin-top: 20px;">
                                    <h3 class="title-content-project">Hình ảnh</h3>
                                    <div class="slider-banner owl-carousel owl-theme">
                                    @foreach($project->url_images as $key => $image)
                                        <div>
                                            <img src="{{ asset($image)}}" alt="{{ $project->title }} {{ $key+1 }}">
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                                <div id="binhluan" class="scoll-section" style="margin-top: 20px; margin-bottom: 20px">
                                    <h3 class="title-content-project">Bình luận</h3>
                                    <button class="btn p-5-20 bg-main color-white color-white-hv" id="add-comment">Thêm bình luận</button>
                                    <div class="comment">
                                        @foreach($comments as $comment)
                                            <div class="comment-item">
                                                <div class="comment-item-avatar">
                                                    <a href="">
                                                        <span class="avatar avatar-xl" style="background-image: url({{ asset('backend/assets/images/avatar-no-image.png') }})"></span>
                                                    </a>
                                                </div>
                                                <div class="comment-item-info">
                                                    <a href="javascript:void(0)" class="comment-name mb-2">
                                                        {{ $comment->name }}
                                                    </a>
                                                    <p class="comment-time mb-2">{{ $comment->date }}</p>
                                                    <div class="comment-content mb-2">
                                                        {{ $comment->content }}
                                                    </div>
                                                    <div class="comment-reply">
                                                        <a class="btn-reply" data-id="{{ $comment->id }}"  href="javascript:void(0)">Trả lời</a>
                                                    </div>
                                                </div>
                                            </div>

                                            @foreach($comment->reply as $reply)
                                            <div class="comment-item ml-3" style="padding-left: 30px;">
                                                <div class="comment-item-avatar">
                                                    <a href="">
                                                        <span class="avatar avatar-xl" style="background-image: url({{ asset('backend/assets/images/avatar-no-image.png') }})"></span>
                                                    </a>
                                                </div>
                                                <div class="comment-item-info">
                                                    <a href="javascript:void(0)" class="comment-name mb-2">
                                                        {{ $reply->name }}
                                                    </a>
                                                    <p class="comment-time mb-2">{{ $reply->date }}</p>
                                                    <div class="comment-content mb-2">
                                                        {{ $reply->content }}
                                                    </div>
                                                    <div class="comment-reply">
                                                        <a class="btn-reply" data-id="{{ $comment->id }}"  href="javascript:void(0)">Trả lời</a>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach

                                        @endforeach

                                            {{-- <div class="comment-item ml-3" style="padding-left: 30px;">
                                                <div class="comment-item-avatar">
                                                    <a href="">
                                                        <span class="avatar avatar-xl" style="background-image: url({{ asset('backend/assets/images/avatar-no-image.png') }})"></span>
                                                    </a>
                                                </div>
                                                <div class="comment-item-info">
                                                    <a href="javascript:void(0)" class="comment-name mb-2">
                                                        Minh Huân
                                                    </a>
                                                    <p class="comment-time mb-2">3 tuần trước</p>
                                                    <div class="comment-content mb-2">
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco. 
                                                    </div>
                                                    <div class="comment-reply">
                                                        <a class="btn-reply" href="javascript:void(0)">Trả lời</a>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="about-c-left single-p-right">
                    <div class="about-avatar">
                        @if( $user->url_avatar != null)
                        <img src="{{ asset($user->url_avatar) }}" alt="{{ $user->name }}" style="width: 100%; height: auto">
                        @else
                        <img src="{{ asset('images/avatar/no-image.jpg') }}" alt="{{ $user->name }}" style="width: 100%; height: auto">
                        @endif
                    </div>
                    <div class="about-content">
                        <h3 style="font-size: 16px">{{ $user->name }}</h3>
                        <p>{{ $user->excerpt }}</p>
                    </div>
                    <div class="about-action">
                        <a href="tel:{{ $user->phone }}"><i class="flaticon-smartphone"></i> {{ $user->phone }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modal-add-comment" style="z-index: 9999999999">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" style="font-weight: bold;">Thêm bình luận</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('AddComment') }}" id="frm-add-comment">
          <div class="modal-body">
            
            @csrf
            <input type="hidden" name="post_id" value="{{ $project->id }}">
            <input type="hidden" name="type" value="1">
            <input type="hidden" name="comment_id" id="ipt-comment-id" value="0">
            <div class="form-group">
              <label class="col-form-label">Tên của bạn <span class="red">*</span></label>
              <input type="text" name="name" class="form-control inp-comment" placeholder="Nhập họ và tên">
              <div class="red" id="inp-name-error"></div>
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Email <span class="red">*</span></label>
              <input type="text" name="email" class="form-control inp-comment" placeholder="Nhập địa chỉ email">
              <div class="red" id="inp-email-error"></div>
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Số điện thoại(nếu có)</label>
              <input type="text" name="phone" class="form-control inp-comment" placeholder="Nhập số điện thoại">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Nội dung bình luận <span class="red">*</span></label>
              <textarea id="inp-content" name="content" class="form-control text-comment" rows="4" placeholder="Nhập nội dung bình luận"></textarea>
              <div class="red" id="inp-content-error"></div>
            </div>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <button type="submit" class="btn bg-main color-white color-white-hv">Gửi</button>
          </div>
          </form>
        </div>
      </div>
    </div>
@endsection

@section('jquery')
<script>
    $(document).ready(function () {
    var height_sidebar = $('.single-p-right').offset().top - 80;
    var height_content = $('.single-product-link').offset().top - 80;
    jQuery(window).scroll(function () {
        var top_single = jQuery(document).scrollTop();
        if (top_single > height_sidebar) {
            jQuery('.single-p-right').addClass('single-p-fixed');
        } else {
            jQuery('.single-p-right').removeClass('single-p-fixed');
        }
        if (top_single > height_content) {
            jQuery('.single-product-link').addClass('link-fixed');
        } else {
            jQuery('.single-product-link').removeClass('link-fixed');
        }
    })

    $('.single-product-link ul li:first-child a').addClass('active');

    $('.single-product-link ul li a, .single-product-link-fixed ul li a').click(function () {
        $('.single-product-link ul li a,.single-product-link-fixed ul li a').removeClass('active');
        $(this).addClass('active');
        var target = $(this).attr('href').slice(1);
        var screen = $("#" + target).offset().top - 100;
        $('html, body').animate({
            scrollTop: screen
        }, 1000);
    })

    $(document).ready(function () {
        var contentSection = $('.scroll-section');
        var navigation = $('.single-product-link-fixed');

        navigation.on('click', 'a', function (event) {
            event.preventDefault();
            smoothScroll($(this.hash));
        });

        $(window).on('scroll', function () {
            updateNavigation();
        })
        updateNavigation();

        function updateNavigation() {
            contentSection.each(function () {
                var sectionName = $(this).attr('id');
                var navigationMatch = $('.single-product-link-fixed a[href="#' + sectionName + '"]');
                if (($(this).offset().top - $(window).height() / 2 < $(window).scrollTop()) &&
                    ($(this).offset().top + $(this).height() - $(window).height() / 2 > $(window).scrollTop())) {
                    navigationMatch.addClass('active');
                } else {
                    navigationMatch.removeClass('active');
                }
            });
        }

        function smoothScroll(target) {
            $('body,html').animate({
                scrollTop: target.offset().top
            }, 800);
        }
    });

    $('#add-comment').on('click', function(){
        $('#ipt-comment-id').val(0);
        $('#modal-add-comment').modal('show');
    })

    $('#frm-add-comment').on('submit',function(e){
        e.preventDefault();
        $('.red').html('');
        $('.red').addClass('d-none');
        let url = $(this).attr('action');
        let data = new FormData($(this)[0]);
        axios.post(url,data).then(response => {
          $.notify('Thêm bình luận thành công và đang đợi duyệt!','success');
          $('#modal-add-comment').modal('hide');
        }).catch(err =>{
          let errors = err.response.data.errors;
          if (typeof errors.name != 'undefined') {
            $('#inp-name-error').html(errors.name[0]);
            $('#inp-name-error').removeClass('d-none');
          }
          if (typeof errors.email != 'undefined') {
            $('#inp-email-error').html(errors.email[0]);
            $('#inp-email-error').removeClass('d-none');
          }
          if (typeof errors.content != 'undefined') {
            $('#inp-content-error').html(errors.content[0]);
            $('#inp-content-error').removeClass('d-none');
          }
        });
    });

    $('#binhluan').on('click', '.btn-reply', function(){
        let comment_id = $(this).attr('data-id');
        $('#ipt-comment-id').val(comment_id);
        $('#modal-add-comment').modal('show');
    })
})
</script>
@endsection