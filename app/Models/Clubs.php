<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clubs extends Model
{
    use HasFactory;

    protected $table = "sw_club";

    protected $fillable = [
        'name',
        'code',
        'description',
        'manager',
        'link_fb',
        'date_thanh_lap'
    ];
    public function __construct(array $attributes = [])
    {
        $this->connection = session('campus_db');
        parent::__construct($attributes);
    }
}
