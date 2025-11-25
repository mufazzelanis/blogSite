<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(5),
            'slug' => fake()->unique()->slug(),
            'content' => fake()->paragraph(6),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'status' => 'published',
        ];
    }
}
