@extends('admin.layouts.main')
@section('title', 'Index')
@section('content')
    @include('admin.templates.search-header', ['name' => 'Swinburne', 'key' => 'Group', 'value' => "List group", 'value2' => ""])

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile" id="content-data">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label col-md-2">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        List Group
                    </h3>
                </div>
                <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10 col-8">
                    <div class="row align-items-center">
                        <div class="col-xl-12 order-2 order-xl-1">
                            <div class="total-record text-center">
                                <p>Total: <span class="text-danger" id="total">{{ count($groups) }}</span> record</p>
                            </div>
                            <div class="list-setting text-center">
                                <p><a class="version" href="{{ route('import.student') }}">Import student to
                                        group(CSV)</a> |
                                    <a class="version" href="{{ route('export.group', ['term_id' => $term->id]) }}">Export
                                        groups from
                                        semmester</a> |
                                    <a class="version" href="{{ route('import.class') }}">Import class schedule</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-2 align-self-center">
                    <a href="{{ route('group.create') }}" class="btn pull-right hidden-sm-down btn btn-primary"
                       data-toggle="kt-tooltip" title="add"><i
                            class="flaticon-add-circular-button"></i></a>
                </div>
            </div>
            <div id="data-body">
                <div class="kt-portlet">
                    <form action="" method="post" style="margin: auto">
                        @csrf
                        <div class="row" style="padding-left: 20px; margin: auto">
                            Term
                            <select id="term_id" name="term_id" onchange="doSearch()">
                                <option value="">Select</option>
                                @foreach($terms as $item)
                                    <option
                                        {{ $term->id == $item->id ? "selected" : "" }} value="{{ $item->id }}">{{ $item->term_name }}</option>
                                @endforeach
                            </select>
                            Subject
                            <select id="department_id" name="department_id" onchange="doSearch()">
                                <option value="">select</option>
                                @foreach($departments as $department)
                                    <option
                                        value="{{ $department->id }}">{{ $department->department_name }}</option>
                                @endforeach
                            </select>
                            Course
                            <select id="course_id" name="course_id" onchange="doSearch()">
                                <option value="">select</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->psubject_code }}
                                        - {{ $course->psubject_name }}</option>
                                @endforeach
                            </select>
                            Status
                            <select name="group_status">
                                <option value="">select</option>
                                <option value="PLAN">Mới đặt lịch</option>
                                <option value="START">Đang học</option>
                                <option value="WAIT">Chờ thi</option>
                                <option value="DONE">Đã xong</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="kt-portlet__body" id="form-table-search">
                    <!--begin: Datatable -->
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="example">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Class Name</th>
                            <th style="width: 70px">Subject Code</th>
                            <th>Subject Name</th>
                            <th>Block</th>
                            <th>Blended</th>
                            <th>SLot</th>
                            <th>Lecturers</th>
                            <th style="width: 104px">Number Of Student</th>
                            <th>Fail</th>
                            <th style="width: 45px">Start Day</th>
                            <th style="width: 45px">End Day</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="tbody">
                        <?php $i = 1 ?>
                        @foreach($groups as $item)
                                <?php
                                $start_day_format = "";
                                $end_day_format = "";
                                $start_day = $item->start_date;
                                if (isset($start_day)) {
                                    $start_day_format = date('d-m-Y', strtotime($start_day));
                                }
                                $end_day = $item->end_date;
                                if (isset($end_day)) {
                                    $end_day_format = date('d-m-Y', strtotime($end_day));
                                }

                                $activityGroup = \App\Models\Fu\Activitys::selectRaw('count(*) as slot_count, slot')
                                    ->where('groupid', $item->id)
                                    ->groupBy('slot')
                                    ->distinct()
                                    ->get();
                                $activityGroupLeader = \App\Models\Fu\Activitys::selectRaw('count(*) as leader_count, leader_login')
                                    ->where('groupid', $item->id)
                                    ->groupBy('leader_login')
                                    ->distinct()
                                    ->get();
                                ?>
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td class="font-weight-bold">
                                    <a class="version"
                                       href="{{ route('course.group', ['id' => $item->id]) }}">{{ $item->group_name }}</a>
                                </td>
                                <td>{{ $item->psubject_code }}</td>
                                <td>{{ $item->psubject_name }}</td>
                                <td>{{ $item->block_name }}</td>
                                <td></td>
                                <td>
                                    @foreach($activityGroup as $activity)
                                        <p>Ca {{$activity->slot}} : {{ $activity->slot_count }}</p>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($activityGroupLeader as $activityLeader)
                                        <p>{{$activityLeader->leader_login}} : {{ $activityLeader->leader_count }}</p>
                                    @endforeach
                                </td>
                                <td>{{ $item->number_student }}</td>
                                <td></td>
                                <td>{{ $start_day_format }}</td>
                                <td>{{ $end_day_format }}</td>
                                <td class="text-nowrap">
                                    <a href="{{ route('course.group', ['id' => $item->id]) }}"
                                       data-original-title="Edit" data-toggle="kt-tooltip" title="Edit"><i
                                            class="flaticon-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!--end: Datatable -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        import App from "../../../js/App";
        export default {
            components: {App}
        }
    </script>
    <script>
        $(document).ready(function () {
            $('#kt_form_search').keyup(function () {
                var value = $('#kt_form_search').val();
                $("#select-value").show();
                $.ajax({
                    url: '{{ route('value.search') }}',
                    type: 'get',
                    data: {value: value},
                }).done(function (response) {
                    $('#select-value').empty();
                    $('#select-value').html(response);
                    $("body").on("click", function () {
                        $("#select-value").hide();
                    })
                })
            });

            // $('#term_id').change(function () {
            //     let url = $(this).val();
            //     if (url) {
            //         window.location = url;
            //     }
            //     return false;
            // })
            //
            // $('#department_id').change(function () {
            //     let url = $(this).val();
            //     if (url) {
            //         window.location = url;
            //     }
            //     return false;
            // })
        });

        function doSearch() {
            $.ajax({
                url: '{{ route('group.search') }}',
                type: 'get',
                data: $('form').serialize(),
            }).done(function (response) {
                $('#content-data').empty();
                $('#content-data').html(response);
                var totalGroup = $('#totalGroup').val();
                $('#total').html(totalGroup)
            })
        }
    </script>
@endsection
