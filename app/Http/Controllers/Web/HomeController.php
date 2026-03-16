<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPosts = Post::with(['user', 'category', 'tags'])
    ->published()
    ->latest('published_at')
    ->take(3)
    ->get();

$latestPosts = Post::with(['user', 'category', 'tags'])
    ->published()
    ->latest('published_at')
    ->paginate((int) setting('posts_per_page', 9));

        return view('web.home', compact('featuredPosts', 'latestPosts'));
    }
}