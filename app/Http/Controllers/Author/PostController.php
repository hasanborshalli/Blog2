<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\StorePostRequest;
use App\Http\Requests\Author\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'tags'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('author.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('author.posts.create', compact('categories', 'tags'));
    }

    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();

        $featuredImagePath = null;

        if ($request->hasFile('featured_image')) {
            $featuredImagePath = $request->file('featured_image')->store('posts', 'public');
        }

        $slug = $validated['slug'] ?: Str::slug($validated['title']);
        $slug = $this->generateUniqueSlug($slug);

        $status = $validated['submit_action'];

        $post = Post::create([
            'user_id' => auth()->id(),
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'slug' => $slug,
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'],
            'featured_image' => $featuredImagePath,
            'status' => $status,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
        ]);

        if (!empty($validated['tags'])) {
            $post->tags()->sync($validated['tags']);
        }

        return redirect()
            ->route('author.posts.index')
            ->with('success', $status === 'pending'
                ? 'Post submitted for review successfully.'
                : 'Post saved as draft successfully.');
    }

    public function show(Post $post)
    {
        abort_unless($post->user_id === auth()->id(), 403);

        return redirect()->route('author.posts.edit', $post);
    }

    public function edit(Post $post)
    {
        abort_unless($post->user_id === auth()->id(), 403);

        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('author.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        abort_unless($post->user_id === auth()->id(), 403);

        $validated = $request->validated();

        if (!empty($validated['remove_featured_image']) && $post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
            $post->featured_image = null;
        }

        if ($request->hasFile('featured_image')) {
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }

            $post->featured_image = $request->file('featured_image')->store('posts', 'public');
        }

        $slug = $validated['slug'] ?: Str::slug($validated['title']);
        $slug = $this->generateUniqueSlug($slug, $post->id);

        $newStatus = $validated['submit_action'];

if ($post->status === 'published') {
    $newStatus = 'pending';
    
}


        $post->update([
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'slug' => $slug,
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'],
            'featured_image' => $post->featured_image,
            'status' => $newStatus,
            'approved_by' => null,
            'approved_at' => null,
            'published_at' => null,
            'rejection_reason' => null,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
        ]);

        $post->tags()->sync($validated['tags'] ?? []);

        return redirect()
            ->route('author.posts.index')
            ->with('success', $newStatus === 'pending'
                ? 'Post updated and submitted for review successfully.'
                : 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        abort_unless($post->user_id === auth()->id(), 403);

        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->tags()->detach();
        $post->delete();

        return redirect()
            ->route('author.posts.index')
            ->with('success', 'Post deleted successfully.');
    }

    private function generateUniqueSlug(string $slug, ?int $ignoreId = null): string
    {
        $originalSlug = $slug;
        $count = 1;

        while (
            Post::when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}