@extends('admin.layouts.main')
@section('title', 'Create')

@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Group', 'value' => "Booking Detail", 'value2' => ""])

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Table Booking Detail
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
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="example">
                        <thead>
                        </thead>
                        <tbody>
                        <tr>
                            <th>Room Name</th>
                            <td data-field="Status" data-autohide-disabled="false" class="kt-datatable__cell">
                                {{ $activity->room_name }}</td>
                        </tr>
                        <tr>
                            <th>Day</th>
                            <td data-field="Status" data-autohide-disabled="false" class="kt-datatable__cell">
                                {{ $activity->day }}</td>
                        </tr>
                        <tr>
                            <th>Group Name</th>
                            <td data-field="Status" data-autohide-disabled="false" class="kt-datatable__cell">
                                {{ $activity->groups ? $activity->groups->group_name : "" }}</td>
                        </tr>
                        <tr>
                            <th>Time</th>
                            <td data-field="Status" data-autohide-disabled="false" class="kt-datatable__cell">
                                {{ $activity->start_at .'-'. $activity->end_at }}</td>
                        </tr>
                        <tr>
                            <th>Area Name</th>
                            <td data-field="Status" data-autohide-disabled="false" class="kt-datatable__cell">
                                {{ $activity->areas ? $activity->areas->area_name : "" }}</td>
                        </tr>
                        <tr>
                            <th>Psubject Code</th>
                            <td data-field="Status" data-autohide-disabled="false" class="kt-datatable__cell">
                                {{ $activity->subjects ? $activity->subjects->subject_name : "" }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td data-field="Status" data-autohide-disabled="false" class="kt-datatable__cell">
                                {{ $activity->description }}</td>
                        </tr>
                        </tbody>
                    </table>
                    @if($activity->is_active !=  1)
                        <td class="text-nowrap">
                            <a href="{{ route('rooms.update', ['id' => $activity->id]) }}"
                               class="btn btn-info">Submit
                            </a>
                            <a href="{{ route('rooms.cancel', ['id' => $activity->id]) }}"
                               class="btn btn-danger">Cancel
                            </a>
                        </td>
                        @else
                        <td class="text-nowrap">
                            <input type="text" class="btn btn-info" value="Approved" disabled>
                        </td>
                    @endif
                </div>
            </div>
            <!--end::Section-->
        </div>
    </div>
@endsection

