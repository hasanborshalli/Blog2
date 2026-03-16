@extends('layouts.web')

@section('title', '#' . $tag->name)
@section('meta_description', 'Browse published articles tagged with ' . $tag->name . '.')

@section('content')
<section class="archive-header">
    <span class="archive-label">Tag</span>
    <h1 class="archive-title">#{{ $tag->name }}</h1>
    <p class="archive-description">Articles associated with this topic tag.</p>
</section>

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
<p class="empty-text">No published posts found for this tag.</p>
@endif
@endsection