@extends('admin.layouts.main')
@section('title', 'Index')
@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Fees', 'value' => "List Fees", 'value2' => ""])

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label col-md-4">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        Danh Sách Hoàn Thành Phí
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body" id="form-table-search">
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="example">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>MSV</th>
                        <th>Họ Và Tên</th>
                        <th>Môn Đã Học</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    <?php $i = 1 ?>
                    @foreach($listStudent as $item)
                            <?php $user = \App\Models\User::where('user_login', $item->student_login)->first();
                            $subject = \App\Models\T7\CourseResult::selectRaw("GROUP_CONCAT(psubject_code) as subject_code")
                        ->where('student_login', $user->user_login)->where('term_id', $item->term)->first();
                            ?>
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $user->user_login }}</td>
                            <td>{{ $user->user_surname .' '. $user->user_middlename .' '. $user->user_givenname }}</td>
                            <td>
                                    {{ $subject->subject_code }}
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
