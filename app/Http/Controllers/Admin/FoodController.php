<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Category;
use Illuminate\Http\Request;

class FoodController extends Controller
{

    public function index()
    {
        $foods = Food::with('categories')->get();
        $categories = Category::all();

        return view('admin.food.index', compact('foods', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'base_price' => 'required|numeric',
            'description' => 'nullable|string',
            'nutrition_info' => 'nullable|string',
            'is_active' => 'nullable|boolean'
        ]);

        $food = Food::create([
            'name' => $validated['name'],
            'base_price' => $validated['base_price'],
            'description' => $validated['description'] ?? null,
            'nutrition_info' => $validated['nutrition_info'] ?? null,
            'is_active' => $request->has('is_active'),
        ]);

        $food->categories()->sync($request->input('category_ids', []));

        return response()->json([
            'message' => 'Food created successfully.',
            'data' => $food->fresh()
        ]);
    }

    public function update(Request $request, Food $food)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'base_price' => 'required|numeric',
            'description' => 'nullable|string',
            'nutrition_info' => 'nullable|string',
            'is_active' => 'nullable|boolean'
        ]);

        $food->update([
            'name' => $validated['name'],
            'base_price' => $validated['base_price'],
            'description' => $validated['description'] ?? null,
            'nutrition_info' => $validated['nutrition_info'] ?? null,
            'is_active' => $request->has('is_active'),
        ]);

        $food->categories()->sync($request->input('category_ids', []));

        return response()->json([
            'message' => 'Food updated successfully.',
            'data' => $food->fresh()
        ]);
    }

    public function destroy(Food $food)
    {
        $food->delete();
        return response()->json(['message' => 'Food deleted successfully.']);
    }
}
