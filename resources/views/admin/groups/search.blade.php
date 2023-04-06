@extends('admin.layouts.table')
@section('content')
    <div class="kt-portlet">
        <form action="" method="post" style="margin: auto;">
            @csrf
            <div class="row">
                Text
                <select id="term_id" name="term_id" onchange="doSearch()">
                    <option value="">Select</option>
                    @foreach($terms as $item)
                        <option
                            {{ $item->id == $term_id ? "selected" : "" }} value="{{ $item->id }}">{{ $item->term_name }}</option>
                    @endforeach
                </select>
                Subject
                <select id="department_id" name="department_id" onchange="doSearch()">
                    <option value="">select</option>
                    @foreach($departments as $department)
                        <option {{ $department_id == $department->id ? "selected" : "" }}
                            value="{{ $department->id }}">{{ $department->department_name }}</option>
                    @endforeach
                </select>
                Course
                <select id="course_id" name="course_id" onchange="doSearch()">
                    <option value="">select</option>
                    @foreach($courses as $course)
                        <option {{ $course_id == $course->id ? "selected" : ""}} value="{{ $course->id }}">{{ $course->psubject_code }} - {{ $course->psubject_name }}</option>
                    @endforeach
                </select>
                Status
                <select name="group_status">
                    <option>select</option>
                    <option value="PLAN">Mới đặt lịch</option>
                    <option value="START">Đang học</option>
                    <option value="WAIT">Chờ thi</option>
                    <option value="DONE">Đã xong</option>
                </select>
            </div>
        </form>
    </div>
    <div class="kt-portlet__body" id="form-table-search">
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
                    $start_day = $item->start_date;
                    $start_day_format = date('d-m-Y', strtotime($start_day));
                    $end_day = $item->end_date;
                    $end_day_format = date('d-m-Y', strtotime($end_day));

                    $activityGroup = \App\Models\Fu\Acitivitys::selectRaw('count(*) as slot_count, slot')
                        ->where('groupid', $item->id)
                        ->groupBy('slot')
                        ->distinct()
                        ->get();
                    $activityGroupLeader = \App\Models\Fu\Acitivitys::selectRaw('count(*) as leader_count, leader_login')
                        ->where('groupid', $item->id)
                        ->groupBy('leader_login')
                        ->distinct()
                        ->get();
                    ?>
                <tr class="text-center">
                    <td>{{ $i++ }}</td>
                    <td class="font-weight-bold"><a class="version"
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
            <input type="hidden" id="totalGroup" value="{{ count($groups) }}">
            </tbody>
        </table>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            var table = $('#example').DataTable({pageLength: 10});
            // Get the page info, so we know what the last is
            var pageInfo = table.page.info();
            // Set the ending interval to the last page
            endInt = pageInfo.end;
            // Current page
            currentInt = 0;
            // interval = setInterval(function () {
            //     // "Next" ...
            //     table.page(currentInt).draw('page');
            //
            //     // Increment the current page int
            //     currentInt++;
            //
            //     // If were on the last page, reset the currentInt to the first page #
            //     if (currentInt === pageInfo.pages) {
            //         currentInt = 0;
            //     }
            //     // console.log(currentInt);
            // }, 10000); // 3 seconds
            {{--$('#term_id').change(function () {--}}
            {{--    var action = $(this).attr('id');--}}
            {{--    var term_id = $('#term_id').val();--}}
            {{--    var result = "";--}}
            {{--    if (action == 'term_id') {--}}
            {{--        result = "block_id";--}}
            {{--    }--}}
            {{--    $.ajax({--}}
            {{--        url: '{{ route('group.search') }}',--}}
            {{--        type: 'get',--}}
            {{--        data: {action: action, term_id: term_id},--}}
            {{--    }).done(function (response) {--}}
            {{--        $('#data-body').empty();--}}
            {{--        $('#data-body').html(response);--}}
            {{--        var totalGroup = $('#totalGroup').val();--}}
            {{--        $('#total').html(totalGroup)--}}
            {{--    })--}}
            {{--});--}}
            function doSearch() {
                $.ajax({
                    url: '{{ route('group.search') }}',
                    type: 'get',
                    data: $('form').serialize(),
                }).done(function (response) {
                    $('#data-body').empty();
                    $('#data-body').html(response);
                    var totalGroup = $('#totalGroup').val();
                    $('#total').html(totalGroup)
                })
            }
        });
    </script>
@endsection
