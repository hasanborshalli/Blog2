@extends('layouts.admin')

@section('title', 'Posts')
@section('page_title', 'Posts Moderation')
@section('page_subtitle', 'Review and manage all submitted posts')

@section('content')
<section class="panel-card" style="margin-bottom: 20px;">
    <div class="panel-card-header">
        <h2>Filter Posts</h2>
    </div>

    <form method="GET" action="{{ route('admin.posts.index') }}"
        style="display:flex; gap:12px; flex-wrap:wrap; align-items:end;">
        <div class="form-group" style="min-width: 220px;">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="">All Statuses</option>
                <option value="draft" {{ request('status')==='draft' ? 'selected' : '' }}>Draft</option>
                <option value="pending" {{ request('status')==='pending' ? 'selected' : '' }}>Pending</option>
                <option value="published" {{ request('status')==='published' ? 'selected' : '' }}>Published</option>
                <option value="rejected" {{ request('status')==='rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Apply Filter</button>

        @if(request()->has('status') && request('status') !== '')
        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Clear</a>
        @endif
    </form>
</section>

<section class="panel-card">
    <div class="panel-card-header">
        <h2>All Posts</h2>
    </div>

    @if($posts->count())
    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th style="width: 320px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>
                        @if($post->featured_image)
                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                            style="width: 72px; height: 52px; object-fit: cover; border-radius: 10px;">
                        @else
                        <span class="empty-text">No Image</span>
                        @endif
                    </td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->user?->name }}</td>
                    <td>{{ $post->category?->name }}</td>
                    <td>
                        <span class="status-badge status-{{ $post->status }}">
                            {{ ucfirst($post->status) }}
                        </span>
                    </td>
                    <td>{{ $post->created_at->format('M d, Y') }}</td>
                    <td>
                        <div style="display:flex; gap:8px; flex-wrap:wrap;">
                            <a href="{{ route('admin.posts.show', $post) }}" class="btn btn-secondary">View</a>

                            @if($post->status !== 'published')
                            <form action="{{ route('admin.posts.approve', $post) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Approve</button>
                            </form>
                            @endif

                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this post?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger-outline">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>

                @if($post->status !== 'published')
                <tr>
                    <td colspan="7" style="background:#fafafa;">
                        <form action="{{ route('admin.posts.reject', $post) }}" method="POST"
                            style="display:flex; gap:10px; flex-wrap:wrap; align-items:end;">
                            @csrf
                            <div class="form-group" style="flex:1; min-width:260px;">
                                <label class="form-label">Rejection Reason</label>
                                <input type="text" name="rejection_reason" class="form-input"
                                    placeholder="Enter rejection reason for the author" required>
                            </div>

                            <button type="submit" class="btn btn-danger-outline">Reject Post</button>
                        </form>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        {{ $posts->links() }}
    </div>
    @else
    <p class="empty-text">No posts found.</p>
    @endif
</section>
@endsection