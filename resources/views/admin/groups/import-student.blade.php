@extends('admin.layouts.main')
@section('title', 'Index')
@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Group', 'value' => "Import", 'value2' => ""])
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label col-md-2">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        Import Student
                    </h3>
                </div>
            </div>
            <div id="data-body">
                <div class="kt-portlet__body">
                    <div class="">
                        <div class="kt-section">
                            <div class="kt-section__desc">
                                <p class="text-dark">Tạo một file CSV có cấu trúc như sau (ví dụ sau chỉ chứa hai dòng đầu tiên):</p>
                                <p style="margin-left: 20px">
                                    user_code,term_name,group_name,subject_code
                                </p>
                                <p style="margin-left: 20px">PT00008,Summer 2012,PT0703-WEB,COM201</p>
                            </div>

                            <div class="kt-separator kt-separator--space-lg kt-separator--border-dashed"></div>
                        </div>
                        <div class="" id="kt_widget4_tab11_content">
                            <form method="POST" action="{{ route('post.student') }}" enctype="multipart/form-data">
                                @csrf
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Chọn file CSV để nhập:</th>
                                        <td><input type="file" id="file" name="file"></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">Tự động tạo Khóa học, Lớp:</th>
                                        <td><input type="checkbox" checked name="auto"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="submit" class="btn-primary" value="Import"></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
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

                {{--function importClass() {--}}
                {{--    var file = $('#file').val();--}}
                {{--    var _token = $('input[name="_token"]').val();--}}
                {{--    $.ajax({--}}
                {{--        url : "{{ route('post.import.class') }}",--}}
                {{--        type: 'post',--}}
                {{--        data : {file:file,_token:_token}--}}
                {{--    }).done(function (data) {--}}

                {{--    })--}}
                {{--}--}}
            </script>
@endsection
