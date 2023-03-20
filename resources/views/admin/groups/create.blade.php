@extends('admin.layouts.main')
@section('title', 'Create')

@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Roles',
      'value' => "Create Role", 'value2' => ""])
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Create Group Form Layout
                            </h3>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="kt-form kt-form--label-right" action="{{route('group.store')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Học kỳ:</label>
                                    <select class="custom-select choose" id="term_id" name="term_id">
                                        <option value="0">Select</option>
                                        @foreach($terms as $item)
                                            <option value="{{ $item->id }}">{{ $item->term_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
{{--                                @error('role_name')--}}
{{--                                <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                                @enderror--}}
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Bộ môn:</label>
                                    <select class="custom-select choose" id="department" name="department_id">
                                        <option value="0">Select</option>
{{--                                        @foreach($subjects as $item)--}}
{{--                                            <option value="{{ $item->id }}">{{ $item->subject_code .' - '. $item->subject_name }}</option>--}}
{{--                                        @endforeach--}}
                                    </select>
                                </div>
{{--                                @error('role_name')--}}
{{--                                <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                                @enderror--}}
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Khóa học:</label>
                                    <select class="custom-select" id="course" name="course_id">
                                        <option value="0">Select</option>
{{--                                        @foreach($syllabus as $item)--}}
{{--                                            <option value="{{ $item->id }}">{{ $item->syllabus_name }}</option>--}}
{{--                                        @endforeach--}}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <a href="{{route('group.index')}}" type="reset" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
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
                    result = "course";
                } else {
                    result = "course";
                }
                $.ajax({
                    url: "{{ route('group.list') }}",
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
