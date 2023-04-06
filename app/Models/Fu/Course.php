<?php

namespace App\Models\Fu;

use App\Models\T7\GradeSyllabus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = "fu_course";

    protected $fillable = [
        'lastmodifier_login',
        'campus_id',
        'subject_id',
        'term_id',
        'subject_id',
        'psubject_name',
        'psubject_code',
        'num_of_credit',
        'syllabus_id',
        'syllabus_name',
        'attendance_required',
        'grade_required',
        'pterm_name',
        'num_of_group',
        'is_started'
    ];

    public function __construct(array $attributes = [])
    {
        $this->connection = session('campus_db');
        parent::__construct($attributes);
    }
    public function subject() {
        return $this->hasOne(Subjects::class, 'id', 'subject_id');
    }

    public function term() {
        return $this->hasOne(Terms::class, 'id', 'term_id');
    }

    public function syllabus() {
        return $this->hasOne(GradeSyllabus::class, 'id', 'syllabus_id');
    }
}
