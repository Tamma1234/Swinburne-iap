@extends('admin.layouts.main')
@section('title', 'Index')
@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Course', 'value' => "List Course", 'value2' => ""])

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
                        <th>USER LOGIN</th>
                        <th>MSV</th>
                        <th style="width: 47px">HỌ VÀ TÊN</th>
                        <th style="width: 54px">MÔN ĐƯỢC XẾP LỚP</th>
                        <th>TA ĐƯỢC XẾP LỚP</th>
                        <th>TRẠNG THÁI PHÍ</th>
                        <th>PHÍ KỲ</th>
                        <th>SỐ DƯ</th>
                        <th>ĐÃ TRỪ</th>
                        <th>CÒN PHẢI NỘP</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    <?php $i = 1 ?>
                    @foreach($fees as $item)
                            <?php
                            $user = \App\Models\User::where('user_login', $item->student_login)->first();
                            $user_login = $user->user_login;
                            $subjects = \App\Models\T7\CourseResult::selectRaw("GROUP_CONCAT(psubject_code) as subjectcode")
                                ->where('student_login', $user_login)
                                ->where('term_id', $item->term)
                                ->first();
                            $statusFee = \App\Models\FeeT::where('term', $item->term)->where('student_login', $user_login)
                                ->where('status', 0)
                                ->count();
                            $count_fee_term = \App\Models\FeeT::where('term', $item->term)->where('student_login', $user->user_login)
                                ->count();
                            $sumAmout = \App\Models\FeeT::where('student_login', $user->user_login)->where('term', $item->term)->sum('amount');
                            $residual = \App\Models\User::where('user_login', $user->user_login)->select('residual')->first();
                            $sum_tien = \App\Models\FeeT::where('student_login', $user->user_login)->where('term', $item->term)->sum('tien_da_nop');
                            $tongNop = $residual->residual + $sum_tien;
                            $con_phai_nop = $sumAmout - $tongNop;
                            ?>
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $user->user_login }}</td>
                            <td>{{ $user->user_code }}</td>
                            <td>{{ $user->user_surname .' '. $user->user_middlename .' '. $user->user_givenname }}</td>
                            <td style="width: 300px">
                                {{ $subjects->subjectcode }}
                            </td>
                            <td></td>
                            <td>@if($statusFee > 0)
                                    <span class="text-danger">Chưa hoàn thành</span>
                                @elseif($count_fee_term == 0)
                                    <span class="text-danger">Không có phí kỳ</span>
                                @else
                                    <span class="text-success">Đã hoàn thành</span>
                                @endif
                            </td>
                            <td>{{ number_format($sumAmout) }}</td>
                            <td>{{ $residual->residual }}</td>
                            <td>{{ $sum_tien }}</td>
                            <td>{{ $con_phai_nop }}</td>
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
