<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class FoodItem extends Model
{
    use HasFactory;

    protected $table = 'foods_items';

    protected $fillable = [
        'category_item_id',
        'name',
        'extra_price',
        'is_active',
        'is_default',
    ];
    public function defaultOfFoods()
    {
        return $this->belongsToMany(Food::class, 'default_foods_item');
    }

    public function categoryItem()
    {
        return $this->belongsTo(CategoryItem::class);
    }
}
