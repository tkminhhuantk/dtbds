@extends('editor/masterbackend')

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
                            <a href="{{ route('EditorProjectsGetAdd') }}">
                            	<span class="btn btn-brand btn-add" data-toggle="modal" data-target="#add-investor">Thêm mới</span>
                            </a>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                  
                                    <table class="table table-striped table-bordered first mb-2" id="tbl-projects" >
                                        <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="ff-google fw-bold">Tên dự án</th>
                                                <th class="text-center ff-google fw-bold">Hình đại diện</th>
                                                <th class="text-center ff-google fw-bold">Giá</th>
                                                <th class="text-center ff-google fw-bold">Danh mục</th>
                                                <th class="text-center ff-google fw-bold">Duyệt</th>
                                                <th class="text-center ff-google fw-bold">Chức năng</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-projects">
                                            @foreach($projects as $key => $project)
                                            <tr>
                                                <td class="text-center">{{ $project->id }}</td>
                                                <td>
                                                    <a href="javascript:void(0)" target="_blank"> 
                                                        {{ $project->title }}
                                                    </a>
                                                    <br />
                                                    <i>{{ $project->date }} - {{ $project->created_at->format('d/m/Y') }}</i>
                                                </td>
                                                <td class="text-center">
                                                    <img style="height: 50px; width: auto" src="{{ asset($project->url_avatar) }}" />
                                                </td>
                                                <td class="text-center">{{ $project->price }}</td>
                                                <td class="text-center">{{ $project->categories->title }}</td>
                                                <td class="text-center">
                                                    <div class="button-switch">
                                                    @if($project->status == 1)
                                                    <input name="status" type="checkbox" id="switch-blue" class="switch inp-status" checked="checked" value="true" disabled="disabled" />
                                                    @else
                                                    <input name="status" type="checkbox" id="switch-blue" class="switch inp-status" value="true" disabled="disabled" />
                                                    @endif
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('EditorProjectsGetUpdate',$project->id) }}" class="btn btn-primary" title="Chỉnh sủa"><i class="fas fa-edit"></i></a>
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
@endsection