<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Food;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $selectedName = $request->query('name', 'All Categories');

        if ($selectedName === 'All Categories') {
            $foods = Food::with('categories')
                ->where('is_active', '1')
                ->get();
        } else {
            $foods = Food::where('is_active', '1')
                ->whereHas('categories', function ($q) use ($selectedName) {
                    $q->where('name', $selectedName);
                })
                ->get();
        }

        return view('Customer.pages.categories', compact('categories', 'foods', 'selectedName'));
    }
}
