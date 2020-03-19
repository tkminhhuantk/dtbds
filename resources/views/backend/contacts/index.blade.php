@extends('backend/masterbackend')

@section('title')
Liên hệ
@endsection

@section('css')
@endsection

@section('content')
		<div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card flex-row" id="card-header">
                            <h5 class="card-header ff-google fw-bold">Danh sách liên hệ</h5>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive mb-2">
                                    <table class="table table-striped table-bordered first">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="text-center ff-google fw-bold">Họ và tên</th>
                                                <th class="ff-google fw-bold">Email</th>
                                                <th class="text-center ff-google fw-bold">Số điện thoại</th>
                                                <th class="text-center ff-google fw-bold">Chức năng</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl-body-contact">
                                            @foreach($contacts as $contact)
                                            <tr>
                                                <td class="text-center">{{ $contact->id }}</td>
                                                <td class="text-center">{{ $contact->name}}</td>
                                                <td>{{ $contact->email }}</td>
                                                <td>{{ $contact->phone }}</td>
                                                <td class="text-center">
                                                	<button class="btn btn-primary btn-view-contact" title="Xem nội dung" data-url="" data-content="{{ $contact->content }}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                	<button class="btn btn-danger btn-delete-contact" data-url="{{ route('ContactsGetDelete', $contact->id) }}" title="Xóa">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                                {{ $contacts->links() }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal fade" id="modal-view-contact">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title ff-google fw-bold upper" id="exampleModalLongTitle">Nội dung liên hệ</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" id="body-modal-content">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
					</div>
				</div>
			</div>
		</div>

@endsection

@section('jquery')
<script>
    $('#tbl-body-contact').on('click', '.btn-delete-contact', function(e){
        e.preventDefault();
        let url = $(this).attr('data-url');
        let data = [];
        if(confirm('Bạn chắc chắn muốn xóa!')){
            axios.get(url,data).then(response => {
                $(this).parent().parent().remove();
                $.notify("Xóa thành công!", "success");
            }).catch(err =>{
                $.notify("Không tìm thấy liên hệ cần xóa", "warn");
            });
        }
    });
    $('#tbl-body-contact').on('click', '.btn-view-contact', function(e){
        e.preventDefault();
        let content = $(this).attr('data-content');
        $('#body-modal-content').html(content);
        $('#modal-view-contact').modal('show');
    });
</script>
@endsection