<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodItem extends Model
{
    use HasFactory;

    protected $table = 'foods_items';

    protected $fillable = [
        'food_id',
        'name',
        'extra_price',
        'is_active',
        'is_default',
    ];

    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}
