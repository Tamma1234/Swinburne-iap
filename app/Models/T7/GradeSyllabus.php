<?php

namespace App\Models\T7;

use App\Models\Fu\Subjects;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeSyllabus extends Model
{
    use HasFactory;

    protected $table = "t7_grade_syllabus";

    public function __construct(array $attributes = [])
    {
        $this->connection = session('campus_db');
        parent::__construct($attributes);
    }
}
