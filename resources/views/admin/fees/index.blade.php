@extends('admin.layouts.main')
@section('title', 'Index')
@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Course', 'value' => "List Course", 'value2' => ""])

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label col-md-2">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        List Fees
                    </h3>
                </div>
                <div class="col-md-10 col-2 align-self-center">
                    <a href="{{ route('event.add') }}" class="btn pull-right hidden-sm-down btn btn-primary"
                       data-toggle="kt-tooltip" title="add"><i
                            class="flaticon-add-circular-button"></i></a>
                </div>
            </div>
            <div class="kt-portlet__body" id="form-table-search">
                <table class="table table-striped- table-bordered table-hover table-checkable">
                    <thead>
                    <tr>
                        <th>Study Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    @foreach($users as $item)
                        <tr>
                            @switch($item->study_status)
                                @case(0)
                                    <td class="text-success">GRADUATED</td>
                                    <?php $total = \App\Models\User::where('study_status', 0)->count(); ?>
                                    <td>{{ $total }}</td>
                                    @break
                                @case(4)
                                    <td class="text-danger">DO</td>
                                        <?php $total = \App\Models\User::where('study_status', 4)->count(); ?>
                                    <td>{{ $total }}</td>
                                    @break
                                @case(17)
                                    <td class="text-danger">PENDING</td>
                                        <?php $total = \App\Models\User::where('study_status', 17)->count(); ?>
                                    <td>{{ $total }}</td>
                                    @break
                                @case(1)
                                    <td class="text-success">INTAKE</td>
                                        <?php $total = \App\Models\User::where('study_status', 1)->count(); ?>
                                    <td>{{ $total }}</td>
                                    @break
                                @case(3)
                                    <td class="text-danger">DEFER</td>
                                        <?php $total = \App\Models\User::where('study_status', 3)->count(); ?>
                                    <td>{{ $total }}</td>
                                    @break
                                @case(5)
                                    <td class="text-danger">CHANGE CAMPUS</td>
                                        <?php $total = \App\Models\User::where('study_status', 5)->count(); ?>
                                    <td>{{ $total }}</td>
                                @break
                            @endswitch
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="example">
                    <thead class="table-active">
                    <tr>
                        <th class="text-white" >Term Name</th>
                        <th class="text-white">Số phí phải thu</th>
                        <th class="text-white">Số phí đã thu</th>
                        <th class="text-white" style="width: 47px">Số phí chưa thu</th>
                        <th class="text-white" style="width: 54px">GC</th>
                        <th class="text-white">CN</th>
                        <th class="text-white">Sinh viên hoàn thành</th>
                        <th class="text-white">Sinh viên chưa hoàn thành</th>
                        <th class="text-white">Phí thu theo kỳ</th>
                        <th class="text-white">Lượt xếp lớp chuyên ngành</th>
                        <th class="text-white">Tiền phải trả</th>
                        <th class="text-white">Danh sách học</th>
                        <th class="text-white">Danh sách lớp</th>
                        <th class="text-white">Action</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    @foreach($terms as $term)
                            <?php $totalClass = \App\Models\T7\CourseResult::where('term_id', $term->id)
                            ->whereNotIn('psubject_code', ['ENL101','ENL102','ENL201','ENL202','ENL301','ENL302','VOV101','VOV201','VOV301','EGM101','GC101','GC102','GC201','GC202','GC301','GC302'])
                            ->count();
                            $phi_phai_tra = $totalClass*125;
                            $phi_phai_thu = \App\Models\FeeT::where('term', $term->id)->select('amount')->sum('amount');
                            $phi_da_thu = \App\Models\FeeT::where('term', $term->id)
                                ->where('tien_da_nop','<>', 0)
                                ->sum('tien_da_nop');
                            $tien_chua_thu = \App\Models\FeeT::where('term', $term->id)
                                ->where('tien_da_nop','=', 0)
                                ->sum('tien_da_nop');
                            $feesGC = \App\Models\FeeT::where('term', $term->id)->where('type_fee', 3)->sum('amount');
                            $feesCN = \App\Models\FeeT::where('term', $term->id)->where('type_fee', 1)->sum('amount');
                            $totalStudent = \App\Models\FeeT2::where('term', $term->id)->where('status', 1)->count();
                            $notStudent = \App\Models\FeeT2::where('term', $term->id)->where('status', 0)->count();
                            $classCN = \App\Models\FeeT2::where('term', $term->id)->where('type_fee', 1)->count();
                            ?>
                        <tr>
                            <td>{{ $term->term_name }}</td>
                            <td>{{ number_format($phi_phai_thu) }}</td>
                            <td>{{ number_format($phi_da_thu)	 }}</td>
                            <td>{{ number_format($tien_chua_thu) }}</td>
                            <td>{{ number_format($feesGC) }}</td>
                            <td>{{ number_format($feesCN) }}</td>
                            <td>{{ $totalStudent }}</td>
                            <td>{{ $notStudent }}</td>
                            <td>{{ $totalStudent }}</td>
                            <td>{{ $classCN }}</td>
                            <td>{{ $phi_phai_tra ." $" }} </td>
                            <td><a href="{{ route('list.student', ['id' => $term->id ]) }}">View</a></td>
                            <td><a href="{{ route('fees.list', ['id' => $term->id ]) }}">View</a></td>
                            <td>
                                <a href="">import DNG</a>
                                <a href="">import CK</a>
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
                    $('#form-table-search').html(data);
                    var totalCourse = $('#totalCourse').val();
                    $('#total').html(totalCourse)
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
@endsection
