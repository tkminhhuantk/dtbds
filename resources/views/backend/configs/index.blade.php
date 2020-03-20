@extends('backend/masterbackend')

@section('title')
CẤU HÌNH 
@endsection

@section('content')
		<div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card flex-row" id="card-header">
                            <h5 class="card-header ff-google fw-bold">THÔNG TIN CẤU HÌNH</h5>
                        </div>
                        <div class="card">
                            <div class="card-body" id="body-add">
                                <form id="frm-add-config" enctype="multipart/form-data" action="{{ route('AdminConfigUpdate') }}" method="post">
                                    @csrf
                                    <div class="alert alert-success d-none" id="mess-add"></div>
                                    <div class="form-group">
                                        <label class="col-form-label">Tên website <span class="red">*</span></label>
                                        <input type="website_name" name="website_name" class="form-control" placeholder="Vui lòng nhập tên website" value="{{ $config->website_name }}">
                                        <div class="alert alert-danger d-none" id="inp-website_name-error"></div>
                                    </div>

                                    <div class="form-group">
                                    	<div class="flex-row" style="justify-content: flex-start; align-content: center;">
                                    		<label>Meta description</label>
                                        <textarea name="description" class="form-control" rows="3" placeholder="Vui lòng nhập meta description">{{ $config->description }}</textarea>
                                    	</div>
                                    </div>

                                    <div class="form-group">
                                        <label>Meta keywords</label>
                                        <textarea name="keywords" class="form-control" rows="2" placeholder="Vui lòng nhập meta keyword">{{ $config->keywords }}</textarea>
                                    </div>

									<div class="form-group">
                                        <label>Seo Head</label>
                                        <textarea name="seo_head" class="form-control" rows="4" placeholder="Vui lòng nhập seo head">{{ $config->seo_head }}</textarea>
                                    </div>

                                    <div class="form-group">
                                    	<label>Logo website <span class="red">*</span></label>
                                    </div>
                                    <div class="form-group">
                                    	@if ($config->logo != null)
                                    		<label class="custom-image-upload ct-img-new" style="background: url({{ asset($config->logo) }});height: 100px; background-size: 100% 100%">
                                    	@else
                                    		<label class="custom-image-upload ct-img-new" style="height: 100px;">
                                    	@endif
                                        	<input type="file" class="form-control d-none" name="logo" id="imgInp">
                                        </label>
                                        <div class="alert alert-danger d-none" id="inp-avatar-error"></div>
                                    </div>
                                    
                                    <div class="form-group d-none">
                                        <label>Mô tả</label>
                                        <textarea name="except" class="form-control" rows="4" placeholder="Vui lòng nhập mô tả">{{ $config->except }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label">Email <span class="red">*</span></label>
                                        <input type="text" name="email" class="form-control" placeholder="Vui lòng nhập email" value="{{ $config->email }}">
                                        <div class="alert alert-danger d-none" id="inp-email-error"></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label">Số điện thoại <span class="red">*</span></label>
                                        <input type="text" name="phone" class="form-control" placeholder="Vui lòng nhập số điện thoại" value="{{ $config->phone }}">
                                        <div class="alert alert-danger d-none" id="inp-phone-error"></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label">Thời gian làm việc <span class="red">*</span></label>
                                        <input type="text" name="time" class="form-control" placeholder="Vui lòng nhập thời gian làm việc" value="{{ $config->time }}">
                                        <div class="alert alert-danger d-none" id="inp-time-error"></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label">Địa chỉ <span class="red">*</span></label>
                                        <input type="text" name="address" class="form-control" placeholder="Vui lòng nhập địa chỉ" value="{{ $config->address }}">
                                        <div class="alert alert-danger d-none" id="inp-address-error"></div>
                                    </div>


                                    <div class="form-group">
                                        <button class="btn btn-info" type="submit">Lưu lại</button>
                                        <a href="{{ route('AdminConfig') }}" class="btn btn-brand color-white">Nhập lại</a>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
@endsection

@section('jquery')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">

	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$(input).parent().css('background-image','url('+e.target.result+')')
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#imgInp").change(function() {
		readURL(this);
    });

    function messAdd (mess = '', aClass = ''){
        $('#mess-add').html('');
        $('#mess-add').html(mess);
        $('#mess-add').addClass(aClass);
        $('#mess-add').removeClass('d-none');
    }

    $('#frm-add-config').submit( function(e){
        e.preventDefault();
        $('.alert').html('');
        $('.alert').addClass('d-none');
        let url = $(this).attr('action');
        let data = new FormData($(this)[0]);
        axios.post(url,data).then(response => {
            $.notify('Cập nhật thành công', 'success');
            $('#frm-add-new').trigger('reset');
        }).catch(err => {
            let errors = err.response.data.errors;
            $.notify('Cập nhật thất bại', 'error');
            if (typeof errors.website_name != 'undefined') {
                $('#inp-website_name-error').html(errors.website_name[0]);
                $('#inp-website_name-error').removeClass('d-none');
            }
            if (typeof errors.phone != 'undefined') {
                $('#inp-phone-error').html(errors.phone[0]);
                $('#inp-phone-error').removeClass('d-none');
            }
            if (typeof errors.email != 'undefined') {
                $('#inp-email-error').html(errors.email[0]);
                $('#inp-email-error').removeClass('d-none');
            }
            if (typeof errors.time != 'undefined') {
                $('#inp-time-error').html(errors.time[0]);
                $('#inp-time-error').removeClass('d-none');
            }
            if (typeof errors.address != 'undefined') {
                $('#inp-time-address').html(errors.address[0]);
                $('#inp-time-address').removeClass('d-none');
            }
        });
    })
</script>
@endsection