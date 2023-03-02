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
                        List Course
                    </h3>
                </div>
                {{--                <div class="col-sm-8 col-md-8">--}}
                {{--                    <form method="post">--}}
                {{--                        <input type="hidden" name="_token" value="nMeViEnqyBfzuEGxFbMoLj4lKUUcUJrDN4dAkGRl">--}}
                {{--                        <div class="form-row" style="margin-top: 22px; justify-content: center">--}}
                {{--                            <div class="form-group row col-md-6">--}}
                {{--                                <label class="col-2 col-form-label" for="inputState">Semester</label>--}}
                {{--                                <select class="form-control col-4" onchange="doSearch();" id="term_id">--}}
                {{--                                    <option value="">Chooose</option>--}}
                {{--                                    @foreach($terms as $item)--}}
                {{--                                        <option value="{{ $item->id }}">{{ $item->term_name }}</option>--}}
                {{--                                    @endforeach--}}
                {{--                                </select>--}}
                {{--                            </div>--}}
                {{--                            <div class="form-group row col-md-6">--}}
                {{--                                <label class="col-3 col-form-label" for="inputState">Department</label>--}}
                {{--                                <select id="department_id"  class="form-control col-4" >--}}
                {{--                                    <option value="">Choose</option>--}}
                {{--                                    @foreach($department as $item)--}}
                {{--                                    <option value="{{ $item->id }}">{{ $item->department_name }}</option>--}}
                {{--                                    @endforeach--}}
                {{--                                </select>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </form>--}}
                {{--                </div>--}}
                <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10 col-8">
                    <div class="row align-items-center">
                        <div class="col-xl-12 order-2 order-xl-1">
                            <div class="total-record text-center">
                                <p>Total: <span class="text-danger" id="total">{{ count($course) }}</span> record</p>
                            </div>
                            <div class="list-setting text-center">
                                <p><a href="" >Add new course</a> |
                                    <a href="" >Input Course excel</a> |
                                    <a href="{{ route('course.list-subject') }}" >Unit</a> |
                                    <a href="" >Semester</a>
                                </p>
                            </div>
                            <div class="row align-items-center" style="justify-content: center">
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <div class="kt-form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Status:</label>
                                        </div>
                                        <select id="term_id" class="form-control" onchange="doSearch()">
                                            @foreach($terms as $item)
                                                <option
                                                    {{ $term->id = $item->id ? "selected" : "" }} value="{{ $item->id }}">{{ $item->term_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <div class="kt-form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Type:</label>
                                        </div>
                                        <select id="department_id" class="form-control" onchange="doSearch()">
                                            <option value="">Select</option>
                                            @foreach($department as $item)
                                                <option value="{{ $item->id }}">{{ $item->department_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-2 align-self-center">
                    <a href="{{ route('course.create') }}" class="btn pull-right hidden-sm-down btn-success"><i
                            class="mdi mdi-plus-circle"></i> Create</a>
                </div>
            </div>
            <div class="kt-portlet__body" id="form-table-search">
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="example">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Course Name</th>
                        <th>Subject Name</th>
                        <th>Subject Code</th>
                        <th>Curriculum Name</th>
                        <th>Group</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    @foreach($course as $item)
                            <?php
                            $subject_name = $item->subject->subject_name;
                            $term_name = $item->term->term_name;
                            $corse_name = $subject_name . ' ' . $term_name;
                            ?>
                        <tr>
                            <td>{{$item->id}}</td>
                            <td class="text-primary font-weight-bold"><a
                                    href="{{ route('course.edit', ['id' => $item->id]) }}">{{$corse_name}}</a></td>
                            <td>{{$subject_name}}</td>
                            <td>{{ $item->psubject_code }}</td>
                            <td>{{ $item->syllabus_name }}</td>
                            <td>{{ $item->num_of_group }}</td>
                            <td class="text-nowrap">
                                <a href="{{ route('course.edit', ['id' => $item->id]) }}"
                                   data-original-title="Edit" data-toggle="kt-tooltip" title="Edit"><i
                                        class="flaticon-edit"></i>
                                </a>
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
        // $(document).ready(function() {
        //     $('#term_id').change(function() {
        //         var url = $(this).val();
        //         if (url) {
        //             window.location = url;
        //         }
        //         return false;
        //     })
        // })

        function doSearch() {
            var term_id = $('#term_id').val();
            var department_id = $('#department_id').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('course.search') }}",
                method: 'GET',
                data: {term_id: term_id, department_id: department_id, _token: _token},
                success: function (data) {
                    $('#tbody').html(data);
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
    {{--    <script>--}}
    {{--        //search with stude_status--}}
    {{--        $(document).ready(function () {--}}
    {{--            $('#study_status').change(function () {--}}
    {{--                $.ajax({--}}
    {{--                    url: '{{ route('users.post.search') }}',--}}
    {{--                    type: 'post',--}}
    {{--                    data: $('form').serialize(),--}}
    {{--                }).done(function (response) {--}}
    {{--                    $('#form-table-search').empty();--}}
    {{--                    $('#form-table-search').html(response);--}}
    {{--                })--}}
    {{--            });--}}
    {{--        });--}}

    {{--        // search with user_level--}}
    {{--        $('#user_level').change(function () {--}}
    {{--            $.ajax({--}}
    {{--                url: "{{ route('users.post.search') }}",--}}
    {{--                type: 'post',--}}
    {{--                data: $('form').serialize()--}}
    {{--            }).done(function (response) {--}}
    {{--                // // Gọi hàm renderCart trả về cart item con--}}
    {{--                $('#form-table-search').empty();--}}
    {{--                $('#form-table-search').html(response);--}}
    {{--            });--}}
    {{--        });--}}

    {{--        // search with curriculum--}}
    {{--        $('#curriculum').change(function () {--}}
    {{--            $.ajax({--}}
    {{--                url: "{{ route('users.post.search') }}",--}}
    {{--                type: 'post',--}}
    {{--                data: $('form').serialize()--}}
    {{--            }).done(function (response) {--}}
    {{--                // // Gọi hàm renderCart trả về cart item con--}}
    {{--                $('#form-table-search').empty();--}}
    {{--                $('#form-table-search').html(response);--}}
    {{--            });--}}
    {{--        });--}}

    {{--        $(document).ready(function () {--}}
    {{--            $('#btn-form-search').click(function (event) {--}}
    {{--                event.preventDefault();--}}
    {{--                $.ajax({--}}
    {{--                    url: '{{ route('users.post.search') }}',--}}
    {{--                    type: 'post',--}}
    {{--                    data: $('form').serialize(),--}}
    {{--                })--}}
    {{--                    .done(function (response) {--}}
    {{--                        $('#form-table-search').empty();--}}
    {{--                        $('#form-table-search').html(response);--}}
    {{--                    })--}}
    {{--            })--}}
    {{--        })--}}
    {{--    </script>--}}
@endsection
