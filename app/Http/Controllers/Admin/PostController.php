<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RejectPostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');

        $posts = Post::with(['user', 'category', 'tags'])
            ->when($status, fn ($query) => $query->where('status', $status))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.posts.index', compact('posts', 'status'));
    }

    public function show(Post $post)
    {
        $post->load(['user', 'category', 'tags', 'approver']);

        return view('admin.posts.show', compact('post'));
    }

    public function approve(Post $post)
{
    if ($post->status !== 'pending') {
        return redirect()
            ->route('admin.posts.index')
            ->with('error', 'Only pending posts can be approved.');
    }

    $post->update([
        'status' => 'published',
        'approved_by' => auth()->id(),
        'approved_at' => now(),
        'published_at' => now(),
        'rejection_reason' => null,
    ]);

    return redirect()
        ->route('admin.posts.index')
        ->with('success', 'Post approved and published successfully.');
}

   public function reject(RejectPostRequest $request, Post $post)
{
    if (!in_array($post->status, ['pending', 'draft'])) {
        return redirect()
            ->route('admin.posts.index')
            ->with('error', 'This post cannot be rejected in its current state.');
    }

    $validated = $request->validated();

    $post->update([
        'status' => 'rejected',
        'approved_by' => null,
        'approved_at' => null,
        'published_at' => null,
        'rejection_reason' => $validated['rejection_reason'],
    ]);

    return redirect()
        ->route('admin.posts.index')
        ->with('success', 'Post rejected successfully.');
}

    public function destroy(Post $post)
    {
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->tags()->detach();
        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Post deleted successfully.');
    }
}