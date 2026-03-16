@extends('layouts.author')

@section('title', 'Create Post')
@section('page_title', 'Create Post')
@section('page_subtitle', 'Write a new article and save it as draft or submit for review')

@section('content')
<section class="panel-card">
    <div class="panel-card-header">
        <h2>New Post</h2>
    </div>

    <form action="{{ route('author.posts.store') }}" method="POST" enctype="multipart/form-data"
        style="display:flex; flex-direction:column; gap:18px;">
        @csrf
        @include('author.posts._form')
    </form>
</section>
@endsection