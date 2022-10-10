@extends('admin.layouts.main')
@section('title', 'Create')

@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Users',
        'value' => "Deleted Account", 'value2' => ""])

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Table User Options
                </h3>
            </div>
            <div class="col-md-6 col-4 align-self-center">
                <a href="{{route('roles.create')}}" class="btn pull-right hidden-sm-down btn-success"><i
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
                            <th>Middlename</th>
                            <th>Givenname</th>
                            <th>Email</th>
                            <th class="text-nowrap">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->user_login}}</td>
                                <td>{{$user->user_middlename}}</td>
                                <td>{{$user->user_givenname}}</td>
                                <td>{{$user->user_email}}</td>
                                <td class="text-nowrap">
                                    <a href="{{route('users.edit', ['id' => $user->id])}}" data-toggle="tooltip"
                                       data-original-title="Edit"><i class="flaticon-edit"></i>
                                    </a>
                                    <a href="{{route('users.remove', ['id' => $user->id])}}" data-toggle="tooltip"
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
@endsection
