@extends('admin.layouts.main')
@section('title', 'Index')
@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Items', 'value' => "List", 'value2' => ""])

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label col-md-4">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        Item List
                    </h3>
                </div>
                <div class="col-md-8 col-2 align-self-center">
                    <a href="{{ route('items.add') }}" class="btn pull-right hidden-sm-down btn btn-primary"
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
                        <th>NAME ITEM</th>
                        <th>GOLD</th>
                        <th>IMAGES</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    <?php $i = 1; ?>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $item->name_item }}</td>
                            <td>{{ $item->gold }}</td>
                            <td><img src="{{ asset("item_images/$item->images") }}" width="150px" height="150px" alt=""></td>
                            <td class="text-nowrap">
                                <a href="{{ route('items.edit', ['id' => $item->id]) }}"
                                   data-original-title="Edit" data-toggle="kt-tooltip" title="Edit"><i class="flaticon-edit"></i>
                                </a>
                                <a href="{{ route('items.delete', ['id' => $item->id]) }}" data-toggle="kt-tooltip" title="Delete"
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
