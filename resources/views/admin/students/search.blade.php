<?php $i = 1; ?>
@foreach($users as $item)
    <tr>
        <td>{{ $i++ }}</td>
        <td>{{ $item->user_login }}</td>
        <td>{{ $item->user_surname .' '. $item->user_middlename .' '. $item->user_givenname }}</td>
        <td>{{ $item->user_code }}</td>
        <td>{{ $item->created_date }}</td>
        <td>{{ $item->nganh}}</td>
        <td>{{ $item->curriculum ? $item->curriculum->nganh : "" }}</td>
        <td>{{ $item->curriculum ? $item->curriculum->chuyen_nganh : "" }}</td>
        <td>{{ $item->intake_major }}</td>
        <td>{{ $item->intake }}</td>
        <td></td>
        <td></td>
        <td>{{ $item->promotion }}</td>
        <td>{{ $item->gender == 1 ? "Nam" : "Nữ" }}</td>
        <td>{{ $item->user_DOB }}</td>
        <td></td>
    </tr>
@endforeach
