<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryItem;
use Illuminate\Http\Request;
use App\Models\Food;

class FoodControllerAdmin extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = CategoryItem::all();
        $foods = Food::with('categories')->get();
        return view('admin.page.food', compact('foods', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // perlu data kategori agar bisa assign pivot
        $categories = CategoryItem::all();
        return view('admin.page.food_create', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'desc' => 'required|string',
            'base_price' => 'required|numeric',
            'categories' => 'array|nullable',
        ]);

        $food = Food::create($validated);

        if ($request->has('categories')) {
            $food->categories()->sync($request->categories);
        }

        return redirect()->back()->with('success', 'Food created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
