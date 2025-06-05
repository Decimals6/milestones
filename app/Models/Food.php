<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $table = 'foods';
    protected $fillable = ['name', 'desc', 'base_price'];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function categories()
    {
        return $this->belongsToMany(CategoryItem::class, 'food_category_lists', 'foods_id', 'categories_item_id');
    }

    public function defaultItems()
    {
        return $this->hasMany(DefaultFoodItem::class);
    }
}
