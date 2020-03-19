@extends('backend/masterbackend')

@section('title')
DỰ ÁN
@endsection

@section('content')
        <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card flex-row" id="card-header">
                            <h5 class="card-header ff-google fw-bold">DANH SÁCH DỰ ÁN</h5>
                            <a href="{{ route('AdminProjectsGetAdd') }}">
                            	<span class="btn btn-brand btn-add" data-toggle="modal" data-target="#add-investor">Thêm mới</span>
                            </a>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">

                                    <select id="action-projects" class="p-1 mb-2">
                                        <option value="">Chọn tác vụ</option>
                                        <option value="1">Duyệt bài dự án</option>
                                        <option value="2">Hủy duyệt dự án</option>
                                        <option value="3">Xóa</option>
                                    </select>

                                    <button class="btn-primary mb-1 mr-2 btn-action-projects"
                                        data-url-statusOn="{{ route('ProjectsPostStatusOn') }}"
                                        data-url-statusOff="{{ route('ProjectsPostStatusOff') }}">
                                        Thực hiện
                                    </button>

                                    {{-- <select class="p-1 mb-2">
                                        <option>Danh mục</option>
                                        @foreach($categories as $category)
                                        <optgroup label="{{ $category->title }}">
                                            @foreach($category->sub as $sub)
                                            <option value="{{ $sub->id }}">{{ $sub->title }}</option>
                                            @endforeach
                                        </optgroup>
                                        @endforeach
                                    </select>

                                    <select class="p-1 mb-2">
                                        <option>Trạng thái</option>
                                        <option>Bật</option>
                                        <option>Tắt</option>
                                    </select>

                                    <span>Hiển thị 
                                        <select class="p-1 mb-2">
                                            <option>10</option>
                                            <option>25</option>
                                            <option>100</option>
                                        </select>
                                     bài</span> 
                                     
                                    <button class="btn-primary mb-1 mr-2 btn-search">Tìm</button>
                                     --}}
                                  
                                    <table class="table table-striped table-bordered first mb-2" id="tbl-projects" >
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    <input type="checkbox" id="select-all" />
                                                </th>
                                                <th class="text-center">ID</th>
                                                <th width="35%" class="ff-google fw-bold">Tên dự án</th>
                                                <th class="text-center ff-google fw-bold">Hình đại diện</th>
                                                <th class="text-center ff-google fw-bold">Giá</th>
                                                <th class="text-center ff-google fw-bold">Danh mục</th>
                                                <th class="text-center ff-google fw-bold">Duyệt</th>
                                                <th width="13%" class="text-center ff-google fw-bold">Chức năng</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-projects">
                                            @foreach($projects as $project)
                                            @if( $project->review > 0)
                                            <tr style="background-color: white">
                                            @else
                                            <tr style="background-color: #ffe6e6">
                                            @endif
                                                <th class="text-center">
                                                    <input class="project_id project_{{ $project->id }}" type="checkbox" id="select" name="id_project[]" value="{{ $project->id }}" data-url-del="{{ route('AdminProjectsGetDelete', $project->id) }}"/>
                                                </th>
                                                <td class="text-center">{{ $project->id }}</td>
                                                <td>
                                                    <a class="a_review" href="{{ route('ProjectsGetReview',['slugCat'=>$project->categories->slug, 'slugPro'=>$project->slug]) }}" target="_blank"> 
                                                        {{ $project->title }}
                                                    </a>
                                                    <br />
                                                    <i>{{ $project->date }} - {{ $project->created_at->format('d/m/Y') }}</i>
                                                    <br>
                                                    <i>({{ $project->users->name }})</i>
                                                </td>
                                                <td class="text-center">
                                                    @if($project->avatar != null)
                                                    <img style="height: 70px; width: 100px" src="{{ asset($project->avatar) }}" />
                                                    @else
                                                    <img style="height: 70px; width: 100px" src="{{ asset('images/noimg.png') }}" />
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ $project->price }}</td>
                                                <td class="text-center">{{ $project->categories->title }}</td>
                                                <td class="text-center">
                                                    <div class="button-switch">
                                                    @if($project->status == 1)
                                                    <input name="status" type="checkbox" id="switch-blue" class="switch inp-status btn-change" checked="checked" value="true" data-url="{{ route('ProjectsGetChangeStatus', $project->id) }}"/>
                                                    @else
                                                    <input name="status" type="checkbox" id="switch-blue" class="switch inp-status btn-change" value="true" data-url="{{ route('ProjectsGetChangeStatus', $project->id) }}"/>
                                                    @endif
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('ProjectsGetUpdate',$project->id) }}" class="btn btn-primary" title="Chỉnh sủa"><i class="fas fa-edit"></i></a>
                                                    <button class="btn btn-danger btn-del-project" data-url="{{ route('AdminProjectsGetDelete',$project->id) }}" title="Xóa"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="d-flex justify-content-between">
                                        <span>Tổng: {{ count($projects) }} / {{ $projects->total() }} bài</span>
                                        {!! $projects->links() !!}
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
<script type="text/javascript">
    $('#body-projects').on('click','.btn-del-project', function(){
        let url = $(this).attr('data-url');
        let data = []
        if(confirm('Bạn chắc chắn muốn xóa!')){
            axios.get(url, data).then(response => {
                $(this).parent().parent().remove();
                $.notify('Xóa thành công', 'success');
            }).catch(err => {
                $.notify('Xóa không thành công','warn');
            })
        }
    });

    $('#select-all').click(function(event) {   
        if(this.checked) {
            $('.project_id:checkbox').each(function() {
                this.checked = true;                     
            });
        } else {
            $('.project_id:checkbox').each(function() {
                this.checked = false;                   
            });
        }
    });

    $('.btn-change').change(function(){
    let url = $(this).attr('data-url');
    let data = [];
    axios.get(url,data).then(response => {
        if(response.data.status == 1){
            $.notify('Duyệt thành công!','success');
        }else{
            $.notify('Hủy duyệt thành công!', 'success');
        }
        }).catch(err => {
             $.notify('Không thể duyệt!','error');
        });
    })
    
    $('#body-projects').on('click', '.a_review', function(e){
        e.preventDefault();
        let url = $(this).attr('href');
        $(this).parent().parent().removeAttr('style');
        $(this).parent().parent().attr('style', 'background-color: white');
        window.open(url,'_blank');
    });
    
    $('.btn-action-projects').on('click', function() {
        let action =  $('#action-projects');
        let self = $(this);
        let urlOn = $(this).attr('data-url-statusOn');
        let urlOff = $(this).attr('data-url-statusOff');
        if(action.val() == ""){
            $.notify('Chưa chọn tác vụ', 'error');
        }else{
            if(action.val() == 1){
                let val = [];
                $('.project_id:checkbox:checked').each(function(i){
                    let id = $(this).val();
                    axios.post(urlOn, {id: id}, {
                        headers: {
                            'Content-Type': 'application/json',
                        }
                    }).then(response => {
                        $.notify('Duyệt thành công: '+response.data.title, 'success');
                    }).catch(err => {
                        $.notify('Duyệt thất bại!', 'error');
                    });
                });
                setTimeout(location.reload.bind(location), 2000);
            }
            if(action.val() == 2){
                let val = [];
                $('.project_id:checkbox:checked').each(function(i){
                    let id = $(this).val();
                    axios.post(urlOff, {id: id}, {
                        headers: {
                            'Content-Type': 'application/json',
                        }
                    }).then(response => {
                        $.notify('Hủy duyệt thành công: '+response.data.title, 'success');
                    }).catch(err => {
                        $.notify('Hủy duyệt thất bại!', 'error');
                    });
                });
                setTimeout(location.reload.bind(location), 2000);
            } 
            if(action.val() == 3){
                if(confirm('Bạn chắc chắn muốn xóa!')){
                    let val = [];
                    $('.project_id:checkbox:checked').each(function(i){
                        let id = $(this).val();
                        let urlDel = $(this).attr('data-url-del')
                        let data = [];
                        axios.get(urlDel, data, {
                            headers: {
                                'Content-Type': 'application/json',
                            }
                        }).then(response => {
                            $.notify('Xóa thành công: '+response.data.title, 'success');
                        }).catch(err => {
                            $.notify('Xóa thất bại!', 'error');
                        });
                    });
                    setTimeout(location.reload.bind(location), 2000);
                }
            } 
        }
    });
</script>
@endsection