@extends('admin.layouts.main')
@section('title', 'index')
@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Survey', 'value' => "List", 'value2' => ""])

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label col-md-2">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        List Survey
                    </h3>
                </div>
                <div class="col-md-10 col-2 align-self-center">
                    <a href="{{ route('survey.create') }}" class="btn pull-right hidden-sm-down btn btn-primary"
                       data-toggle="kt-tooltip" title="Add Club"><i
                            class="flaticon-add-circular-button"></i></a>
                </div>
            </div>
            <div class="kt-portlet__body" id="form-table-search">
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="example">
                    <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>DESCRIPTION</th>
                        <th>START AT</th>
                        <th>END AT</th>
                        <th>ACTION</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    <?php $i=1 ?>
                    @foreach($surveys as $item)
                        <tr>
                            <td>{{ $i++  }}</td>
                            <td>{{ $item->name  }}</td>
                            <td>   {!! htmlspecialchars_decode($item->description) !!}</td>
                            <td style="width: 100px">{{ $item->start_at  }}</td>
                            <td style="width: 100px">{{ $item->end_at }}</td>
                            <td>
                                <a href="{{ route('club.detail', ['id' => $item->id]) }}"
                                   data-original-title="Detail" data-toggle="kt-tooltip" title="Detail"><i
                                        class="flaticon-list-2"></i>
                                </a>
                                <a href="{{route('club.edit', ['id' => $item->id])}}" data-toggle="kt-tooltip" title="Edit"
                                   data-original-title="Edit"><i class="flaticon-edit"></i>
                                </a>
                                <a id="delete_event" data-id="{{ $item->id }}" style="cursor: pointer"
                                   data-toggle="kt-tooltip" title="Delete"
                                   data-original-title="Close"><i class="flaticon-delete" style="color: red"></i></a>
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
@endsection
