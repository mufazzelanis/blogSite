<?php

namespace Database\Seeders;

use Database\Seeders\TagSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\PostSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TagSeeder::class,
            PostSeeder::class,
        ]);
    }
}
