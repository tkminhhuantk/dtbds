@extends('editor/masterbackend')

@section('title')
CHỈNH SỬA DỰ ÁN
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
                            <h5 class="card-header ff-google fw-bold">CHỈNH SỬA DỰ ÁN</h5>
                            <a href="{{ route('EditorProjects') }}">
                            	<span class="btn btn-brand btn-add" data-toggle="modal" data-target="#add-investor">Quay lại</span>
                            </a>
                        </div>
                        <div class="card" >
                            <div class="card-body" id="body-add">

                                @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                                @else
                                <div class="alert alert-success d-none"></div>
                                @endif

                                <form id="frm-update-project" enctype="multipart/form-data" action="{{ route('EditorProjectsPostUpdate', $project->id) }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-form-label">Tiêu đề <span class="red">*</span></label>
                                        <input type="text" name="title" class="form-control" placeholder="Nhập tên dự án" value="{{ $project->title }}">
                                        @error('title')
                                            <div class="alert alert-danger" id="inp-title-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Slug <span class="red">*</span></label>
                                        <input type="text" name="slug" class="form-control" placeholder="Nhập tên dự án" value="{{ $project->slug }}">
                                        @error('slug')
                                            <div class="alert alert-danger" id="inp-title-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-form-label">Chọn loại bài đăng</label>
                                        <select id="select-content" class="form-control">
                                            <option value="">- Chọn lại bài đăng -</option>
                                            <option value="1"> Mua bán</option>
                                            <option value="2"> Cho thuê</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Meta description</label>
                                        <textarea name="meta_description" class="form-control" rows="3" placeholder="Nhập mô tả dự án">{{ $project->meta_description }}</textarea>   
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea name="except" class="form-control" rows="3" placeholder="Nhập mô tả">{{ $project->except }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Meta keyword</label>
                                        <textarea id="meta_keyword" name="meta_keyword" class="form-control" rows="2" placeholder="Nhập keyword">{{ $project->meta_keyword }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Seo Head</label>
                                        <textarea name="seo_head" class="form-control" rows="4" placeholder="Nhập seo head">{{ $project->seo_head }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Địa chỉ  <span class="red">*</span></label>
                                        <input type="text" name="address" class="form-control" placeholder="Nhập địa chỉ" value="{{ $project->address }}">
                                        @error('address')
                                            <div class="alert alert-danger" id="inp-title-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Giá <span class="red">*</span></label>
                                        <input type="text" name="price" class="form-control" placeholder="Nhập giá" value="{{ $project->price }}">
                                        @error('price')
                                            <div class="alert alert-danger" id="inp-title-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Diện tích <span class="red">*</span></label>
                                        <input type="text" name="acreage" class="form-control" placeholder="Nhập diện tích" value="{{ $project->acreage }}">
                                        @error('acreage')
                                            <div class="alert alert-danger" id="inp-acreage-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Dự án nổi bật</label>
                                    </div>
                                    <div class="form-group">
                                        @if($project->seo == 0)
                                        <input type="checkbox" name="seo" data-toggle="toggle" data-on="Bật" data-off="Tắt" value="true">
                                        @else
                                        <input type="checkbox" checked="checked" name="seo" data-toggle="toggle" data-on="Bật" data-off="Tắt" value="true">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                    	<label>Hình đại diện</label>
                                    </div>
                                    <div class="form-group">
                                        @if($project->avatar != null)
                                        <label class="custom-image-upload ct-img-new" style="background-image: url({{ url($project->avatar) }})">
                                        @else
                                        <label class="custom-image-upload ct-img-new">
                                        @endif
                                        	<input type="file" class="form-control d-none" name="avatar" id="imgInp">
                                        </label>
                                        @error('avatar')
                                            <div class="alert alert-danger" id="inp-avatar-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <label>Hình ảnh <span class="red">*</span></label>
                                    </div>
                                    <div class="form-group row">
                                        <div class="row" id="body-sliders">
                                        @foreach($project->url_images as $url_images)
                                        <div class="col-md-2 col-sm-12 ct-img-slider custom-file-image" style="position: relative;">
                                            <img src="{{ asset($url_images) }}" style="width: 133px; height: 100px"/>
                                            <span class="custom-file-preview-del btn-del-slider" style="left: 6px!important" data-url="{{ route('ProjectsPostDeleteImage') }}" data-id="{{ $project->id }}" data-image="{{ $url_images }}">
                                                <i class="fa fa-times"></i>
                                            </span>
                                        </div>
                                        @endforeach
                                        </div>
                                    </div>
                                    <div class="form-group row">
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
                                        @error('images')
                                        <div class="alert alert-danger" style="width: 100%">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Tổng quang</label>
                                        <textarea id="content-new" name="overview" class="form-control" rows="20" placeholder="Nhập nội dung bài viết">{{ $project->overview }}</textarea>                                 
                                    </div>
                                    <div class="form-group">
                                        <div class="card">
                                            <h5 class="card-header ff-google fw-bold">Tiện ích</h5>
                                            <div class="card-body">
                                                <select name="utilities[]" id='keep-order' multiple="multiple">
                                                    @foreach($utilities as $utiliti)
                                                        @php
                                                            $check = 0;
                                                            foreach ($project_utiliti as $pu) {
                                                                if($utiliti->id == $pu->utiliti_id){ $check = 1; break; } 
                                                            }
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
                                                            @php
                                                                $check = 0;
                                                                foreach($project_detail as $pd){
                                                                    if($detail->id == $pd->detail_id){
                                                                        $check = 1; break;
                                                                    }
                                                                }
                                                            @endphp
                                                            @if($check == 0)
                                                            <option value="{{ $detail->id }}" data-title="{{ $detail->title }}">{{ $detail->title }}</option>
                                                            @endif
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
                                                @foreach($project_detail as $pd)
                                                <div class="form-group">
                                                    <label>{{ $pd->details->title }}</label>
                                                    <div class="row">
                                                        <input type="text" name="detail_id[]" value="{{ $pd->details->id }}" class="d-none" />
                                                        <input type="text" name="value[]" class="form-control col-md-11" value="{{ $pd->value }}">
                                                        <div class="col-md-1">
                                                            <button class="btn btn-danger btn-del-project-detail" title="Xóa" data-id="{{ $pd->details->id }}" data-title="{{ $pd->details->title }}"><i class="fas fa-trash"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Danh mục</label>
                                        <select class="form-control" name="category_id">
                                            @foreach($categories as $category)
                                            <optgroup label="{{ $category->title }}">
                                                @foreach($category->sub as $sub)
                                                @if($sub->id == $project->category_id)
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
                                        <textarea name="map" rows="6" class="form-control" placeholder="Dán thẻ iframe google map">{{ $project->map }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Tags</label>
                                    </div>
                                    <div class="form-group">
                                        <select class="js-example-basic-multiple" name="tags[]" multiple="multiple" class="form-control" style="width: 100%">
                                            @foreach ($tags as $tag)
                                                @php
                                                    $check = 0;
                                                    foreach ($tagProject as $taged) {
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
                                        <label>Tình trạng</label>
                                        <select name="state" class="form-control">
                                            @if($project->state == 1)
                                            <option value="1" selected="selected">Đang mở bán</option>
                                            @else
                                            <option value="1">Đang mở bán</option>
                                            @endif

                                            @if($project->state == 2)
                                            <option value="2" selected="selected">Sắp mở bán</option>
                                            @else
                                            <option value="2">Sắp mở bán</option>
                                            @endif

                                            @if($project->state == 3)
                                            <option value="3" selected="selected">Đã hết hạn</option>
                                            @else
                                            <option value="3">Đã hết hạn</option>
                                            @endif

                                            @if($project->state == 4)
                                            <option value="4" selected="selected">Đang cập nhật</option>
                                            @else
                                            <option value="4">Đang cập nhật</option>
                                            @endif
                                        </select>
                                    </div>
                                    
                                    <div class="form-group d-none">
                                    	<label>Trạng thái</label>
                                    </div>
                                    <div class="form-group d-none">
                                        @if($project->status = 0)
                                    	<input type="checkbox" name="status" data-toggle="toggle" data-on="Bật" data-off="Tắt" value="true">
                                        @else
                                        <input type="checkbox" name="status" checked="checked" data-toggle="toggle" data-on="Bật" data-off="Tắt" value="true">
                                        @endif
                                    </div><hr />
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Lưu lại</button>
                                        <a href="{{ route('EditorProjectsGetUpdate', $project->id) }}"><span class="btn btn-brand">Nhập lại</span></a>
                                        <a href="{{ route('EditorProjects') }}"><span class="btn btn-danger">Quay lại</span></a>
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
    CKEDITOR.replace('content-new', {
        filebrowserBrowseUrl: url + '/ckfinder/ckfinder.html',
        filebrowserUploadUrl: "{{route('editor.ckeditor.upload', ['_token' => csrf_token() ])}}",
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
    }):
    
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