@extends('frontend/master')

@section('title')
Liên hệ
@endsection

@section('css')
@endsection

@section('content')
<div class="get-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="title">
                    <h1>Liên hệ</h1>
                </div>
            </div>
            <div class="col-md-5">
                <div class="breadcrumb">
                    <ul>
                        <li>
                            <a href="{{ route('Home') }}">Trang chủ</a>
                        </li>
                        <li class="current">
                            <a href="{{ route('Contact') }}">Liên hệ</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@php
    $config = App\Config::first();
@endphp

<section class="main main-contact main main-form-register">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title">
                    <h2>LIÊN HỆ VỚI CHÚNG TÔI</h2>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="contact-item">
                            <div class="contact-content">
                                <div class="contact-icon">
                                    <i class="flaticon-clock"></i>
                                </div>
                                <div class="contact-title">
                                    Thời gian làm việc
                                </div>
                                <div class="contact-desc">
                                    <div>{!! $config->time !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h3 style="text-align: center; font-size: 1.8rem; font-weight: 600; padding-bottom: 20px">Đăng ký tư vấn nhanh</h3>
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
</script>
@endsection