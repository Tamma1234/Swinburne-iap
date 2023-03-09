@extends('admin.layouts.main')
@section('title', 'index')
@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Subject', 'value' => "List", 'value2' => ""])

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label col-md-2">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        Quản lí môn học
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body" id="form-table-search">
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable">
                    <thead class="table-primary">
                    <tr>
                        <th>Department</th>
                        <th>Subject Code</th>
                        <th>Subject Name</th>
                        <th>Subject Name (EN)</th>
                        <th>Abbreviations (SMS)</th>
                        <th>Conversion Cod</th>
                        <th>Level</th>
                        <th>Number Of Credit</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    <tr>
                        <td>{{ $subject->departments ? $subject->departments->department_name : ""  }}</td>
                        <td>{{ $syllabus->subject_code }}</td>
                        <td><input type="text" value="{{$syllabus->syllabus_name}}"></td>
                        <td><input type="text" value="{{$syllabus->syllabus_name}}"></td>
                        <td><input type="text" value="{{$syllabus->subject_code}}"></td>
                        <td><input type="text" value="{{$syllabus->subject_code}}"></td>
                        <td>{{ $subject->level }}</td>
                        <td>{{ $subject->num_of_credit }}</td>
                    </tr>
                    </tbody>
                </table>
                <!--end: Datatable -->
                <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" style="border-bottom: 1px solid">
                    <input type="hidden" value="{{ $subject->id }}" id="subject_id">
                    <li class="nav-item">
                        <a href="{{ route('subject.list', ['id' => $subject->id, 'view_child' => 1]) }}"
                           class="nav-link btn btn-primary" style="color: #fff">
                            Version
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('subject.list', ['id' => $subject->id, 'view_child' => 2]) }}"
                           class="nav-link btn btn-primary" style="color: #fff">
                            Group
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('subject.list', ['id' => $subject->id, 'view_child' => 3]) }}"
                           class="nav-link btn btn-primary" style="color: #fff">
                            Separation Of Subjects
                        </a>
                    </li>
                </ul>
                @if($view_child == 1)
                    <div class="tab-content">
                        <div class="tab-pane active" id="kt_widget4_tab1_content" aria-expanded="true">
                            <div class="kt-widget kt-widget--project-1">
                                <h5 class="text-primary font-weight-bold">Danh sách khung chương trình học</h5>
                                <div class="kt-widget__footer">
                                    <div class="kt-widget__wrapper">
                                        <div class="kt-widget__section">
                                            @foreach($groupsSyllabus as $item)
                                                <div class="kt-widget__blog"
                                                     style="margin-right: 10px; border: 1px solid #a4a4a4; padding: 5px; border-radius: 13px">
                                                    <i class="flaticon2-list-1"></i>
                                                    <a href="{{ route('course.group', ['id' => $item->id]) }}"
                                                       class="kt-widget__value kt-font-brand">{{ $item->syllabus_name }}</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($view_child == 2)
                    <div class="tab-pane active" id="kt_widget4_tab1_content" aria-expanded="true">
                        <div class="kt-widget kt-widget--project-1">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-0 col-form-label font-weight-bold">Text</label>
                                <div class="col-2">
                                    <select class="form-control" id="term_id" onchange="doSearch()">
                                        @foreach($terms as $term)
                                        <option value="{{ $term->id }}">{{ $term->term_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="kt-widget__footer">
                                <div class="kt-widget__wrapper">
                                    <div class="kt-widget__section" id="group_body">
                                        @foreach($groupTerm as $item)
                                            <div class="kt-widget__blog"
                                                 style="margin-right: 10px; border: 1px solid #a4a4a4; padding: 5px; border-radius: 13px">
                                                <i class="flaticon2-list-1"></i>
                                                <a href="{{ route('course.group', ['id' => $item->id]) }}"
                                                   class="kt-widget__value kt-font-brand">{{ $item->group_name }}</a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="tab-pane active" id="kt_widget4_tab1_content" aria-expanded="true">
                        <div class="kt-widget kt-widget--project-1">
                            <table class="table table-striped- table-bordered table-hover table-checkable">
                                <thead class="table-primary">
                                <tr>
                                    <th>MÃ MÔN</th>
                                    <th>TÊN MÔN</th>
                                    <th>ENGLISH SUBJECT NAME</th>
                                    <th>BỘ MÔN</th>
                                    <th>MÃ CHUYỂN ĐỔI</th>
                                    <th>SỐ TÍN CHỈ</th>
                                </tr>
                                </thead>
                                <tbody id="tbody">
                                <tr>
                                    <td>{{ $subject->subject_code  }}</td>
                                    <td>{{ $subject->subject_name }}</td>
                                    <td>{{ $subject->subject_name_en }}</td>
                                    <td>{{ $subject->departments ? $subject->departments->department_name : "" }}</td>
                                    <td>{{ $subject->subject_code }}</td>
                                    <td>{{ $subject->num_of_credit }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
                $(document).ready(function () {
                    $('#term_id').change(function () {
                        var term_id = $('#term_id').val();
                        var subject_id = $('#subject_id').val();
                        $.ajax({
                            url: '{{ route('search.term') }}',
                            type: 'get',
                            data: {term_id:term_id, subject_id:subject_id},
                        }).done(function (response) {
                            $('#group_body').empty();
                            $('#group_body').html(response);
                        })
                    });
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
