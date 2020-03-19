@extends('backend/masterbackend')

@section('title')
CHUYÊN MỤC 
@endsection

@section('content')
		<div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
            	<div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    	<div class="card flex-row" id="card-header">
                            <h5 class="card-header ff-google fw-bold">DANH SÁCH DANH MỤC</h5>
                            <button class="btn btn-primary text-center btn-add" data-toggle="modal" data-target="#add-category">Thêm mới</button>
                        </div>
                        <div class="card">
							<div class="card-body">

								@if(session()->has('success'))
								<div class="alert alert-success">
									{{ session()->get('success') }}
								</div>
								@else
								<div class="alert alert-success d-none"></div>
								@endif

								<div class="alert alert-success d-none" id="mess-add"></div>
                                <ul id="list-category">
                                	@foreach($categories as $category)
                                	<li>
                                		<a class="fw-bold" href="{{ asset($category->slug) }}" target="_blank" style="margin-right: 30px;">{{ $category->title }} ({{ $category->slug }})</a>
                                		<!--<button class="btn btn-primary"><i class="fas fa-edit"></i></button>-->
                                		<button class="btn btn-danger btn-del-cat" title="Xóa" data-url="{{ route('AdminCategoriesDelete',$category->id) }}">
                                			<i class="fas fa-trash"></i>
                                		</button>
                                	</li>
	                                	@foreach($category->sub as $sub)
	                        			<li class="sub">
	                        				<a class="fw-bold" href="{{ asset($sub->slug) }}" target="_blank" style="margin-right: 30px;">{{ $sub->title }} ({{ $sub->slug}})</a>
	                        				<!--<button class="btn btn-primary"><i class="fas fa-edit"></i></button>-->
                                			<button class="btn btn-danger btn-del-cat" title="Xóa" data-url="{{ route('AdminCategoriesDelete',$sub->id) }}">
	                                			<i class="fas fa-trash"></i>
	                                		</button>
	                        			</li>
	                        			@endforeach
                        			@endforeach
                                </ul>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="add-category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title ff-google fw-bold" id="exampleModalLabel">THÊM CHUYÊN MỤC MỚI</h5>
 						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="{{ route('AdminCategoriesCreate') }}" method="post" id="frm-add-category">
						@csrf
						<div class="modal-body">
							<div class="form-group">
								<label>Tên chuyên mục <span class="red">*</span></label>
								<input type="text" name="title" id="title" class="form-control" placeholder="Nhập tên chuyên mục">
								<div class="alert alert-danger d-none" id="inp-title-error"></div>
							</div>
							<div class="form-group">
								<label>Chuyên mục cha</label>
								<select name="category_id" class="form-control">
									<option value="0">Chọn chuyên mục</option>
									@foreach($categories as $category)
									<option value="{{ $category->id }}">{{ $category->title }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>Mô tả</label>
								<textarea class="form-control" id="description" name="description" placeholder="Nhập mô tả chuyên mục" rows="3"></textarea>
							</div>
							<div class="form-group">
								<label>Keywords</label>
								<input type="text" name="keywords" id="keywords" class="form-control" placeholder="Nhập tên keywords">
							</div>
							<div class="form-group">
								<label>Seo Head</label>
								<textarea class="form-control" id="seo_head" name="seo_head" placeholder="Nhập seo head chuyên mục" rows="3"></textarea>
							</div>
							<div class="form-group">
								<label>Trạng thái</label>
								<input class="btn-status" name="status" type="checkbox" checked data-toggle="toggle" data-on="Bật" data-off="Tắt" value="true">
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
	function messAdd (mess = '', aClass = ''){
		$('#mess-add').html('');
		$('#mess-add').html(mess);
		$('#mess-add').addClass(aClass);
		$('#mess-add').removeClass('d-none');
	}

	$('#list-category').on('click', '.btn-del-cat', function(){
		let url = $(this).attr('data-url');
		if(confirm('Bạn chắc chắn muốn xóa!')){
			window.location.href = url;
		}
	});
</script>
@endsection