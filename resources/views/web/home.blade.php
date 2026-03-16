@extends('layouts.web')

@section('title', 'Community Blog')
@section('meta_description', 'Discover articles from multiple authors across tech, business, education, marketing, and
more.')

@section('content')
<section class="hero-section">
    <div class="hero-card">
        <div class="hero-text">
            <span class="hero-badge">{{ setting('site_name', 'Community Blog Platform') }}</span>
            <h1 class="hero-title">
                {{ setting('site_tagline', 'A modern multi-author publishing platform for creators, businesses, and
                communities.') }}
            </h1>
            <p class="hero-description">
                Discover fresh articles, expert perspectives, and curated stories across multiple categories.
            </p>

            <div class="hero-actions">
                @guest
                <a href="{{ route('register') }}" class="btn btn-primary">Become an Author</a>
                <a href="{{ route('login') }}" class="btn btn-secondary">Login</a>
                @endguest

                @auth
                @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Go to Admin Panel</a>
                @else
                <a href="{{ route('author.dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
                @endif
                @endauth
            </div>
        </div>
    </div>
</section>

@if($featuredPosts->count())
<section class="section-block">
    <div class="section-heading">
        <h2>Featured Posts</h2>
        <p>Handpicked articles from the latest published content.</p>
    </div>

    <div class="post-grid">
        @foreach($featuredPosts as $post)
        @include('components.post-card', ['post' => $post])
        @endforeach
    </div>
</section>
@endif

<section class="section-block">
    <div class="section-heading">
        <h2>Latest Articles</h2>
        <p>Browse the newest published posts from the community.</p>
    </div>

    @if($latestPosts->count())
    <div class="post-grid">
        @foreach($latestPosts as $post)
        @include('components.post-card', ['post' => $post])
        @endforeach
    </div>

    <div style="margin-top: 24px;">
        {{ $latestPosts->links() }}
    </div>
    @else
    <p class="empty-text">No published posts yet.</p>
    @endif
</section>
@endsection