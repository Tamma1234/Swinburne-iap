@extends('admin.layouts.main')
@section('title', 'Index')
@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Course', 'value' => "List Course", 'value2' => ""])

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label col-md-2">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        Quản lí môn học
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body" id="form-table-search">
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" >
                    <thead class="table-primary">
                    <tr>
                        <th>Department</th>
                        <th>Subject Code</th>
                        <th>Subject Name</th>
                        <th>Subject Name (EN)</th>
                        <th>Abbreviations (SMS)</th>
                        <th>Conversion Cod</th>
                        <th>Level</th>
                        <th>Number Of Credit</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr>
                            <td>{{ $subject->departments ? $subject->departments->department_name : ""  }}</td>
                            <td>{{ $syllabus->subject_code }}</td>
                            <td><input type="text" value="{{$syllabus->syllabus_name}}"> </td>
                            <td><input type="text" value="{{$syllabus->syllabus_name}}"> </td>
                            <td><input type="text" value="{{$syllabus->subject_code}}"> </td>
                            <td><input type="text" value="{{$syllabus->subject_code}}"> </td>
                            <td>{{ $subject->level }}</td>
                            <td>{{ $subject->num_of_credit }}</td>
                        </tr>
                    </tbody>
                </table>
                <!--end: Datatable -->
                <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" style="border-bottom: 1px solid">
                    <li class="nav-item">
                        <a href="#" class="nav-link btn btn-primary" style="color: #fff">
                            Version
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link btn btn-primary" style="color: #fff">
                            Group
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link btn btn-primary" style="color: #fff">
                            Separation Of Subjects
                        </a>
                    </li>
                </ul>
                <div>
                    <p class="kt-portlet__head-title font-weight-bold btn btn-success btn-sm" >
                        Kiểm tra lỗi
                    </p>
                </div>

                <table class="table table-striped- table-bordered table-hover table-checkable" >
                    <thead class="table-primary">
                    <tr>
                        <th>TÊN KHUNG CHƯƠNG TRÌNH HỌC</th>
                        <th>SYLLABUS CODE</th>
                        <th>SỐ NHÓM ĐẦU ĐIỂM</th>
                        <th>SỐ BUỔI HỌC</th>
                        <th>PHẰN TRĂM ĐI HỌC</th>
                        <th>ĐIỂM TỐI THIỂU</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    <tr>
                        <td><input type="text" value="{{ $syllabus->syllabus_name  }}"></td>
                        <td><input type="text" value="{{ $syllabus->syllabus_code }}"></td>
                        <td><input type="text" value="{{ $syllabus->lock_type }}"></td>
                        <td><input type="text" value="{{ $syllabus->num_of_session }}"></td>
                        <td><input type="text" value="{{ $subject->num_of_credit }}"></td>
                        <td><input type="text" value="{{ $syllabus->minimum_required }}"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function doSearch() {
            var term_id = $('#term_id').val();
            var department_id = $('#department_id').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('course.search') }}",
                method: 'GET',
                data: {term_id: term_id, department_id: department_id, _token: _token},
                success: function (data) {
                    $('#tbody').html(data);
                    var totalCourse = $('#totalCourse').val();
                    $('#total').html(totalCourse)
                }
            });
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
    {{--    <script>--}}
    {{--        //search with stude_status--}}
    {{--        $(document).ready(function () {--}}
    {{--            $('#study_status').change(function () {--}}
    {{--                $.ajax({--}}
    {{--                    url: '{{ route('users.post.search') }}',--}}
    {{--                    type: 'post',--}}
    {{--                    data: $('form').serialize(),--}}
    {{--                }).done(function (response) {--}}
    {{--                    $('#form-table-search').empty();--}}
    {{--                    $('#form-table-search').html(response);--}}
    {{--                })--}}
    {{--            });--}}
    {{--        });--}}

    {{--        // search with user_level--}}
    {{--        $('#user_level').change(function () {--}}
    {{--            $.ajax({--}}
    {{--                url: "{{ route('users.post.search') }}",--}}
    {{--                type: 'post',--}}
    {{--                data: $('form').serialize()--}}
    {{--            }).done(function (response) {--}}
    {{--                // // Gọi hàm renderCart trả về cart item con--}}
    {{--                $('#form-table-search').empty();--}}
    {{--                $('#form-table-search').html(response);--}}
    {{--            });--}}
    {{--        });--}}

    {{--        // search with curriculum--}}
    {{--        $('#curriculum').change(function () {--}}
    {{--            $.ajax({--}}
    {{--                url: "{{ route('users.post.search') }}",--}}
    {{--                type: 'post',--}}
    {{--                data: $('form').serialize()--}}
    {{--            }).done(function (response) {--}}
    {{--                // // Gọi hàm renderCart trả về cart item con--}}
    {{--                $('#form-table-search').empty();--}}
    {{--                $('#form-table-search').html(response);--}}
    {{--            });--}}
    {{--        });--}}

    {{--        $(document).ready(function () {--}}
    {{--            $('#btn-form-search').click(function (event) {--}}
    {{--                event.preventDefault();--}}
    {{--                $.ajax({--}}
    {{--                    url: '{{ route('users.post.search') }}',--}}
    {{--                    type: 'post',--}}
    {{--                    data: $('form').serialize(),--}}
    {{--                })--}}
    {{--                    .done(function (response) {--}}
    {{--                        $('#form-table-search').empty();--}}
    {{--                        $('#form-table-search').html(response);--}}
    {{--                    })--}}
    {{--            })--}}
    {{--        })--}}
    {{--    </script>--}}
@endsection
