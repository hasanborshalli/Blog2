<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoCommentSeeder extends Seeder
{
    public function run(): void
    {
        $publishedPosts = Post::where('status', 'published')->take(5)->get();
        $users = User::where('status', 'active')->get();

        if ($publishedPosts->isEmpty() || $users->isEmpty()) {
            return;
        }

        foreach ($publishedPosts as $post) {
            $firstUser = $users->random();
            $secondUser = $users->random();

            $parent = Comment::create([
                'post_id' => $post->id,
                'user_id' => $firstUser->id,
                'parent_id' => null,
                'content' => 'This is a demo approved comment on the article.',
                'status' => 'approved',
            ]);

            Comment::create([
                'post_id' => $post->id,
                'user_id' => $secondUser->id,
                'parent_id' => $parent->id,
                'content' => 'This is a demo approved reply to the comment.',
                'status' => 'approved',
            ]);
        }

        $pendingPost = Post::where('status', 'published')->first();
        if ($pendingPost) {
            Comment::create([
                'post_id' => $pendingPost->id,
                'user_id' => $users->random()->id,
                'parent_id' => null,
                'content' => 'This is a demo pending comment for moderation testing.',
                'status' => 'pending',
            ]);

            Comment::create([
                'post_id' => $pendingPost->id,
                'user_id' => $users->random()->id,
                'parent_id' => null,
                'content' => 'This is another demo pending comment.',
                'status' => 'pending',
            ]);

            Comment::create([
                'post_id' => $pendingPost->id,
                'user_id' => $users->random()->id,
                'parent_id' => null,
                'content' => 'This is a rejected demo comment.',
                'status' => 'rejected',
            ]);
        }
    }
}