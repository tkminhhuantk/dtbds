@extends('backend/masterbackend')

@section('title')
Bình luận 
@endsection

@section('content')
        <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">

				<div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card flex-row" id="card-header">
                                <h5 class="card-header ff-google fw-bold">DANH SÁCH BÌNH LUẬN</h5>
                                <a href="{{ route('CommentsGetOnAll') }}">
                                    <span class="btn btn-brand btn-add">Duyệt tất cả</span>
                                </a>
                            </div>
							<div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first" id="tbl-detail">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    <input type="checkbox" />
                                                </th>
                                                <th class="ff-google fw-bold">Thông tin người bình luận</th>
                                                <th class="ff-google fw-bold">Nội dung</th>
                                                <th class="ff-google fw-bold">Thời gian</th>
                                                <th class="ff-google fw-bold text-center">Duyệt</th>
                                                <th class="ff-google fw-bold text-center">Chức năng</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-comments">
                                            @foreach($comments as $comment)
                                            @if( $comment->view == 1)
                                            <tr style="background-color: white">
                                            @else
                                            <tr style="background-color: #ffe6e6">
                                            @endif
                                                <td class="text-center">
                                                    <input type="checkbox" name="">
                                                </td>
                                                <td>
                                                    <b>{{ $comment->name }}</b>
                                                    <p class="mb-0">{{ $comment->email }}</p>
                                                    <p>{{ $comment->phone }}</p>
                                                </td>
                                                <td width="40%">{{ $comment->content }}</td>
                                                <td width="15%">
                                                    <span>{{ $comment->date }}</span>
                                                    <span>{{ $comment->created_at->format('d/m/Y') }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="button-switch">
                                                    @if($comment->status == 1)
                                                    <input name="status" type="checkbox" id="switch-blue" class="switch inp-status change-status" checked="checked" value="true" data-url="{{ route('CommentsChangeStatus', $comment->id) }}"/>
                                                    @else
                                                    <input name="status" type="checkbox" id="switch-blue" class="switch inp-status change-status" value="true" data-url="{{ route('CommentsChangeStatus', $comment->id) }}"/>
                                                    @endif
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-primary btn-edit-comment" title="Chỉnh sủa" data-url="">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-danger del-comment" title="Xóa" data-url="{{ route('CommentsGetDelete', $comment->id) }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $comments->links() }}
                            </div>
                        </div>

					</div>
				</div>

            </div>
        </div>

        
@endsection

@section('jquery')
<script>
    @if(session()->has('success'))
    $.notify('{{ session()->get('success') }}', 'success')
    @endif
    $('#body-comments').on('click', '.change-status', function(){
        let url = $(this).attr('data-url');
        let data = [];
        axios.get(url, data).then(response => {
            if(response.data.status == 1){
                $.notify('Duyệt thành công!', 'success');
            }else{
                $.notify('Hủy duyệt thành công!', 'success');
            }
        }).catch(err => {
            $.notify('Duyệt thất bại!', 'error');
        })
    });
    $('#body-comments').on('click', '.del-comment', function(){
        let url = $(this).attr('data-url');
        let data = [];
        if(confirm('Bạn chắc chắn muốn xóa!')){
            axios.get(url, data).then(response => {
                $(this).parent().parent().remove();
                $.notify('Xóa thành công!', 'success');
            }).catch(err => {
                $.notify('Xóa thất bại!', 'error');
            })
        }
    });
</script>
@endsection