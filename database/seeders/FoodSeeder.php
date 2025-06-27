<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Food;
use App\Models\Category;

class FoodSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        Food::factory()->count(10)->create()->each(function ($food) use ($categories) {
            $food->categories()->attach(
                $categories->random(rand(1, $categories->count()))->pluck('id')->toArray()
            );
        });
    }
}
