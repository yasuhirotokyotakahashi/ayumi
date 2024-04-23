<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CategoryItem>
 */
class CategoryItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'category_id' => function () {
                return Category::inRandomOrder()->first()->id;
            },
            'item_id' => function () {
                return Item::inRandomOrder()->first()->id;
            },
        ];
    }
}
