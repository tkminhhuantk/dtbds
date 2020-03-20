@extends('editor/masterbackend')

@section('title')
TIN TỨC
@endsection

@section('content')
		<div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card flex-row" id="card-header">
                            <h5 class="card-header ff-google fw-bold">DANH SÁCH TIN TỨC</h5>
                            <a href="{{ route('EditorNewsGetAdd') }}">
                            	<span class="btn btn-primary btn-add" data-toggle="modal" data-target="#add-investor">Thêm mới</span>
                            </a>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                  
                                    <table class="table table-striped table-bordered first" id="tbl-news" data-url="{{ route('AdminNewsAnyData') }}">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="ff-google fw-bold">Tên bài viết</th>
                                                <th class="text-center ff-google fw-bold">Hình đại diện</th>
                                                <th class="text-center ff-google fw-bold">Thời gian đăng</th>
                                                <th class="text-center ff-google fw-bold">Duyệt</th>
                                                <th class="text-center ff-google fw-bold">Chức năng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($news as $new)
                                            <tr>
                                                <td class="text-center">{{ $new->id }}</td>
                                                <td style="text-align: left;" width="45%">{{ $new->title }}</td>
                                                <td class="text-center">
                                                    <img src="{{ asset($new->link_avatar) }}" class="img-new-review">
                                                </td>
                                                <td>
                                                  <i>{{ $new->date }}</i><br>
                                                  <span>{{ $new->created_at->format('d-m-Y') }}</span>
                                                </td>
                                                <td>
                                                  <div class="button-switch">
                                                    @if($new->status == 1)
                                                    <input name="status" type="checkbox" id="switch-blue" class="switch inp-status" checked="checked" value="true" disabled="disabled" />
                                                    @else
                                                    <input name="status" type="checkbox" id="switch-blue" class="switch inp-status btn-change" value="true" disabled="disabled" />
                                                    @endif
                                                  </div>
                                                </td>
                                                <td>
                                                    <a href="{{ route('EditorNewsGetUpdate', $new->id) }}"><span class="btn btn-primary" title="Chỉnh sủa"><i class="fas fa-edit"></i></span></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table><br>
                                    <div class="d-flex justify-content-between">
                                        <span>Tổng: {{ count($news) }} / {{ $news->total() }} bài</span>
                                        {!! $news->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
@endsection

@section('jquery')
<script>
$(document).ready(function() { 

  $('#tbl-news').on('click', '.btn-del-new', function(){
    let url = $(this).attr('data-url');
    let data = []
    if(confirm('Bạn chắc chắn muốn xóa!')){
      axios.get(url, data).then(response => {
        $(this).parent().parent().remove();
        $.notify('Xóa thành công!', 'success');
      }).catch(err => {
        $.notify('Không thể xóa!', 'error');
      })
    }
  });
  
  $('#tbl-news').on('click', '.btn-change', function(){
    let url = $(this).attr('data-url');
    let data = [];
    axios.get(url, data).then(response => {
        console.log(response.data);
        if(response.data.status == 1){
            $.notify('Duyệt thành công!', 'success');
        }else{
            $.notify('Hủy duyệt thành công!', 'success');
        }
     }).catch(err => {
        $.notify('Duyệt bài viết không thành công!', 'error');
     });
  });
});
</script>
@endsection