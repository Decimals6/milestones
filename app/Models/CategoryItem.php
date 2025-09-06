<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryItem extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function foodItems()
    {
        return $this->hasMany(FoodItem::class, 'categories_item_id');
    }

    public function foods()
    {
        return $this->belongsToMany(Food::class, 'food_category_lists', 'categories_item_id', 'foods_id');
    }
}
