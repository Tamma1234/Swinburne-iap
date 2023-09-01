<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table>
    <thead>
    <tr>
        <th>STT</th>
        <th>User Code</th>
        <th>Full Name</th>
        <th>Name Event</th>
        <th>Relatives Friends</th>
        <th>Gold</th>
        <th>Active</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    @foreach($events as $item)
        <?php $name_event = \App\Models\EventSwin::where('id', $item->event_id)->first()->name_event;
        ?>
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $item->user_code }}</td>
            <td>{{ $item->full_name }}</td>
            <td>{{ $name_event }}</td>
            <td>{{ $item->gold }}</td>
            <td>{{ $item->relatives }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>


