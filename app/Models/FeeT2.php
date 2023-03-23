<?php

namespace App\Models;

use App\Models\Fu\Terms;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeT2 extends Model
{
    use HasFactory;

    protected $table = "fee_t2";

    protected $guarded;

    public function __construct(array $attributes = [])
    {
        $this->connection = session('campus_db');
        parent::__construct($attributes);
    }

    public function terms() {
        return $this->hasMany(Terms::class, 'id', 'term');
    }
}
