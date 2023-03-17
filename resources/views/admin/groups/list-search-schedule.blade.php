@extends('admin.layouts.table')
@section('content')
    <div class="tab-pane active" id="kt_widget5_tab1_content" aria-expanded="true">
        <div class="kt-widget5">
            <table class="table table-striped- table-bordered table-hover table-checkable" >
                <input type="hidden" value="{{ $date }}">
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
                    <tr>
                        <td>{{$room->room_name}}</td>
                        @foreach($slots as $slot)
                                <?php $activity = \App\Models\Fu\Acitivitys::where('room_id', $room->id)
                                ->where('slot', $slot->id)->where('day', $date)
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
                                ->where('slot', $slot->id)->where('day', $date)
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
