<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodsItem extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'category_item_id'];

    public function category()
    {
        return $this->belongsTo(CategoryItem::class, 'category_item_id');
    }
}
