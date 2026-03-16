@extends('layouts.author')

@section('title', 'My Posts')
@section('page_title', 'My Posts')
@section('page_subtitle', 'Create, edit, and manage your articles')

@section('content')
<div class="page-actions" style="margin-bottom: 20px;">
    <a href="{{ route('author.posts.create') }}" class="btn btn-primary">Create New Post</a>
</div>

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
                    <th>Category</th>
                    <th>Status</th>
                    <th>Tags</th>
                    <th>Created</th>
                    <th style="width: 220px;">Actions</th>
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
                    <td>{{ $post->category?->name }}</td>
                    <td>
                        <span class="status-badge status-{{ $post->status }}">
                            {{ ucfirst($post->status) }}
                        </span>
                    </td>
                    <td>
                        @if($post->tags->count())
                        <div style="display:flex; flex-wrap:wrap; gap:6px;">
                            @foreach($post->tags as $tag)
                            <span class="status-badge" style="background:#eef2ff; color:#3730a3;">
                                {{ $tag->name }}
                            </span>
                            @endforeach
                        </div>
                        @else
                        <span class="empty-text">No Tags</span>
                        @endif
                    </td>
                    <td>{{ $post->created_at->format('M d, Y') }}</td>
                    <td>
                        <div style="display:flex; gap:10px; flex-wrap:wrap;">
                            <a href="{{ route('author.posts.edit', $post) }}" class="btn btn-secondary">Edit</a>

                            <form action="{{ route('author.posts.destroy', $post) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this post?')">
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
        {{ $posts->links() }}
    </div>
    @else
    <p class="empty-text">You have not created any posts yet.</p>
    @endif
</section>
@endsection