@extends('backend/masterbackend')

@section('title')
THÊM DỰ ÁN
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/multi-select/css/multi-select.css') }}">
@endsection

@section('content')
<div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card flex-row" id="card-header">
                            <h5 class="card-header ff-google fw-bold">THÊM DỰ ÁN MỚI</h5>
                            <a href="{{ route('AdminProjects') }}">
                            	<span class="btn btn-brand btn-add" data-toggle="modal" data-target="#add-investor">Quay lại</span>
                            </a>
                        </div>
                        <div class="card">
                            <div class="card-body" id="body-add">

                                @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                                @else
                                <div class="alert alert-success d-none"></div>
                                @endif

                                <form id="frm-add-project" enctype="multipart/form-data" action="{{ route('AdminProjectsPostAdd') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-form-label">Tiêu đề <span class="red">*</span></label>
                                        <input id="inp-title" type="text" name="title" class="form-control" placeholder="Nhập tên dự án" value="{{ old('title') }}" data-url="{{ route('ProjectsGetCreateSlug') }}">
                                        @error('title')
                                            <div class="alert alert-danger" id="inp-title-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Slug <span class="red">*</span></label>
                                        <input type="text" name="slug" class="form-control" placeholder="Nhập slug dự án" value="{{ old('slug') }}" id="inp-slug">
                                        @error('slug')
                                            <div class="alert alert-danger" id="inp-slug-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-form-label">Chọn loại bài đăng</label>
                                        <select id="select-content" class="form-control">
                                            <option value="">- Chọn loại bài đăng -</option>
                                            <option value="1"> Mua bán</option>
                                            <option value="2"> Cho thuê</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Meta description</label>
                                        <textarea name="meta_description" class="form-control" rows="3" placeholder="Nhập mô tả dự án">{{ old('meta_description') }}</textarea>   
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea name="except" class="form-control" rows="3" placeholder="Nhập mô tả">{{ old('except') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Meta keyword</label>
                                        <textarea id="meta_keyword" name="meta_keyword" class="form-control" rows="2" placeholder="Nhập keyword">{{ old('meta_keyword') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Seo Head</label>
                                        <textarea name="seo_head" class="form-control" rows="4" placeholder="Nhập seo head">{{ old('seo_head') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Địa chỉ  <span class="red">*</span></label>
                                        <input type="text" name="address" class="form-control" placeholder="Nhập địa chỉ" value="{{ old('address') }}">
                                        @error('address')
                                            <div class="alert alert-danger" id="inp-title-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Giá <span class="red">*</span></label>
                                        <input type="text" name="price" class="form-control" placeholder="Nhập giá" value="{{ old('price') }}">
                                        @error('price')
                                            <div class="alert alert-danger" id="inp-title-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Diện tích <span class="red">*</span></label>
                                        <input type="text" name="acreage" class="form-control" placeholder="Nhập diện tích" value={{ old('acreage') }}>
                                        @error('acreage')
                                            <div class="alert alert-danger" id="inp-acreage-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Dự án nổi bật</label>
                                    </div>
                                    <div class="form-group">
                                        @if(old('seo') == 'true')
                                        <input type="checkbox" checked="checked" name="seo" data-toggle="toggle" data-on="Bật" data-off="Tắt" value="true">
                                        @else
                                        <input type="checkbox" name="seo" data-toggle="toggle" data-on="Bật" data-off="Tắt" value="true">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                    	<label>Hình đại diện <span class="red">*</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label class="custom-image-upload ct-img-new">
                                        	<input type="file" class="form-control d-none" name="avatar" id="imgInp">
                                        </label>
                                        @error('avatar')
                                            <div class="alert alert-danger" id="inp-avatar-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Hình ảnh <span class="red">*</span></label>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-file-image">
                                            <input type="file" id="fileImage" name="url_images[]"
                                                     class="custom-file-image-input"
                                                     accept="image/*"
                                                     multiple="multiple">
                                            <div class="custom-file-preview">
                                                <label class="custom-file-preview-add" for="fileImage">
                                                    <i class="fas fa-plus"></i>
                                                </label>
                                            </div>
                                        </div>
                                        <p class="text-danger error-product_image"></p>
                                        @error('url_images')
                                        <div class="alert alert-danger" style="width: 100%">{{ $message }}</div>
                                        @enderror
                                        @error('url_images.*')
                                        <div class="alert alert-danger" style="width: 100%">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Tổng quang</label>    
                                        <textarea name="overview" class="form-control">{{ old('overview') }}</textarea>                            
                                    </div>
                                    <div class="form-group">
                                        <div class="card">
                                            <h5 class="card-header ff-google fw-bold">Tiện ích</h5>
                                            <div class="card-body">
                                                <select name="utilities[]" id='keep-order' multiple="multiple">
                                                    @foreach($utilities as $utiliti)
                                                        @php
                                                            $check = 0;
                                                            if(old('utilities') != null):
                                                            foreach (old('utilities') as $pu) {
                                                                if($utiliti->id == $pu){ $check = 1; break; } 
                                                            }
                                                            endif;
                                                        @endphp
                                                        @if($check == 1)
                                                        <option value='{{ $utiliti->id }}' selected="selected">
                                                            {{ $utiliti->title }}
                                                        </option>
                                                        @else
                                                        <option value='{{ $utiliti->id }}' >
                                                            {{ $utiliti->title }}
                                                        </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="card">
                                            <h5 class="card-header ff-google fw-bold">Thông tin chi tiết</h5>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <select class="form-control" id="sel-detail">
                                                            <option value="">Chọn thông tin chi tiết cần thêm vào</option>
                                                            @foreach($details as $detail)
                                                            <option value="{{ $detail->id }}" data-title="{{ $detail->title }}">{{ $detail->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="alert alert-danger d-none" id="mess-error-detail"></div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <button class="btn btn-primary" id="btn-add-detail">Thêm</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body" id="content-detail">
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group">
                                        <label>Danh mục</label>
                                        <select class="form-control" name="category_id">
                                            @foreach($categories as $category)
                                            <optgroup label="{{ $category->title }}">
                                                @foreach($category->sub as $sub)
                                                    @if($sub->id == old('category_id'))
                                                    <option value="{{ $sub->id }}" selected="selected">{{ $sub->title }}</option>
                                                    @else
                                                    <option value="{{ $sub->id }}">{{ $sub->title }}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Vị trí dự án</label>
                                        <textarea name="map" rows="6" class="form-control" placeholder="Dán thẻ iframe google map">{{ old('map') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Tags</label>
                                    </div>
                                    <div class="form-group">
                                        <select class="js-example-basic-multiple" name="tags[]" multiple="multiple" class="form-control" style="width: 100%">
                                            @foreach ($tags as $tag)
                                                @php
                                                    $check = 0;
                                                    if(old('tags') != null):
                                                    foreach (old('tags') as $taged) {
                                                        if($tag->id == $taged){ $check = 1; break; } 
                                                    }
                                                    endif;
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
                                        <label>Tình trạng</label>
                                        <select name="state" class="form-control">
                                            @if(old('state') == 1)
                                            <option value="1" selected="selected">Đang mở bán</option>
                                            @else
                                            <option value="1">Đang mở bán</option>
                                            @endif

                                            @if(old('state') == 2)
                                            <option value="2" selected="selected">Sắp mở bán</option>
                                            @else
                                            <option value="2">Sắp mở bán</option>
                                            @endif

                                            @if(old('state') == 3)
                                            <option value="3" selected="selected">Đã hết hạn</option>
                                            @else
                                            <option value="3">Đã hết hạn</option>
                                            @endif

                                            @if(old('state') == 4)
                                            <option value="4" selected="selected">Đang cập nhật</option>
                                            @else
                                            <option value="4">Đang cập nhật</option>
                                            @endif
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                    	<label>Trạng thái</label>
                                    </div>
                                    <div class="form-group">
                                        @if(old('status') == 'true')
                                    	<input type="checkbox" checked="checked" name="status" data-toggle="toggle" data-on="Bật" data-off="Tắt" value="true">
                                    	@else
                                    	<input type="checkbox" name="status" checked data-toggle="toggle" data-on="Bật" data-off="Tắt" value="true">
                                    	@endif
                                    </div><hr />
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Lưu lại</button>
                                        <a href="{{ route('AdminProjectsGetAdd') }}"><span class="btn btn-brand">Nhập lại</span></a>
                                        <a href="{{ route('AdminProjects') }}"><span class="btn btn-danger">Quay lại</span></a>
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
    $('#keep-order').multiSelect({ keepOrder: true });
    let url = '{{ url('/') }}/ckeditor';
    
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

    CKEDITOR.replace('overview', {
        filebrowserBrowseUrl: url + '/ckfinder/ckfinder.html',
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });

    function messAdd (mess = '', aClass = ''){
        $('#mess-add').html('');
        $('#mess-add').html(mess);
        $('#mess-add').addClass(aClass);
        $('#mess-add').removeClass('d-none');
    }

    $('#btn-add-detail').click(function(e){
        e.preventDefault();
        $('.alert').html('');
        $('.alert').addClass('d-none');
        let id = $('#sel-detail option:selected').val();
        let title = $('#sel-detail option:selected').text();
        if(id != ''){
            $('#content-detail').append(`
                                                    <div class="form-group">
                                                        <label>${title}</label>
                                                        <div class="row">
                                                            <input type="text" name="detail_id[]" value="${id}" class="d-none" />
                                                            <input type="text" name="value[]" class="form-control col-md-11">
                                                            <div class="col-md-1">
                                                                <button class="btn btn-danger btn-del-project-detail" title="Xóa" data-id="${id}" data-title="${title}"><i class="fas fa-trash"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                `);
            $('#sel-detail option:selected').remove();
        }else{
            $('#mess-error-detail').html('');
            $('#mess-error-detail').html('Chưa chọn danh mục hoặc danh mục đã thêm hết');
            $('#mess-error-detail').removeClass('d-none');
        }
    })

function CustomUpload(element) {
    let ref = this;
    this.imageFileArray = [];
    this.element = $(element);
    this.element.on('change', async function (e) {
        let arrayImage = e.target.files;
        let start = ref.imageFileArray.length;
        let validExt = ['image/jpg', 'image/jpeg', 'image/png'];
        $.each(arrayImage, (index, item) => {
            if ($.inArray(item.type,validExt) != -1) {
                item.index = start + index;
                ref.imageFileArray.push(item);
                let fr = new FileReader();
                let imageItem = '';
                fr.onload = function (event) {
                    imageItem += `
                    <div class="custom-file-preview-item"
                    style="background: url('${event.target.result}')">
                    <span data-key="${item.index}" class="custom-file-preview-del"><i
                    class="fa fa-times"></i></span>
                    </div>
                    `;
                    $('.custom-file-preview').append(imageItem);
                }
                fr.readAsDataURL(item);
            }else{
                alert('This is not an image');
            }
            //Array images
            console.log(ref.imageFileArray);
        });
    });
    this.element.parent().on('click', '.custom-file-preview-del', function (e) {
        e.preventDefault();
        let del = $(this);
        let id = del.data('key');
        let index = ref.imageFileArray.findIndex(item => {
            return item.index == id;
        });
        ref.imageFileArray.splice(index, 1);
        del.parent().remove();
        //Array after deleted
        console.log(ref.imageFileArray);
    });
}
const upload = new CustomUpload('#fileImage');

    $('#content-detail').on('click', '.btn-del-project-detail', function(){
        let detail_id = $(this).attr('data-id');
        let detail_title = $(this).attr('data-title');
        $('#sel-detail').append(`
                <option value="${detail_id}" data-title="${detail_title}">${detail_title}</option>
            `);
        $(this).parent().parent().parent().remove();
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