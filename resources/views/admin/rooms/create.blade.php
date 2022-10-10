@extends('admin.layouts.main')
@section('title', 'Create')

@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Group', 'value' => "Booking Detail", 'value2' => ""])

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Table Booking Create
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <a href="{{ route('rooms.index') }}" class="btn btn-clean btn-icon-sm">
                        <i class="la la-long-arrow-left"></i>
                        Back
                    </a>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body" id="table-room">
            <!--begin::Section-->
            <div class="kt-section">
                <div class="kt-section__content">
                    <form enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $format }}" name="date">
                        <input type="hidden" value="{{ $room->room_name }}" class="room_name-{{ $room->id }}"
                               name="room_name">
                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="kt_widget5_tab1_content"
                                 aria-expanded="true">
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
                                                    <input type="text"
                                                           class="form-control btn-end-{{ $room->id }}"
                                                           id="kt_timepicker_2" name="end_at" readonly
                                                           placeholder="Select time">
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
                                                    <select class="form-control exampleSelect1-{{ $room->id }}"
                                                            id="exampleSelect1">
                                                        <option value="">Choose Area</option>
                                                        <option value="4">Duong Khue</option>
                                                        <option value="9">Duy Tan</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label class="col-form-label col-lg-6 col-sm-12">Psubject
                                                Name</label>
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <select class="form-control" name="psubject-name"
                                                            id="psubject-name-{{ $room->id }}">
                                                        <option value="">Choose Subject</option>
                                                        @foreach($subjects as $subject)
                                                            <option
                                                                value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
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
                                                        <option
                                                            value="{{ $group->id }}">{{ $group->group_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label"
                                               for="exampleFormControlTextarea1">Description</label>
                                        <textarea class="form-control description-{{ $room->id }}"
                                                  name="description"
                                                  id="description"
                                                  rows="2"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="kt_widget5_tab2_content"
                                 aria-expanded="true">
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
                                                    <input type="text"
                                                           class="form-control btn-end-{{ $room->id }}"
                                                           id="kt_timepicker_2" name="end_at" readonly
                                                           placeholder="Select time">
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
                                                    <select class="form-control exampleSelect1-{{ $room->id }}"
                                                            id="exampleSelect1">
                                                        <option value="">Choose Area</option>
                                                        <option value="4">Duong Khue</option>
                                                        <option value="9">Duy Tan</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label"
                                               for="exampleFormControlTextarea1">Description</label>
                                        <textarea class="form-control description-{{ $room->id }}"
                                                  name="description"
                                                  id="description"
                                                  rows="2"></textarea>
                                    </div>
                                </div>
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
            <!--end::Section-->
        </div>
    </div>
@endsection

