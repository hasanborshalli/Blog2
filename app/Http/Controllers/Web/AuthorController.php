<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;

class AuthorController extends Controller
{
    public function show(string $username)
    {
        $author = User::where('username', $username)
            ->where('status', 'active')
            ->firstOrFail();

        $posts = $author->posts()
            ->with(['category', 'tags'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->paginate((int) setting('posts_per_page', 9));

        return view('web.posts.author', compact('author', 'posts'));
    }
}