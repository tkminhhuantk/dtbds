@extends('backend/masterbackend')

@section('title')
Thêm tài khoản 
@endsection

@section('content')
        <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">

				<div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card flex-row" id="card-header">
                                <h5 class="card-header ff-google fw-bold">THÊM TÀI KHOẢN</h5>
                                <a href="{{ route('UsersList') }}">
                                    <span class="btn btn-brand btn-add">Quay lại</span>
                                </a>
                            </div>
							<form action="{{ route('UserPostAddAccount') }}" method="post" id="frm-add-account">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8 offset-md-2">
                                            @csrf
                                            <div class="form-group">
                                                <input type="hidden" name="id">
                                                <label for="name">Họ và tên <span class="red">*</span></label>
                                                <input type="text" name="name" id="name" value="" placeholder="Vui lòng nhập họ và tên" class="form-control">
                                                <div class="err d-none red" id="err-name"></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email (dùng để đăng nhập)<span class="red">*</span></label>
                                                <input type="text" name="email" id="email" value="" placeholder="Vui lòng nhập email" class="form-control">
                                                <div class="err d-none red" id="err-email"></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Mật khẩu <span class="red">*</span></label>
                                                <input name="password" type="password" placeholder="Vui lòng nhập mật khẩu" class="form-control">
                                                <div class="err d-none red" id="err-password"></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Nhập lại mật khẩu <span class="red">*</span></label>
                                                <input name="confirm_password" type="password" placeholder="Vui lòng nhập lại mật khẩu" class="form-control">
                                                <div class="err d-none red" id="err-confirm_password"></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Số điện thoại</label>
                                                <input type="text" name="phone" id="phone" value="" placeholder="Vui lòng nhập số điện thoại" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="excerpt">Mô tả</label>
                                                <textarea name="excerpt" id="excerpt" rows="3" placeholder="Vui lòng nhập mô tả" class="form-control"></textarea>
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
                                                <label for="permission">Chức vụ</label>
                                                <select name="permission" id="permission" class="form-control">
                                                    <option value="">Chọn chức vụ</option>
                                                    @foreach($permissions as $pms)
                                                        <option value="{{ $pms->id }}">{{ $pms->title }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="err d-none red" id="err-permission"></div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-add">Lưu lại</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

    $('#frm-add-account').on('submit', function(e){
        e.preventDefault();
        let url = $(this).attr('action');
        let data = new FormData($(this)[0]);
        axios.post(url,data).then(response => {
            $(this).trigger('reset');
            $.notify('Thêm thành công!', 'success');
        }).catch(err => {
            $.notify('Sai thông tin', 'error');
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
            if (typeof errors.permission != 'undefined') {
                $('#err-permission').html(errors.permission[0]);
                $('#err-permission').removeClass('d-none');
            }
            if (typeof errors.password != 'undefined') {
                $('#err-password').html(errors.password[0]);
                $('#err-password').removeClass('d-none');
            }
            if (typeof errors.confirm_password != 'undefined') {
                $('#err-confirm_password').html(errors.confirm_password[0]);
                $('#err-confirm_password').removeClass('d-none');
            }
        });
    })
</script>
@endsection