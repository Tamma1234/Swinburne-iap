<?php

namespace App\Models\Fu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acitivitys extends Model
{
    use HasFactory;

    protected $table = "fu_activity";

    protected $fillable = [
        'day',
        'room_id',
        'group_name',
        'psubject_code',
        'description',
        'leader_login',
        'start_at',
        'end_at',
        'leader_login2',
        'lastmodifier_login',
        'repeat_id',
        'done',
        'lastmodified_time',
        'room_name',
        'psubject_name',
        'short_subject_name',
        'session_description',
        'tutor_login',
        'pterm_name',
        'term_id',
        'course_id',
        'psubject_id',
        'session_type',
        'psyllabus_id',
        'area_id',
        'area_name',
        'department_id',
        'noi_dung',
        'nv_sinh_vien',
        'hoc_lieu_mon',
        'nv_giang_vien',
        'tai_lieu_tk',
        'tu_hoc',
        'tl_buoi_hoc',
        'muc_tieu',
        'custom_edit',
        'session_check',
        'is_active'
    ];

    public function __construct(array $attributes = [])
    {
        $this->connection = session('campus_db');
        parent::__construct($attributes);
    }

    public function areas() {
        return $this->belongsTo(Areas::class, 'area_id', 'id');
    }
}
