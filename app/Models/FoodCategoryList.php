<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodCategoryList extends Model
{
    use HasFactory;

    protected $fillable = [
        'categories_item_id',
        'foods_id',
    ];

    public function categoryItem()
    {
        return $this->belongsTo(CategoryItem::class, 'categories_item_id');
    }

    public function food()
    {
        return $this->belongsTo(Food::class, 'foods_id');
    }
}
