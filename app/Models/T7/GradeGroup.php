<?php

namespace App\Models\T7;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeGroup extends Model
{
    use HasFactory;

    protected $table = "t7_grade_group";

    public function __construct(array $attributes = [])
    {
        $this->connection = session('campus_db');
        parent::__construct($attributes);
    }
}
