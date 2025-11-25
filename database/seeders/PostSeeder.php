<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Database\Seeders\PostSeeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        // Create 50 posts
        Post::factory(20)->create()->each(function ($post) {
            // Attach random tags (1–5 tags)
            $post->tags()->attach(
                Tag::inRandomOrder()->take(rand(1, 5))->pluck('id')
            );
        });
    }
}
