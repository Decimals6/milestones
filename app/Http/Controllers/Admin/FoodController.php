<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index()
    {
        $foods = Food::all();
        return view('admin.food.index', compact('foods'));
    }

    public function create()
    {
        return view('admin.food.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'base_price' => 'required|numeric',
        ]);

        Food::create([
            'name' => $request->name,
            'base_price' => $request->base_price,
            'description' => $request->description,
            'nutrition_info' => $request->nutrition_info,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('foods.index')->with('success', 'Menu created successfully');
    }

    public function edit(Food $food)
    {
        return view('admin.food.edit', compact('food'));
    }

    public function update(Request $request, Food $food)
    {
        $request->validate([
            'name' => 'required',
            'base_price' => 'required|numeric',
        ]);

        $food->update([
            'name' => $request->name,
            'base_price' => $request->base_price,
            'description' => $request->description,
            'nutrition_info' => $request->nutrition_info,
            'is_active' => $request->has('is_active'),
        ]);
        return response()->json([
            'message' => 'Food updated successfully.',
            'data' => $food->fresh()
        ]);
    }

    public function destroy(Food $food)
    {
        try {
            $food->delete();
            return response()->json(['message' => 'Food deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete.'], 500);
        }
    }
}
