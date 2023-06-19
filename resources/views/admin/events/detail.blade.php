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
                        Infomation
                    </h3>
                </div>
                <div class="col-md-10 col-2 align-self-center">
{{--                    <a href="{{ route('event.add') }}" class="btn pull-right hidden-sm-down btn btn-primary"--}}
{{--                       data-toggle="kt-tooltip" title="add-student" ><i--}}
{{--                            class="flaticon-add-circular-button"></i></a>--}}
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Student</button>
                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post">
                                    @csrf
                                    <input type="hidden" value="{{ $id }}" id="event_id">
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">List Student:</label>
                                        <textarea class="form-control" name="user_name" id="message-text"></textarea>
                                    </div>
                                    <div class="text-danger" id="error_type"></div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="submit-send">Send message</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body" id="form-table-search">
                <table class="table table-striped- table-bordered table-hover table-checkable">
                    <thead>
                    </thead>
                    <tbody id="tbody">
                    <tr>
                        <td>Name</td>
                        <td>{{ $event->name_event }}</td>
                    </tr>
                    <tr>
                        <td>Des</td>
                        <td>{{ $event->description_event }}</td>
                    </tr>
                    <tr>
                        <td>Department</td>
                    </tr>
                    </tbody>
                </table>
                <!--begin: Datatable -->
                <div class="kt-portlet__head-label col-md-2" style="margin-bottom: 20px">
                    <a href="{{ route("qr-code.index", ['id' => $event->id]) }}" class="btn btn-primary">Check in</a>
                    <h3 class="kt-portlet__head-title">
                        Student List
                    </h3>
                </div>
                <table class="table table-striped- table-bordered table-hover table-checkable" id="example">
                    <thead class="table-active">
                    <tr>
                        <th class="text-white">STT</th>
                        <th class="text-white">User Code</th>
                        <th class="text-white">FullName</th>
                        <th class="text-white">Active</th>
                        <th class="text-white">Action</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    <?php $i = 1 ?>
                    @foreach($studentEvent as $item)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $item->user_code }}</td>
                            <td>{{ $item->full_name }}</td>
                            <td>@if($item->is_active == 1)
                                    <button type="button"
                                            class="btn btn-success btn-elevate btn-pill btn-elevate-air btn-sm">
                                        Attendance
                                    </button>
                                @else
                                    <button type="button"
                                            class="btn btn-warning btn-elevate btn-pill btn-elevate-air btn-sm">
                                        Warning
                                    </button>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn" id="delete_event" data-id="{{ $item->id }}" data-toggle="kt-tooltip" title="Delete"
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
                data: {user_name: user_name, _token: _token, event_id:event_id},
                success: function (data) {
                    if ($.isEmptyObject(data.error_type)) {
                        location.reload();
                        toastr.success(data.success);
                    } else {
                        $('#error_type').html(data.error_type);
                    }
                }
            });
        })

        $("#example").on("click", "#delete_event", function () {
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('student-delete') }}/" + id,
                type: 'GET',
            }).done(function(response) {
                // Gọi hàm renderCart trả về cart item con
                location.reload();
                toastr.success(response.msg_delete);
            });
        })
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
