<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence,
            'slug' => fake()->slug,
            'body' => fake()->paragraphs(fake()->numberBetween(3, 10), true),
            'user_id' => function() {
                return User::inRandomOrder()->first()->id;
            },
            'is_public' => fake()->boolean,
            'created_at' => fake()->dateTime,
            'updated_at' => fake()->dateTime
        ];
    }
}
