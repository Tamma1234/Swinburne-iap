@extends('admin.layouts.main')
@section('title', 'Create')

@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Roles',
      'value' => "Create Role", 'value2' => ""])
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12">

                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Create Role Form Layout
                            </h3>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="kt-form kt-form--label-right" action="{{route('roles.store')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label>Role Name:</label>
                                    <input type="text" name="role_name" class="form-control" id="exampleInputEmail1"
                                           placeholder="Enter Role Name">
                                </div>
                                @error('role_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
                                            @foreach($permissions as $permission)
                                                <div class="form-group col-md-3" >
                                                    <div class="kt-checkbox-inline">
                                                        <label class="kt-checkbox kt-checkbox--solid kt-checkbox--primary">
                                                            <input type="checkbox"  name="office_id[]"
                                                                   class="checkbox_childrent custom-control-input"
                                                                   value="{{$permission->id}}"> {{$permission->permission_name}}
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
                                        <a href="{{route('roles.index')}}" type="reset" class="btn btn-secondary">Cancel</a>
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

