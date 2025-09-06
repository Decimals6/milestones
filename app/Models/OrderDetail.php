<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'foods_id',
        'orders_id',
        'notes',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'orders_id');
    }

    public function food()
    {
        return $this->belongsTo(Food::class, 'foods_id');
    }

    public function options()
    {
        return $this->hasMany(OrderDetailOption::class);
    }
}
