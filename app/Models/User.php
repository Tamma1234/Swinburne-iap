<?php

namespace App\Models;

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
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_pass',
        'user_login',
        'user_surname',
        'user_middlename',
        'user_givenname',
        'user_email',
        'user_code_au',
        'cmt',
        'alternative_code',
        'user_status',
        'ngaycap',
        'campus_id',
        'office_id',
        'password'
    ];

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

    public function offices() {
        return $this->belongsToMany(Office::class, 'dra_user_office',
            'user_id', 'office_id');
    }

    public function roles() {
        return $this->belongsToMany(Roles::class, 'dra_t1_user_role', 'user_id', 'role_id');
    }

    public function checkRolePermisson ($checkOffice) {
        $roles = auth()->user()->roles;
        foreach ($roles as $role) {
            $permission = Permissions::find($role->id);
            if ($permission->permission_name == $checkOffice) {
                return true;
            } else {
                return false;
            }
        }
//        foreach ($offices as $office) {
//            $campus = Campus::find($office->id);
//            if ($campus->campus_code == $checkOffice) {
//                return true;
//            }
//        }

        return false;
    }

    public function checkUserLevel($checkLevel) {
        dd($checkLevel);
    }
}
