<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


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
            'category_ids' => 'nullable|array',
            'images' => 'nullable|image|mimes:jpg,jpeg,png|max:5000',
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

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::slug($food->name) . '-' . $food->id . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('foods', $filename, 'public');
            $food->update(['image_path' => $path]);
        }

        return response()->json([
            'message' => 'Food created successfully.',
            'data' => $food->fresh()
        ]);
    }

    public function update(Request $request, Food $food)
    {
        if ($request->has('delete_image')) {
            if ($food->image_path && Storage::disk('public')->exists($food->image_path)) {
                Storage::disk('public')->delete($food->image_path);
                $food->update(['image_path' => null]);
            }

            return response()->json(['message' => 'Image deleted successfully.']);
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'base_price' => 'required|numeric',
            'description' => 'nullable|string',
            'nutrition_info' => 'nullable|string',
            'category_ids' => 'nullable|array',
            'images' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
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

        if ($request->hasFile('image')) {
            if ($food->image_path && Storage::disk('public')->exists($food->image_path)) {
                Storage::disk('public')->delete($food->image_path);
            }

            $file = $request->file('image');
            $filename = Str::slug($food->name) . '-' . $food->id . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('foods', $filename, 'public');
            $food->update(['image_path' => $path]);
        }

        return response()->json([
            'message' => 'Food updated successfully.',
            'data' => $food->fresh()
        ]);
    }

    public function destroy(Food $food)
    {
        if ($food->image_path && Storage::disk('public')->exists($food->image_path)) {
            Storage::disk('public')->delete($food->image_path);
        }

        $food->categories()->detach();
        $food->delete();

        return response()->json(['message' => 'Food deleted successfully']);
    }
}
