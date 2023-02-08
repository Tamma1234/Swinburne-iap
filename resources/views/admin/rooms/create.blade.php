@extends('admin.layouts.main')
@section('title', 'Create')

@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Rooms', 'value' => "Create Room", 'value2' => ""])

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12">

                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Create Room Form Layout
                            </h3>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="kt-form kt-form--label-right" action="{{route('room.store')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Khu giảng đường:</label>
                                    <select class="custom-select" name="area_id">
                                        @foreach($areas as $item)
                                            <option value="{{ $item->id }}">{{ $item->area_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label>Tên phòng:</label>
                                    <input type="text" name="room_name" class="form-control" id="exampleInputEmail1"
                                           placeholder="Điền tên phòng">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Loại phòng:</label>
                                    <select class="custom-select" name="room_type">
                                        <option value="0">Class room</option>
                                        @foreach($room_type as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label>Sức chứa:</label>
                                    <input type="text" name="capacity" class="form-control" id="exampleInputEmail1"
                                           placeholder="Điền sức chứa">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Ngày bắt đầu hoạt động:</label>
                                    <input type="date" name="valid_from" class="form-control" id="exampleInputEmail1"
                                           placeholder="Điền ngày bắt đầu">
                                </div>
                                <div class="col-lg-6">
                                    <label>Mô tả:</label>
                                    <textarea type="text" name="description" class="form-control" id="exampleInputEmail1"
                                              placeholder="Điền mô tả nếu có"></textarea>
                                </div>

                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <a href="{{route('list.rooms')}}" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!--end::Form-->
                </div>
            </div>
        </div>
    </div>
@endsection
