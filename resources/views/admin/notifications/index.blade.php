@extends('admin.layouts.main')
@section('title', 'Dashboard')

@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Permissions',
          'value' => "List Permission", 'value2' => ""])
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label col-md-2">
                    <span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        Table Head Options
                    </h3>
                </div>

            </div>
            <div class="kt-portlet__body">
                <!--begin::Section-->
                <div class="kt-section">
                    <div class="kt-section__content">
                        <table class="table table-striped- table-bordered table-hover table-checkable" id="example">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sends as $send)
                                <tr>
                                    <td>{{$send->id}}</td>
                                    <td>{{$send->title}}</td>
                                    <td class="text-nowrap">
                                        <a href="{{route('notifications.show', ['id' => $send->id])}}"
                                           data-toggle="kt-tooltip" title="Edit"
                                           data-original-title="Edit"><i class="flaticon-edit"></i>
                                        </a>
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
    </div>
@endsection
