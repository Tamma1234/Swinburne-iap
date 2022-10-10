
@extends('admin.layouts.main')
@section('title', 'Create')

@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Permissions',
      'value' => "Create Permission", 'value2' => ""])
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-lg-12">

                    <!--begin::Portlet-->
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Create Permission Form Layout
                                </h3>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form class="kt-form kt-form--label-right" action="{{route('permissions.store')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="kt-portlet__body">
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <label>Permission Name:</label>
                                        <input type="text" name="permission_name" class="form-control" id="exampleInputEmail1"
                                               placeholder="Enter Permission Name">
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            <a href="{{route('permissions.index')}}" class="btn btn-secondary">Cancel</a>
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
