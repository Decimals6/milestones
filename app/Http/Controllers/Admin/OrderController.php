<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'payment')->latest()->get();
        return view('admin.order.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with([
            'user',
            'payment',
            'details.food',
            'details.options.foodItem'
        ])->findOrFail($id);

        return view('admin.order.show', compact('order'));
    }
}
