<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSwin extends Model
{
    use HasFactory;

    protected $table = "event_swin";

    protected $fillable = [
        'start_date',
        'end_date',
        'name_event',
        'description_event',
        'phong_ban'
    ];

    public function __construct(array $attributes = [])
    {
        $this->connection = session('campus_db');
        parent::__construct($attributes);
    }
}
