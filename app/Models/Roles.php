<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'fu_roles';

    protected $fillable = [
        'name',
    ];

    public function __construct(array $attributes = [])
    {
        $this->connection = session('campus_db');
        parent::__construct($attributes);
    }

    public function permissions() {
        return $this->belongsToMany(
            Permissions::class, 'role_permission', 'role_id', 'permission_id'
        );
    }
}
