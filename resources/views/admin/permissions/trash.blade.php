@extends('admin.layouts.main')
@section('title', 'Trash')

@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Permissions',
      'value' => "Deleted Permission", 'value2' => ""])
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Table Permisson Trash Options
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin::Section-->
            <div class="kt-section">
                <div class="kt-section__content">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th class="text-nowrap">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <td>{{$permission->id}}</td>
                                <td>{{$permission->permission_name}}</td>
                                <td class="text-nowrap">
                                    <a href="{{route('permissions.delete.completely', ['id' => $permission->id])}}" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a>
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
@endsection
