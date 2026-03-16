@extends('layouts.admin')

@section('title', 'Edit Category')
@section('page_title', 'Edit Category')
@section('page_subtitle', 'Update category details')

@section('content')
<section class="panel-card">
    <div class="panel-card-header">
        <h2>Edit Category</h2>
    </div>

    <form action="{{ route('admin.categories.update', $category) }}" method="POST"
        style="display:flex; flex-direction:column; gap:18px;">
        @csrf
        @method('PUT')
        @include('admin.categories._form', ['category' => $category])
    </form>
</section>
@endsection