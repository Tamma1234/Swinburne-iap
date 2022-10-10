@extends('admin.layouts.main')
@section('title', 'Create')

@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Users', 'value' => "Edit User", 'value2' => ""])

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12">

                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Edit User Form Layout
                            </h3>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="kt-form kt-form--label-right" action="{{route('users.update', ['id' => $user->id])}}"
                          enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>User Login:</label>
                                    <input type="text" disabled name="user_login" class="form-control" id="exampleInputEmail1"
                                           placeholder="Enter User login" value="{{$user->user_login}}">
                                </div>
                                <div class="col-lg-6">
                                    <label>User Surname:</label>

                                    <input type="text" disabled name="user_surname" class="form-control" id="exampleInputEmail1"
                                           placeholder="Enter User surname" value="{{$user->user_surname}}" >
                                </div>
                                @error('user_surname')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>User Middlename:</label>
                                    <input type="text" disabled name="user_middlename" class="form-control"
                                           id="exampleInputEmail1"
                                           placeholder="Enter User middlename" value="{{$user->user_middlename}}">
                                </div>
                                @error('user_middlename')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="col-lg-6">
                                    <label>User GivenName:</label>
                                    <input type="text" name="user_givenname" class="form-control"
                                           id="exampleInputEmail1"
                                           placeholder="Enter User givenname" value="{{$user->user_givenname}}">
                                </div>
                                @error('user_givenname')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>User Email:</label>
                                    <input type="text" disabled name="user_email" class="form-control" id="exampleInputEmail1"
                                           placeholder="Enter User Email" value="{{$user->user_email}}">
                                </div>
                                <div class="col-lg-6">
                                    <label>User Password:</label>
                                    <input type="password" disabled name="user_pass" class="form-control" id="exampleInputEmail1"
                                           placeholder="Enter User Password" >
                                </div>
                            </div>
                            @error('user_pass')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="card-border-primary mb-3 col-md-12">
                                        <div class="row" id="modul-row">
                                            <div class="kt-checkbox-list">
                                                <label class="kt-checkbox kt-checkbox--solid kt-checkbox--light">
                                                    <input class="checkbox_wraper custom-control-input" type="checkbox">Roles
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row" id="permission-row">
                                            @foreach($roles as $role)
                                                <div class="form-group col-md-3">
                                                    <div class="kt-checkbox-inline">
                                                        <label
                                                            class="kt-checkbox kt-checkbox--solid kt-checkbox--primary">
                                                            <input type="checkbox" name="role_id[]"
                                                                   {{$user->roles->contains('id', $role->id) ? 'checked' : ""}}
                                                                   class="checkbox_childrent custom-control-input"
                                                                   value="{{$role->id}}"> {{$role->role_name}}
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <a href="{{route('users.index')}}" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!--end::Form-->
                </div>
            </div>
        </div>
@endsection
