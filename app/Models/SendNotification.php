<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendNotification extends Model
{
    use HasFactory;
    protected $table = "send_notification";

    protected $fillable = [
      'title',
      'content',
      'date_send',
      'sender',
      'nguoi_nhan',
      'nguoi_gui',
      'phong_ban'
    ];

    public function __construct(array $attributes = [])
    {
        $this->connection = session('campus_db');
        parent::__construct($attributes);
    }
}
