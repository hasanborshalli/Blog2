@extends('layouts.author')

@section('title', 'Edit Post')
@section('page_title', 'Edit Post')
@section('page_subtitle', 'Update your article content and submission status')

@section('content')
<section class="panel-card">
    <div class="panel-card-header">
        <h2>Edit Post</h2>
    </div>

    @if($post->status === 'rejected' && $post->rejection_reason)
    <div class="alert alert-error" style="margin-bottom:18px;">
        <strong>Rejection Reason:</strong> {{ $post->rejection_reason }}
    </div>
    @endif

    @if($post->status === 'published')
    <div class="alert alert-error" style="margin-bottom:18px;">
        Editing a published post will send it back for admin review.
    </div>
    @endif

    <form action="{{ route('author.posts.update', $post) }}" method="POST" enctype="multipart/form-data"
        style="display:flex; flex-direction:column; gap:18px;">
        @csrf
        @method('PUT')
        @include('author.posts._form', ['post' => $post])
    </form>
</section>
@endsection