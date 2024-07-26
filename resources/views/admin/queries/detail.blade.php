@extends('admin.layouts.main')
@section('title', 'Create')

@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Queries', 'value' => "Detail", 'value2' => ""])

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-xl-12">
                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Detail
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <table class="table table-striped- table-bordered table-hover table-checkable">
                            <thead>
                            </thead>
                            <tbody id="tbody">
                            <tr>
                                <td>Queries Type</td>
                                <td>{{ $detail->queries_type }}</td>
                            </tr>
                            <tr>
                                <td>Queries Question</td>
                                <td>{{ $detail->question }}</td>
                            </tr>
                            <tr>
                                <td>Department</td>
                                <td>{{ $detail->user_code }}</td>
                            </tr>
                            <tr>
                                <td>Date Send</td>
                                <td>{{ $detail->time_send }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <!--begin::Section-->
                        <div class="kt-section">
                            <div class="kt-section__content" style="overflow-x: auto;">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>CONTENT</th>
                                        <th>FILENAME</th>
                                        <th>DATE</th>
                                        <th>CREATE BY</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; ?>
                                    @foreach($query as $item)
                                        <tr>
                                            <th scope="row">{{ $i++ }}</th>
                                            <td>{{ $item->content }}</td>
                                            <td class="text-nowrap">
                                                @if($item->file_name != "")
                                                    <a href="https://drive.google.com/uc?export=view&id={{ $item->file_name }}"
                                                       data-toggle="tooltip"
                                                       data-original-title="Edit" target="_blank">View</i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->create_by }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Form-->
                </div>
                <!--end::Portlet-->
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__body">
                        <!--begin::Section-->
                        <form action="" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xl-3"></div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="exampleSelects">Choose Status</label>
                                        <select class="form-control form-control-sm" id="exampleSelects" name="status">
                                            <option {{ $detail->queries_status == "New" ? "selected" : "" }} value="New">
                                                New
                                            </option>
                                            <option {{ $detail->queries_status == "Progress" ? "selected" : "" }} value="Progress">
                                                In progress
                                            </option>
                                            <option {{ $detail->queries_status == "Pending" ? "selected" : "" }} value="Pending">
                                                Pending
                                            </option>
                                            <option {{ $detail->queries_status == "Resolved" ? "selected" : "" }} value="Resolved">
                                                Resolved
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleTextarea">Note:<code>*</code></label>
                                        <textarea class="form-control" id="exampleTextarea" rows="3"
                                                  name="content"></textarea>

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleTextarea">File:<code>*</code></label>
                                        <input class="uppy-input-label btn btn-light-primary btn-sm" type="file"
                                               name="file" id="file">
                                        <span></span>
                                    </div>
                                </div>
                                <div class="col-xl-3"></div>
                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="col-xl-3"></div>
                                        <div class="col-xl-6">
                                            <input type="submit" class="btn btn-brand" name="submit" value="Submit">
                                        </div>
                                        <div class="col-xl-3"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--end::Section-->
                    </div>
                    <!--end::Form-->
                </div>
                <!--end::Portlet-->
            </div>
        </div>
    </div>
@endsection

