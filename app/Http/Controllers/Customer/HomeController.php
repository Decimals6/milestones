<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categoriesTop = Category::with(['foods' => function ($query) {
            $query->where('is_active', 1)->inRandomOrder();
        }])
            ->withCount('foods')
            ->orderByDesc('foods_count')
            ->take(2)
            ->get()
            ->map(function ($category) {
                $category->foods = $category->foods->take(3);
                return $category;
            });

        return view('customer.pages.home', compact('categoriesTop'));
    }
}
