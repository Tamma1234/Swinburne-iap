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
                                {{  $send->title }}
                            </h3>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <div>
                        {!! $send->content !!}
                    </div>
                    <!--end::Form-->
                </div>
            </div>
        </div>
    </div>
@endsection
