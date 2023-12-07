@extends('admin.layouts.main')
@section('title', 'Create')

@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Guidline',
      'value' => "Create", 'value2' => ""])
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Create Guidline Form Layout
                            </h3>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="kt-form kt-form--label-right" action="{{ route('guidline.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Name:</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="col-lg-6">
                                    <label>Guidline Type:</label>
                                    <select class="custom-select" name="group_guidline">
                                        <option value="0">Strategic & Plan</option>
                                        <option value="1">Operation Guidline</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Content:</label>
                                    <textarea class="form-control" name="content"></textarea>
                                </div>
                                <div class="col-lg-6">
                                    <label>Date:</label>
                                    <input type="date" class="form-control" name="date_create">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Description:</label>
                                    <textarea class="form-control" name="description"></textarea>
                                </div>
                                <div class="col-lg-6">
                                    <label>File:</label>
                                    <input type="file" class="form-control" name="file_name">
                                    @error('gold')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <a href="{{ route('guidline.index') }}" type="reset" class="btn btn-secondary">Cancel</a>
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

