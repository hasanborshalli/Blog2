@extends('layouts.web')

@section('title', $category->name . ' Posts')
@section('meta_description', 'Browse published articles in the ' . $category->name . ' category.')

@section('content')
<section class="archive-header">
    <span class="archive-label">Category</span>
    <h1 class="archive-title">{{ $category->name }}</h1>

    @if($category->description)
    <p class="archive-description">{{ $category->description }}</p>
    @endif
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
<p class="empty-text">No published posts found in this category.</p>
@endif
@endsection