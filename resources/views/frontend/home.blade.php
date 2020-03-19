@extends('frontend/master')

@section('title')
@endsection

@section('css')
@endsection

@section('content')
<section class="banner" style="position: relative;">
    <div class="slider-banner owl-carousel owl-theme">
        @foreach($sliders as $slider)
        <div class="slider-item">
            <a href="javascript:void(0)">
                <img src="{{ asset($slider->url_slider) }}" class="img-banner-responsive"  alt="Banner">
            </a>
        </div>
        @endforeach
    </div>
    <div class="search" style="position: absolute; top: 40%; width: 100% ; z-index: 100;">
        <div class="container" id="form-search">
            <h2 class="d-none">Banner</h2>
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
                        <input type="text" id="inpt-search-realty" name="search" placeholder="Nhập nội dung tìm kiếm" class="form-control">
                    </div>
                    <div class="col-md-4 p-1 ">
                        <select name="slugCatSub" class="form-control" id="cat_sub">
                            <option value="all">Chọn danh mục</option>
                            @foreach($categories as $cat)
                            <optgroup label="{{ $cat->title }}">
                                @foreach($cat->sub as $sub)
                                <option value="{{ $sub->slug }}">{{ $sub->title }}</option>
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

<section class="main main-actions">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <a href="{{ route('ProjectSeo') }}" class="action-item d-md-flex align-items-center justify-content-center">
                    <div class="action-icon">
                        <h2><i class="fas fa-chart-pie"></i> Dự Án Nổi Bật</h2>
                    </div>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="#" data-toggle="modal" data-target="#registerDriver"
                   class="action-item d-md-flex align-items-center justify-content-center">
                    <div class="action-icon">
                        <i class="fas fa-home"></i> Đăng ký nhận thông tin
                    </div>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="{{ route('Contact') }}"
                   class="action-item d-md-flex align-items-center justify-content-center">
                    <div class="action-icon">
                        <i class="fas fa-calculator"></i> Liên hệ
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="main main-product">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title">
                    <h2>DỰ ÁN MỚI NHẤT</h2>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    @foreach($projects as $project)
                    <div class="col-sm-6 col-md-4">
                        <div class="product-item p-0">
                            <div class="product-avatar">
                                <a href="{{ route('Project',['slugCat'=>$project->categories->slug, 'slugPro'=>$project->slug]) }}" title="Xem chi tiết">
                                    <img src="{{ $project->avatar }}" alt="{{ $project->title }}" class="custom-image-cat">
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
                            <div class="text-center limit-line-2" style="margin: 10px 10px; line-height: 24px; ">
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
                    
                </div>
            </div>
        </div>
    </div>
</section>

<section class="main main-buy">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="buy-item d-flex align-items-start justify-content-start">
                    <div class="buy-icon d-flex align-items-center">
                        <i class="fas fa-dollar-sign"></i>
                        <h2 class="d-none">Vì sao chọn chúng tôi</h2>
                    </div>
                    <div class="buy-content">
                        <div class="buy-title">
                            CAM KẾT BÁN GIÁ RẺ NHẤT
                        </div>
                        <div class="buy-desc">
                            Với nhiều Chương trình khuyến mãi hấp dẫn, quà tặng đặc biệt và liên kết với mạng lưới ngân
                            hàng lớn mạnh tại Việt Nam sẽ giúp cho người dùng yên tâm về chúng tôi
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="buy-item d-flex align-items-start justify-content-start">
                    <div class="buy-icon d-flex align-items-center">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="buy-content">
                        <div class="buy-title">
                            HẾT LÒNG VÌ KHÁCH HÀNG
                        </div>
                        <div class="buy-desc">
                            Đội ngũ tư vấn bán hàng luôn sẵn lòng giúp tư vấn để tìm ra căn hộ ưng ý cho quý khách
                            hàng. Hỗ trợ 24/7 tận tâm, nhiệt tình, có trách nhiệm.
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="buy-item d-flex align-items-start justify-content-start">
                    <div class="buy-icon d-flex align-items-center">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="buy-content">
                        <div class="buy-title">
                            ĐẠI LÝ TỐT NHẤT
                        </div>
                        <div class="buy-desc">
                            Chúng tôi tự hào là đại lý bán hàng tốt nhất trong những năm qua, với đội ngũ nhân viên đào
                            tạo chuyên nghiệp luôn nằm top tư vấn bán hàng xuất sắc trong hệ thống sẽ mang đến chất
                            lượng, dịch vụ tốt nhất.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="slider-image owl-carousel owl-theme">
                <div class="image-item">
                    <a href="{{ asset('frontend/images/product/product01.jpg') }}" data-lightbox="roadtrip">
                        <img src="{{ asset('frontend/images/product/product01.jpg') }}" alt="Hình hoạt động">
                    </a>
                </div>
                <div class="image-item">
                    <a href="{{ asset('frontend/images/product/product02.jpg') }}" data-lightbox="roadtrip">
                        <img src="{{ asset('frontend/images/product/product02.jpg') }}" alt="Hình hoạt động">
                    </a>
                </div>
                <div class="image-item">
                    <a href="{{ asset('frontend/images/product/product03.jpg') }}" data-lightbox="roadtrip">
                        <img src="{{ asset('frontend/images/product/product03.jpg') }}" alt="Hình hoạt động">
                    </a>
                </div>
                <div class="image-item">
                    <a href="{{ asset('frontend/images/product/product04.jpg') }}" data-lightbox="roadtrip">
                        <img src="{{ asset('frontend/images/product/product04.jpg') }}" alt="Hình hoạt động">
                    </a>
                </div>
                <div class="image-item">
                    <a href="{{ asset('frontend/images/product/product05.jpg') }}" data-lightbox="roadtrip">
                        <img src="{{ asset('frontend/images/product/product05.jpg') }}" alt="Hình hoạt động">
                    </a>
                </div>
                
            </div>
        </div>
    </div>
