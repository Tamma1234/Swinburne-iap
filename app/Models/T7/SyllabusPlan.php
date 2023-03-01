<?php

namespace App\Models\T7;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyllabusPlan extends Model
{
    use HasFactory;

    protected $table = "t7_syllabus_plan";

    public function __construct(array $attributes = [])
    {
        $this->connection = session('campus_db');
        parent::__construct($attributes);
    }
}
