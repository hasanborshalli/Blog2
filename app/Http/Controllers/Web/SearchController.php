<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = trim((string) $request->query('q', ''));

        $posts = Post::with(['user', 'category', 'tags'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->when($query !== '', function ($builder) use ($query) {
                $builder->where(function ($inner) use ($query) {
                    $inner->where('title', 'like', "%{$query}%")
                        ->orWhere('excerpt', 'like', "%{$query}%")
                        ->orWhere('content', 'like', "%{$query}%")
                        ->orWhere('meta_title', 'like', "%{$query}%")
                        ->orWhere('meta_description', 'like', "%{$query}%");
                });
            })
            ->latest('published_at')
            ->paginate((int) setting('posts_per_page', 9))
            ->withQueryString();

        return view('web.posts.search', compact('posts', 'query'));
    }
}