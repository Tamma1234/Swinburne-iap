<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SwinGuiline extends Model
{
    use HasFactory;

    protected $table = "swin_guidline";

    protected $fillable = [
        'name',
        'group_guidline',
        'content',
        'date_create',
        'description',
        'images'
    ];

    public function __construct(array $attributes = [])
    {
        $this->connection = session('campus_db');
        parent::__construct($attributes);
    }
}
