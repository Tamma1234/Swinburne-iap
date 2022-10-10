<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'dra_t1_role';

    protected $fillable = [
        'role_name',
        'is_active'
    ];

    public function __construct(array $attributes = [])
    {
        $this->connection = session('campus_db');
        parent::__construct($attributes);
    }

    public function permissions() {
        return $this->belongsToMany(
            Permissions::class, 'dra_t1_role_permission', 'role_id', 'permission_id'
        );
    }
}
