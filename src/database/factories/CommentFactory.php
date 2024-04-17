<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
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
            'user_id' => function () {
                return User::inRandomOrder()->first()->id;
            },
            'item_id' => function () {
                return Item::inRandomOrder()->first()->id;
            },
            'comment' => fake()->sentence(),
        ];
    }
}
