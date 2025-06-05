<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultFoodItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'idDefault_Foods_Item';

    protected $fillable = [
        'foods_items_id',
        'foods_id',
    ];

    public function food()
    {
        return $this->belongsTo(Food::class, 'foods_id');
    }

    public function foodItem()
    {
        return $this->belongsTo(FoodItem::class, 'foods_items_id');
    }
}
