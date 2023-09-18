@extends('admin.layouts.main')
@section('title', 'Index')
@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Evaluate', 'value' => "List", 'value2' => ""])

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label col-md-8">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        List Evaluate
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
                        <th>Type</th>
                        <th>Problems</th>
                        <th>Findding</th>
                        <th>Solution</th>
                        <th>Note</th>
                        <th>Date</th>
                        <th>Actor</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    <?php $i = 1; ?>
                    @foreach($evaluates as $item)
                            <?php
                            $user = \App\Models\User::where('user_login', $item->user_login)->first();
                            ?>
                        @if($user)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $user->user_code }}</td>
                                <td class="text-primary font-weight-bold"><a href="{{ route('users.profile', ['id' => $user->id]) }}">
                                        {{ $user->user_surname .' '. $user->user_middlename .' '. $user->user_givenname }}</a></td>
                                <td>{{ $item->loai_danh_gia }}</td>
                                <td>{{ $item->noi_dung }}</td>
                                <td>{{ $item->findding }}</td>
                                <td>{{ $item->solution }}</td>
                                <td>{{ $item->note }}</td>
                                <td>{{ $item->ngay_danh_gia }}</td>
                                <td>{{ $item->actor }}</td>
                                <td class="text-nowrap">
                                    <a href="#" onclick="detail({{ $item->id }})" data-toggle="kt-tooltip"
                                       title="detail" data-original-title="Edit"><i class="flaticon-list-2"></i>
                                    </a>
                                </td>
                            </tr>
                        @endif
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
        var windowChild = null;
        function detail(id) {
            windowChild =  window.open("{{ route('evaluate.detail') }}/" + id,"windowChild ", "width=1000, height=800");
            return false;
        }
    </script>
@endsection

