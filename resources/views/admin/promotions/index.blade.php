@extends('admin.layouts.main')
@section('title', 'Index')
@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Promotion', 'value' => "List", 'value2' => ""])

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label col-md-4">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        Promotion
                    </h3>
                </div>
                <div class="col-md-8 col-2 align-self-center">
                    <a href="{{ route('promotion.add') }}" class="btn pull-right hidden-sm-down btn btn-primary"
                       data-toggle="kt-tooltip" title="Add"><i
                            class="flaticon-add-circular-button"></i></a>
                </div>
            </div>
            <div class="kt-portlet__body" id="form-table-search">
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>NAME</th>
                        <th>START_DATE</th>
                        <th>END_DATE</th>
                        <th>PERCENT</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    <?php $i = 1; ?>
                    @foreach($promotions as $item)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $item->code }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->start_date }}</td>
                            <td>{{ $item->end_date }}</td>
                            <td>{{ $item->percent }}</td>
                            <td class="text-nowrap">
                                <a href="{{ route('promotion.edit', ['id' => $item->id]) }}"
                                   data-original-title="Edit" data-toggle="kt-tooltip" title="Edit"><i class="flaticon-edit"></i>
                                </a>
{{--                                <a href="{{ route('promotion.delete', ['id' => $item->id]) }}" data-toggle="kt-tooltip" title="Delete"--}}
{{--                                   data-original-title="Close"> <i class="flaticon-delete"></i> </a>--}}
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
