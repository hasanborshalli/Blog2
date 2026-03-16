@extends('layouts.admin')

@section('title', 'Comments')
@section('page_title', 'Comments Moderation')
@section('page_subtitle', 'Review, approve, reject, and manage comments')

@section('content')
<section class="panel-card" style="margin-bottom: 20px;">
    <div class="panel-card-header">
        <h2>Filter Comments</h2>
    </div>

    <form method="GET" action="{{ route('admin.comments.index') }}"
        style="display:flex; gap:12px; flex-wrap:wrap; align-items:end;">
        <div class="form-group" style="min-width: 220px;">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="">All Statuses</option>
                <option value="pending" {{ request('status')==='pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status')==='approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ request('status')==='rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Apply Filter</button>

        @if(request()->has('status') && request('status') !== '')
        <a href="{{ route('admin.comments.index') }}" class="btn btn-secondary">Clear</a>
        @endif
    </form>
</section>

<section class="panel-card">
    <div class="panel-card-header">
        <h2>All Comments</h2>
    </div>

    @if($comments->count())
    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Post</th>
                    <th>Type</th>
                    <th>Content</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th style="width: 320px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->user?->name }}</td>
                    <td>
                        @if($comment->post)
                        {{ $comment->post->title }}
                        @else
                        <span class="empty-text">Post removed</span>
                        @endif
                    </td>
                    <td>{{ $comment->parent_id ? 'Reply' : 'Comment' }}</td>
                    <td style="max-width: 320px;">{{ \Illuminate\Support\Str::limit($comment->content, 120) }}</td>
                    <td>
                        <span class="status-badge status-{{ $comment->status }}">
                            {{ ucfirst($comment->status) }}
                        </span>
                    </td>
                    <td>{{ $comment->created_at->format('M d, Y h:i A') }}</td>
                    <td>
                        <div style="display:flex; gap:8px; flex-wrap:wrap;">
                            @if($comment->status !== 'approved')
                            <form action="{{ route('admin.comments.approve', $comment) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Approve</button>
                            </form>
                            @endif

                            @if($comment->status !== 'rejected')
                            <form action="{{ route('admin.comments.reject', $comment) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-secondary">Reject</button>
                            </form>
                            @endif

                            <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this comment?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger-outline">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        {{ $comments->links() }}
    </div>
    @else
    <p class="empty-text">No comments found.</p>
    @endif
</section>
@endsection