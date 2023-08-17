@extends('admin.layouts.main')
@section('title', 'Index')
@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Curriculum', 'value' => "List", 'value2' => ""])
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label col-md-2">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        Student List
                    </h3>
                </div>
                <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10 col-8">
                    <div class="row align-items-center">
                        <div class="col-xl-12 order-2 order-xl-1">
                            <div class="total-record text-center">
                                <p>Total: <span class="text-danger" id="total">{{ count($curriculums) }}</span> record
                                </p>
                            </div>

                                <div class="form-group row" style="justify-content: center; margin: auto">
                                    <div class="col-6">
                                        Chương trình học:
                                        <select id="curriculum_id" class="col-md-6" name="curriculum_id">
                                            <option value="{{ Request::url() }}?curriculum_id=all">Select</option>
                                            <option value="{{ Request::url() }}?curriculum_id=0">Không có khóa</option>
                                            @foreach($curriculum as $item)
                                                <option
                                                    value="{{ Request::url() }}?curriculum_id={{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <form action="{{ route('personal.export') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="submit" class="btn-primary btn-sm" value="Export Excel">
                                        </form>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                {{--                <div class="col-md-2 col-2 align-self-center">--}}
                {{--                    <a href="{{ route('curriculum.create') }}" class="btn pull-right hidden-sm-down btn btn-primary"--}}
                {{--                       data-toggle="kt-tooltip" title="add"><i--}}
                {{--                            class="flaticon-add-circular-button"></i></a>--}}
                {{--                </div>--}}
            </div>
            <div id="data-body">
                <div class="kt-portlet__body" id="form-table-search" style="overflow-x: scroll">
                    <!--begin: Datatable -->
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="example">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Ảnh</th>
                            <th style="width: 70px">STUDENT CODE</th>
                            <th>FULL NAME</th>
                            <th>DOB</th>
                            <th>GENDER</th>
                            <th>SCHOLARSHIP</th>
                            <th>EMAIL</th>
                            <th>CHƯƠNG TRÌNH HỌC</th>
                            <th>COURSE</th>
                            <th>MAJOR</th>
                            <th>ADDRESS</th>
                            <th>STATUS</th>
                            <th>PHONE STUDENT</th>
                            <th>PHONE PARENT</th>
                            <th>PERSONAL EMAIL</th>
                            <th>PARENT EMAIL1</th>
                            <th>CCID</th>
                        </tr>
                        </thead>
                        <tbody id="tbody">
                        <?php $i = 1; ?>
                        @foreach($curriculums as $curri)
                            <?php $full_name = $curri->user_surname . ' ' . $curri->user_middlename . ' ' . $curri->user_givenname ?>
                            <!--                            --><?php //$countUser = \App\Models\User::where('curriculum_id', $item->id)->where('user_level', 3)->count(); ?>
                            <tr class="text-center">
                                <td>{{ $i++ }}</td>
                                <td></td>
                                <td class="font-weight-bold"><a class="version" href="">{{ $curri->user_code }}</a>
                                </td>
                                <td>{{ $full_name }}</td>
                                <td>{{ $curri->user_DOB }}</td>
                                <td>{{ $curri->gender == 1 ? "Nam" : "Nữ" }}</td>
                                <td>{{ $curri->promotion."%" }}</td>
                                <td>{{ $curri->user_email }}</td>
                                <td>{{ $curri->name }}</td>
                                <td>{{ $curri->khoa }}</td>
                                <td>{{ $curri->chuyen_nganh }}</td>
                                <td>{{ $curri->user_address }}</td>
                                <td>{{ $curri->study_status }}</td>
                                <td>{{ $curri->user_telephone }}</td>
                                <td>{{ $curri->ph_telephone2 }}</td>
                                <td>{{ $curri->personal_email }}</td>
                                <td>{{ $curri->parent_email1 }}</td>
                                <td>{{ $curri->cmt }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!--end: Datatable -->
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#curriculum_id').change(function () {
                var url = $(this).val();
                if (url) {
                    window.location = url;
                }
                return false;
            })
        });

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
