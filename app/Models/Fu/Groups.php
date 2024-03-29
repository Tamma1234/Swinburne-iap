<?php

namespace App\Models\Fu;

use App\Models\T7\GradeSyllabus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    use HasFactory;

    protected $table = "fu_group";
    protected $guarded;

    public function __construct(array $attributes = [])
    {
        $this->connection = session('campus_db');
        parent::__construct($attributes);
    }

    public function syllabus() {
        return $this->hasOne(GradeSyllabus::class, 'id', 'syllabus_id');
    }

    public function activitys() {
        return $this->hasMany(Activitys::class, 'groupid', 'id');
    }
}
