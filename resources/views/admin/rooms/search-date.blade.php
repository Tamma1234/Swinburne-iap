@extends('admin.layouts.table')
@section('content')
    <div class="kt-section">
        <div class="kt-section__content">
            <table class="table table-striped- table-bordered table-hover table-checkable" id="example">
                <thead>
                <tr>
                    <th>Room Name</th>
                    <th>Time</th>
                    <th class="text-nowrap">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rooms as $room)
                    <?php
                    $activityToday = $activitys->where('room_id', $room->id)
                        ->where('day', $format)
                        ->get();
                    ?>
                    <tr>
                        <td>{{ $room->room_name }}</td>
                        @if(count($activityToday) > 0)
                            <td data-field="Status" data-autohide-disabled="false" class="kt-datatable__cell">
                                @foreach($activityToday as $item)
                                    @if($item->is_active == 1)
                                        <span style="width: 112px; cursor: pointer" id="{{ $item->id }}"
                                              data-toggle="modal"
                                              data-target="#room-{{ $item->id }}">
                                                <span
                                                    class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">
                                                {{ $item->start_at .' - '. $item->end_at }}
                                                <br>
                                                </span></span>
                                    @elseif($item->is_active == 2)
                                        <span style="width: 112px; cursor: pointer" id="{{ $item->id }}"
                                              data-toggle="modal"
                                              data-target="#room-{{ $item->id }}">
                                                <span
                                                    class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill">
                                                {{ $item->start_at .' - '. $item->end_at }}
                                                <br>
                                                </span></span>
                                    @else
                                        <span style="width: 112px; cursor: pointer" id="{{ $item->id }}"
                                              data-toggle="modal"
                                              data-target="#room-{{ $item->id }}">
                                                <span
                                                    class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">
                                                {{ $item->start_at .' - '. $item->end_at }}
                                                <br>
                                                </span></span>
                                    @endif
                                    <div class="modal fade" id="room-{{ $item->id }}"
                                         tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                         aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        {{ $item->room_name }}</h5>
                                                    <button type="button" class="close"
                                                            data-dismiss="modal" id="closeUp"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <label class="col-form-label col-lg-6 col-sm-12">Start
                                                                Time</label>
                                                            <div class="col-md-12 col-sm-12">
                                                                <div class="input-group timepicker">
                                                                    <div class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <i class="la la-clock-o"></i>
                                                                            </span>
                                                                    </div>
                                                                    <input class="form-control"
                                                                           disabled
                                                                           value="{{ $item->start_at }}"
                                                                           placeholder="Select time"
                                                                           type="text">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <label class="col-form-label col-lg-6 col-sm-12">End
                                                                Time</label>
                                                            <div class="col-md-12 col-sm-12">
                                                                <div class="input-group timepicker">
                                                                    <div class="input-group-prepend">
                                                                                <span class="input-group-text">
                                                                                    <i class="la la-clock-o"></i>
                                                                                </span>
                                                                    </div>
                                                                    <input class="form-control"
                                                                           disabled
                                                                           value="{{ $item->end_at }}"
                                                                           placeholder="Select time"
                                                                           type="text">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <label class="col-form-label col-lg-6 col-sm-12">Area
                                                                Name</label>
                                                            <div class="col-md-12 col-sm-12">
                                                                <div class="input-group ">
                                                                    <input class="form-control" disabled
                                                                           value="{{ $item->areas ? $item->areas->area_name : "" }}"
                                                                           placeholder="Area Name"
                                                                           type="text">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <label class="col-form-label col-lg-6 col-sm-12">Psubject
                                                                Name</label>
                                                            <div class="col-md-12 col-sm-12">
                                                                <div class="input-group ">
                                                                    <input disabled class="form-control"
                                                                           value="{{ $item->psubject_name }}"
                                                                           placeholder="Psubject Name"
                                                                           type="text">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <label class="col-form-label col-lg-6 col-sm-12">Group
                                                                Name</label>
                                                            <div class="col-md-12 col-sm-12">
                                                                <div class="input-group ">
                                                                    <input class="form-control" disabled
                                                                           value="{{ $item->groups ? $item->groups->group_name : "" }}"
                                                                           placeholder="Group Name"
                                                                           type="text">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <label class="col-form-label col-lg-6 col-sm-12">Psubject
                                                                Code</label>
                                                            <div class="col-md-12 col-sm-12">
                                                                <div class="input-group ">
                                                                    <input disabled class="form-control"
                                                                           value="{{ $item->subjects ? $item->subjects->subject_code : "" }}"
                                                                           placeholder="Psubject Code"
                                                                           type="text">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label">Leader</label>
                                                        <input disabled class="form-control"
                                                               value="{{ $item->leader_login }}" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label"
                                                               for="exampleFormControlTextarea1">Description</label>
                                                        <textarea disabled class="form-control"
                                                                  id="exampleFormControlTextarea1"
                                                                  rows="2">{{ $item->description }}</textarea>
                                                    </div>
                                                </div>
                                                @if( $item->des_cancel_room != "")
                                                    <div class="form-group">
                                                        <label class="col-form-label"
                                                               for="exampleFormControlTextarea1">Frame
                                                            content is approved</label>
                                                        <textarea disabled class="form-control btn-danger"
                                                                  id="exampleFormControlTextarea1"
                                                                  rows="2">{{ $item->des_cancel_room }}</textarea>
                                                    </div>
                                                @endif
                                                <div class="modal-footer">
                                                    @if( $item->is_active == 0)
                                                        <input type="text" disabled class="btn btn-success"
                                                               value="Pending">
                                                    @endif
                                                    @can('attendance_export')
                                                        <a href="{{ route('rooms.active', ['id' => $item->id]) }}"
                                                           class="btn btn-info">Browser
                                                        </a>
                                                    @endcan
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </td>
                        @else
                            <td data-field="Status" data-toggle="modal"
                                data-target="#add-room-{{ $room->id }}" data-autohide-disabled="false"
                                class="kt-datatable__cell" style="cursor: pointer">
                        @endif
                        {{--<td>{{$room->areas ? $room->areas->area_name : ""}}</td>--}}
                        {{--   <td> @if($room->room_type == 1)--}}
                        {{--       <button type="button" class="btn btn-warning">Meeting</button>--}}
                        {{--    @else--}}
                        {{--       <button type="button" class="btn btn-success">Classroom</button>--}}
                        {{--    @endif--}}
                        {{--  </td>--}}
                        <td class="text-nowrap">
                            <button type="button" data-toggle="modal"
                                    data-target="#add-room-{{ $room->id }}"
                                    class="btn btn-info">Add
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @foreach($rooms as $room)
        <div class="modal fade" id="add-room-{{ $room->id }}"
             tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            {{ $room->room_name }}</h5>
                        <button type="button" class="close"
                                data-dismiss="modal" id="closeUp"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $format }}" name="date">
                        <input type="hidden" value="{{ $room->room_name }}" class="room_name-{{ $room->id }}"
                               name="room_name">
                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <label class="col-form-label col-lg-6 col-sm-12">Start Time</label>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="input-group timepicker">
                                            <div class="input-group-prepend">
                                                  <span class="input-group-text">
                                                    <i class="la la-clock-o"></i>
                                                   </span>
                                            </div>
                                            <input class="form-control btn-start-{{ $room->id }}"
                                                   id="kt_timepicker_2" readonly name="start_at"
                                                   placeholder="Select time" type="text">
                                        </div>
                                        <div class="alert alert-danger error_time" style="display:none">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <label class="col-form-label col-lg-6 col-sm-12">End Time</label>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="input-group timepicker">
                                            <div class="input-group-prepend">
                                                     <span class="input-group-text">
                                                       <i class="la la-clock-o"></i>
                                                     </span>
                                            </div>
                                            <input type="text" class="form-control btn-end-{{ $room->id }}"
                                                   id="kt_timepicker_2" name="end_at" readonly
                                                   placeholder="Select time"
                                                   type="text">
                                        </div>
                                        <div class="alert alert-danger error_time" style="display:none">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label class="col-form-label col-lg-6 col-sm-12">Area Name</label>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <select class="form-control" id="exampleSelect1-{{ $room->id }}">
                                                <option value="">Choose Area</option>
                                                <option value="4">Duong Khue</option>
                                                <option value="9">Duy Tan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <label class="col-form-label col-lg-6 col-sm-12">Psubject Name</label>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <select class="form-control" name="psubject-name"
                                                    id="psubject-name-{{ $room->id }}">
                                                <option value="">Choose Subject</option>
                                                @foreach($subjects as $subject)
                                                    <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label col-lg-6 col-sm-12">Group Name</label>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <select class="form-control" name="groupid"
                                                id="group-{{ $room->id }}">
                                            <option value="">Choose Group</option>
                                            @foreach($groups as $group)
                                                <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label"
                                       for="exampleFormControlTextarea1">Description</label>
                                <textarea class="form-control" name="description"
                                          id="description-{{ $room->id }}"
                                          rows="2"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="addRooms({{ $room->id }})"
                                    class="btn btn-info">Save cart
                            </button>
                            <button type="button" onclick="reset()"
                                    class="btn btn-secondary"
                                    data-dismiss="modal">Close
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"
                 style="margin-left: 450px">
                {{--                        {{ $getEvent->links('pagination::bootstrap-4') }}--}}
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/admin/js/pages/crud/forms/widgets/bootstrap-timepicker.js')}}"
            type="text/javascript"></script>
    <script !src="">
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

        $('.modal').on('hidden.bs.modal', function (e) {
            $('.modal').find('form').trigger('reset');
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'none');
            $(".error_time").css('display', 'none');
        });


        function addRooms(id) {
            var _token = $("input[name='_token']").val();
            var date = $('#kt_datepicker_2').val();
            var room_name = $('.room_name-' + id).val();
            var start_at = $(".btn-start-" + id).val();
            var end_at = $('.btn-end-' + id).val();
            var area_name = $('#exampleSelect1-' + id).val();
            var psubject_id = $('#psubject-name-' + id).val();
            var groupId = $('#group-' + id).val();
            var description = $('#description-' + id).val();

            $.ajax({
                url: "{{ route('rooms.add') }}/" + id,
                type: 'POST',
                data: {
                    _token: _token,
                    start_at: start_at,
                    end_at: end_at,
                    groupId: groupId,
                    description: description,
                    date: date,
                    room_name: room_name,
                    area_name: area_name,
                    psubject_id: psubject_id
                },
                success: function (data) {
                    if ($.isEmptyObject(data.error)) {
                        if (!$.isEmptyObject(data.errorType)) {
                            $(".error_time").html('');
                            $(".error_time").css('display', 'block');
                            $(".error_time").append(data.errorType);
                        } else {
                            $(".error_time").html('');
                            $(".error_time").css('display', 'none');
                            if ($.isEmptyObject(data.errorTime)) {
                                $('#add-room-' + id).modal('hide');
                                location.reload();
                                alertify.success(data.success);
                            } else {
                                $(".error_time").html('');
                                $(".error_time").css('display', 'block');
                                $(".error_time").append(data.errorTime);
                            }
                        }
                    } else {
                        printErrorMsg(data.error);
                    }
                }
            });

            function printErrorMsg(msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'block');
                $.each(msg, function (key, value) {
                    $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                });
            }
        }
@endsection
