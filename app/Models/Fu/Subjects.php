<?php

namespace App\Models\Fu;

use App\Models\T7\GradeSyllabus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    use HasFactory;

    protected $table = "fu_subject";

    public function __construct(array $attributes = [])
    {
        $this->connection = session('campus_db');
        parent::__construct($attributes);
    }

    public function gradeSyllabus() {
        return $this->hasMany(GradeSyllabus::class, 'subject_id', 'id');
    }

    public function departments() {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
