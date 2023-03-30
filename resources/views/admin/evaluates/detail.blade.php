@extends('admin.layouts.main')
@section('title', 'Create')

@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Evaluate',
      'value' => "Edit Evaluate", 'value2' => ""])

        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-lg-12">

                    <!--begin::Portlet-->
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Create Evaluate Form Layout
                                </h3>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form class="kt-form kt-form--label-right" enctype="multipart/form-data" method="POST">
                            @csrf
                            <input type="hidden" id="id" name="id" value="{{ $evaluate->id }}">
                                <div class="kt-portlet__body">
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Chọn loại đánh giá:</label>
                                        <div class="col-10">
                                            <select class="form-control" name="type">
                                                <option {{ $evaluate->loai_danh_gia == "A" ? "selected" : "" }} value="A">A</option>
                                                <option {{ $evaluate->loai_danh_gia == "B" ? "selected" : "" }} value="B">B</option>
                                                <option {{ $evaluate->loai_danh_gia == "C" ? "selected" : "" }} value="C">C</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-search-input" class="col-2 col-form-label">Problems</label>
                                        <div class="col-10">
                                            <textarea class="form-control" type="search" name="noi_dung">{{ $evaluate->noi_dung }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-search-input" class="col-2 col-form-label">Findding</label>
                                        <div class="col-10">
                                            <textarea class="form-control" type="search" name="findding">{{ $evaluate->findding }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-search-input" class="col-2 col-form-label">Solution</label>
                                        <div class="col-10">
                                            <textarea class="form-control" type="search" name="solution">{{ $evaluate->solution }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-search-input" class="col-2 col-form-label">Note</label>
                                        <div class="col-10">
                                            <textarea class="form-control" type="search" name="note">{{ $evaluate->note }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-portlet__foot">
                                    <div class="kt-form__actions">
                                        <div class="row">
                                            <div class="col-2">
                                            </div>
                                            <div class="col-10">
                                                <button type="button" class="btn btn-success" id="submit">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
            </div>
@endsection
@section('script')
      <script>
          $(document).ready(function () {
             $("#submit").on('click', function (){
                var id = $('#id').val();
                 $.ajax({
                     url: "{{ route('evaluate.update') }}/" + id,
                     method: 'POST',
                     data: $('form').serialize(),
                     success: function (data) {
                         window.close();
                         opener.window.location.reload();
                     }
                 });
             })
          })
      </script>
@endsection
