<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{

    public function index()
    {
        $userId = auth()->id();

        $cartItems = CartItem::with('food')
            ->where('user_id', $userId)
            ->get();

        $cart = $cartItems->map(function ($item) {
            return [
                'food_id'  => $item->food_id,
                'name'     => $item->food->name,
                'price'    => $item->food->base_price,
                'quantity' => $item->quantity,
                'image'    => $item->food->image_path
                    ? asset('storage/' . $item->food->image_path)
                    : 'https://picsum.photos/seed/' . $item->food_id . '/90/90'
            ];
        });

        return view('customer.pages.cart', [
            'cart' => $cart
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'food_id' => 'required|exists:foods,id',
            'quantity' => 'nullable|integer|min:1'
        ]);

        $user = auth()->user();
        $qty = $request->input('quantity', 1);

        // Cek apakah sudah ada di cart
        $item = CartItem::where('user_id', $user->id)
            ->where('food_id', $request->food_id)
            ->first();

        if ($item) {
            $item->quantity += $qty;
            $item->save();
        } else {
            CartItem::create([
                'user_id' => $user->id,
                'food_id' => $request->food_id,
                'quantity' => $qty
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Item berhasil ditambahkan ke cart'
        ]);
    }

    // Tambah atau kurang qty
    public function update(Request $request)
    {
        $request->validate([
            'food_id' => 'required|exists:foods,id',
            'action'  => 'required|in:increment,decrement'
        ]);

        $item = CartItem::where('user_id', auth()->id())
            ->where('food_id', $request->food_id)
            ->firstOrFail();

        if ($request->action === 'increment') {
            $item->quantity++;
        } else {
            $item->quantity--;
            if ($item->quantity <= 0) {
                $item->delete();
                return response()->json(['status' => 'deleted']);
            }
        }

        $item->save();
        return response()->json(['status' => 'updated']);
    }

    // Hapus 1 item
    public function remove(Request $request)
    {
        $request->validate([
            'food_id' => 'required|integer'
        ]);

        CartItem::where('user_id', auth()->id())
            ->where('food_id', $request->food_id)
            ->delete();

        return response()->json(['status' => 'success', 'message' => 'Item removed from cart.']);
    }

    // Clear semua cart
    public function clear()
    {
        CartItem::where('user_id', auth()->id())->delete();
        return back()->with('status', 'Cart cleared.');
    }
}
