<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    public function show(string $slug)
    {
        $post = Post::with([
                'user',
                'category',
                'tags',
                'comments' => function ($query) {
                    $query->where('status', 'approved')
                        ->whereNull('parent_id')
                        ->with([
                            'user',
                            'replies' => function ($replyQuery) {
                                $replyQuery->where('status', 'approved')
                                    ->with('user')
                                    ->latest();
                            }
                        ])
                        ->latest();
                }
            ])
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        $post->increment('views_count');

        $relatedPosts = Post::with(['user', 'category'])
            ->published()
            ->where('id', '!=', $post->id)
            ->where('category_id', $post->category_id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('web.posts.show', compact('post', 'relatedPosts'));
    }
}