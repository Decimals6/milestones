<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetailOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_details_id',
        'foods_item_id'
    ];

    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class, 'order_details_id');
    }

    public function foodItem()
    {
        return $this->belongsTo(FoodItem::class, 'foods_item_id');
    }
}
