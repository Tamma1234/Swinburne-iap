@extends('admin.layouts.main')
@section('title', 'Index')
@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Student', 'value' => "Student status", 'value2' => ""])

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label col-md-4">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        Gold Detail
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body" id="form-table-search">
                <table class="table table-striped- table-bordered table-hover table-checkable">
                    <thead>
                    </thead>
                    <tbody id="tbody">
                    <tr>
                        <td>User Code</td>
                        <td>{{ $user->user_code }}</td>
                    </tr>
                    <tr>
                        <td>Full Name</td>
                        <td>{{ $full_name }}</td>
                    </tr>
                    </tbody>
                </table>
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>DESCRIPTION</th>
                        <th>GOLD GIVER</th>
                        <th>Name Event</th>
                        <th>GOLD</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    <?php $i = 1; ?>
                    @foreach($golds as $gold)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $gold->description }}</td>
                            <td>{{ $gold->gold_giver }}</td>
                            <td>{{ $gold->events ? $gold->events->name_event : "" }}</td>
                            <td>{{ $gold->gold }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!--end: Datatable -->
            </div>
        </div>
    </div>
@endsection
