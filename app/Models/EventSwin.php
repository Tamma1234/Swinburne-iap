<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSwin extends Model
{
    use HasFactory;

    protected $table = "event_swin";

    protected $fillable = [
        'department',
        'start_date',
        'end_date',
        'name_event',
        'description_event',
        'type_person',
        'gold'
    ];

    public function __construct(array $attributes = [])
    {
        $this->connection = session('campus_db');
        parent::__construct($attributes);
    }

    public function students(){
        return $this->hasMany(StudentEvent::class, 'event_id', 'id');
    }
}
