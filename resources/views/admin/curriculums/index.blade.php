@extends('admin.layouts.main')
@section('title', 'Index')
@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Curriculum', 'value' => "List", 'value2' => ""])
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label col-md-2">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        List Curriculum
                    </h3>
                </div>
                <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10 col-8">
                    <div class="row align-items-center">
                        <div class="col-xl-12 order-2 order-xl-1">
                            <div class="total-record text-center">
                                <p>Total: <span class="text-danger" id="total">{{ count($curriculums) }}</span> record</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-2 align-self-center">
                    <a href="{{ route('curriculum.create') }}" class="btn pull-right hidden-sm-down btn btn-primary"
                       data-toggle="kt-tooltip" title="add"><i
                            class="flaticon-add-circular-button"></i></a>
                </div>
            </div>
            <div id="data-body">
{{--                <div class="kt-portlet">--}}
{{--                    <form action="" method="post" style="margin: auto">--}}
{{--                        @csrf--}}
{{--                        <div class="row" style="padding-left: 20px; margin: auto">--}}
{{--                                Text--}}
{{--                                <select id="term_id" name="term_id" onchange="doSearch()">--}}
{{--                                    <option value="">Select</option>--}}
{{--                                    @foreach($terms as $item)--}}
{{--                                        <option--}}
{{--                                            {{ $term->id == $item->id ? "selected" : "" }} value="{{ $item->id }}">{{ $item->term_name }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            Subject--}}
{{--                                <select id="department_id" name="department_id" onchange="doSearch()">--}}
{{--                                    <option value="">select</option>--}}
{{--                                    @foreach($departments as $department)--}}
{{--                                        <option--}}
{{--                                            value="{{ $department->id }}">{{ $department->department_name }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            Course--}}
{{--                                <select id="course_id" name="course_id" onchange="doSearch()">--}}
{{--                                    <option value="">select</option>--}}
{{--                                    @foreach($courses as $course)--}}
{{--                                        <option value="{{ $course->id }}">{{ $course->psubject_code }} - {{ $course->psubject_name }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            Status--}}
{{--                            <select name="group_status">--}}
{{--                                <option value="">select</option>--}}
{{--                                <option value="PLAN">Mới đặt lịch</option>--}}
{{--                                <option value="START">Đang học</option>--}}
{{--                                <option value="WAIT">Chờ thi</option>--}}
{{--                                <option value="DONE">Đã xong</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
                <div class="kt-portlet__body" id="form-table-search">
                    <!--begin: Datatable -->
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="example">
                        <thead>
                        <tr>
                            <th>Curriculum Code</th>
                            <th>Intake</th>
                            <th style="width: 70px">Course</th>
                            <th>Major</th>
                            <th>Content</th>
                            <th>Number Of Student</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="tbody">
                        @foreach($curriculums as $item)
                            <?php $countUser = \App\Models\User::where('curriculum_id', $item->id)->where('user_level', 3)->count(); ?>
                            <tr class="text-center">
                                <td class="font-weight-bold"><a class="version" href="">{{ $item->name }}</a>
                                </td>
                                <td>{{ $item->khoa }}</td>
                                <td>{{ $item->nganh }}</td>
                                <td>{{ $item->chuyen_nganh }}</td>
                                <td></td>
                                <td>{{ $countUser }}</td>
                                <td class="text-nowrap">
                                    <a href="{{ route('curriculum.edit', ['id' => $item->id]) }}"
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


        });
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
    </script>
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
        });
    </script>
@endsection
