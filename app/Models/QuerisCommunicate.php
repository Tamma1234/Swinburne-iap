<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuerisCommunicate extends Model
{
    use HasFactory;

    protected $table = "queries_communicate";

    protected $guarded;

    public function __construct(array $attributes = [])
    {
        $this->connection = session('campus_db');
        parent::__construct($attributes);
    }

    public function queries() {
        return $this->hasOne(Queries::class, 'id', 'queries_id');
    }
}
