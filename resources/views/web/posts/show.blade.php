@extends('layouts.web')

@section('title', $post->meta_title ?: $post->title)
@section('meta_description', $post->meta_description ?: ($post->excerpt ?: 'Read this article on our community blog.'))

@section('content')
<article class="single-post-layout">
    <div class="single-post-main">
        <header class="single-post-header">
            @if($post->category)
            <a href="{{ route('categories.show', $post->category->slug) }}" class="post-card-category">
                {{ $post->category->name }}
            </a>
            @endif

            <h1 class="single-post-title">{{ $post->title }}</h1>

            <div class="single-post-meta">
                <span>
                    By
                    @if($post->user && $post->user->username)
                    <a href="{{ route('authors.show', $post->user->username) }}" class="text-link">
                        {{ $post->user->name }}
                    </a>
                    @else
                    {{ $post->user?->name }}
                    @endif
                </span>
                <span>{{ $post->published_at?->format('M d, Y') }}</span>
                <span>{{ $post->views_count }} views</span>
            </div>

            @if($post->excerpt)
            <p class="single-post-excerpt">{{ $post->excerpt }}</p>
            @endif
        </header>

        @if($post->featured_image)
        <div class="single-post-image-wrap">
            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                class="single-post-image">
        </div>
        @endif

        <div class="single-post-content">
            {!! nl2br(e($post->content)) !!}
        </div>

        @if($post->tags->count())
        <div class="single-post-tags">
            <h3>Tags</h3>
            <div class="post-card-tags">
                @foreach($post->tags as $tag)
                <a href="{{ route('tags.show', $tag->slug) }}" class="post-tag-chip">
                    {{ $tag->name }}
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <section class="comments-section">
            <div class="section-heading">
                <h2>Comments</h2>
                <p>Join the discussion around this article.</p>
            </div>

            @auth
            <div class="comment-form-card">
                <form action="{{ route('comments.store') }}" method="POST"
                    style="display:flex; flex-direction:column; gap:14px;">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">

                    <div class="form-group">
                        <label for="content" class="form-label">Leave a Comment</label>
                        <textarea name="content" id="content" class="form-textarea" rows="5"
                            placeholder="Write your comment here..."
                            required>{{ old('parent_id') ? '' : old('content') }}</textarea>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary">Submit Comment</button>
                    </div>
                </form>
            </div>
            @else
            <div class="comment-login-box">
                <p>You need to be logged in to comment.</p>
                <div style="display:flex; gap:10px; flex-wrap:wrap; margin-top:10px;">
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
                </div>
            </div>
            @endauth

            <div class="comments-list">
                @forelse($post->comments as $comment)
                @include('web.posts.partials.comment-item', ['comment' => $comment, 'post' => $post])
                @empty
                <p class="empty-text">No approved comments yet. Be the first to join the discussion.</p>
                @endforelse
            </div>
        </section>
    </div>

    <aside class="single-post-sidebar">
        <div class="sidebar-card">
            <h3>About the Author</h3>
            <p><strong>{{ $post->user?->name }}</strong></p>

            @if($post->user?->bio)
            <p class="sidebar-card-text">{{ $post->user->bio }}</p>
            @endif

            @if($post->user?->username)
            <a href="{{ route('authors.show', $post->user->username) }}" class="text-link">
                View author profile
            </a>
            @endif
        </div>

        @if($relatedPosts->count())
        <div class="sidebar-card">
            <h3>Related Posts</h3>

            <div class="related-posts-list">
                @foreach($relatedPosts as $relatedPost)
                <a href="{{ route('posts.show', $relatedPost->slug) }}" class="related-post-item">
                    {{ $relatedPost->title }}
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </aside>
</article>
@endsection

@push('scripts')
<script>
    function toggleReplyForm(id) {
        const form = document.getElementById(id);
        if (!form) return;
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }
</script>
@endpush