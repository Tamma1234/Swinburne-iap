@extends('admin.layouts.main')
@section('title', 'Index')
@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Term', 'value' => "List Term", 'value2' => ""])

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label col-md-8">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        List Term
                    </h3>
                </div>
                <div class="col-md-2 col-2 align-self-center">
                    <a href="{{ route('term.create') }}" class="btn pull-right hidden-sm-down btn-success"><i
                            class="mdi mdi-plus-circle"></i> Create</a>
                </div>
            </div>
            <div class="kt-portlet__body" id="form-table-search">
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="example">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Term Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Fee Term</th>
                        <th>GC Term</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    @foreach($terms as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->term_name}}</td>
                            <td>{{$item->startday}}</td>
                            <td>{{ $item->endday }}</td>
                            <td> @if ($item->phat_sinh_phi_ky ==  1)
                                    Đã phát sinh
                                @else
                                    Phát sinh
                                @endif
                            </td>
                            <td> @if ($item->phat_sinh_phi_gc ==  1)
                                    Đã phát sinh
                                @else
                                    Phát sinh
                                @endif
                            </td>
                            <td class="text-nowrap">
                                <a href="{{ route('term.edit', ['id' => $item->id]) }}" data-toggle="kt-tooltip" title="Edit"
                                   data-original-title="Edit"><i class="flaticon-edit"></i>
                                </a>
                                <a href="{{ route('term.delete', ['id' => $item->id]) }}" data-toggle="kt-tooltip" title="Delete"
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
    <script>
        //search with stude_status
        $(document).ready(function () {
            $('#study_status').change(function () {
                $.ajax({
                    url: '{{ route('users.post.search') }}',
                    type: 'post',
                    data: $('form').serialize(),
                }).done(function (response) {
                    $('#form-table-search').empty();
                    $('#form-table-search').html(response);
                })
            });
        });

        // search with user_level
        $('#user_level').change(function () {
            $.ajax({
                url: "{{ route('users.post.search') }}",
                type: 'post',
                data: $('form').serialize()
            }).done(function (response) {
                // // Gọi hàm renderCart trả về cart item con
                $('#form-table-search').empty();
                $('#form-table-search').html(response);
            });
        });

        // search with curriculum
        $('#curriculum').change(function () {
            $.ajax({
                url: "{{ route('users.post.search') }}",
                type: 'post',
                data: $('form').serialize()
            }).done(function (response) {
                // // Gọi hàm renderCart trả về cart item con
                $('#form-table-search').empty();
                $('#form-table-search').html(response);
            });
        });

        $(document).ready(function () {
            $('#btn-form-search').click(function (event) {
                event.preventDefault();
                $.ajax({
                    url: '{{ route('users.post.search') }}',
                    type: 'post',
                    data: $('form').serialize(),
                })
                    .done(function (response) {
                        $('#form-table-search').empty();
                        $('#form-table-search').html(response);
                    })
            })
        })
    </script>
@endsection

