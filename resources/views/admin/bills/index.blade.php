@extends('admin.layouts.main')
@section('title', 'Index')
@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Bills', 'value' => "List", 'value2' => ""])

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label col-md-4">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        Bills List
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body" id="form-table-search">
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable">
                    <thead>
                    <tr>
                        <th>Code</th>
                        <th>Full Name</th>
                        <th>User Code</th>
                        <th>Item Name</th>
                        <th>Date Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    <?php $i = 1; ?>
                    @foreach($bills as $item)
                        <?php $user = \App\Models\User::where('user_code', $item->user_code)->first();
                        $full_name = $user->user_surname . ' ' . $user->user_middlename . ' ' . $user->user_givenname;
                        ?>
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $full_name }}</td>
                            <td>{{ $item->user_code }}</td>
                            <td>{{ $item->items ? $item->items->name_item : "" }}</td>
                            <td>{{ $item->date_time }}</td>
                            <td>
                                <select class="custom-select form-control" onchange="activeAll({{ $item->id }})"  name="bill_active" id="activeAll">
                                    <option {{ $item->status == 0 ? "selected" : "" }} value="0">Awaiting confirmation
                                    </option>
                                    <option {{ $item->status == 1 ? "selected" : "" }} value="1">Confirmed</option>
                                    <option {{ $item->status == 2 ? "selected" : "" }} value="2">Successful delivery
                                    </option>
                                </select>
                            </td>
                            <td>
                                <a href=""
                                   data-original-title="Detail" data-toggle="kt-tooltip" title="Detail"><i
                                        class="flaticon-list-2"></i>
                                </a>
                                <a href="{{ route('bill.delete', ['id' => $item->id]) }}" data-toggle="kt-tooltip" title="Delete"
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
        // Thay đổi trạng thái đơn hàng
        function activeAll(id) {
            var active = $('#activeAll').val();
            var data = {
                active: active,
                id: id,
            };
            $.ajax({
                url: "{{ route('update.status') }}",
                method: 'get',
                data: data,
                success: function(data) {
                    location.reload();
                }
            });
        }
    </script>
@endsection
