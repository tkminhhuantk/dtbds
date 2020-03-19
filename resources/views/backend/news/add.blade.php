@extends('backend/masterbackend')

@section('title')
THÊM TIN TỨC
@endsection

@section('content')
        <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card flex-row" id="card-header">
                            <h5 class="card-header ff-google fw-bold">THÊM TIN TỨC MỚI</h5>
                            <a href="{{ route('AdminNews') }}">
                            	<span class="btn btn-brand btn-add" data-toggle="modal" data-target="#add-investor">Quay lại</span>
                            </a>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <form id="frm-add-new" enctype="multipart/form-data" action="{{ route('AdminNewsPostAdd') }}">
                                    @csrf
                                    <div class="alert alert-success d-none" id="mess-add"></div>
                                    <div class="form-group">
                                        <label class="col-form-label">Tiêu đề <span class="red">*</span></label>
                                        <input id="inp-title" type="text" name="title" class="form-control" placeholder="Nhập tên bài viết" value="{{ old('title') }}" data-url="{{ route('AdminNewsGetCreateSlug') }}">
                                        <div class="alert alert-danger d-none" id="inp-title-error"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Slug <span class="red">*</span></label>
                                        <input type="text" name="slug" class="form-control" placeholder="Nhập slug dự án" value="{{ old('slug') }}" id="inp-slug">
                                        <div class="alert alert-danger d-none" id="inp-slug-error"></div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-form-label">Chọn loại bài đăng</label>
                                        <select id="select-content" class="form-control">
                                            <option value="">- Chọn lại bài đăng -</option>
                                            <option value="1"> Content</option>
                                            <option value="2"> Tin tức</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                    	<div class="flex-row" style="justify-content: flex-start; align-content: center;">
                                    		<label>Meta description</label>
                                        <textarea name="meta_description" class="form-control" rows="3" placeholder="Vui lòng nhập meta description"></textarea>
                                    	</div>
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea name="except" class="form-control" rows="4" placeholder="Vui lòng nhập mô tả"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Meta keyword</label>
                                        <textarea id="meta_keyword" name="meta_keyword" class="form-control" rows="2" placeholder="Vui lòng nhập meta keyword"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Seo Head</label>
                                        <textarea name="seo_head" class="form-control" rows="4" placeholder="Vui lòng nhập seo head"></textarea>
                                    </div>
                                    <div class="form-group">
                                    	<label>Hình đại diện <span class="red">*</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label class="custom-image-upload ct-img-new">
                                        	<input type="file" class="form-control d-none" name="link_avatar" id="imgInp">
                                        </label>
                                        <div class="alert alert-danger d-none" id="inp-avatar-error"></div>
                                    </div>
                                    <div class="form-group">
                                    	<label>Nội dung</label>
                                        <textarea id="content-new" name="content" class="form-control" rows="20" placeholder="Nhập nội dung bài viết"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Tags</label>
                                    </div>
                                    <div class="form-group">
                                        <select class="js-example-basic-multiple" name="tags[]" multiple="multiple" class="form-control" style="width: 100%">
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group"></div>
                                    <div class="form-group">
                                    	<label>Trạng thái</label>
                                    </div>
                                    <div class="form-group">
                                    	<div class="button-switch">
                                            <input name="status" type="checkbox" id="switch-blue" class="switch inp-status btn-change" checked="checked" value="true" />
                                        </div>
                                    </div><hr />
                                    <div class="form-group">
                                        <button class="btn btn-info" type="submit">Lưu lại</button>
                                        <a href="{{ route('AdminNewsGetAdd') }}" class="btn btn-brand color-white">Nhập lại</a>
                                        <a href="{{ route('AdminNews') }}" class="btn btn-danger color-white">Quay lại</a>
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
    $('.js-example-basic-multiple').select2();
    let url = '{{ url('/') }}/cpanel/assets/ckeditor';
    CKEDITOR.replace('content', {
        filebrowserBrowseUrl: url + '/ckfinder/ckfinder.html',
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });

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

    $('#frm-add-new').on('submit', function(e){
        e.preventDefault();
        $('.alert').html('');
        $('.alert').addClass('d-none');
        let url = $(this).attr('action');
        let data = new FormData($(this)[0]);
        data.append('content',CKEDITOR.instances['content-new'].getData());
        axios.post(url,data).then(response => {
            $.notify('Thêm thành công', 'success');
            CKEDITOR.instances['content-new'].setData('');
            $('.js-example-basic-multiple').val(null).trigger('change');
            $('#frm-add-new').trigger('reset');
            $('.ct-img-new').removeAttr('style');
        }).catch(err => {
            let errors = err.response.data.errors;
            if (typeof errors.title != 'undefined') {
                $('#inp-title-error').html(errors.title[0]);
                $('#inp-title-error').removeClass('d-none');
            }
            if (typeof errors.slug != 'undefined') {
                $('#inp-slug-error').html(errors.slug[0]);
                $('#inp-slug-error').removeClass('d-none');
            }
            if (typeof errors.link_avatar != 'undefined') {
                $('#inp-avatar-error').html(errors.link_avatar[0]);
                $('#inp-avatar-error').removeClass('d-none');
            }
            $.notify('Dữ liệu thêm không hợp lệ', 'error');
        });
    });
    
    $('#inp-title').change(function(){
        let title = $(this).val();
        let url = $(this).attr('data-url');
        axios.post(url, {title: title}, {
            headers: {
                'Content-Type': 'application/json',
            }
        }).then(response => {
            $('#inp-slug').val(response.data);
        }).catch(err => {
            $.notify('Tạo slug thất bại', 'error');
        });
    });
    
    $('#select-content').change(function(){
        let value = $(this).val();
        let meta_keyword = $('#meta_keyword');
        if( !meta_keyword.val().length){
            if(value == '1'){
                meta_keyword.val('');
            }
            if(value == '2'){
                meta_keyword.val('');
            } 
        }
         
    });
</script>
@endsection