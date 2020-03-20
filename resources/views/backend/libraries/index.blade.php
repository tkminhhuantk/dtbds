@extends('backend/masterbackend')

@section('title')
THƯ VIỆN
@endsection

@section('content')
		<div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">

            	<div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header ff-google fw-bold">Thêm hình ảnh thư viện</h5>
                            <form action="" method="post" enctype="multipart/form-data" id="frm-create-slider">
                                <div class="card-body row">
                                    @csrf
                                    <div class="form-group col-md-2 col-sm-12 text-right offset-md-2">
										<label>Hình ảnh thư viện <span class="red">*</span></label>
                                    </div>
                                    <div class="form-group col-md-4 col-sm-12">
                                    	<label class="custom-image-upload ct-img-slider">
                                        	<input type="file" class="form-control d-none" name="url_slider" placeholder="Nhập tên tiện ích" id="imgInp">
                                        </label>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-2 text-left">
                                    	<button type="submit" class="btn btn-primary">Lưu lại</button>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </form>
						</div>
					</div>
				</div>

				<div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header ff-google fw-bold">Trình chiếu đang hiển thị</h5>
							<div class="card-body">
								<div class="row" id="body-sliders">
									@foreach()
                                    <div class="col-md-3 col-sm-12 ct-img-slider custom-file-image" style="position: relative;">
										<img src="{{  }}" />
                                        <span class="custom-file-preview-del btn-del-slider" style="left: 6px!important" data-url="{{ }}" >
                                            <i class="fa fa-times"></i>
                                        </span>
                                    </div>
                                    @endforeach
                                </div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>

            </div>
		</div>
@endsection

@section('jquery')
<script>
	
</script>
@endsection