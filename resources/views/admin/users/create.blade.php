@extends('admin.layouts.main')
@section('title', 'Create')

@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Users', 'value' => "Create User", 'value2' => ""])

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12">

                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Create User Form Layout
                            </h3>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="kt-form kt-form--label-right" action="{{route('users.store')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>User Login:</label>
                                    <input type="text" name="user_login" class="form-control" id="exampleInputEmail1"
                                           placeholder="Enter User login">
                                    @error('user_login')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label>User Surname:</label>
                                    <input type="text" name="user_surname" class="form-control" id="exampleInputEmail1"
                                           placeholder="Enter User surname">
                                    @error('user_surname')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>User Middlename:</label>
                                    <input type="text" name="user_middlename" class="form-control" id="exampleInputEmail1"
                                           placeholder="Enter User middlename">
                                    @error('user_middlename')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label>User GivenName:</label>
                                    <input type="text" name="user_givenname" class="form-control" id="exampleInputEmail1"
                                           placeholder="Enter User givenname">
                                    @error('user_givenname')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>User Email:</label>
                                    <input type="text" name="user_email" class="form-control" id="exampleInputEmail1"
                                           placeholder="Enter User Email">
                                    @error('user_email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                    <label>User Password:</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputEmail1"
                                           placeholder="Enter User Password">
                                </div>
{{--                                @error('password')--}}
{{--                                <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                                @enderror--}}
                            </div>
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
                                                <div class="form-group col-md-3" >
                                                    <div class="kt-checkbox-inline">
                                                        <label class="kt-checkbox kt-checkbox--solid kt-checkbox--primary">
                                                            <input type="checkbox"  name="office_id[]"
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
    </div>
@endsection
