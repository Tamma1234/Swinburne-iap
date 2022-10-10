@extends('admin.layouts.table')

@section('content')
        <table class="table table-striped- table-bordered table-hover table-checkable" id="example">
            <thead>
            <tr>
                <th>USER LOGIN</th>
                <th>USER SURNAME</th>
                <th>USER MIDDLENAME</th>
                <th>USER GIVENAME</th>
                <th>USER EMAIL</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($valueSearch as $user)
                <tr>
                    <td>{{$user->user_login}}</td>
                    <td>{{$user->user_surname}}</td>
                    <td>{{$user->user_middlename}}</td>
                    <td>{{$user->user_givenname}}</td>
                    <td>{{$user->user_email}}</td>
                    <td class="text-nowrap">
                        <a href="{{route('users.edit', ['id' => $user->id])}}" data-toggle="tooltip"
                           data-original-title="Edit"><i class="flaticon-edit"></i>
                        </a>
                        <a href="{{route('users.remove', ['id' => $user->id])}}" data-toggle="tooltip"
                           data-original-title="Close"> <i class="flaticon-delete"></i> </a>
                    </td>
                </tr>
            @endforeach
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