</section>

<section class="main main-post">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title">
                    <h2>TIN TỨC MỚI NHẤT</h2>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    @foreach($news as $new)
                    <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                        <div class="post-item">
                            <div class="post-avatar">
                                <a href="{{ route('SingleNews', $new->slug) }}">
                                    <img src="{{ asset($new->link_avatar) }}" alt="{{ $new->title }}">
                                </a>
                                <a href="{{ route('SingleNews', $new->slug) }}" title="Xem chi tiết">
                                    <div class="post-action">
                                        <i class="far fa-eye" style="color: var(--base-color); border-radius: 50%; border: solid 2px var(--base-color); padding: 10px"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="post-content">
                                <div class="post-title">
                                    <a href="{{ route('SingleNews', $new->slug) }}" title="{{ $new->title }}">
                                        {{ $new->title }}
                                    </a>
                                </div>
                                <div class="post-day">
                                    Đăng ngày: <span>{{ $new->created_at->format('d-m-Y') }}</span>
                                </div>
                                <div class="post-desc text-justify">
                                    {{ $new->except }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<section class="main main-form-register">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="column-left d-flex align-items-center justify-content-start">
                    <h3 class="title">Đăng ký tư vấn nhanh</h3>
                    <span>Hãy để thông tin lại, tôi sẽ liên hệ cho bạn ngay!</span>
                </div>
            </div>
            <div class="col-md-9">
                <form action="{{ route('ContactPostAdd') }}" method="post" id="frm-add-contact-page">
                    <div class="column-right">
                        <div class="form-group">
                            @csrf
                            <input type="text" name="name" placeholder="Tên của bạn *" class="form-control" />
                            <div class="red d-none" id="inp-name-error"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" placeholder="Email *" class="form-control" />
                            <div class="red d-none" id="inp-email-error"></div>
                        </div>
                    </div>
                    <div class="column-right">
                        <div class="form-group">
                            <input type="text" name="phone" placeholder="Điện thoại" class="form-control" />
                        </div>
                        <div class="form-group">
                            <input type="text" name="title" placeholder="Tiêu đề *" class="form-control" />
                            <div class="red d-none" id="inp-title-error"></div>
                        </div>
                        
                    </div>
                    <div class="column-right">
                        <div class="form-group">
                            <textarea name="content" class="form-control" placeholder="Nội dung *" rows="3"></textarea>
                            <div class="red d-none" id="inp-content-error"></div>
                        </div>
                    </div>
                    <div class="column-right">
                        <div class="form-group">
                            <button type="submit" class="form-control">Gửi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('jquery')
<script>
$(`#frm-add-contact-page`).on('submit', function(e){
    e.preventDefault();
  $('.red').html('');
  $('.red').addClass('d-none');
  let url = $(this).attr('action');
  let data = new FormData($(this)[0]);
  axios.post(url,data).then(response => {
    $(this).trigger('reset');
    $('#frm-add-contact-page').modal('hide');
    $.notify("Gửi thành công thông tin liên hệ!", "success");
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
    if (typeof errors.title != 'undefined') {
      $('#inp-title-error').html(errors.title[0]);
      $('#inp-title-error').removeClass('d-none');
    }
    if (typeof errors.content != 'undefined') {
      $('#inp-content-error').html(errors.content[0]);
      $('#inp-content-error').removeClass('d-none');
    }
    $.notify("Sai thông tin form liên hệ!", "error");
  });
});

$(`#frm-add-contact-popup`).on('submit', function(e){
    e.preventDefault();
  $('.red').html('');
  $('.red').addClass('d-none');
  let url = $(this).attr('action');
  let data = new FormData($(this)[0]);
  axios.post(url,data).then(response => {
    $(this).trigger('reset');
    $.notify("Gửi thành công thông tin liên hệ!", "success");
  }).catch(err =>{
    let errors = err.response.data.errors;
    if (typeof errors.name != 'undefined') {
      $('#inp-name-error-popup').html(errors.name[0]);
      $('#inp-name-error-popup').removeClass('d-none');
    }
    if (typeof errors.email != 'undefined') {
      $('#inp-email-error-popup').html(errors.email[0]);
      $('#inp-email-error-popup').removeClass('d-none');
    }
    if (typeof errors.title != 'undefined') {
      $('#inp-title-error-popup').html(errors.title[0]);
      $('#inp-title-error-popup').removeClass('d-none');
    }
    if (typeof errors.content != 'undefined') {
      $('#inp-content-error-popup').html(errors.content[0]);
      $('#inp-content-error-popup').removeClass('d-none');
    }
    $.notify("Sai thông tin form liên hệ!", "error");
  });
});

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