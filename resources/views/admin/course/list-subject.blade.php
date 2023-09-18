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
                        Subject List
                    </h3>
                </div>
                <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10 col-8">
                    <div class="row align-items-center">
                        <div class="col-xl-12 order-2 order-xl-1">
                            <div class="total-record text-center">
                                <p>Total: <span class="text-danger font-weight-bold" id="total">{{ count($subjects) }}</span> record</p>
                            </div>
                            <div class="list-setting text-center">
                                <p><a class="version font-weight-bold" href="" >Create new</a> |
                                    <a class="version font-weight-bold" href="" >Cập nhập từ HO</a>
                                </p>
                            </div>
                            <div class="row align-items-center" style="justify-content: center">
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <div class="kt-form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Department:</label>
                                        </div>
                                        <select id="department_id" class="form-control">
                                            <option value="0">Select</option>
                                            @foreach($departments as $item)
                                                <option value="{{ $item->id }}">{{ $item->department_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
{{--                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">--}}
{{--                                    <div class="kt-form__group kt-form__group--inline">--}}
{{--                                        <div class="kt-form__label">--}}
{{--                                            <label>Search:</label>--}}
{{--                                        </div>--}}
{{--                                        <input type="text" class="form-control">--}}
{{--                                        <select id="department_id" class="form-control" onchange="doSearch()">--}}
{{--                                            <option value="">Select</option>--}}
{{--                                            @foreach($department as $item)--}}
{{--                                                <option value="{{ $item->id }}">{{ $item->department_name }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
{{--                <div class="col-md-2 col-2 align-self-center">--}}
{{--                    <a href="{{ route('course.create') }}" class="btn pull-right hidden-sm-down btn-success"><i--}}
{{--                            class="mdi mdi-plus-circle"></i> Create</a>--}}
{{--                </div>--}}
            </div>
            <div class="kt-portlet__body" id="form-table-search">
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="example">
                    <thead class="table-primary">
                    <tr>
                        <th colspan="1" style="width: 115px">Department Name</th>
                        <th colspan="1">Subject Name</th>
                        <th colspan="1" style="width: 115px">Subject Code</th>
                        <th colspan="1">Version</th>
                        <th colspan="1" style="width: 115px">Conversion Code</th>
                        <th colspan="1" style="width: 115px">Number Of Credit</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    @foreach($subjects as $item)
                        <tr>
                            <td>{{ $item->departments ? $item->departments->department_name : "" }}</td>
                            <td><a class="version font-weight-bold"
                                   href="{{ route('course.edit', ['id' => $item->id]) }}">{{$item->subject_name}}</a></td>
                            <td>{{ $item->subject_code }}</td>
                            <td>
                                @foreach($item->gradeSyllabus as $grade)
                               <a href="{{ route('subject.create', ['id' => $item->id]) }}" class="version font-weight-bold">{{ $grade->syllabus_name }}</a> <span class="text-dark font-weight-bold">({{ $grade->syllabus_code }})</span>
                                    <br>
                                @endforeach
                            </td>
                            <td>{{ $item->subject_code }}</td>
                            <td>
                                {{ $item->num_of_credit }}
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
        $(document).ready(function () {
            $('#department_id').change(function () {
                var department_id = $('#department_id').val();
                $.ajax({
                    url: '{{ route('subjects.search') }}',
                    type: 'get',
                    data: { department_id:department_id },
                }).done(function (response) {
                    $('#tbody').empty();
                    $('#tbody').html(response);
                    var totalSubject = $('#totalSubject').val();
                    $('#total').html(totalSubject)
                })
            });
        });
    </script>


@endsection
