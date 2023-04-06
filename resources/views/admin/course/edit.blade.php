@extends('admin.layouts.main')
@section('title', 'Create')

@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Term',
      'value' => "Edit Term", 'value2' => ""])
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Edit Term Form Layout
                            </h3>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="kt-form kt-form--label-right" action="{{route('course.store')}}"
                          enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Học kỳ:</label>
                                    <select class="custom-select choose" id="term_id" name="term_id">
                                        <option value="0">Select</option>
                                        @foreach($terms as $item)
                                            <option
                                                {{ $course->term_id == $item->id ? "selected" : "" }} value="{{ $item->id }}">{{ $item->term_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{--                                @error('role_name')--}}
                                {{--                                <div class="alert alert-danger">{{ $message }}</div>--}}
                                {{--                                @enderror--}}
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Môn học:</label>
                                    <select class="custom-select choose" id="subject" name="subject_id">
                                        <option value="0">Select</option>
                                        @foreach($subjects as $item)
                                            <option {{ $course->id == $item->id ? "selected" : "" }}
                                                    value="{{ $item->id }}">{{ $item->subject_code .' - '. $item->subject_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{--                                @error('role_name')--}}
                                {{--                                <div class="alert alert-danger">{{ $message }}</div>--}}
                                {{--                                @enderror--}}
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Khung chương trình học:</label>
                                    <select class="custom-select" id="syllabus" name="syllabus_id">
                                        <option value="0">Select</option>
                                        @foreach($syllabus as $item)
                                            <option {{ $course->syllabus_id == $item->id ? "selected" : "" }}
                                                    value="{{ $item->id }}">{{ $item->syllabus_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{--                                @error('role_name')--}}
                                {{--                                <div class="alert alert-danger">{{ $message }}</div>--}}
                                {{--                                @enderror--}}
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Khung chương trình học:</label>
                                    <textarea class="form-control" name="groups_name"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Có tính điểm danh:</label>
                                    <input type="checkbox"
                                           {{ $course->attendance_required == 1 ? "checked" : "" }} checked
                                           name="attendance_required" value="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Có tính điểm vào kết quả học tập:</label>
                                    <input type="checkbox"
                                           {{ $course->grade_required == 1 ? "checked" : "" }} name="grade_required"
                                           value="1">
                                </div>
                            </div>
                        </div>
                        {{--                        <div class="kt-portlet__foot">--}}
                        {{--                            <div class="kt-form__actions">--}}
                        {{--                                <div class="row">--}}
                        {{--                                    <div class="col-lg-6">--}}
                        {{--                                        <button type="submit" class="btn btn-primary">Save</button>--}}
                        {{--                                        <a href="{{route('course.index')}}" type="reset" class="btn btn-secondary">Cancel</a>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </form>
                    <!--end::Form-->
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 order-lg-3 order-xl-1">
                <!--begin:: Widgets/Best Sellers-->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-toolbar">
                            <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">
                                <li class="nav-item-group">
                                    <button type="button" class="nav-link-group active btn btn-dark btn-hover-danger"
                                            data-toggle="tab" href="#kt_widget5_tab1_content" role="tab">
                                        DS Lớp
                                    </button>
                                </li>
                                <li class="nav-item-group">
                                    <a class="nav-link-group btn btn-dark btn-hover-danger" data-toggle="tab"
                                       href="#kt_widget5_tab2_content" role="tab">
                                        Điểm
                                    </a>
                                </li>
                                <li class="nav-item-group">
                                    <a class="nav-link-group btn btn-dark btn-hover-danger" data-toggle="tab"
                                       href="#kt_widget5_tab3_content" role="tab">
                                        Kế Hoạch
                                    </a>
                                </li>
                                <li class="nav-item-group">
                                    <a class="nav-link-group btn btn-dark btn-hover-danger" data-toggle="tab"
                                       href="#kt_widget5_tab4_content" role="tab">
                                        Tổng Quan
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="kt-portlet__body-group">
                        <div class="tab-content">
                            <div class="tab-pane active" id="kt_widget5_tab1_content" aria-expanded="true">
                                <div class="kt-widget kt-widget--project-1">
                                    <div class="kt-widget__footer">
                                        <div class="kt-widget__wrapper">
                                            <div class="kt-widget__section">
                                                @foreach($groups as $item)
                                                    <div class="kt-widget__blog"
                                                         style="margin-right: 10px; border: 1px solid #a4a4a4; padding: 5px; border-radius: 13px">
                                                        <i class="flaticon2-list-1"></i>
                                                        <a href="{{ route('course.group', ['id' => $item->id]) }}"
                                                           class="kt-widget__value kt-font-brand">{{ $item->group_name }}</a><span
                                                            class="kt-widget__value">({{ $item->number_student }})</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <span style="margin-left: 30px">Nhập tên các lớp, phân tách bởi dấu (,)</span>
                                            <div class="col-3">
                                                <input type="text">
                                                <input type="button" value="Thêm lớp">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="kt_widget5_tab2_content">
                                <div class="d-flex align-items-center justify-content-center" style="height: 300px">
                                    <div class="text-center">
                                        <h1 class="display-1 fw-bold">404</h1>
                                        <p class="fs-3"><span class="text-danger">Opps!</span> Page not found.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="kt_widget5_tab3_content"
                                 style="overflow: auto; min-height: 300px">
                                <div class="kt-section__content">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <?php $i = 1; ?>
                                            <th>Buổi</th>
                                            @foreach($activity as $item)
                                                <th>{{ $i++ }}</th>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <th>Mô tả</th>
                                            @foreach($activity as $item)
                                                <th>{{ $item->description }}</th>
                                            @endforeach
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="kt_widget5_tab4_content">
                                <div class="kt-portlet">
                                    <div class="kt-portlet__body">

                                        <!--begin::Section-->
                                        <div class="kt-section" style="overflow: auto">
                                            <div class="kt-section__content">
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        <td class="text-dark font-weight-bold" id="proffesor"
                                                            style="width: 50px">Proffesor
                                                        </td>
                                                        <td>
                                                            <table class="table">
                                                                <tbody>
                                                                <tr>
                                                                    <td></td>
                                                                    @foreach($groups as $group)
                                                                        <td class="text-primary font-weight-bold"><a
                                                                                href="{{ route('course.group', ['id' => $group->id]) }}">{{ $group->group_name }}</a>
                                                                        </td>
                                                                    @endforeach
                                                                </tr>
                                                                @foreach($leaderActivity as $leader)
                                                                    <tr>
                                                                        <td class="text-primary font-weight-bold">{{ $leader->leader_login }}</td>
                                                                        @foreach($groups as $group)
                                                                                <?php
                                                                                $numberActivity = \App\Models\Fu\Acitivitys::where('groupid', $group->id)
                                                                                    ->where('leader_login', $leader->leader_login)
                                                                                    ->get();
                                                                                $totalActive = \App\Models\Fu\Acitivitys::where('groupid', $group->id)
                                                                                    ->where('leader_login', $leader->leader_login)
                                                                                    ->where('done', 1)
                                                                                    ->get();
                                                                                ?>
                                                                            @if(count($numberActivity) > 0)
                                                                                <td class="text-dark font-weight-bold">{{ count($totalActive) }}
                                                                                    /<span>{{ count($numberActivity) }}</span>
                                                                                </td>
                                                                            @else
                                                                                <td>
                                                                                </td>
                                                                            @endif
                                                                        @endforeach
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-dark font-weight-bold">Grade</td>
                                                        <td>Final Grade</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-dark font-weight-bold" id="plan">Plan</td>
                                                        <td>
                                                            <table class="table">
                                                                <tbody>
                                                                <tr>
                                                                    <td colspan="2">Session</td>
                                                                    @foreach($syllabusCourse as $syllabus)
                                                                        <td>{{ $syllabus->course_session }}</td>
                                                                    @endforeach
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2">Description</td>
                                                                    @foreach($syllabusCourse as $syllabus)
                                                                        <td>{{ $syllabus->description }}</td>
                                                                    @endforeach
                                                                </tr>
                                                                @foreach($groups as $group)
                                                                        <?php $activitys = \App\Models\Fu\Acitivitys::where('groupid', $group->id)->get();
                                                                        $i = 1;
                                                                        ?>
                                                                    <tr>
                                                                        <td colspan="2">{{ $group->group_name }}</td>
                                                                        @foreach($activitys as $item)
                                                                                <?php $day = date('d/m', strtotime($item->day)); ?>
                                                                            <td class="text-primary"> {{ $day }}
                                                                            <p class="text-danger">S{{ $item->slot }}</p>
                                                                            <p class="text-danger">{{ $i++ }}</p>
                                                                            </td>
                                                                        @endforeach
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>

                                        <!--end::Section-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end:: Widgets/Best Sellers-->
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('.choose').on('change', function () {
                var action = $(this).attr('id');
                var id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = "";
                if (action == 'term_id') {
                    result = "subject";
                } else {
                    result = "syllabus";
                }
                $.ajax({
                    url: "{{ route('list.course') }}",
                    method: 'POST',
                    data: {action: action, id: id, _token: _token},
                    success: function (data) {
                        $('#' + result).html(data);
                    }
                });
            })
        });
    </script>
@endsection
