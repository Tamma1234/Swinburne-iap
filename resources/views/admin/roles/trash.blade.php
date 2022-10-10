@extends('admin.layouts.main')
@section('title', 'Trash')

@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Roles',
      'value' => "Deleted Role", 'value2' => ""])

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Table Roles Trash Options
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
                        @foreach($roles as $role)
                            <tr>
                                <td>{{$role->id}}</td>
                                <td>{{$role->role_name}}</td>
                                <td class="text-nowrap">
                                    <a href="{{route('roles.delete.completely', ['id' => $role->id])}}" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a>
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
