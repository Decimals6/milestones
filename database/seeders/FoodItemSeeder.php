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
            $items = FoodItem::factory()->count(4)->create(['food_id' => $food->id]);
            $food->defaultFoodItems()->attach($items->random(rand(1, $items->count()))->pluck('id')->toArray());
        });
    }
}
