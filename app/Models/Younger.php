<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Younger extends Model
{
    use HasFactory;
    protected $table = 'Youngers';
    public $connection = 'ph';

}
