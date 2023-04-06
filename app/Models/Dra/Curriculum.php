<?php

namespace App\Models\Dra;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    protected $table = "dra_curriculum";
    protected $guarded;

    public function __construct(array $attributes = [])
    {
        $this->connection = session('campus_db');
        parent::__construct($attributes);
    }

}
