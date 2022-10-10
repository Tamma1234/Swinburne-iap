<?php

namespace App\Models\Fu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    use HasFactory;

    protected $table = 'fu_campus';
    protected $connection = 'ho';

//    public function __construct(array $attributes = [])
//    {
//        $this->connection = session('campus_db');
//        parent::__construct($attributes);
//    }
}
