<?php

namespace App\Models\Fu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityGroups extends Model
{
    use HasFactory;
    protected $table = "fu_activity_groups";
    protected $fillable = [
        "activity_id",
        "groupid",
        "term_id_cache",
        "group_name",
        "session_type_group"
    ];

    public function __construct(array $attributes = [])
    {
        $this->connection = session('campus_db');
        parent::__construct($attributes);
    }
}
