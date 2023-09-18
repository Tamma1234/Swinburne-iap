<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Golds extends Model
{
    use HasFactory;

    protected $table = "golds";

    protected $guarded;

    public function __construct(array $attributes = [])
    {
        $this->connection = session('campus_db');
        parent::__construct($attributes);
    }

    public function events()
    {
        return $this->hasOne(EventSwin::class, 'id', 'event_id');
    }
}
