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
                        List Course
                    </h3>
                </div>
            </div>
            <form class="kt-form kt-form--label-right">
                <div class="kt-portlet__body">
                    <div class="form-group row">
                        <label for="example-text-input" class="col-1 col-form-label">Học kỳ</label>
                        <div class="col-6">
                            <select class="custom-select form-control">
                                @foreach($groupMember as $item)
                                <option value="{{ $item->pterm_id }}">{{ $item->pterm_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-search-input" class="col-1 col-form-label">Bộ môn</label>
                        <div class="col-6">
                            <select class="custom-select form-control">
                                <option selected="">Select</option>
                                <option value="1">One</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-email-input" class="col-1 col-form-label">Khóa học</label>
                        <div class="col-6">
                            <select class="custom-select form-control">
                                <option selected="">Select</option>
                                <option value="1">One</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-url-input" class="col-1 col-form-label">Tên lớp</label>
                        <div class="col-6">
                            <input class="form-control" type="text" value="">
                        </div>
                    </div>
                </div>
            </form>
            <div class="kt-portlet__body" id="form-table-search">
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="example">
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
                            ?>
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$item->member_login}}</td>
                            <td>{{ $user->user_code }}</td>
                            <td>{{ $user->user_code_au }}</td>
                            <td>{{ $user->user_surname .' '. $user->user_middlename .' '. $user->user_givenname }}</td>
                            <td>{{ $item->date }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!--end: Datatable -->
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

