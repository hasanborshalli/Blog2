@extends('layouts.admin')

@section('title', 'Edit Tag')
@section('page_title', 'Edit Tag')
@section('page_subtitle', 'Update tag details')

@section('content')
<section class="panel-card">
    <div class="panel-card-header">
        <h2>Edit Tag</h2>
    </div>

    <form action="{{ route('admin.tags.update', $tag) }}" method="POST"
        style="display:flex; flex-direction:column; gap:18px;">
        @csrf
        @method('PUT')
        @include('admin.tags._form', ['tag' => $tag])
    </form>
</section>
@endsection