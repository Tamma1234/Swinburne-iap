<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotions extends Model
{
    use HasFactory;

    protected $table = "promotions";
    protected $fillable = [
        'name',
        'code',
        'start_date',
        'end_date',
        'percent'
    ];
    public function __construct(array $attributes = [])
    {
        $this->connection = session('campus_db');
        parent::__construct($attributes);
    }

    // Hàm size để liên kết table product vs table size
    public function item()
    {
        return $this->belongsToMany(Items::class, 'item_promotion', 'promotion_id', 'item_id');
    }
}
