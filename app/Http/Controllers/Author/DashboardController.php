<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('author.dashboard', [
            'totalPosts' => Post::where('user_id', $user->id)->count(),
            'draftPosts' => Post::where('user_id', $user->id)->where('status', 'draft')->count(),
            'pendingPosts' => Post::where('user_id', $user->id)->where('status', 'pending')->count(),
            'publishedPosts' => Post::where('user_id', $user->id)->where('status', 'published')->count(),
            'rejectedPosts' => Post::where('user_id', $user->id)->where('status', 'rejected')->count(),
            'latestPosts' => Post::where('user_id', $user->id)->latest()->take(5)->get(),
        ]);
    }
}