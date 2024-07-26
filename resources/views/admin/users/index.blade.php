@extends('admin.layouts.main')
@section('title', 'Create')
@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Users', 'value' => "List User", 'value2' => ""])

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label col-md-2">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        List User
                    </h3>
                </div>
                <div class="col-sm-12 col-md-8">
                    <form method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="inputState"></label>
                                <select class="form-control" id="user_level" name="user_level">
                                    <option selected value="">Chooose</option>
                                    <option value="1">Cán bộ cấp cao</option>
                                    <option value="2">Giảng viên</option>
                                    <option value="3">Sinh viên</option>
                                    <option value="4">Cán bộ đào tạo</option>
                                    <option value="11">Giảng viên thể chất</option>
                                    <option value="13">Cán bộ - Nhân viên</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputState"></label>
                                <select id="study_status" class="form-control" name="study_status">
                                    <option selected value="">Choose</option>
                                    <option value="1">INTAKE</option>
                                    <option value="3">DEFER</option>
                                    <option value="4">DO</option>
                                    <option value="5">CHANGE CAMPUS</option>
                                    <option value="7">PENDING</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputState"></label>
                                <select id="curriculum" class="form-control" name="curriculum_id">
                                    <option selected value="">Choose...</option>
                                    @foreach($curriculums as $curriculum)
                                        <option value="{{ $curriculum->id }}">{{ $curriculum->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-2 col-2 align-self-center">
                    <a href="{{ route('users.create')  }}" class="btn pull-right hidden-sm-down btn btn-primary"
                       data-toggle="kt-tooltip" title="" data-original-title="add"><i
                            class="flaticon-add-circular-button"></i></a>
                </div>
            </div>
            <div class="kt-portlet__body" id="form-table-search">
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="example">
                    <thead>
                    <tr>
                        <th>USER LOGIN</th>
                        <th>USER SURNAME</th>
                        <th>USER MIDDLENAME</th>
                        <th>USER GIVENAME</th>
                        <th>USER EMAIL</th>
                        <th>BARCODE</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->user_login}}</td>
                            <td>{{$user->user_surname}}</td>
                            <td>{{$user->user_middlename}}</td>
                            <td>{{$user->user_givenname}}</td>
                            <td>{{$user->user_email}}</td>
                            {{--                            <td><img class="qrcode" src="https://chart.googleapis.com/chart?chs=150x150&amp;cht=qr&amp;chl={{ $user->user_code }}&amp;choe=UTF-8" alt="QR code" /></td>--}}
                            <td style="padding: 50px">
                                <img src="{{ asset("storage/qr_code/$user->file_qr") }}" width="150" alt="">
                            </td>
                            <td class="text-nowrap">
                                <a href="{{route('users.edit', ['id' => $user->id])}}" data-toggle="kt-tooltip"
                                   title="Edit"
                                   data-original-title="Edit"><i class="flaticon-edit"></i>
                                </a>
                                <a href="{{route('users.remove', ['id' => $user->id])}}" data-toggle="kt-tooltip"
                                   title="Delete"
                                   data-original-title="Close"> <i class="flaticon-delete"></i> </a>
                            </td>
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
                }).done(function (response) {
                        $('#form-table-search').empty();
                        $('#form-table-search').html(response);
                })
            })
        })
    </script>
@endsection

