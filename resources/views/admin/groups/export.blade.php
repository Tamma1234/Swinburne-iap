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
        <th scope="col">STT</th>
        <th scope="col">Tên lớp</th>
        <th scope="col">Mã môn</th>
        <th scope="col">Tên môn</th>
        <th scope="col">Block</th>
        <th scope="col">Số thành viên</th>
        <th scope="col">Ngày bắt đầu</th>
        <th scope="col">Ngày kết thúc</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i = 1; ?>
    @foreach($groups as $group)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $group->group_name }}</td>
            <td>{{ $group->psubject_code }}</td>
            <td>{{ $group->psubject_name }}</td>
            <td>{{ $group->pterm_name }}</td>
            <td>{{ $group->number_student }}</td>
            <td>{{ $group->start_date }}</td>
            <td>{{ $group->edn_start }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
