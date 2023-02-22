<?php

namespace App\Models\Fu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Terms extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "fu_term";

    protected $fillable = [
        'term_name',
        'ordering',
        'startday',
        'endday',
        'phat_sinh_phi_ky',
        'phat_sinh_phi_gc'
    ];

    public function __construct(array $attributes = [])
    {
        $this->connection = session('campus_db');
        parent::__construct($attributes);
    }
}
