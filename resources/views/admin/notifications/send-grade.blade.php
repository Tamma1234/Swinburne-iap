@extends('admin.layouts.main')
@section('title', 'Index')
@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Notifications', 'value' => "Send Mail", 'value2' => ""])


    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Send Mail Group
                        </h3>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="kt-form kt-form--fit kt-form--label-right" method="post" id="send_email_form" enctype="multipart/form-data">
                    @csrf
                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3 col-sm-12">Học kì:</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control form-control-sm" name="term_id" id="exampleSelects">
                                    @foreach($terms as $term)
                                        <option value="{{ $term->id }}">{{ $term->term_name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3 col-sm-12">Department:</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <div class="kt-radio-inline">
                                    <label class="kt-radio kt-radio--bold kt-radio--brand">
                                        <input type="radio" name="phongban" value="academic"> Academic
                                        <span></span>
                                    </label>
                                    <label class="kt-radio kt-radio--bold kt-radio--brand">
                                        <input type="radio" name="phongban" checked="" value="studenthq"> StudentHQ
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3 col-sm-12">List group:</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <textarea class="form-control" name="group_list" id="kt_clipboard_2"
                                          rows="4"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3 col-sm-12">Title email:</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="title_email"
                                           aria-describedby="emailHelp" placeholder="Title email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3 col-sm-12">Content:</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <div class="summernote" id="kt_summernote_1"></div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-9">
                                <button type="submit" class="btn btn-brand">Submit</button>
                                <button type="button" class="btn btn-secondary">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>

                <!--end::Form-->
            </div>
            {{--            <div class="kt-portlet__head kt-portlet__head--lg">--}}
            {{--                <div class="kt-portlet__head-label col-md-4">--}}
            {{--										<span class="kt-portlet__head-icon">--}}
            {{--											<i class="kt-font-brand flaticon2-line-chart"></i>--}}
            {{--										</span>--}}
            {{--                    <h3 class="kt-portlet__head-title">--}}
            {{--                        Send Mail Group--}}
            {{--                    </h3>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--            <div class="kt-portlet__body" id="form-table-search">--}}
            {{--                <!--begin: Datatable -->--}}
            {{--                <!--end: Datatable -->--}}
            {{--           --}}
            {{--            </div>--}}
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            $('#kt_summernote_1').summernote({
                height: 300,
                callbacks: {
                    onImageUpload: function(files) {
                        uploadImage(files[0]);
                    }
                }
            });

            function uploadImage(file) {
                let data = new FormData();
                data.append('file', file);
                $.ajax({
                    url: '{{ route('upload.image') }}',
                    method: 'POST',
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.url) {
                            $('#kt_summernote_1').summernote('insertImage', response.url);
                        } else {
                            alert('Failed to upload image');
                        }
                    },
                    error: function(response) {
                        alert('Error uploading image');
                    }
                });
            }

            $('#send_email_form').submit(function(e) {
                e.preventDefault(); // Ngăn chặn hành động submit mặc định của form
                let form = $(this);
                let content = $('#kt_summernote_1').summernote('code');
                let formData = form.serializeArray();
                formData.push({ name: 'content', value: content });
                $.ajax({
                    url: '{{ route('store.send.mail') }}',
                    type: 'post',
                    data: $.param(formData),
                    success: function(response) {
                        Swal.fire({
                            title: "Success!",
                            text: "Email has been sent successfully.",
                            icon: "success",
                            confirmButtonClass: 'btn btn-primary',
                            buttonsStyling: false,
                        }).then(function () {
                            location.reload();
                            // Kiểm tra phản hồi và thực hiện redirect nếu thành công

                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: "Error!",
                            text: "An error occurred while sending the email. Please try again.",
                            icon: "error",
                            confirmButtonClass: 'btn btn-primary',
                            buttonsStyling: false,
                        });
                    },
                });
            });
        });
    </script>
@endsection
