<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Post;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $posts = Post::all();

        foreach ($posts as $post) {
            for ($i = 0; $i < 3; $i++) {
                Comment::create([
                    'post_id' => $post->id,
                    'user_id' => $post->user_id, // Assuming the comment is from the same user as the post
                    'content' => 'This is a comment for post ' . $post->id . ' - comment ' . $i,
                ]);
            }
        }
    }
}
