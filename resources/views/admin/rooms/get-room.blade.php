@extends('admin.layouts.main')
@section('title', 'Create')

@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Room',
      'value' => "List", 'value2' => ""])
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Table Room Options
                </h3>
            </div>
            <div class="col-md-6 col-4 align-self-center">
                <a href="{{ route('create.rooms') }}" class="btn pull-right hidden-sm-down btn-success"><i
                        class="mdi mdi-plus-circle"></i> Create</a>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin::Section-->
            <div class="kt-section">
                <div class="kt-section__content">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="example">
                        <thead style="background-color: #b3c1fd">
                        <tr>
                            <th>#</th>
                            <th>Role Name</th>
                            <th>Capacity</th>
                            <th>Roomtype</th>
                            <th>Valid From</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rooms as $room)
                            <tr>
                                <td>{{ $room->id }}</td>
                                <td><input class="form-control" value="{{$room->room_name}}"></td>
                                <td><input class="form-control" value="{{$room->capacity}}"></td>
                                <td>
                                    <select class="custom-select">
                                        <option value="0">Class room</option>
                                        @foreach($room_type as $item)
                                            <option {{ $room->room_type == $item->id ? "selected" : "" }} value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input class="form-control" value="{{$room->valid_from}}"></td>
                                <td class="text-nowrap">
{{--                                    <a href="" data-toggle="tooltip"--}}
{{--                                       data-original-title="Edit"><i class="flaticon-edit"></i>--}}
{{--                                    </a>--}}
                                    <a href="{{ route('delete.room', ['id' => $room->id]) }}" data-toggle="tooltip"
                                       data-original-title="Close"> <i class="flaticon-delete"></i> </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"
                         style="margin-left: 450px">
                        {{--                        {{ $roles->links('pagination::bootstrap-4') }}--}}
                    </div>
                </div>
            </div>

            <!--end::Section-->
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
    </script>
@endsection
