<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\ContactMessage;
use App\Models\Post;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'activeUsers' => User::where('status', 'active')->count(),
            'disabledUsers' => User::where('status', 'disabled')->count(),
            'totalPosts' => Post::count(),
            'pendingPosts' => Post::where('status', 'pending')->count(),
            'publishedPosts' => Post::where('status', 'published')->count(),
            'rejectedPosts' => Post::where('status', 'rejected')->count(),
            'pendingComments' => Comment::where('status', 'pending')->count(),
            'unreadMessages' => ContactMessage::where('is_read', false)->count(),
        ]);
    }
}