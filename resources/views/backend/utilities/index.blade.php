@extends('backend/masterbackend')

@section('title')
TIỆN ÍCH
@endsection

@section('content')
        <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header ff-google fw-bold">Thêm tiện ích</h5>
                            <form action="{{ route('AdimUtilitiesCreate') }}" method="post" id="frm-add-utilities">
                                <div class="card-body row">
                                    @csrf
                                    <div class="form-group col-md-9 col-sm-12">
                                        <input type="text" class="form-control" name="title" placeholder="Nhập tên tiện ích">
                                        <div class="red err d-none mt-2" id="ipt-title-add"></div>
                                    </div>
                                    <div class="form-group col-md-1 col-sm-12">
                                        <div class="button-switch mt-2">
                                            <input name="status" type="checkbox" id="switch-blue" class="switch inp-status update-status" checked="checked" value="true"/>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-1">
                                    	<button type="submit" class="btn btn-primary">Lưu lại</button>
                                    </div>
                                </div>
                            </form>
						</div>
					</div>
				</div>

				<div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card d-none">
                            <h5 class="card-header ff-google fw-bold" id="message"></h5>
						</div>
					</div>
				</div>

				<div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header ff-google fw-bold">Danh sách thông tin chi tiết</h5>
							<div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="ff-google fw-bold">Tên tiện ích</th>
                                                <th class="text-center ff-google fw-bold">Duyệt</th>
                                                <th class="text-center ff-google fw-bold">Chức năng</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-utilities">
                                            @foreach($utilities as $utiliti)
                                            <tr>
                                                <td class="text-center">{{ $utiliti->id }}</td>
                                                <td id="title_edit_{{ $utiliti->id }}">{{ $utiliti->title }}</td>
                                                <td class="text-center">
                                                	<div class="button-switch">
                                                    @if($utiliti->status == 1)
                                                    <input name="status" type="checkbox" id="switch-blue" class="switch inp-status update-status" checked="checked" value="true" data-url="{{ route('AdminUtilitiesStatus', $utiliti->id) }}"/>
                                                    @else
                                                    <input name="status" type="checkbox" id="switch-blue" class="switch inp-status update-status" value="true" data-url="{{ route('AdminUtilitiesStatus', $utiliti->id) }}"/>
                                                    @endif
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                	<button id="btn-edit-utiliti" data-url="{{ route('AdminUtilitiesGet', $utiliti->id) }}" type="button" class="btn btn-primary btn-edit-utiliti" title="Chỉnh sủa"><i class="fas fa-edit"></i></button>
                                                	<button class="btn btn-danger del-utiliti" title="Xóa" data-url="{{ route('AdminUtilitiesDelete', $utiliti->id) }}" >
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

        <div class="modal fade" id="edit-utiliti" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title ff-google fw-bold" id="exampleModalLabel">CHỈNH SỬA TIỆN ÍCH</h5>
 						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form id="frm-update-utiliti">
						<div class="modal-body">
							<div class="form-group">
								<label>Tên tiện ích</label>
								<input type="text" name="title" id="title-edit" class="form-control">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
							<button type="submit" class="btn btn-primary">Lưu lại</button>
						</div>
					</form>
				</div>
			</div>
		</div>
@endsection

@section('jquery')
<script type="text/javascript">
    jQuery(function($) {

    	function message(mess = ''){
            $('#message').html('');
            $('#message').html(mess);
            $('#message').parent().removeClass('d-none');
        };

    	$('#frm-add-utilities').on('submit', function(e){
    		e.preventDefault();
    		let url = $(this).attr('action');
    		let data = new FormData($(this)[0]);
    		axios.post(url,data).then(response => {
    			let data = response.data;
    			if(data.status == 1){
    				$('#body-utilities').prepend(`<tr>
                                                <td class="text-center">${data.id}</td>
                                                <td id="title_edit_${data.id}">${data.title}</td>
                                                <td class="text-center">
                                                	<div class="button-switch">
                                                        <input name="status" type="checkbox" id="switch-blue" class="switch inp-status update-status" checked="checked" value="true" data-url="${data.url_status}"/>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                	<button id="btn-edit-utiliti" data-url="${data.url_update}" type="button" class="btn btn-primary btn-edit-utiliti" title="Chỉnh sủa"><i class="fas fa-edit"></i></button>
                                                	<button class="btn btn-danger del-utiliti" title="Xóa" data-url="${data.url_delete}" >
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>`)
    			}else{
    				$('#body-utilities').prepend(`<tr>
                                                <td class="text-center">${data.id}</td>
                                                <td id="title_edit_${data.id}">${data.title}</td>
                                                <td class="text-center">
                                                	<div class="button-switch">
                                                        <input name="status" type="checkbox" id="switch-blue" class="switch inp-status update-status" value="true" data-url="${data.url_status}"/>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                	<button id="btn-edit-utiliti" data-url="${data.url_update}" type="button" class="btn btn-primary btn-edit-utiliti" title="Chỉnh sủa"><i class="fas fa-edit"></i></button>
                                                	<button class="btn btn-danger del-utiliti" title="Xóa" data-url="${data.url_delete}" >
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>`)
    			}
    			$(this).trigger('reset');
                $.notify('Thêm thành công!', 'success');
    		}).catch(err => {
    			let errors = err.response.data.errors;
                console.log(errors);
                if (typeof errors.title != 'undefined') {
                    message(errors.title[0]);
                }
                $.notify('Thêm thất bại!', 'error');
    		});
    	});

    	$('#body-utilities').on('click', '.del-utiliti', function(){
    		let me = $(this);
    		let url = me.attr('data-url');
    		if(confirm('Bạn chắc chắn muốn xóa!')){
                axios.get(url).then(response => {
                    $.notify('Xóa thành công tiện ích: '+response.data.title, 'success');
                    me.parent().parent().remove();
                }).catch(err => {
                    $.notify('Không tìm thấy tiện ích cần xóa', 'success');
                });
            }
    	});

    	$('#body-utilities').on('click', '.btn-edit-utiliti', function(){
    		let url = $(this).attr('data-url');
    		axios.get(url).then(response => {
    			$('#title-edit').val(response.data.title);
    			$('#edit-utiliti').modal('show');
    			$('#frm-update-utiliti').attr('action',response.data.url_update);

    		}).catch(err => {
    			$.notify('Không tìm thấy tiện ích cần chỉnh sủa', 'error');
    		});
    	});

    	$('#body-utilities').on('change','.update-status', function(){
    		let me = $(this);
    		let url = me.attr('data-url');
    		axios.get(url).then(response => {
    			if(response.data.status == 1){
    			    $.notify('Duyệt thành công!', 'success');
    			}else{
    			    $.notify('Hủy duyệt thành công!', 'success');
    			}
    		}).catch(err => {
    			$.notify('Duyệt không thành công!', 'error');
    		})
    	});

    	$('#frm-update-utiliti').on('submit',function(e){
    		e.preventDefault();
    		let url = $(this).attr('action');
    		let data = new FormData($(this)[0]);
    		axios.post(url,data).then(response => {
    			$.notify('Cập nhật thành công tiện ích: '+response.data.title, 'success');
    			$('#title_edit_'+response.data.id).html(response.data.title);
    			$('#edit-utiliti').modal('hide');
    		}).catch(err => {
    			$.notify('Không thể cập nhật!', 'error');
    		})
    	})
    });
</script>
@endsection