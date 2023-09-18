@extends('admin.layouts.main')
@section('title', 'Index')
@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Event', 'value' => "Detail", 'value2' => ""])

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label col-md-2">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        Detail Club
                    </h3>
                </div>
                <div class="col-md-10 col-2 align-self-center">
                    {{--                    <a href="{{ route('event.add') }}" class="btn pull-right hidden-sm-down btn btn-primary"--}}
                    {{--                       data-toggle="kt-tooltip" title="add-student" ><i--}}
                    {{--                            class="flaticon-add-circular-button"></i></a>--}}
                    <a type="button" href="{{ route('add.management', ['id' => $id]) }}" class="btn btn-primary">Add
                        Management</a>
                </div>

            </div>
            <div class="kt-portlet__body" id="form-table-search">
                <table class="table table-striped- table-bordered table-hover table-checkable">
                    <thead>
                    </thead>
                    <tbody id="tbody">
                    <tr>
                        <td>Name</td>
                        <td>{{ $club_detail->name }}</td>
                    </tr>
                    <tr>
                        <td>Des</td>
                        <td>{{ $club_detail->description }}</td>
                    </tr>
                    </tbody>
                </table>
                <table class="table table-striped- table-bordered table-hover table-checkable" id="example">
                    <thead class="table-active">
                    <tr>
                        <th class="text-white">STT</th>
                        <th class="text-white">User Code</th>
                        <th class="text-white">FullName</th>
                        <th class="text-white">Gold</th>
                        <th class="text-white">Active</th>
                        <th class="text-white">Action</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    <?php $i = 1; ?>
                    @foreach($user_club as $item)
                        <?php
                            $user = \App\Models\User::where('user_code', $item->user_code)->first();
                            $full_name = $user->user_surname . ' '. $user->user_surname .' '. $user->user_givenname;
                        ?>
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $item->user_code }}</td>
                            <td>{{ $full_name }}</td>
                            <td>{{ $club_detail->name }}>
                            </td>
                            <td>@if($item->permission == 3)
                                    <button type="button"
                                            class="btn btn-warning btn-elevate btn-pill btn-elevate-air btn-sm">
                                        Chairperson
                                    </button>
                                @else
                                    <button type="button"
                                            class="btn btn-success btn-elevate btn-pill btn-elevate-air btn-sm">
                                        Personal
                                    </button>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn" id="delete_user" data-id="{{ $item->id }}"
                                        data-toggle="kt-tooltip" title="Delete"
                                        data-original-title="Close"><i class="flaticon-delete"></i></button>
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
        $("#submit-send").on('click', function () {
            var user_name = $("#message-text").val();
            var event_id = $("#event_id").val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('student.add') }}",
                method: 'POST',
                data: {user_name: user_name, _token: _token, event_id: event_id},
                success: function (data) {
                    if ($.isEmptyObject(data.error_type)) {
                        $('#form-table-search').empty();
                        $('#form-table-search').html(response);
                    } else {
                        $('#error_type').html(data.error_type);
                    }
                }
            });
        })

        $("#example").on("click", "#delete_user", function () {
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('club.delete') }}/" + id,
                type: 'GET',
            }).done(function (response) {
                // Gọi hàm renderCart trả về cart item con
                location.reload();
                toastr.success(response.msg_delete);
            });
        })
    </script>
@endsection
