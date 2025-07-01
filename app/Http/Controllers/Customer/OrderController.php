<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Pisahkan pesanan "proses" dan "selesai"
        $orders = Order::with('details.food')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($order) {
                return in_array($order->status, ['pending', 'diproses', 'dikirim'])
                    ? 'proses'
                    : 'selesai';
            });

        $proses = $orders->get('proses', collect());
        $selesai = $orders->get('selesai', collect());

        return view('Customer.orders.index', compact('proses', 'selesai'));
    }
}
