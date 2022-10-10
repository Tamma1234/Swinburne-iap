<?php
$data = [
    'campus' => ['ph','pd','pk','ps','pc','th','ht','ts','tc','tk','td','ho'],
    'campus_detail' => [
        'ph' => 'Hà Nội',
        'ps' => 'Hồ Chí Minh',
        'pd' => 'Đà Nẵng',
        'pk' => 'Tây Nguyên',
        'pc' => 'Cần Thơ',
        'ht' => 'Hitech',
    ]
];
$data = json_encode($data);
$data = json_decode($data, false);

return $data;
