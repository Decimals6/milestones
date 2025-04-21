<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetailsOption extends Model
{
    use HasFactory;

    protected $fillable = ['order_detail_id', 'food_item_id'];

    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class, 'order_detail_id');
    }

    public function foodItem()
    {
        return $this->belongsTo(FoodsItem::class, 'food_item_id');
    }
}
