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
                        Gold List
                    </h3>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputState"></label>
                    <div class="">
                        <a href="{{ route('export.gold') }}" class="btn btn-default btn-icon-sm dropdown-toggle">
                            <i class="la la-download"></i>
                            Export Golds
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-2 align-self-center">
                    <a href="{{ route('gold.add') }}" class="btn pull-right hidden-sm-down btn btn-primary"
                       data-toggle="kt-tooltip" title="present gold"><i
                            class="flaticon-add-circular-button"></i></a>
                </div>
            </div>
            <div class="kt-portlet__body" id="form-table-search">
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>GOLD RECEIVER</th>
                        <th>FULL NAME</th>
                        <th>TOTAL GOLD</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    <?php $i = 1; ?>
                    @foreach($golds as $gold)
                        <?php $user = \App\Models\User::where('user_code', $gold->gold_receiver)->first();
                            if ($user) {
                                $full_name = $user->user_surname .' '. $user->user_middlename .' '. $user->user_givenname;
                            } else {
                                $full_name = "";
                            }
                        ?>
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $gold->gold_receiver }}</td>
                            <td>{{ $full_name }}</td>
                            <td>{{ $gold->total }}</td>
                            <td><a href="{{ route('gold.detail', ['user_code' => $gold->gold_receiver ]) }}">Detail</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!--end: Datatable -->
            </div>
        </div>
    </div>
@endsection
