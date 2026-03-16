@extends('layouts.web')

@section('title', $author->name)
@section('meta_description', 'Read articles written by ' . $author->name . '.')

@section('content')
<section class="author-header-card">
    <div class="author-header-main">
        <div class="author-avatar-wrap">
            @if($author->avatar)
            <img src="{{ asset('storage/' . $author->avatar) }}" alt="{{ $author->name }}" class="author-avatar">
            @else
            <div class="author-avatar-placeholder">
                {{ strtoupper(substr($author->name, 0, 1)) }}
            </div>
            @endif
        </div>

        <div class="author-header-content">
            <h1 class="archive-title">{{ $author->name }}</h1>

            @if($author->bio)
            <p class="archive-description">{{ $author->bio }}</p>
            @endif

            <div class="author-meta-list">
                @if($author->website)
                <a href="{{ $author->website }}" target="_blank" class="text-link">Website</a>
                @endif

                @if($author->facebook)
                <a href="{{ $author->facebook }}" target="_blank" class="text-link">Facebook</a>
                @endif

                @if($author->instagram)
                <a href="{{ $author->instagram }}" target="_blank" class="text-link">Instagram</a>
                @endif

                @if($author->linkedin)
                <a href="{{ $author->linkedin }}" target="_blank" class="text-link">LinkedIn</a>
                @endif

                @if($author->twitter)
                <a href="{{ $author->twitter }}" target="_blank" class="text-link">Twitter</a>
                @endif
            </div>
        </div>
    </div>
</section>

<section class="section-block">
    <div class="section-heading">
        <h2>Published Articles</h2>
        <p>Articles written by {{ $author->name }}.</p>
    </div>

    @if($posts->count())
    <div class="post-grid">
        @foreach($posts as $post)
        @include('components.post-card', ['post' => $post])
        @endforeach
    </div>

    <div style="margin-top: 24px;">
        {{ $posts->links() }}
    </div>
    @else
    <p class="empty-text">This author has no published posts yet.</p>
    @endif
</section>
@endsection