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
        Post::factory(20)->create()->each(function ($post) {
            $post->tags()->attach(
                Tag::inRandomOrder()->take(rand(1, 5))->pluck('id')
            );
        });
    }
}
