<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailDetail extends Model
{
    use HasFactory;
    protected $table = 'email_detail';
    protected $fillable = [
        'email',
        'password',
        'email_name',
        'department',
        'list_cc',
        'encryption',
        'host',
        'port'
    ];
    public function __construct(array $attributes = [])
    {
        $this->connection = session('campus_db');
        parent::__construct($attributes);
    }
}
