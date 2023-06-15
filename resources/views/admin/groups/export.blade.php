<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">STT</th>
        <th scope="col">Tên lớp</th>
        <th scope="col">Mã môn </th>
        <th scope="col">Tên môn</th>
        <th scope="col">Block</th>
        <th scope="col">Số thành viên</th>
        <th scope="col">Ngày bắt đầu</th>
        <th scope="col">Ngày kết thúc</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i =1; ?>
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
