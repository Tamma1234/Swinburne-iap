<?php
$data = [
    'object' => [
        'group' => 'Group',
        'user' => 'User',
        'club' => 'Club',
        'item' => 'Item',
        'event' => 'Event',
        'term' => 'Term',
        'room' => 'Room',
        'course' => 'Course',
        'query' => 'Queries',
        'fee' => 'Fee',
    ],
    'action' => [
        'a' => 'add',
        'e' => 'edit',
        'd' => 'delete',
        'dm' => 'deleteMemberClub',
        'i' => 'import',
        'ex' => 'export',
        'am' => 'addMember',
        'qe' => 'Queries',
        'fe' => 'Fee',
    ],
];
$data = json_encode($data);
$data = json_decode($data, false);

return $data;
