<?php

namespace App\Models\Fu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLeaders extends Model
{
    use HasFactory;

    protected $table = "fu_activity_leaders";
    protected $fillable = [
        "activity_id",
        "leader_login"
    ];

    public function __construct(array $attributes = [])
    {
        $this->connection = session('campus_db');
        parent::__construct($attributes);
    }
}
