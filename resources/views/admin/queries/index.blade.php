@extends('admin.layouts.main')
@section('title', 'Index')
@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Evaluate', 'value' => "List", 'value2' => ""])

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label col-md-2">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        List Queries
                    </h3>
                </div>

                <div class="col-md-8">
                    <form method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row align-items-center">
                            <div class="form-group row" style="margin: auto; margin-top: 20px">
                                Queries type:
                                <select id="queries_type" onchange="doSearch()" name="queries_type">
                                    <option>All</option>
                                    <option value="Academic calendar">Academic calendar</option>
                                    <option value="Well-being issues">Well-being issues</option>
                                    <option>Change/Defer/Transfer of course</option>
                                    <option>Study plan/ course advices</option>
                                    <option>Clubs and Activities</option>
                                    <option>Academic Consulting</option>
                                    <option>Other</option>
                                </select>
                                Chọn trạng thái:
                                <select id="queries_status" onchange="doSearch()" name="queries_status">
                                    <option>All</option>
                                    <option>New</option>
                                    <option>In progress</option>
                                    <option>Pending</option>
                                    <option>Resolved</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="kt-portlet__body" id="form-table-search">
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>User Code</th>
                        <th>Queries Type</th>
                        <th>Question</th>
                        <th>Time Queries</th>
                        <th>Queries Status</th>
                        <th>Note</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    <?php $i = 1; ?>
                    @foreach($queries as $item)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $item->user_code }}</td>
                            <td>{{ $item->queries_type }}</td>
                            <td>{{ $item->question }}</td>
                            <td>{{ $item->time_send }}</td>
                            <td>
                                @if($item->querries_status == "Processed")
                                    <span class="text-danger font-weight-bold">Processed</span>
                                @elseif($item->querries_status == "New")
                                    <span class="text-danger font-weight-bold" >New</span>
                                @elseif($item->querries_status == "Processing")
                                    <span class="text-danger font-weight-bold">Processing</span>
                                @elseif($item->querries_status == "Resolved")
                                    <span class="text-danger font-weight-bold">Resolved</span>
                                @elseif($item->querries_status == "In progress")
                                    <span class="text-primary font-weight-bold">In progress</span>
                                @else
                                    <span class="text-success font-weight-bold">Pending</span>
                                @endif
                            </td>
                            <td>{{ $item->note_xu_ly }}</td>
                            <td class="text-nowrap">
                                <a href="{{ route('queries.detail', ['id' => $item->id]) }}" data-toggle="kt-tooltip"
                                   title="detail" data-original-title="Edit"><i class="flaticon-list-2"></i>
                                </a>
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
            $.ajax({
                url: "{{ route('queries.search') }}",
                method: 'post',
                data: $('form').serialize(),
                success: function (data) {
                    let content = "";
                    let index = 1;
                    $.each(data, function (k, v) {
                        var id = v['id'];
                        var url = "{{ route('queries.detail', ['id' => ':id']) }}".replace(':id', id);
                        content += '<tr>';
                        content += '<td>' + index++ + '</td>';
                        content += '<td> ' + v['user_code'] + ' </td>';
                        content += '<td>' + v['queries_type'] + ' </td>';
                        content += '<td> ' + v['question'] + '</td>';
                        content += '<td> ' + v['time_send'] + '</td>';
                        content += '<td>' + v['querries_status'] + '</td>';
                        content += '<td>' + v['note_xu_ly'] + ' </td>';
                        content += '<td class="text-nowrap">';
                        content += '<a href="'+ url +'" data-toggle="kt-tooltip" title="detail" data-original-title="Edit"><i class="flaticon-list-2"></i></a>';
                        content += '</td>';
                        content += '</tr>';
                    });
                    $('#tbody').html(content);
                }
            })
        }
    </script>
@endsection

