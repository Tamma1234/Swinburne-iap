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
                                Create Curriculum Form Layout
                            </h3>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="kt-form kt-form--label-right" action="{{route('curriculum.store')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Tên</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Tổng số giai đoạn</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Mô tả</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Chương trình</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Hệ</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Tổng số tín chỉ</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Tổng số môn</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Trạng Thái</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Tổng số tín chỉ bắt buộc</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Tổng số môn bắt buộc</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Danh mục các môn bắt buộc</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Tổng số tín chỉ tự chọn</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Tổng số môn tự chọn</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Danh mục các môn tự chọn</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Tổng số tín chỉ tự chọn</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Ngành học</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">Chuyên ngành học:</label>
                                    <div class="col-6">
                                        <select class="custom-select" id="syllabus" name="syllabus_id">
                                            <option value="0">Select</option>
                                        </select>
                                    </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Khóa</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Ngành</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Nội dung</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Ngành in bằng VI</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Ngành in bằng EN</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" id="example-text-input">
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <a href="{{route('curriculum.index')}}" type="reset" class="btn btn-secondary">Cancel</a>
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
