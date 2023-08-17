@extends('admin.layouts.main')
@section('title', 'index')
@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Subject', 'value' => "List", 'value2' => ""])

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label col-md-2">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        Quản lí Club
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body" id="form-table-search">
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable">
                    <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>DESCRIPTION</th>
                        <th>MANAGER</th>
                        <th>FACEBOOK</th>
                        <th>CREATED DATE</th>
                        <th>ACTION</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    <?php $i=1 ?>
                    @foreach($clubs as $item)
                        <tr>
                            <td>{{ $i++  }}</td>
                            <td>{{ $item->name  }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->manager }}</td>
                            <td><a href="{{ $item->link_fb }}">{{ $item->link_fb }}</a> </td>
                            <td>{{ $item->date_thanh_lap }}</td>
                            <td><a href="{{ route('club.detail', ['id' => $item->id]) }}">Detail</a></td>
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
        $(document).ready(function () {
            $('#term_id').change(function () {
                var term_id = $('#term_id').val();
                var subject_id = $('#subject_id').val();
                $.ajax({
                    url: '{{ route('search.term') }}',
                    type: 'get',
                    data: {term_id: term_id, subject_id: subject_id},
                }).done(function (response) {
                    $('#group_body').empty();
                    $('#group_body').html(response);
                })
            });
        });
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
