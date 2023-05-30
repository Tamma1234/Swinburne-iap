<?php

namespace App\Models\Fu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'fu_room';

    protected $fillable = [
        'area_id',
        'room_name',
        'room_type',
        'description',
        'capacity',
        'valid_from',
        'is_deleted'
    ];

    public function __construct(array $attributes = [])
    {
        $this->connection = session('campus_db');
        parent::__construct($attributes);
    }

    public function areas() {
        return $this->belongsTo(Areas::class, 'area_id', 'id');
    }

    public function activity() {
        return $this->hasMany(Activitys::class, 'room_id', 'id');
    }

}
