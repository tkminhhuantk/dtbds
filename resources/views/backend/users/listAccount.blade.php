@extends('backend/masterbackend')

@section('title')
Danh sách tài khoản  
@endsection

@section('content')
        <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">

				<div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card flex-row" id="card-header">
                                <h5 class="card-header ff-google fw-bold">DANH SÁCH TÀI KHOẢN</h5>
                                <a href="{{ route('UserAddAccount') }}">
                                    <span class="btn btn-brand btn-add">Thêm</span>
                                </a>
                            </div>
							<div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first" id="tbl-users">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    <input type="checkbox" />
                                                </th>
                                                <th class="ff-google fw-bold">Ho và tên</th>
                                                <th class="ff-google fw-bold">Email</th>
                                                <th class="ff-google fw-bold">Số điện thoại</th>
                                                <th class="ff-google fw-bold text-center">Chức vụ</th>
                                                <th class="ff-google fw-bold text-center">Trạng thái</th>
                                                <th class="ff-google fw-bold text-center">Chức năng</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-comments">
                                            @foreach($users as $user)
                                            <tr>
                                                <td class="text-center">
                                                    <input type="checkbox" name="">
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td class="text-center">{{ $user->permissions->title }}</td>
                                                <td class="text-center">
                                                  <div class="button-switch">
                                                    @if($user->status == 1)
                                                    <input name="status" type="checkbox" id="switch-blue" class="switch inp-status btn-change" checked="checked" value="true" data-url="{{ route('UsersGetChangeStatus', $user->id) }}"/>
                                                    @else
                                                    <input name="status" type="checkbox" id="switch-blue" class="switch inp-status btn-change" value="true" data-url="{{ route('UsersGetChangeStatus', $user->id) }}"/>
                                                    @endif
                                                  </div>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('UserGetUpdateAccount', $user->id) }}" class="btn btn-primary btn-edit-detail" title="Chỉnh sủa" data-url=""><i class="fas fa-edit"></i></a>
                                                    <button class="btn btn-danger del-detail" title="Xóa" data-url="" >
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $users->links() }}
                            </div>
                        </div>

					</div>
				</div>

            </div>
        </div>

        
@endsection

@section('jquery')
<script>
    $('#tbl-users').on('click', '.btn-change', function(){
    let url = $(this).attr('data-url');
    let data = [];
    axios.get(url, data).then(response => {
        console.log(response.data);
        if(response.data.status == 1){
            $.notify('Tài khoản đã được bật!', 'success');
        }else{
            $.notify('Tài khoản đã tắt!', 'success');
        }
     }).catch(err => {
        $.notify('Cập nhật trạng thái không thành công!', 'error');
     });
  });
</script>
@endsection