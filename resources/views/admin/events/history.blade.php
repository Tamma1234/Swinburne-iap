@extends('admin.layouts.main')
@section('title', 'Index')
@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Course', 'value' => "List Course", 'value2' => ""])

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label col-md-2">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        History Event
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body" id="form-table-search">
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="example">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>User Code</th>
                        <th>Full Name</th>
                        <th>Name Event</th>
                        <th>Total Gold</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    <?php $i = 1 ?>
                    @foreach($eventHistory as $item)
                        <?php $events = \App\Models\StudentEvent::where('user_code', $item->user_code)->select('event_id')->get();
                        ?>
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $item->user_code }}</td>
                            <td>{{ $item->full_name }}</td>
                            <td>
                                @foreach($events as $event)
                                    <?php $event_name = \App\Models\EventSwin::where('id', $event->event_id)->first()->name_event; ?>
                                   <span> {{ $event_name }},</span>
                                @endforeach
                            </td>
                            <td>{{ $item->gold }}</td>
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
        function doSearch() {
            var term_id = $('#term_id').val();
            var department_id = $('#department_id').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('course.search') }}",
                method: 'GET',
                data: {term_id: term_id, department_id: department_id, _token: _token},
                success: function (data) {
                    $('#form-table-search').html(data);
                    var totalCourse = $('#totalCourse').val();
                    $('#total').html(totalCourse)
                }
            });
        }
    </script>
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            var table = $('#example').DataTable({pageLength: 10});--}}
{{--            // Get the page info, so we know what the last is--}}
{{--            var pageInfo = table.page.info();--}}
{{--            // Set the ending interval to the last page--}}
{{--            endInt = pageInfo.end;--}}
{{--            // Current page--}}
{{--            currentInt = 0;--}}
{{--            // interval = setInterval(function () {--}}
{{--            //     // "Next" ...--}}
{{--            //     table.page(currentInt).draw('page');--}}
{{--            //--}}
{{--            //     // Increment the current page int--}}
{{--            //     currentInt++;--}}
{{--            //--}}
{{--            //     // If were on the last page, reset the currentInt to the first page #--}}
{{--            //     if (currentInt === pageInfo.pages) {--}}
{{--            //         currentInt = 0;--}}
{{--            //     }--}}
{{--            //     // console.log(currentInt);--}}
{{--            // }, 10000); // 3 seconds--}}
{{--        });--}}
{{--    </script>--}}
@endsection
