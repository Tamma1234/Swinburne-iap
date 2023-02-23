<?php

namespace App\Models\T7;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseResult extends Model
{
    use HasFactory;

    protected $table = "t7_course_result";

    public function __construct(array $attributes = [])
    {
        $this->connection = session('campus_db');
        parent::__construct($attributes);
    }
}
