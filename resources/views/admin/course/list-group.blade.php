@extends('admin.layouts.main')
@section('title', 'Index')
@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Course', 'value' => "List Course", 'value2' => ""])
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        Thêm/sửa lớp
                    </h3>
                </div>
            </div>
            <form class="kt-form kt-form--label-right">
                <div class="kt-portlet__body">
                    <div class="form-group row">
                        <label for="example-text-input" class="col-1 col-form-label">Học kỳ</label>
                        <div class="col-6">
                            <select class="custom-select form-control" disabled>
                                <option selected="">{{ $group->pterm_name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-search-input" class="col-1 col-form-label">Bộ môn</label>
                        <div class="col-6">
                            <select class="custom-select form-control" disabled>
                                <option selected="">{{ $department->department_name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-email-input" class="col-1 col-form-label">Khóa học</label>
                        <div class="col-6">
                            <select class="custom-select form-control" disabled>
                                <option selected="">{{ $group->psubject_code .' - '. $group->psubject_name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-url-input" class="col-1 col-form-label">Tên lớp</label>
                        <div class="col-6">
                            <input class="form-control" type="text" value="{{ $group->group_name }}">
                        </div>
                    </div>
                </div>
            </form>
            <div class="col-xl-12 col-lg-12 order-lg-3 order-xl-1">
                <!--begin:: Widgets/Best Sellers-->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-toolbar">
                            <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">
                                <li class="nav-item-group">
                                    <button type="button" class="nav-link-group active btn btn-dark btn-hover-danger"
                                            data-toggle="tab" href="#kt_widget5_tab1_content" role="tab">
                                        THÀNH VIÊN
                                    </button>
                                </li>
                                <li class="nav-item-group">
                                    <a class="nav-link-group btn btn-dark btn-hover-danger" data-toggle="tab"
                                       href="#kt_widget5_tab2_content" role="tab">
                                        KẾ HOẠCH
                                    </a>
                                </li>
                                <li class="nav-item-group">
                                    <a class="nav-link-group btn btn-dark btn-hover-danger" data-toggle="tab"
                                       href="#kt_widget5_tab3_content" role="tab">
                                        BẢNG ĐIỂM
                                    </a>
                                </li>
                                <li class="nav-item-group">
                                    <a class="nav-link-group btn btn-dark btn-hover-danger" data-toggle="tab"
                                       href="#kt_widget5_tab4_content" role="tab">
                                        ĐIỂM DANH
                                    </a>
                                </li>
                                <li class="nav-item-group">
                                    <a class="nav-link-group btn btn-dark btn-hover-danger" data-toggle="tab"
                                       href="#kt_widget5_tab5_content" role="tab">
                                        LỚP KHÁC
                                    </a>
                                </li>
                                <li class="nav-item-group">
                                    <a class="nav-link-group btn btn-dark btn-hover-danger" data-toggle="tab"
                                       href="#kt_widget5_tab6_content" role="tab">
                                        LỊCH SỬ
                                    </a>
                                </li>
                                <li class="nav-item-group">
                                    <a class="nav-link-group btn btn-dark btn-hover-danger" data-toggle="tab"
                                       href="#kt_widget5_tab7_content" role="tab">
                                        DANH SÁCH BV
                                    </a>
                                </li>
                                <li class="nav-item-group">
                                    <a class="nav-link-group btn btn-dark btn-hover-danger" data-toggle="tab"
                                       href="#kt_widget5_tab8_content" role="tab">
                                        PLAN NEW
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="kt-portlet__body-group" style="margin-top: 20px">
                        <div class="tab-content">
                            <div class="tab-pane active " id="kt_widget5_tab1_content">
                                <!--begin: Datatable -->
                                <table class="table table-striped- table-bordered table-hover table-checkable"
                                       id="example">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên Đăng Nhập</th>
                                        <th>Mã Sinh Viên</th>
                                        <th>Mã Sinh Viên AU</th>
                                        <th>Họ Và Tên</th>
                                        <th>Ngày Vào Lớp</th>
                                        <th>Trạng Thái</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbody">
                                    <?php $i = 1 ?>
                                    @foreach($groupMember as $item)
                                            <?php
                                            $user_login = $item->member_login;
                                            $user = \App\Models\User::where('user_login', $user_login)->first();
                                            $totalGroup = \App\Models\Fu\GroupMember::where('groupid', $id)->where('member_login', $item->member_login)->get();
                                            ?>
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td class="text-primary">{{$item->member_login}}</td>
                                            <td>{{ $user->user_code }}</td>
                                            <td>{{ $user->user_code_au }}</td>
                                            <td>{{ $user->user_surname .' '. $user->user_middlename .' '. $user->user_givenname }}</td>
                                            <td>{{ $item->date }}</td>
                                            <td>
                                                @if(count($totalGroup) == 1)
                                                    <span class="text-success">Intake</span>
                                                @else
                                                    <span class="text-danger">Fall</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <!--end: Datatable -->
                            </div>
                            <div class="tab-pane" id="kt_widget5_tab2_content">
                                <div class="kt-section" style="overflow: auto">
                                    <div class="kt-section__content">
                                        <table class="table">
                                            <thead class="thead-dark">
                                            <tr>
                                                <?php $i = 1 ?>
                                                <th>BUỔI HỌC</th>
                                                @foreach($activityGroup as $item)
                                                    <th>{{ $i++ }}</th>
                                                @endforeach
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Mô tả</td>
                                                @foreach($activityGroup as $item)
                                                    <td>{{ $item->description }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td>Ngày Tháng</td>
                                                @foreach($activityGroup as $item)
                                                        <?php $date = date('d/m', strtotime($item->day));
                                                        ?>
                                                    <td class="text-primary font-weight-bold">{{ $date }}
                                                        <p>{{ $item->slot }}</p></td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td>Giảng viên</td>
                                                @foreach($activityGroup as $item)
                                                    <td class="text-primary font-weight-bold">{{ $item->leader_login }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td>Giảng viên 2</td>
                                            </tr>
                                            <tr>
                                                <td>Phòng</td>
                                                @foreach($activityGroup as $item)
                                                    <td>{{ $item->room_name }}</td>
                                                @endforeach
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr/>
                                    <button type="button" class="btn btn-outline-brand">Sửa lịch
                                    </button>
                                    <div class="kt-section__content">
                                        <table class="table">
                                            <thead class="table-active" style="color: white">
                                            <tr>
                                                <th>Buồi Học</th>
                                                <th>Ngày Tháng</th>
                                                <th>Ca</th>
                                                <th>Mô Tả</th>
                                                <th>Phòng</th>
                                                <th>Giảng Viên</th>
                                                <th>Giảng Viên 2</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i = 1 ?>
                                            @foreach($activityGroup as $item)

                                                <tr class="{{ $item->done == 1 ? "table-primary" : "" }}">
                                                    <th scope="row"
                                                        class="{{ $item->done == 1 ? "text-success" : "" }}">{{ $i++ }}
                                                        - {{$item->done == 1 ? "Đã học" : "Chưa học" }}</th>
                                                    <td><input type="text"
                                                               {{ $item->done == 1 ? "disabled" : "" }} value="{{ $item->day }}"><span>{{ date('l', strtotime($date)) }}</span>
                                                    </td>
                                                    <td>
                                                        <select class="custom-select choose" id="subject"
                                                                name="subject_id" {{ $item->done == 1 ? "disabled" : "" }}>
                                                            @foreach($slots as $slot)
                                                                <option
                                                                    value="{{ $item->id }}">{{ $slot->id .' - '. $slot->slot_start}} </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>{{ $item->description }}</td>
                                                    <td>{{ $item->room_name }}</td>
                                                    <td>{{ $item->leader_login }}</td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="kt_widget5_tab3_content">
                                <!--begin: Datatable -->
                                <div class="col-md-8">
                                    <table class="table table-bordered table-hover">
                                        <thead class="table-active" style="color: #fff">
                                        <tr>
                                            <th>Mã</th>
                                            <th>Họ và Tên</th>
                                            <th>Tổng</th>
                                            <th>Trạng Thái</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($courseResult as $item)
                                                <?php $user = \App\Models\User::where('user_login', $item->student_login)->first();
                                                $full_name = $user->user_surname . ' ' . $user->user_middlename . ' ' . $user->user_givenname;
                                                ?>
                                            <tr>
                                                <td class="text-primary">{{ $item->student_login }}</td>
                                                <td class="text-primary">{{ $full_name }}</td>
                                                <td>{{ $item->grade }}</td>
                                                <td> @if($item->is_finish == 0)
                                                        <span class="text-danger">Not Passed</span>
                                                    @else
                                                        <span class="text-success">Passed</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-dark">
                                    <span class="text-dark font-weight-bold">Trung Bình (Tổng {{ count($courseResult) }} Sinh Viên)</span>
                                </div>
                                <!--end: Datatable -->
                            </div>
                            <div class="tab-pane" id="kt_widget5_tab4_content">
                                <div class="kt-section" style="overflow: auto">
                                    <div class="kt-section__content">
                                        <table class="table table-bordered sortable">
                                            <thead class="table-active" style="color: white">
                                            <tr>
                                                <th rowspan="3" style="padding-bottom: 55px">STT</th>
                                                <th rowspan="3" style="padding-bottom: 55px">Tên Đăng Nhập</th>
                                                <th rowspan="3" style="padding-bottom: 55px">Mã</th>
                                                <th rowspan="3" style="padding-bottom: 55px">Tổng Vắng</th>
                                                <th rowspan="3" style="padding-bottom: 55px">% Vắng</th>
                                                <th colspan="{{ count($activityGroup) + 1 }}" class="text-center">Tình
                                                    Hình Đi Học
                                                    <br/>
                                                </th>
                                                <th rowspan="3">Vắng (%) tới hiện nay</th>
                                            </tr>
                                            <?php $i = 1; ?>
                                            <tr>
                                                @foreach($activityGroup as $item)
                                                        <?php $date = date('d/m', strtotime($item->day));
                                                        ?>
                                                    <th class="unsortable">{{ $date }}</th>
                                                @endforeach
                                                <th rowspan="2">Tổng</th>
                                            </tr>
                                            <tr>
                                                @foreach($activityGroup as $item)
                                                    <th class="unsortable">{{ $i++ }}</th>
                                                @endforeach
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i = 1 ?>
                                            @foreach($courseResult as $item)
                                                    <?php $user = \App\Models\User::where('user_login', $item->student_login)->first();
                                                    $attendances = \App\Models\Fu\Attendance::where('user_login', $item->student_login)
                                                        ->where('groupid', $id)
                                                        ->where('val', 0)
                                                        ->get();
                                                    $totalAttendance = count($attendances);
                                                    ?>
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $item->student_login }}</td>
                                                    <td>{{ $user->user_code }}</td>
                                                    <td class="text-center">{{ $totalAttendance }}</td>
                                                    <td class="text-danger text-center">{{ $item->phan_tram_nghi }}%</td>
                                                    @foreach($activityGroup as $activity)
                                                            <?php $attendance = \App\Models\Fu\Attendance::where('activity_id', $activity->id)
                                                            ->where('user_login', $item->student_login)
                                                            ->first();
                                                            ?>
                                                        @if($activity->done == 1)
                                                            <td class="text-center">
                                                                @if($attendance->val == 1)
                                                                    <span class="text-success">P</span>
                                                                @else
                                                                    <span class="text-danger">A</span>
                                                                @endif
                                                            </td>
                                                        @else
                                                            <td class="text-center font-weight-bold">-</td>
                                                        @endif
                                                    @endforeach
                                                    <td class="text-center" style="padding-bottom: 55px">{{ $totalAttendance }}</td>
                                                    <td class="text-danger" style="padding-bottom: 55px">{{ $item->phan_tram_nghi }}%</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="kt_widget5_tab5_content" aria-expanded="true">
                                <div class="kt-widget kt-widget--project-1">
                                    <div class="kt-widget__footer">
                                        <div class="kt-widget__wrapper">
                                            <div class="kt-widget__section">
                                                @foreach($groupAnother as $item)
                                                    <div class="kt-widget__blog" style="margin-right: 10px; border: 1px solid #a4a4a4; padding: 5px; border-radius: 13px">
                                                        <i class="flaticon2-list-1"></i>
                                                        <a href="{{ route('course.group', ['id' => $item->id]) }}" class="kt-widget__value kt-font-brand">{{ $item->group_name }}</a><span class="kt-widget__value">({{ $item->number_student }})</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end:: Widgets/Best Sellers-->
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
    <script>
        //search with stude_status
        $(document).ready(function () {
            $('#study_status').change(function () {
                $.ajax({
                    url: '{{ route('users.post.search') }}',
                    type: 'post',
                    data: $('form').serialize(),
                }).done(function (response) {
                    $('#form-table-search').empty();
                    $('#form-table-search').html(response);
                })
            });
        });

        // search with user_level
        $('#user_level').change(function () {
            $.ajax({
                url: "{{ route('users.post.search') }}",
                type: 'post',
                data: $('form').serialize()
            }).done(function (response) {
                // // Gọi hàm renderCart trả về cart item con
                $('#form-table-search').empty();
                $('#form-table-search').html(response);
            });
        });

        // search with curriculum
        $('#curriculum').change(function () {
            $.ajax({
                url: "{{ route('users.post.search') }}",
                type: 'post',
                data: $('form').serialize()
            }).done(function (response) {
                // // Gọi hàm renderCart trả về cart item con
                $('#form-table-search').empty();
                $('#form-table-search').html(response);
            });
        });

        $(document).ready(function () {
            $('#btn-form-search').click(function (event) {
                event.preventDefault();
                $.ajax({
                    url: '{{ route('users.post.search') }}',
                    type: 'post',
                    data: $('form').serialize(),
                })
                    .done(function (response) {
                        $('#form-table-search').empty();
                        $('#form-table-search').html(response);
                    })
            })
        })
    </script>
@endsection

