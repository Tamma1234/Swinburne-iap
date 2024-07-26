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
                    <form class="kt-form kt-form--label-right" action="{{route('permissions.store')}}"
                          enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group">
                                <label for="exampleSelectd">Choose Roles Parent</label>
                                <select class="form-control" id="exampleSelectd" name="permission_name">
                                    @foreach(config('permissions.module_parent') as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label>Permission Name:</label>
                                    <div class="kt-checkbox-inline">
                                        @foreach(config('permissions.module_children') as $children)
                                            <label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand col-2">
                                                <input type="checkbox" name="children[]" value="{{ $children }}">{{ $children }}
                                                <span></span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
{{--                            <div class="row" id="permission-row">--}}
{{--                                @foreach($permissionChildren->permissionChildren as $item)--}}
{{--                                    <div class="form-group col-md-3">--}}
{{--                                        <div class="kt-checkbox-inline">--}}
{{--                                            <label--}}
{{--                                                class="kt-checkbox kt-checkbox--bold kt-checkbox--brand">--}}
{{--                                                <input type="checkbox" name="permission_id[]"--}}
{{--                                                       class="checkbox_childrent custom-control-input"--}}
{{--                                                       value="{{$item->id}}"> {{$item->route_name}}--}}
{{--                                                <span></span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
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
