@extends('admin.layouts.main')
@section('title', 'Dashboard')

@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Permissions',
          'value' => "List Permission", 'value2' => ""])
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label col-md-2">
                    <span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                        <h3 class="kt-portlet__head-title">
                            Table Head Options
                        </h3>
                </div>
                <div class="col-md-10 col-2 align-self-center">
                    <a href="{{ route('permissions.create')  }}" class="btn pull-right hidden-sm-down btn btn-primary"
                       data-toggle="kt-tooltip" title="" data-original-title="add"><i
                            class="flaticon-add-circular-button"></i></a>
                </div>
            </div>
            <div class="kt-portlet__body">
                <!--begin::Section-->
                <div class="kt-section">
                    <div class="kt-section__content">
                        <table class="table table-striped- table-bordered table-hover table-checkable" id="example">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions as $permission)
                                <tr>
                                    <td>{{$permission->id}}</td>
                                    <td>{{$permission->permission_name}}</td>
                                    <td class="text-nowrap">
                                        <a href="{{route('permissions.edit', ['id' => $permission->id])}}"
                                           data-toggle="kt-tooltip" title="Edit"
                                           data-original-title="Edit"><i class="flaticon-edit"></i>
                                        </a>
                                        <a href="{{route('permissions.remove', ['id' => $permission->id])}}"
                                           data-toggle="kt-tooltip" title="Delete"
                                           data-original-title="Close"> <i class="flaticon-delete"></i> </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--end::Section-->
            </div>

        </div>
    </div>
@endsection
