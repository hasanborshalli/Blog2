<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        $validated = $request->validated();

        $post = Post::published()->findOrFail($validated['post_id']);

        if (!empty($validated['parent_id'])) {
            $parentComment = Comment::where('id', $validated['parent_id'])
                ->where('post_id', $post->id)
                ->firstOrFail();
        }

        Comment::create([
            'post_id' => $post->id,
            'user_id' => auth()->id(),
            'parent_id' => $validated['parent_id'] ?? null,
            'content' => $validated['content'],
            'status' => 'pending',
        ]);

        return back()->with('success', 'Your comment was submitted and is awaiting approval.');
    }
}