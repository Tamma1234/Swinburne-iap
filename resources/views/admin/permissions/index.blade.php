@extends('admin.layouts.main')
@section('title', 'Dashboard')

@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Permissions',
          'value' => "List Permission", 'value2' => ""])
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Table Head Options
                </h3>
            </div>
            <div class="col-md-6 col-4 align-self-center">
                <a href="{{route('permissions.create')}}" class="btn pull-right hidden-sm-down btn-success"><i
                        class="mdi mdi-plus-circle"></i> Create</a>
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
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <td>{{$permission->id}}</td>
                                <td>{{$permission->permission_name}}</td>
                                <td class="text-nowrap">
                                    <a href="{{route('permissions.edit', ['id' => $permission->id])}}" data-toggle="tooltip"
                                       data-original-title="Edit"><i class="flaticon-edit"></i>
                                    </a>
                                    <a href="{{route('permissions.remove', ['id' => $permission->id])}}" data-toggle="tooltip"
                                       data-original-title="Close"> <i class="flaticon-delete"></i> </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"
                         style="margin-left: 450px">
                        {{ $permissions->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>

            <!--end::Section-->
        </div>
    </div>
@endsection
