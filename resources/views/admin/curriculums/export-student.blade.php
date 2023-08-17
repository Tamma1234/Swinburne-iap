<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            border: 1px solid grey;
        }
    </style>
</head>
<body>
<table class="table-active">
<thead>
<tr>
    <th>STT</th>
    <th>Ảnh</th>
    <th style="width: 70px">STUDENT CODE</th>
    <th>FULL NAME</th>
    <th>DOB</th>
    <th>GENDER</th>
    <th>SCHOLARSHIP</th>
    <th>EMAIL</th>
    <th>CHƯƠNG TRÌNH HỌC</th>
    <th>COURSE</th>
    <th>MAJOR</th>
    <th>ADDRESS</th>
    <th>STATUS</th>
    <th>PHONE STUDENT</th>
    <th>PHONE PARENT</th>
    <th>PERSONAL EMAIL</th>
    <th>PARENT EMAIL1</th>
    <th>CCID</th>
</tr>
</thead>
<tbody id="tbody">
<?php
$i = 1; ?>
@foreach($curriculums as $curri)
    <?php $full_name = $curri->user_surname . ' ' . $curri->user_middlename . ' ' . $curri->user_givenname;
    ?>
    <tr class="text-center">
        <td>{{ $i++ }}</td>
        <td></td>
        <td class="font-weight-bold"><a class="version" href="">{{ $curri->user_code }}</a>
        </td>
        <td>{{ $full_name }}</td>
        <td>{{ $curri->user_DOB }}</td>
        <td>{{ $curri->gender == 1 ? "Nam" : "Nữ" }}</td>
        <td>{{ $curri->promotion."%" }}</td>
        <td>{{ $curri->user_email }}</td>
        <td>{{ $curri->name }}</td>
        <td>{{ $curri->khoa }}</td>
        <td>{{ $curri->chuyen_nganh }}</td>
        <td>{{ $curri->user_addressthie }}</td>
        <td>{{ $curri->study_status }}</td>
        <td>{{ $curri->user_telephone }}</td>
        <td>{{ $curri->ph_telephone2 }}</td>
        <td>{{ $curri->personal_email }}</td>
        <td>{{ $curri->parent_email1 }}</td>
        <td>{{ $curri->cmt }}</td>
    </tr>
@endforeach
</tbody>
</table>

</body>
</html>
