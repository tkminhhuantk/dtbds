@extends('backend/masterbackend')

@section('title')
Tags
@endsection

@section('content')
		<div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">

                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="card flex-row" id="card-header">
                            <h5 class="card-header ff-google fw-bold">CHỈNH SỬA TAGS</h5>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <form id="frm-add-tag" enctype="multipart/form-data" action="{{ route('AdminTagsPostUpdate', $tag->id) }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-form-label">Tên tags <span class="red">*</span></label>
                                        <input type="text" name="title" class="form-control" placeholder="Vui lòng nhập tên tag" value="{{ $tag->title }}">
                                        <div class="alert alert-danger d-none" id="inp-title-error"></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label">Slug <span class="red">*</span></label>
                                        <input type="text" name="slug" class="form-control" placeholder="Vui lòng nhập đường dẫn tag" value="{{ $tag->slug }}">
                                        <div class="alert alert-danger d-none" id="inp-slug-error"></div>
                                    </div>

                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea name="description" class="form-control" rows="8" placeholder="Vui lòng nhập mô tả">{{ $tag->description }}</textarea>
                                        <div class="alert alert-danger d-none" id="inp-description-error"></div>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-info" type="submit">Lưu lại</button>
                                        <a href="{{ route('AdminTagsPostUpdate', $tag->id) }}" class="btn btn-brand color-white">Nhập lại</a>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <div class="card flex-row" id="card-header">
                            <h5 class="card-header ff-google fw-bold">DANH SÁCH TAGS</h5>
                            <a href="{{ route('AdminTags') }}">
                            	<span class="btn btn-primary btn-add" data-toggle="modal" data-target="#add-investor">Thêm mới</span>
                            </a>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                  
                                    <table class="table table-striped table-bordered first" id="tbl-tags" data-url="{{ route('AdminNewsAnyData') }}">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="ff-google fw-bold">Tên tag</th>
                                                <th class="ff-google fw-bold">Slug</th>
                                                <th class="text-center ff-google fw-bold">Thời gian đăng</th>
                                                <th width="18%" class="text-center ff-google fw-bold">Chức năng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($tags as $tag)
                                            <tr>
                                                <td>{{ $tag->id }}</td>
                                                <td style="text-align: left;" width="25%"><a href="#" target="_blank">{{ $tag->title }}</a></td>
                                                <td>
                                                    {{ $tag->slug }}
                                                </td>
                                                <td class="text-center">
                                                  <span>{{ $tag->created_at->format('d-m-Y') }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('AdminTagsGetUpdate', $tag->id) }}"><span class="btn btn-primary" title="Chỉnh sủa"><i class="fas fa-edit"></i></span></a>
                                                    <button class="btn btn-danger btn-del-tag" data-url="{{ route('AdminTagsGetDelete', $tag->id) }}" title="Xóa"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table><br>
                                    {{ $tags->links() }}
                                </div>
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

    $('#frm-add-tag').submit( function(e){
        e.preventDefault();
        $('.alert').html('');
        $('.alert').addClass('d-none');
        let url = $(this).attr('action');
        let data = new FormData($(this)[0]);
        axios.post(url,data).then(response => {
            $.notify('Cập nhật thành công', 'success');
            setTimeout(function(){ }, 400);
            location.reload();
        }).catch(err => {
            let errors = err.response.data.errors;
            $.notify('Cập nhật thất bại', 'error');
            if (typeof errors.title != 'undefined') {
                $('#inp-title-error').html(errors.title[0]);
                $('#inp-title-error').removeClass('d-none');
            }
            if (typeof errors.slug != 'undefined') {
                $('#inp-slug-error').html(errors.slug[0]);
                $('#inp-slug-error').removeClass('d-none');
            }
        });
    })

    $('#tbl-tags').on('click', '.btn-del-tag', function(e){
        e.preventDefault();
        let url = $(this).attr('data-url');
        let data = [];
        if(confirm('Bạn chắc chắn muốn xóa!')){
            axios.get(url,data).then(response => {
                $.notify('Xóa thành công', 'success');
                setTimeout(function(){ }, 2000);
                location.href = "{{ route('AdminTags') }}";
            }).catch(err => {
                $.notify('Xóa thất bại', 'error');
            });
        }
    })
</script>
@endsection