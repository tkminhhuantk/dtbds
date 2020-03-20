@extends('backend/masterbackend')

@section('title')
Thông tin cá nhân
@endsection

@section('content')
		<div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">

            	<div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header ff-google fw-bold">Thông tin cá nhân</h5>
                            <form action="{{ route('UserUpdateMyAccount') }}" method="post" id="frm-upadte-myaccount">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            @csrf
                                            <div class="form-group">
                                                <input type="hidden" name="id" value="{{ $myUser->id }}">
                                                <label for="name">Họ và tên <span class="red">*</span></label>
                                                <input type="text" name="name" id="name" value="{{ $myUser->name }}" placeholder="Vui lòng nhập họ và tên" class="form-control">
                                                <div class="err d-none red" id="err-name"></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email (dùng để đăng nhập)<span class="red">*</span></label>
                                                <input type="text" name="email" id="email" value="{{ $myUser->email }}" placeholder="Vui lòng nhập email" class="form-control" disabled="disabled">
                                                <div class="err d-none red" id="err-email"></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Số điện thoại</label>
                                                <input type="text" name="phone" id="phone" value="{{ $myUser->phone }}" placeholder="Vui lòng nhập số điện thoại" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="excerpt">Mô tả</label>
                                                <textarea name="excerpt" id="excerpt" rows="3" placeholder="Vui lòng nhập mô tả" class="form-control">{{ $myUser->excerpt }}</textarea>
                                            </div> 
                                            <div class="form-group">
                                                <label>Tải ảnh đại điện mới</label>
                                                <div class="custom-file-image">
                                                    <input type="file" id="fileImage" name="url_avatar" class="custom-file-image-input" accept="image/*" >
                                                    <div class="custom-file-preview">
                                                        <label class="custom-file-preview-add" for="fileImage">
                                                            <i class="fas fa-plus"></i>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="err d-none red" id="err-url_avatar"></div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-add">Lưu lại</button>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <img src="{{ asset($myUser->url_avatar) }}" id="content-avatar" alt="" style="width: 100%; height: auto">
                                        </div> 
                                    </div>
                                </div>
                            </form>
						</div>
					</div>
				</div>

				<div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header ff-google fw-bold">Thay đổi mật khẩu</h5>
                            <form action="{{ route('UserChangePass') }}" method="post" id="frm-update-pass">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 offset-md-3">
                                            <div class="form-group">
                                                @csrf
                                                <label>Mật khẩu hiện tại</label>
                                                <input name="current_password" type="password" placeholder="Vui lòng nhập mật khẩu hiện tại" class="form-control" disabled="disabled">
                                                <div class="err d-none red" id="err-current_password"></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Mật khẩu mới</label>
                                                <input name="new_password" type="password" placeholder="Vui lòng nhập mật khẩu mới" class="form-control">
                                                <div class="err d-none red" id="err-new_password"></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Nhập lại mật khẩu mới</label>
                                                <input name="new_confirm_password" type="password" placeholder="Vui lòng nhập lại mật khẩu mới" class="form-control">
                                                <div class="err d-none red" id="err-new_confirm_password"></div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-add">Gửi</button>
                                        </div>  
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </form>
						</div>
					</div>
				</div>

            </div>
		</div>
@endsection

@section('jquery')
<script>
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

$('#frm-upadte-myaccount').on('submit', function(e){
    e.preventDefault();
    let data = new FormData($(this)[0]);
    let url = $(this).attr('action');
    axios.post(url, data).then(response => {
        $.notify('Cập nhật thành công!', 'success');
        $('#content-avatar').removeAttr('src');
        $('#content-avatar').attr('src',response.data.url_avatar);
    }).catch(err => {
        let errors = err.response.data.errors;
        if (typeof errors.name != 'undefined') {
            $('#err-name').html(errors.name[0]);
            $('#err-name').removeClass('d-none');
        }
        if (typeof errors.email != 'undefined') {
            $('#err-email').html(errors.email[0]);
            $('#err-email').removeClass('d-none');
        }
        if (typeof errors.url_avatar != 'undefined') {
            $('#err-url_avatar').html(errors.url_avatar[0]);
            $('#err-url_avatar').removeClass('d-none');
        }
    })
})

$('#frm-update-pass').on('submit', function(e){
    $('.err').html('');
    $('.err').addClass('d-none');
    e.preventDefault();
    let data = new FormData($(this)[0]);
    let url = $(this).attr('action');
    axios.post(url, data).then(response => {
        $.notify('Thay đổi thành công mật khẩu!', 'success');
    }).catch(err => {
        let errors = err.response.data.errors;
        if (typeof errors.current_password != 'undefined') {
            $('#err-current_password').html(errors.current_password[0]);
            $('#err-current_password').removeClass('d-none');
        }
        if (typeof errors.new_password != 'undefined') {
            $('#err-new_password').html(errors.new_password[0]);
            $('#err-new_password').removeClass('d-none');
        }
        if (typeof errors.new_confirm_password != 'undefined') {
            $('#err-new_confirm_password').html(errors.new_confirm_password[0]);
            $('#err-new_confirm_password').removeClass('d-none');
        }
    })
})
</script>
@endsection