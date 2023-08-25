<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserClub extends Model
{
    use HasFactory;
    protected $table = "user_club";

    public function __construct(array $attributes = [])
    {
        $this->connection = session('campus_db');
        //dd($this->connection);
        parent::__construct($attributes);
    }
}
