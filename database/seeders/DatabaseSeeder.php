<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // it takes time more than 6 hours.
        // $this->call(UserSeeder::class);

        $this->call([
            PostSeeder::class,
            CommentSeeder::class,
            CategorySeeder::class,
        ]);
    }
}
