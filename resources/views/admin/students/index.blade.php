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
                        List Student & Student status
                    </h3>
                </div>
                <div class="col-md-8 col-2 align-self-center">
                    <a href="{{ route('event.add') }}" class="btn pull-right hidden-sm-down btn btn-primary"
                       data-toggle="kt-tooltip" title="add"><i
                            class="flaticon-add-circular-button"></i></a>
                </div>
            </div>
            <div class="kt-portlet__body" id="form-table-search">
                <table class="table table-striped- table-bordered table-hover table-checkable">
                    <thead>
                    <tr>
                        <th>YEAR INTAKE</th>
                        @foreach($study_status as $item)
                            @if($item->study_status == 1)
                                <th class="text-success">INTAKE</th>
                            @elseif($item->study_status == 2)
                                <th class="text-success">INTAKE COURSE</th>
                            @elseif($item->study_status == 3)
                                <th class="text-danger">DEFER</th>
                            @elseif($item->study_status == 4)
                                <th class="text-danger">DO</th>
                            @elseif($item->study_status == 5)
                                <th class="text-danger">CHANGE CAMPUS</th>
                            @elseif($item->study_status == 17)
                                <th class="text-danger">PENDING</th>
                            @endif
                        @endforeach
                        <th>PENDING RATE</th>
                        <th>DF RATE</th>
                        <th>DO RATE</th>
                        <th>GRADUATED RATE</th>
                        <th>TOTAL</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($intakes as $intake)
                            <?php
                            $total_intake = \App\Models\User::where('user_level', 3)->where('intake', $intake->intake)->get()->count();
                            $count_pd = \App\Models\User::where('user_level', 3)->where('study_status', 17)->where('intake', $intake->intake)->get()->count();
                            $count_do = \App\Models\User::where('user_level', 3)->where('study_status', 4)->where('intake', $intake->intake)->get()->count();
                            $count_df = \App\Models\User::where('user_level', 3)->where('study_status', 3)->where('intake', $intake->intake)->get()->count();
                            $count_tn = \App\Models\User::where('user_level', 3)->where('study_status', 8)->where('intake', $intake->intake)->get()->count();
                            ?>
                        <tr>
                            <td>{{ $intake->intake }}</td>
                            @foreach($study_status as $status)
                                    <?php
                                    $count_status = \App\Models\User::where('user_level', 3)->where('study_status', $status->study_status)->where('intake', $intake->intake)->get()->count();
                                    ?>
                                <td>{{ $count_status }}</td>
                            @endforeach
                            <td>{{ $count_pd }}</td>
                            <td>{{ $count_df }}</td>
                            <td>{{ $count_do }}</td>
                            <td>{{ $count_tn }}</td>
                            <td>{{ $total_intake }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!--begin: Datatable -->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Fillter student status
                            </h3>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelects">Choose Student Stutas:</label>
                        <select class="form-control form-control-sm col-2" id="choose_status">
                            <option value="">Select</option>
                            <option value="1">INTAKE</option>
                            <option value="2">INTAKE COURSE</option>
                            <option value="3">DEFER</option>
                            <option value="4">DO ( Dropout )</option>
                            <option value="5">CHANGE CAMPUS</option>
                            <option value="17">PENDING</option>
                            <option value="8">GRADUATED</option>
                        </select>
                    </div>
                    <!--end::Form-->
                </div>
                <table class="table table-striped- table-bordered table-hover table-checkable">
                    <thead class="table-active">
                    <tr>
                        <th class="text-white">#</th>
                        <th class="text-white">STUDENT LOGIN</th>
                        <th class="text-white">FULL NAME</th>
                        <th class="text-white">STUDENT CODE</th>
                        <th class="text-white" style="width: 47px">CREATED DATE</th>
                        <th class="text-white">COURSE PLAN</th>
                        <th class="text-white" style="width: 54px">COURSE INTAKE</th>
                        <th class="text-white">MAJOR INTAKE</th>
                        <th class="text-white">INTAKE GC</th>
                        <th class="text-white">INTAKE</th>
                        <th class="text-white">INTAKE COURSE</th>
                        <th class="text-white">CHANGE STATUS DATE</th>
                        <th class="text-white">SCHOLARSHIP</th>
                        <th class="text-white">GENDER</th>
                        <th class="text-white" style="width: 90px">DOB</th>
                        <th class="text-white">STATUS</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">

                    </tbody>
                </table>
                <!--end: Datatable -->
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#choose_status').change(function () {
            var value = $('#choose_status').val();
            $.ajax({
                url: '{{ route('status.search') }}',
                type: 'get',
                data: {value: value},
            }).done(function (response) {
                $('#tbody').empty();
                $('#tbody').html(response);
            })
        });
    </script>
@endsection
