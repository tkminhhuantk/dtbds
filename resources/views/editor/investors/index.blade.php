@extends('editor/masterbackend')

@section('title')
CHỦ ĐẦU TƯ
@endsection

@section('css')
	<link rel="stylesheet" href="{{ asset('backend/assets/vendor/datepicker/tempusdominus-bootstrap-4.css') }}" />
@endsection

@section('content')
		<div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card flex-row" id="card-header">
                            <h5 class="card-header ff-google fw-bold">Danh sách chủ đầu tư</h5>
                            <button class="btn btn-primary btn-add" data-toggle="modal" data-target="#add-investor">Thêm mới</button>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        <thead>
                                            <tr>
                                                <th class="text-center">STT</th>
                                                <th class="ff-google fw-bold">Tên chủ đầu tư</th>
                                                <th class="text-center">Logo</th>
                                                <th>Link Website</th>
                                                <th class="text-center ff-google fw-bold">Trạng thái</th>
                                                <th class="text-center ff-google fw-bold">Chức năng</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl-body-investor">
                                            @foreach($investors as $investor)
                                            <tr>
                                                <td class="text-center">{{ $investor->id }}</td>
                                                <td>{{ $investor->name }}</td>
                                                <td class="text-center"><img style="height: 50px; width: auto" src="{{ asset($investor->url_logo) }}" /></td>
                                                <td><a href="{{ $investor->link }}" target="_blank">{{ $investor->link }}</a></td>
                                                <td class="text-center">
                                                    <div class="button-switch">
                                                    @if($investor->status == 1)
                                                    <input name="status" type="checkbox" id="switch-blue" class="switch inp-status btn-change" checked="checked" value="true" disabled="disabled" />
                                                    @else
                                                    <input name="status" type="checkbox" id="switch-blue" class="switch inp-status btn-change" value="true" disabled="disabled" />
                                                    @endif
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                	<button class="btn btn-primary edit-investor" title="Chỉnh sủa" data-url="{{ route('AdminInvestorGet', $investor->id) }}">
                                                        <i class="fas fa-edit"></i>
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

        <div class="modal fade" id="add-investor" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title ff-google fw-bold upper" id="exampleModalLongTitle">Thêm chủ đầu tư mới</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
                    <form action="{{ route('EditorInvestorsPostAdd') }}" id="frm-add-investor" enctype="multipart/form-data">
						<div class="modal-body">
							<div class="row">
								@csrf
								<div class="form-group-investor">
									<label for="name">Tên chủ đầu tư <span class="red">*</span></label>
									<input type="text" class="form-control" placeholder="Nhập tên chủ đầu tư" id="name" name="name">
									<div class="alert alert-danger d-none" id="inp-name-error"></div>
								</div>
								<div class="form-group-investor">
									<label for="full_name">Tên đầy đủ của chủ đầu tư <span class="red">*</span></label>
									<input type="text" class="form-control" placeholder="Nhập tên đầy đủ của chủ đầu tư" id="full_name" name="full_name">
									<div class="alert alert-danger d-none" id="inp-full_name-error"></div>
								</div>
								<div class="form-group-investor">
									<label>Logo <span class="red">*</span></label>
								</div>
								<div class="form-group-investor">
									<label class="custom-image-upload ct-img-investor">
                                        <input type="file" class="form-control d-none" name="url_logo" placeholder="Nhập tên tiện ích" id="imgInp">
                                    </label>
                                    <div class="alert alert-danger d-none" id="inp-url_logo-error"></div>
								</div>
								<div class="form-group-investor">
									<label>Ngày thành lập</label>
									<div class="input-group date" id="datetimepicker4" data-target-input="nearest">
										<input type="text" id="datepicker" class="form-control datetimepicker-input" data-target="#datetimepicker4" name="founding" />
                                        <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                        </div>
                                    </div>
                                </div>
								<div class="form-group-investor">
									<label for="link">Link liên kết <span class="red">*</span></label>
									<input type="text" class="form-control" placeholder="Nhập link liên kết" id="link" name="link">
									<div class="alert alert-danger d-none" id="inp-link-error"></div>
								</div>
								<div class="form-group-investor">
									<label for="description">Mô tả</label>
									<textarea class="form-control" rows="6" placeholder="Nhập nội dung mô tả" id="description" name="description"></textarea>
								</div>
								<div class="form-group-investor">
									<label for="description">Trạng thái</label>
								</div>
								<div class="form-group-investor">
                                    <div class="button-switch">
									   <input name="status" type="checkbox" id="switch-blue" class="switch inp-status" checked="checked" value="true" disabled="disabled" />
                                    </div>
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

        <div class="modal fade" id="update-investor" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title ff-google fw-bold upper" id="exampleModalLongTitle">Thêm chủ đầu tư mới</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="#" id="frm-update-investor" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                @csrf
                                <div class="form-group-investor">
                                    <label for="name-update">Tên chủ đầu tư <span class="red">*</span></label>
                                    <input type="text" class="form-control" placeholder="Nhập tên chủ đầu tư" id="name-update" name="name">
                                    <div class="alert alert-danger d-none" id="inp-name-error-update"></div>
                                </div>
                                <div class="form-group-investor">
                                    <label for="full_name-update">Tên đầy đủ của chủ đầu tư <span class="red">*</span></label>
                                    <input type="text" class="form-control" placeholder="Nhập tên đầy đủ của chủ đầu tư" id="full_name-update" name="full_name">
                                    <div class="alert alert-danger d-none" id="inp-full_name-error-update"></div>
                                </div>
                                <div class="form-group-investor">
                                    <label>Logo <span class="red">*</span></label>
                                </div>
                                <div class="form-group-investor">
                                    <label class="custom-image-upload ct-img-investor">
                                        <input type="file" class="form-control d-none" name="url_logo" placeholder="Nhập tên tiện ích" id="imgInp">
                                    </label>
                                    <div class="alert alert-danger d-none" id="inp-url_logo-error-update"></div>
                                </div>
                                <div class="form-group-investor">
                                    <label>Ngày thành lập</label>
                                    <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                                        <input type="text" id="datepicker" class="form-control datetimepicker-input" data-target="#datetimepicker4" name="founding" />
                                        <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group-investor">
                                    <label for="link">Link liên kết <span class="red">*</span></label>
                                    <input type="text" class="form-control" placeholder="Nhập link liên kết" id="link" name="link">
                                    <div class="alert alert-danger d-none" id="inp-link-error-update"></div>
                                </div>
                                <div class="form-group-investor">
                                    <label for="description">Mô tả</label>
                                    <textarea class="form-control" rows="6" placeholder="Nhập nội dung mô tả" id="description" name="description"></textarea>
                                </div>
                                <div class="form-group-investor">
                                    <label for="description">Trạng thái</label>
                                </div>
                                <div class="form-group-investor">
                                    <div class="button-switch">
                                       <input name="status" type="checkbox" id="switch-blue" class="switch inp-status btn-change" checked="checked" value="true" disabled="disabled" />
                                    </div>
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
	<script src="{{ asset('backend/assets/vendor/datepicker/moment.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/datepicker/tempusdominus-bootstrap-4.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/datepicker/datepicker.js') }}"></script>
