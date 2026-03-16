@extends('layouts.admin')

@section('title', 'Create Category')
@section('page_title', 'Create Category')
@section('page_subtitle', 'Add a new blog category')

@section('content')
<section class="panel-card">
    <div class="panel-card-header">
        <h2>New Category</h2>
    </div>

    <form action="{{ route('admin.categories.store') }}" method="POST"
        style="display:flex; flex-direction:column; gap:18px;">
        @csrf
        @include('admin.categories._form')
    </form>
</section>
@endsection