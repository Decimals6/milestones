<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    // Di dalam FoodController.php
    public function getDetails($id)
    {
        try {
            // Ambil food beserta relasi categoryItem, dan di dalam categoryItem, ambil juga foodItems-nya
            // Kita juga ambil defaultItems untuk menandai pilihan default
            $food = Food::with(['categoriesItem.foodItems', 'defaultItems'])->findOrFail($id);

            // Ambil ID dari item-item default untuk kemudahan pengecekan di frontend
            $defaultItemIds = $food->defaultItems->pluck('food_item_id')->toArray();

            // Format data agar mudah dikonsumsi oleh JavaScript
            $response = [
                'id' => $food->id,
                'name' => $food->name,
                'base_price' => $food->base_price,
                'image_path' => asset('storage/' . $food->image_path), // Sesuaikan path-mu
                'rating' => 4.0, // Ganti dengan data rating asli
                'reviews' => 0, // Ganti dengan data review asli
                'options' => [],
                'default_ids' => $defaultItemIds,
            ];

            foreach ($food->categoriesItem as $category) {
                $response['options'][] = [
                    'category_name' => $category->name,
                    // Kamu bisa menambahkan logika untuk menentukan tipe input (radio/checkbox)
                    // Misal, dari kolom baru di tabel categories_item
                    'selection_type' => $category->selection_type ?? 'checkbox', // Contoh: 'radio' atau 'checkbox'
                    'items' => $category->foodItems->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'name' => $item->name,
                            'extra_price' => $item->extra_price,
                        ];
                    })
                ];
            }

            return response()->json($response);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Food not found'], 404);
        }
    }
}
