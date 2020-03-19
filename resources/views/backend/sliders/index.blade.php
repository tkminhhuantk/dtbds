@extends('backend/masterbackend')

@section('title')
TRÌNH CHIẾU
@endsection

@section('content')
		<div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">

            	<div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header ff-google fw-bold">Thêm hình trình chiếu</h5>
                            <form action="{{ route('AdminSliderCreate') }}" method="post" enctype="multipart/form-data" id="frm-create-slider">
                                <div class="card-body row">
                                    @csrf
                                    <div class="form-group col-md-2 col-sm-12 text-right offset-md-2">
										<label>Hình trình chiếu <span class="red">*</span></label>
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
									@foreach($sliders as $slider)
                                    <div class="col-md-3 col-sm-12 ct-img-slider custom-file-image" style="position: relative;">
										<img src="{{ asset($slider->url_slider) }}" />
                                        <span class="custom-file-preview-del btn-del-slider" style="left: 6px!important" data-url="{{ route('AdminSliderDelete', $slider->id) }}" >
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
<script type="text/javascript">
	function messAdd (mess = '', aClass = ''){
		$('#mess-add').html('');
		$('#mess-add').html(mess);
		$('#mess-add').addClass(aClass);
		$('#mess-add').removeClass('d-none');
	}

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

    $('#frm-create-slider').on('submit',function(e){
    	e.preventDefault();
    	let url = $(this).attr('action');
    	let data = new FormData($(this)[0]);
    	axios.post(url,data).then(response => {
    		let data = response.data;
            location.reload();
    	// 	$('#body-sliders').append(`
    	// 		<div class="col-md-3 col-sm-12 ct-img-slider">
					// <img src="${data.url_slider}" />
     //                <span class="custom-file-preview-del btn-del-slider" style="left: 6px!important" data-url="${data.url_del}" >
     //                    <i class="fa fa-times"></i>
     //                </span>
     //            </div>
    	// 		`);
    	}).catch(err => {
    		alert('Fail');
    		console.log(err.data.errors);
    	});
    });

    $('.btn-del-slider').on('click', function(){
        let me = $(this);
        let url = $(this).attr('data-url');
        let data = [];
        if(confirm('Bạn chắc chắn muốn xóa!')){
            axios.get(url,data).then(response => {;
                me.parent().remove();
                $.notify("Xóa thành công!", "success");
            }).catch(err => {
                $.notify("Xóa không thành công!", "warn");
            });
        }
    });
</script>
@endsection