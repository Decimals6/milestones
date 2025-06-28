<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\FoodItem;

class FoodItemController extends Controller
{
    public function index()
    {
        $foods = Food::all();
        $foodItems = FoodItem::with('food')->get();

        return view('admin.food_items.index', compact('foods', 'foodItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'extra_price' => 'required|numeric',
            'food_id' => 'required|exists:foods,id',
            'is_active' => 'nullable|boolean',
        ]);

        FoodItem::create([
            'name' => $request->name,
            'extra_price' => $request->extra_price,
            'food_id' => $request->food_id,
            'is_active' => $request->has('is_active'),
        ]);

        return response()->json(['message' => 'Food item created successfully']);
    }

    public function update(Request $request, FoodItem $foodItem)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'extra_price' => 'required|numeric',
            'food_id' => 'required|exists:foods,id',
            'is_active' => 'nullable|boolean',
        ]);

        $foodItem->update([
            'name' => $request->name,
            'extra_price' => $request->extra_price,
            'food_id' => $request->food_id,
            'is_active' => $request->has('is_active'),
        ]);

        return response()->json(['message' => 'Food item updated successfully']);
    }

    public function destroy(FoodItem $foodItem)
    {
        $foodItem->delete();

        return response()->json(['message' => 'Food item deleted successfully']);
    }
}
