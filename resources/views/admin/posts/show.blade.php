@extends('layouts.admin')

@section('title', $post->title)
@section('page_title', 'Post Details')
@section('page_subtitle', 'Review full article details before moderation')

@section('content')
<section class="panel-card" style="margin-bottom: 20px;">
    <div class="panel-card-header">
        <h2>{{ $post->title }}</h2>
    </div>

    <div style="display:grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap:18px; margin-bottom: 18px;">
        <div>
            <strong>Author:</strong> {{ $post->user?->name }}
        </div>
        <div>
            <strong>Category:</strong> {{ $post->category?->name }}
        </div>
        <div>
            <strong>Status:</strong>
            <span class="status-badge status-{{ $post->status }}">
                {{ ucfirst($post->status) }}
            </span>
        </div>
        <div>
            <strong>Slug:</strong> {{ $post->slug }}
        </div>
        <div>
            <strong>Created:</strong> {{ $post->created_at->format('M d, Y h:i A') }}
        </div>
        <div>
            <strong>Published At:</strong> {{ $post->published_at?->format('M d, Y') ?? '—' }}
        </div>
    </div>

    @if($post->tags->count())
    <div style="margin-bottom: 18px;">
        <strong>Tags:</strong>
        <div style="display:flex; gap:8px; flex-wrap:wrap; margin-top:8px;">
            @foreach($post->tags as $tag)
            <span class="status-badge" style="background:#eef2ff; color:#3730a3;">
                {{ $tag->name }}
            </span>
            @endforeach
        </div>
    </div>
    @endif

    @if($post->featured_image)
    <div style="margin-bottom: 18px;">
        <strong>Featured Image:</strong>
        <div style="margin-top:10px;">
            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                style="max-width: 420px; width:100%; border-radius:16px; border:1px solid var(--border);">
        </div>
    </div>
    @endif

    @if($post->excerpt)
    <div style="margin-bottom: 18px;">
        <strong>Excerpt:</strong>
        <p style="margin-top:8px; color:var(--muted);">{{ $post->excerpt }}</p>
    </div>
    @endif

    @if($post->meta_title || $post->meta_description)
    <div style="margin-bottom: 18px;">
        <strong>SEO Meta:</strong>
        <div style="margin-top:8px;">
            <p><strong>Meta Title:</strong> {{ $post->meta_title ?: '—' }}</p>
            <p><strong>Meta Description:</strong> {{ $post->meta_description ?: '—' }}</p>
        </div>
    </div>
    @endif

    @if($post->rejection_reason)
    <div class="alert alert-error" style="margin-bottom:18px;">
        <strong>Rejection Reason:</strong> {{ $post->rejection_reason }}
    </div>
    @endif

    <div style="margin-top: 20px;">
        <strong>Content:</strong>
        <div
            style="margin-top:10px; padding:18px; border:1px solid var(--border); border-radius:16px; background:#fff;">
            {!! nl2br(e($post->content)) !!}
        </div>
    </div>
</section>

<section class="panel-card">
    <div class="panel-card-header">
        <h2>Moderation Actions</h2>
    </div>

    <div style="display:flex; gap:12px; flex-wrap:wrap; margin-bottom:16px;">
        @if($post->status !== 'published')
        <form action="{{ route('admin.posts.approve', $post) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Approve and Publish</button>
        </form>
        @endif

        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST"
            onsubmit="return confirm('Are you sure you want to delete this post?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger-outline">Delete Post</button>
        </form>
    </div>

    @if($post->status !== 'published')
    <form action="{{ route('admin.posts.reject', $post) }}" method="POST"
        style="display:flex; flex-direction:column; gap:14px;">
        @csrf

        <div class="form-group">
            <label for="rejection_reason" class="form-label">Rejection Reason</label>
            <textarea name="rejection_reason" id="rejection_reason" class="form-textarea" rows="5"
                placeholder="Explain clearly why the post is being rejected" required></textarea>
        </div>

        <div>
            <button type="submit" class="btn btn-danger-outline">Reject Post</button>
        </div>
    </form>
    @endif
</section>
@endsection