<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Condition;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'price' => $this->faker->numberBetween(100, 10000),
            'description' => fake()->realText(10),
            'img_url' => $this->faker->imageUrl(),
            'user_id' => function () {
                return User::inRandomOrder()->first()->id;
            },
            'category_id' => function () {
                return Category::inRandomOrder()->first()->id;
            },
            'condition_id' =>
            function () {
                return Condition::inRandomOrder()->first()->id;
            },
            // $this->faker->image(storage_path('app/public/images'), 640, 480, null, false),
        ];
    }
}
