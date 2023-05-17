@extends('admin.layouts.main')
@section('title', 'Index')
@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Group', 'value' => "Import Lịch", 'value2' => ""])
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label col-md-2">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        Import Lịch
                    </h3>
                </div>
            </div>
            <div id="data-body">
                <div class="kt-portlet__body">
                    <div class="">
                        <div>
                            <h5 class="font-weight-bold">Hướng dẫn sử dụng:</h5>
                        </div>
                        <div class="kt-section">
                            <div class="kt-section__desc">
                                <p class="text-dark">- Tạo một file CSV có định dạng như sau:</p>
                                <p style="margin-left: 20px">
                                    term,date,slot,room,teacher_login,subject_code,course_session,student_group1[,student_group2,...,student_group_n]</p>
                                <p style="margin-left: 20px">SUMMER
                                    2012,2012-04-02,2,H201,quangln,BUS101,1,PT0802,PT0801,PT0803</p>
                            </div>

                            <div class="kt-separator kt-separator--space-lg kt-separator--border-dashed"></div>
                        </div>
                        <div class="" id="kt_widget4_tab11_content">
                            <div class="kt-scroll ps ps--active-y">
                                <div class="kt-list-timeline">
                                    <div class="kt-list-timeline__items">
                                        <div class="kt-list-timeline__item">
                                            <span class="kt-list-timeline__badge kt-list-timeline__badge--brand"></span>
                                            <span class="kt-list-timeline__text"><strong>term</strong>: Tên học kỳ, bắt buộc phải giống tên hiển thị trong chức năng Quản lý học kỳ</span>
                                        </div>
                                        <div class="kt-list-timeline__item">
                                            <span class="kt-list-timeline__badge kt-list-timeline__badge--brand"></span>
                                            <span class="kt-list-timeline__text"><strong>date</strong>: Ngày học bắt buộc phải nhập theo định dạng yyyy-mm-dd. VD 2013-09-23.</span>
                                        </div>
                                        <div class="kt-list-timeline__item">
                                            <span class="kt-list-timeline__badge kt-list-timeline__badge--brand"></span>
                                            <span class="kt-list-timeline__text"><strong>slot</strong>: Ca học</span>
                                        </div>
                                        <div class="kt-list-timeline__item">
                                            <span class="kt-list-timeline__badge kt-list-timeline__badge--brand"></span>
                                            <span class="kt-list-timeline__text"><strong>room</strong>: Tên phòng, bắt buộc phải giống tên hiển thị trong chức năng Quản lý phòng</span>
                                        </div>
                                        <div class="kt-list-timeline__item">
                                            <span class="kt-list-timeline__badge kt-list-timeline__badge--brand"></span>
                                            <span class="kt-list-timeline__text"><strong>teacher_login</strong>: Tên đăng nhập của giảng viên</span>
                                        </div>
                                        <div class="kt-list-timeline__item">
                                            <span class="kt-list-timeline__badge kt-list-timeline__badge--brand"></span>
                                            <span class="kt-list-timeline__text"><strong>subject_code</strong>: Mã môn học</span>
                                        </div>
                                        <div class="kt-list-timeline__item">
                                            <span class="kt-list-timeline__badge kt-list-timeline__badge--brand"></span>
                                            <span class="kt-list-timeline__text"><strong>course_session</strong>: Buổi học thứ</span>
                                        </div>
                                        <div class="kt-list-timeline__item">
                                            <span class="kt-list-timeline__badge kt-list-timeline__badge--brand"></span>
                                            <span class="kt-list-timeline__text"><strong>student_group1</strong>: Tên lớp</span>
                                        </div>
                                        <div class="kt-list-timeline__item">
                                            <span class="kt-list-timeline__badge kt-list-timeline__badge--brand"></span>
                                            <span class="kt-list-timeline__text"><strong>Lưu ý</strong>: Có thể đặt nhiều lớp cùng học một buổi học bằng cách thêm các cột student_group2, student_group3,... vào đằng sau cột student_group1</span>
                                        </div>
                                    </div>
                                    <p class="text-dark" style="margin-top: 20px">- Duyệt tới file này sau đó nhấn nút
                                        <strong>Nhập</strong>:</p>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('post.import.class') }}"  enctype="multipart/form-data">
                                @csrf
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>File CSV để nhập:</th>
                                        <td><input type="file" id="file" name="file"></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">Tự động tạo Khóa học, Lớp:</th>
                                        <td><input type="checkbox" checked name="auto"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="submit" class="btn-primary" value="Nhập"></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
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
                });

                {{--function importClass() {--}}
                {{--    var file = $('#file').val();--}}
                {{--    var _token = $('input[name="_token"]').val();--}}
                {{--    $.ajax({--}}
                {{--        url : "{{ route('post.import.class') }}",--}}
                {{--        type: 'post',--}}
                {{--        data : {file:file,_token:_token}--}}
                {{--    }).done(function (data) {--}}

                {{--    })--}}
                {{--}--}}
            </script>
        <script>
            {{--$(document).ready(function () {--}}
            {{--    $('.btn-primary').click(function () {--}}
            {{--        var file = $("input[name='files']").val();--}}
            {{--        var _token = $('input[name="_token"]').val();--}}
            {{--        $.ajax({--}}
            {{--            url: '{{ route('post.import.class') }}',--}}
            {{--            type: 'post',--}}
            {{--            data: {_token:_token, file:file},--}}
            {{--        }).done(function (response) {--}}

            {{--        })--}}
            {{--    });--}}
            {{--});--}}
        </script>

@endsection
