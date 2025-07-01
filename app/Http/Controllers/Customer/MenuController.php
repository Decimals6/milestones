<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\CategoryFood;
use App\Models\Food;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua kategori untuk tab
        $categories = ['All'] + CategoryFood::pluck('name')->toArray();

        // Ambil kategori aktif dari URL
        $active = $request->get('category', 'All');

        // Query dasar: hanya produk aktif
        $query = Food::where('is_active', 1);

        // Jika bukan "All", tambahkan filter kategori
        if ($active !== 'All') {
            $categoryId = CategoryFood::where('name', $active)->value('id');
            $query->where('category_food_id', $categoryId);
        }

        // Eksekusi query
        $foods = $query->get();

        return view('customer.pages.menu', compact('categories', 'active', 'foods'));
    }
}
