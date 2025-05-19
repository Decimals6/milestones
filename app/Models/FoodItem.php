<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'categories_item_id'
    ];

    public function categoryItem()
    {
        return $this->belongsTo(CategoryItem::class, 'categories_item_id');
    }

    public function orderDetailOptions()
    {
        return $this->hasMany(OrderDetailOption::class);
    }

    public function defaultItems()
    {
        return $this->hasMany(DefaultFoodItem::class, 'foods_items_id');
    }
}
