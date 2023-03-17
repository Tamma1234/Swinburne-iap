@extends('admin.layouts.main')
@section('title', 'Create')

@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Schedule', 'value' => "", 'value2' => ""])

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <!--Begin::Row-->
        <div class="row">
            <div class="col-xl-12 col-lg-12 order-lg-3 order-xl-1">

                <!--begin:: Widgets/Best Sellers-->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-toolbar">
                            <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#kt_widget5_tab1_content" role="tab" aria-selected="false">
                                        Duy Tân
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#kt_widget5_tab2_content" role="tab" aria-selected="true">
                                        Dương Khuê
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="kt-portlet__head-toolbar col-4" style="margin: auto">
                         <input class="form-control" type="date" value="{{ $day }}" id="example-date-input">
                         <input class="form-control" type="hidden" value="{{ $formatDate }}">
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="tab-content" id="tab-content">
                            <div class="tab-pane active" id="kt_widget5_tab1_content" aria-expanded="true">
                                <div class="kt-widget5">
                                    <table class="table table-striped- table-bordered table-hover table-checkable" >
                                        <thead style="background-color: #b3c1fd">
                                        <tr>
                                            <th>Room</th>
                                            @foreach($slots as $slot)
                                            <th>Slot {{ $slot->id }}
                                            <p>{{ $slot->slot_start }}</p></th>
                                            @endforeach
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($roomDT as $room)
                                            <?php $activitys = \App\Models\Fu\Acitivitys::where('room_id', $room->id)
                                                ->where('day', "2019-11-04")->get();
                                                ?>
                                            <tr>
                                                <td>{{$room->room_name}}</td>
                                                @foreach($slots as $slot)
                                                    <?php $activity = \App\Models\Fu\Acitivitys::where('room_id', $room->id)
                                                        ->where('slot', $slot->id)->where('day', $formatDate)
                                                        ->first();

                                                        ?>
                                                    <td>@if($activity)
                                                            <p>{{ $activity->description }}</p>
                                                            <p>{{ $activity->psubject_code }}</p>
                                                            <p>{{ $activity->leader_login }}</p>
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="kt_widget5_tab2_content">
                                <div class="kt-widget5">
                                    <table class="table table-striped- table-bordered table-hover table-checkable" >
                                        <thead style="background-color: #b3c1fd">
                                        <tr>
                                            <th>Room</th>
                                            @foreach($slots as $slot)
                                                <th>Slot {{ $slot->id }}
                                                    <p>{{ $slot->slot_start }}</p></th>
                                            @endforeach
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($roomDK as $room)
                                                <?php $activitys = \App\Models\Fu\Acitivitys::where('room_id', $room->id)
                                                ->where('day', "2019-11-04")->get();
                                                ?>
                                            <tr>
                                                <td>{{$room->room_name}}</td>
                                                @foreach($slots as $slot)
                                                        <?php $activity = \App\Models\Fu\Acitivitys::where('room_id', $room->id)
                                                        ->where('slot', $slot->id)->where('day', $formatDate)
                                                        ->first();
                                                        ?>
                                                    <td>@if($activity)
                                                            <p>{{ $activity->description }}</p>
                                                            <p>{{ $activity->psubject_code }}</p>
                                                            <p>{{ $activity->leader_login }}</p>
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
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
        $(document).ready(function () {
            $("#example-date-input").on("change", function () {
                var date = $("#example-date-input").val();
                $.ajax({
                    url: "{{ route('search.schedule') }}",
                    method: 'GET',
                    data: {date: date},
                    success: function (data) {
                        $('#tab-content').empty();
                        $('#tab-content').html(data);
                    }
                });
            })
        })
    </script>
@endsection
