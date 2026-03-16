<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');

        $comments = Comment::with(['post', 'user', 'parent'])
            ->when($status, fn ($query) => $query->where('status', $status))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.comments.index', compact('comments', 'status'));
    }

    public function approve(Comment $comment)
    {
        $comment->update([
            'status' => 'approved',
        ]);

        return redirect()
            ->route('admin.comments.index')
            ->with('success', 'Comment approved successfully.');
    }

    public function reject(Comment $comment)
    {
        $comment->update([
            'status' => 'rejected',
        ]);

        return redirect()
            ->route('admin.comments.index')
            ->with('success', 'Comment rejected successfully.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()
            ->route('admin.comments.index')
            ->with('success', 'Comment deleted successfully.');
    }
}