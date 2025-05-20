<?php

namespace App\Models;

use App\Models\Dra\Curriculum;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, SoftDeletes, HasFactory, Notifiable;

    protected $table = 'fu_user';

    protected $guarded;

    public function __construct(array $attributes = [])
    {
        $this->connection = session('campus_db');
        parent::__construct($attributes);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'user_pass',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'user_email_verified_at' => 'datetime',
    ];

    public function offices()
    {
        return $this->belongsToMany(Office::class, 'dra_user_office',
            'user_id', 'office_id');
    }
    public function roles()
    {
        return $this->belongsToMany(Roles::class, 'fu_user_role', 'user_id', 'role_id');
    }


    public function curriculum()
    {
        return $this->hasOne(Curriculum::class, 'id', 'curriculum_id');
    }

    public function checkRolePermisson($checkOffice)
    {
        $roles = auth()->user()->roles;
        foreach ($roles as $role) {
            $permission = $role->permissions;

            if ($permission->contains('route_name', $checkOffice)) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function checkUserLevel($checkLevel)
    {
        dd($checkLevel);
    }
}
