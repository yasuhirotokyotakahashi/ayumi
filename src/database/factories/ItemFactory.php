<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Condition;
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
        // ディレクトリがなければ作成
        if (!Storage::exists('public/images')) {
            Storage::makeDirectory('public/images');
        }
        return [
            'name' => $this->faker->name,
            'price' => $this->faker->numberBetween(100, 10000),
            'description' => $this->faker->sentence,
            'img_url' => $this->faker->imageUrl(),
            'user_id' => $this->faker->numberBetween(1, 100),
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
