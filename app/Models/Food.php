<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';

    protected $fillable = ['name', 'desc', 'base_price'];

    public function categories()
    {
        return $this->belongsToMany(CategoryItem::class, 'foods_categories_list', 'food_id', 'category_item_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
