@extends('admin.layouts.table')
@section('content')
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
    <?php $i = 1; ?>
    @foreach($course as $item)
            <?php
            $subject_name = $item->subject->subject_name;
            $term_name = $item->term->term_name;
            $corse_name = $subject_name . ' ' . $term_name;
            ?>
        <tr>
            <td>{{ $i++ }}</td>
            <td class="text-primary font-weight-bold"><a class="version"
                                                         href="{{ route('course.edit', ['id' => $item->id]) }}">{{$corse_name}}</a></td>
            <td>{{$subject_name}}</td>
            <td>{{ $item->psubject_code }}</td>
            <td class="text-primary font-weight-bold"><a href="{{ route('subject.create', ['id' => $item->id]) }}"
                                                         class="version">{{ $item->syllabus ? $item->syllabus->syllabus_name : "" }}</a></td>
            <td>{{ $item->num_of_group }}</td>
            <td class="text-nowrap">
                <a href="{{ route('course.edit', ['id' => $item->id]) }}"
                   data-original-title="Edit" data-toggle="kt-tooltip" title="Edit"><i
                        class="flaticon-edit"></i>
                </a>
            </td>
        </tr>
    @endforeach
    <input type="hidden" id="totalCourse" value="{{ count($course) }}">
    </tbody>
</table>
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
    </script>
@endsection
