<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryItem extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function foods()
    {
        return $this->belongsToMany(Food::class, 'foods_categories_list', 'category_item_id', 'food_id');
    }

    public function foodsItems()
    {
        return $this->hasMany(FoodsItem::class, 'category_item_id');
    }
}
