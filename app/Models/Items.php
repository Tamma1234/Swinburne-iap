<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    protected $table = "items";

    protected $fillable = [
        'name_item',
        'gold',
        'description',
        'quantity',
        'status',
        'images',
        'cate_id'
    ];

    public function __construct(array $attributes = [])
    {
        $this->connection = session('campus_db');
        parent::__construct($attributes);
    }

    public function size() {
        return $this->belongsToMany(Sizes::class, "item_size", 'item_id', 'size_id');
    }

    public function showGallery()
    {
        return $this->hasMany(ItemGallery::class, 'item_id');
    }

    public function hasCate()
    {
        return $this->belongsTo(ItemCategories::class, 'cate_id');
    }

    public function promotion() {
        return $this->belongsToMany(Promotions::class, 'item_promotion', 'item_id', 'promotion_id');
    }
}
