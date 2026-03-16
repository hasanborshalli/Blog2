@extends('layouts.web')

@section('title', 'Search')
@section('meta_description', 'Search published articles across the blog.')

@section('content')
<section class="archive-header">
    <span class="archive-label">Search</span>
    <h1 class="archive-title">
        @if($query !== '')
        Results for "{{ $query }}"
        @else
        Search Articles
        @endif
    </h1>

    <p class="archive-description">
        @if($query !== '')
        Browse the articles that matched your search.
        @else
        Enter a keyword in the search box above to find articles.
        @endif
    </p>
</section>

@if($query !== '')
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
<p class="empty-text">No published posts matched your search.</p>
@endif
@endif
@endsection