<script>
jQuery(function($) {
	function messAdd (mess = '', aClass = ''){
        $('#mess-add').html('');
        $('#mess-add').html(mess);
        $('#mess-add').addClass(aClass);
        $('#mess-add').removeClass('d-none');
    }

	$('#frm-add-investor').on('submit',function (e){
		$('.alert').html('');
        $('.alert').addClass('d-none');
		e.preventDefault();
		let url = $(this).attr('action');
		let data = new FormData($(this)[0]);
		axios.post(url,data).then(response => {
			$('#frm-add-investor').trigger('reset');
            $('#add-investor').modal('hide');
            let data = response.data;
            $('#tbl-body-investor').prepend(`
                                            <tr>
                                                <td class="text-center">${data.id}</td>
                                                <td>${data.name}</td>
                                                <td class="text-center"><img style="height: 50px; width: auto" src="${data.url_logo}" /></td>
                                                <td ><a href="${data.link}" target="_blank">${data.link}</a></td>
                                                <td class="text-center">
                                                    <div class="button-switch">
                                                       <input name="status" type="checkbox" id="switch-blue" class="switch inp-status btn-change" checked="checked" value="true" disabled="disabled" />
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#edit-investor" title="Chỉnh sủa"><i class="fas fa-edit"></i></button>
                                                </td>
                                            </tr>
                `);
            $.notify('Thêm thành công!', 'success');
		}).catch(err => {
			let errors = err.response.data.errors;
            if (typeof errors.name != 'undefined') {
                $('#inp-name-error').html(errors.name[0]);
                $('#inp-name-error').removeClass('d-none');
            }
            if (typeof errors.full_name != 'undefined') {
                $('#inp-full_name-error').html(errors.full_name[0]);
                $('#inp-full_name-error').removeClass('d-none');
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

    $('#tbl-body-investor').on('click','.btn-delete-investor', function(){
        let url = $(this).attr('data-url');
        if(confirm('Bạn chắc chắn muốn xóa!')){
            axios.get(url).then(response => {
                console.log(response.data);
                $(this).parent().parent().remove();
            }).catch(err => {
                alert('Không tìm thấy tiện ích cần xóa');
            });
        }
    });

    $('#tbl-body-investor').on('click', '.edit-investor', function(e){
        e.preventDefault();
        let url = $(this).attr('data-url');
        let data = [];
        axios.get(url, data).then(response => {
            let data = response.data;
            $('#name-update').val(data.name);
            $('#full_name-update').val(data.full_name);
            $('#update-investor').modal('show');
        }).catch(err => {
            $.notify('Không tìm thấy thông tin chủ đầu tư cần chỉnh sửa');
        });
    });
    
    $('#tbl-body-investor').on('click', '.btn-change', function(){
        let url = $(this).attr('data-url');
        let data = [];
        axios.get(url, data).then(response => {
            if(response.data.status ==1){
                $.notify('Duyệt thành công!', 'success');
            }else{
                $.notify('Hủy duyệt thành công!', 'success');
            }
        }).catch(err => {
           $.notify('Duyệt thất bại!', 'error'); 
        });
    });
});
</script>
@endsection