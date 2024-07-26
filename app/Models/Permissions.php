<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'fu_permission';

    protected $fillable = [
        'name',
        'route_name',
        'parent_id'
    ];

    public function __construct(array $attributes = [])
    {
        $this->connection = session('campus_db');
        parent::__construct($attributes);
    }

    public function permissionChildren() {
        return $this->hasMany(Permissions::class, 'parent_id');
    }
}
