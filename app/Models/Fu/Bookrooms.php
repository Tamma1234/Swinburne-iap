<?php

namespace App\Models\Fu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookrooms extends Model
{
    use HasFactory;

    protected $table = "fu_book_rooms";

    protected $fillable = [
        'day',
        'room_id',
        'description',
        'leader_login',
        'start_at',
        'end_at',
        'groupid',
        'room_name',
        'term_id',
        'course_id',
        'psubject_id',
        'session_type',
        'psyllabus_id',
        'area_id',
        'is_active',
        'des_cancel_room'
    ];

    public function __construct(array $attributes = [])
    {
        $this->connection = session('campus_db');
        parent::__construct($attributes);
    }

    public function areas() {
        return $this->belongsTo(Areas::class, 'area_id', 'id');
    }

    public function subjects() {
        return $this->belongsTo(Subjects::class, 'psubject_id', 'id');
    }

    public function groups() {
        return $this->belongsTo(Groups::class, 'groupid', 'id');
    }
}
