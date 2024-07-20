<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Post;
use App\Models\User;

class PostSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            for ($i = 0; $i < 20; $i++) {
                Post::create([
                    'user_id' => $user->id,
                    'title' => 'Post Title ' . $i,
                    'description' => 'This is the content for post ' . $i,
                ]);
            }
        }
    }
}
