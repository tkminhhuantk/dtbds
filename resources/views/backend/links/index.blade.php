@extends('backend/masterbackend')

@section('title')
Liên kết
@endsection

@section('css')
@endsection

@section('content')
		<div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card flex-row" id="card-header">
                            <h5 class="card-header ff-google fw-bold">Danh sách liên kết website</h5>
                            <button class="btn btn-primary btn-add" data-toggle="modal" data-target="#add-link">Thêm mới</button>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        <thead>
                                            <tr>
                                                <th class="text-center">STT</th>
                                                <th class="text-center">Logo</th>
                                                <th class="ff-google fw-bold">Tên website liên kết</th>
                                                <th>Link Website</th>
                                                <th class="text-center ff-google fw-bold">Trạng thái</th>
                                                <th class="text-center ff-google fw-bold">Chức năng</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl-body-link">
                                            @foreach($links as $key => $link)
                                            <tr>
                                                <td class="text-center">{{ $key+1 }}</td>
                                                <td class="text-center"><img style="height: 50px; width: auto" src="{{ asset($link->url_logo) }}" />
                                                <td>{{ $link->title }}</td>
                                                </td>
                                                <td><a href="{{ $link->link }}" target="_blank">{{ $link->link }}</a></td>
                                                <td class="text-center">
                                                    <div class="button-switch">
                                                    @if($link->status == 1)
                                                    <input name="status" type="checkbox" id="switch-blue" class="switch inp-status btn-change" checked="checked" value="true" data-url="{{ route('LinksGetChangeStatus', $link->id) }}"/>
                                                    @else
                                                    <input name="status" type="checkbox" id="switch-blue" class="switch inp-status btn-change" value="true" data-url="{{ route('LinksGetChangeStatus', $link->id) }}"/>
                                                    @endif
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                	<button class="btn btn-primary" data-toggle="modal" data-target="#edit-investor" title="Chỉnh sủa">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                	<button class="btn btn-danger btn-delete-link" data-url="{{ route('LinksGetDelete', $link->id) }}" title="Xóa">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal fade" id="add-link">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title ff-google fw-bold upper" id="exampleModalLongTitle">Thêm liên kết mới</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
                    <form action="{{ route('LinksPostAdd') }}" id="frm-add-link" enctype="multipart/form-data">
						<div class="modal-body">
							<div class="row">
								@csrf
								<div class="form-group-investor">
									<label for="title">Tên website liên kết<span class="red">*</span></label>
									<input type="text" class="form-control" placeholder="Nhập tên website liên kết" id="title" name="title">
									<div class="alert alert-danger d-none" id="inp-title-error"></div>
								</div>
								<div class="form-group-investor">
									<label>Logo Website<span class="red">*</span></label>
								</div>
								<div class="form-group-investor text-center">
									<label class="custom-image-upload ct-img-investor">
                                        <input type="file" class="form-control d-none" name="url_logo" placeholder="Nhập tên tiện ích" id="imgInp">
                                    </label>
                                    <div class="alert alert-danger d-none" id="inp-url_logo-error"></div>
								</div>
								<div class="form-group-investor">
									<label for="link">Link liên kết <span class="red">*</span></label>
									<input type="text" class="form-control" placeholder="Nhập link liên kết" id="link" name="link">
									<div class="alert alert-danger d-none" id="inp-link-error"></div>
								</div>
								<div class="form-group-investor">
									<label for="description">Trạng thái</label>
								</div>
								<div class="form-group-investor">
									<input name="status" type="checkbox" checked data-toggle="toggle" data-on="Bật" data-off="Tắt" value="true">
								</div>
								
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
							<button type="submit" class="btn btn-primary">Lưu lại</button>
						</div>
					</form>
				</div>
			</div>
		</div>

@endsection

@section('jquery')
<script>
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

    $('#frm-add-link').on('submit',function (e){
        $('.alert').html('');
        $('.alert').addClass('d-none');
        e.preventDefault();
        let url = $(this).attr('action');
        let data = new FormData($(this)[0]);
        axios.post(url,data).then(response => {
            $('#frm-add-link').trigger('reset');
            $('#add-link').modal('hide');
            let data = response.data;
            
            $('.toggle-btn-status').bootstrapToggle();
            $.notify('Thêm thành công', 'success');
            location.reload();
        }).catch(err => {
            let errors = err.response.data.errors;
            if (typeof errors.title != 'undefined') {
                $('#inp-title-error').html(errors.title[0]);
                $('#inp-title-error').removeClass('d-none');
            }
            if (typeof errors.url_logo != 'undefined') {
                $('#inp-url_logo-error').html(errors.url_logo[0]);
                $('#inp-url_logo-error').removeClass('d-none');
            }
            if (typeof errors.link != 'undefined') {
                $('#inp-link-error').html(errors.link[0]);
                $('#inp-link-error').removeClass('d-none');
            }
        });
    });

    $('#tbl-body-link').on('click','.btn-delete-link', function(e){
        e.preventDefault();
        let url = $(this).attr('data-url');
        let data = [];
        if(confirm('Bạn chắc chắn muốn xóa!')){
            axios.get(url,data).then(response => {
                $(this).parent().parent().remove();
                $.notify("Xóa thành công!", "success");
            }).catch(err =>{
                $.notify("Không tìm thấy liên kết cần xóa!", "warn");
            });
        }
    });
    
    $('.btn-change').change(function(){
        let url = $(this).attr('data-url');
        let data = [];
        axios.get(url,data).then(response => {
            if(response.data.status == 1){
                $.notify('Hiển thị liên kết!', 'success');
            }else{
                $.notify('Ẩn hiển thị liên kết!', 'success');
            }
        }).catch(err => {
             $.notify('Thay đổi trang thái không thành công','error');
        });
    });
</script>
@endsection