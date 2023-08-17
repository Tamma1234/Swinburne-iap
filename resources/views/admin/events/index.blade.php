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
                        List Event
                    </h3>
                </div>
                <div class="col-md-10 col-2 align-self-center">
                    <a href="{{ route('event.add') }}" class="btn pull-right hidden-sm-down btn btn-primary"
                       data-toggle="kt-tooltip" title="add"><i
                            class="flaticon-add-circular-button"></i></a>
                </div>
            </div>
            <div class="kt-portlet__body" id="form-table-search">
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="example">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th style="width: 47px">Total User</th>
                        <th style="width: 54px">Time Start</th>
                        <th>Time End</th>
                        <th style="width: 54px">Gold</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    <?php $i = 1 ?>
                    @foreach($events as $item)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td><a href="{{ route('event.detail', ['id' => $item->id]) }}">{{ $item->name_event }}</a></td>
                            <td>{{ $item->description_event }}</td>
                            <td class="text-danger font-weight-bold">{{ count($item->students) }}</td>
                            <td>{{ $item->start_date }}</td>
                            <td>{{ $item->end_date }}</td>
                            <td>{{ $item->gold }} <img width="20px" src="{{ asset('assets/admin/images/dong-coin.jpg') }}" alt=""></td>
                            <td class="text-nowrap">
                                <a href="{{ route('event.detail', ['id' => $item->id]) }}"
                                   data-original-title="Detail" data-toggle="kt-tooltip" title="Detail"><i
                                        class="flaticon-list-2"></i>
                                </a>
                                <a href="{{ route('event.delete', ['id' => $item->id]) }}" data-toggle="kt-tooltip" title="Delete"
                                   data-original-title="Close"> <i class="flaticon-delete"></i> </a>
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
