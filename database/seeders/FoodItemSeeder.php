<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Food;
use App\Models\FoodItem;

class FoodItemSeeder extends Seeder
{
    public function run(): void
    {
        Food::all()->each(function ($food) {
            $items = FoodItem::factory()->count(3)->create(['food_id' => $food->id]);

            if ($items->isNotEmpty()) {
                $items->random()->update(['is_default' => true]);
            }
        });
    }
}
