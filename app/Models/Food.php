<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';

    protected $fillable = [
        'name',
        'description',
        'base_price',
        'image_path',
        'nutrition_info',
        'is_active',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'foods_categories_list');
    }

    public function items()
    {
        return $this->hasMany(FoodItem::class);
    }
}
