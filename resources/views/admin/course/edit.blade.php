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
                    <form class="kt-form kt-form--label-right" action="{{route('course.store')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Học kỳ:</label>
                                    <select class="custom-select choose" id="term_id" name="term_id">
                                        <option value="0">Select</option>
                                        @foreach($terms as $item)
                                            <option {{ $course->term_id == $item->id ? "selected" : "" }} value="{{ $item->id }}">{{ $item->term_name }}</option>
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
                                    <input type="checkbox" {{ $course->attendance_required == 1 ? "checked" : "" }} checked name="attendance_required" value="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Có tính điểm vào kết quả học tập:</label>
                                    <input type="checkbox" {{ $course->grade_required == 1 ? "checked" : "" }} name="grade_required" value="1">
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
                                    <button type="button" class="nav-link-group active btn btn-dark btn-hover-danger" data-toggle="tab" href="#kt_widget5_tab1_content" role="tab">
                                        DS Lớp
                                    </button>
                                </li>
                                <li class="nav-item-group">
                                    <a class="nav-link-group btn btn-dark btn-hover-danger" data-toggle="tab" href="#kt_widget5_tab2_content" role="tab">
                                        Điểm
                                    </a>
                                </li>
                                <li class="nav-item-group">
                                    <a class="nav-link-group btn btn-dark btn-hover-danger" data-toggle="tab" href="#kt_widget5_tab3_content" role="tab">
                                        Kế Hoạch
                                    </a>
                                </li>
                                <li class="nav-item-group">
                                    <a class="nav-link-group btn btn-dark btn-hover-danger" data-toggle="tab" href="#kt_widget5_tab3_content" role="tab">
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
                                                <div class="kt-widget__blog" style="margin-right: 10px; border: 1px solid #a4a4a4; padding: 5px; border-radius: 13px">
                                                    <i class="flaticon2-list-1"></i>
                                                    <a href="{{ route('course.group', ['id' => $item->id]) }}" class="kt-widget__value kt-font-brand">{{ $item->group_name }}</a><span class="kt-widget__value">({{ $item->number_student }})</span>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="kt_widget5_tab2_content">
                                <div class="d-flex align-items-center justify-content-center" style="height: 300px">
                                    <div class="text-center">
                                        <h1 class="display-1 fw-bold">404</h1>
                                        <p class="fs-3"> <span class="text-danger">Opps!</span> Page not found.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="kt_widget5_tab3_content">
                                <div class="kt-section__content">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Buổi</th>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>Mô tả</th>
                                            <td></td>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
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
