@extends('backend/masterbackend')

@section('title')
CẬP NHẬT TIN TỨC
@endsection

@section('content')
<div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card flex-row" id="card-header">
                            <h5 class="card-header ff-google fw-bold">CẬP NHẬT TIN TỨC</h5>
                            <a href="{{ route('AdminNews') }}">
                            	<span class="btn btn-brand btn-add" data-toggle="modal" data-target="#add-investor">Quay lại</span>
                            </a>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <form id="frm-update-new" enctype="multipart/form-data" action="{{ route('AdminNewsPostUpdate',$new->id) }}">
                                    @csrf
                                    <div class="alert alert-success d-none" id="mess-add"></div>
                                    <div class="form-group">
                                        <label class="col-form-label">Tiêu đề</label>
                                        <input type="text" name="title" class="form-control" value="{{ $new->title }}">
                                        <div class="alert alert-danger d-none" id="inp-title-error"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Slug <span class="red">*</span></label>
                                        <input type="text" name="slug" class="form-control" placeholder="Nhập tên dự án" value="{{ $new->slug }}">
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
                                        <textarea name="meta_description" class="form-control" rows="3">{{ $new->meta_description }}</textarea>
                                    	</div>
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea name="except" class="form-control" rows="4">{{ $new->except }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Meta keyword</label>
                                        <textarea id="meta_keyword" name="meta_keyword" class="form-control" rows="2">{{ $new->meta_keyword }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Seo Head</label>
                                        <textarea name="seo_head" class="form-control" rows="4">{{ $new->seo_head }}</textarea>
                                    </div>
                                    <div class="form-group">
                                    	<label>Hình đại diện</label>
                                    </div>
                                    <div class="form-group">
                                        <label class="custom-image-upload ct-img-new" style="background-image: url({{ url($new->link_avatar) }})">
                                        	<input type="file" class="form-control d-none" name="link_avatar" id="imgInp">
                                        </label>
                                        <div class="alert alert-danger d-none" id="inp-avatar-error"></div>
                                    </div>
                                    <div class="form-group">
                                    	<label>Nội dung</label>
                                        <textarea id="content-new" name="content" class="form-control" rows="20" placeholder="Nhập nội dung bài viết">{{ $new->content }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Tags</label>
                                    </div>
                                    <div class="form-group">
                                        <select class="js-example-basic-multiple" name="tags[]" multiple="multiple" class="form-control" style="width: 100%">
                                            @foreach ($tags as $tag)
                                               @php
                                                    $check = 0;
                                                    foreach ($tagNew as $taged) {
                                                        if($tag->id == $taged->tag_id){ $check = 1; break; } 
                                                    }
                                                @endphp
                                                @if($check == 1)
                                                    <option value="{{ $tag->id }}" selected="selected">{{ $tag->title }}</option>
                                                @else
                                                    <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                    	<label>Duyệt</label>
                                    </div>
                                    <div class="form-group">
                                        @if($new->status == 1)
                                        <div class="button-switch">
                                    	   <input name="status" type="checkbox" id="switch-blue" class="switch inp-status btn-change" checked="checked" value="true" />
                                        </div>
                                        @else
                                        <div class="button-switch">
                                            <input name="status" type="checkbox" id="switch-blue" class="switch inp-status btn-change" value="true" />
                                        </div>
                                        @endif
                                    </div><hr />
                                    <div class="form-group">
                                        <button class="btn btn-info" type="submit">Lưu lại</button>
                                        <a href="{{ route('AdminNewsGetUpdate', $new->id) }}" class="btn btn-brand">Nhập lại</a>
                                        <a href="{{ route('AdminNews') }}" class="btn btn-danger">Quay lại</a>
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

    $('#frm-update-new').on('submit', function(e){
        e.preventDefault();
        let url = $(this).attr('action');
        let data = new FormData($(this)[0]);
        data.append('content',CKEDITOR.instances['content-new'].getData());
        axios.post(url,data).then(response => {
            $.notify('Cập nhật thành công tin tức!', 'success');
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
            $.notify('Thông tin bài viết không chính xác!', 'warn');
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