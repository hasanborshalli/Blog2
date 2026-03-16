@extends('layouts.admin')

@section('title', 'Create Tag')
@section('page_title', 'Create Tag')
@section('page_subtitle', 'Add a new tag')

@section('content')
<section class="panel-card">
    <div class="panel-card-header">
        <h2>New Tag</h2>
    </div>

    <form action="{{ route('admin.tags.store') }}" method="POST" style="display:flex; flex-direction:column; gap:18px;">
        @csrf
        @include('admin.tags._form')
    </form>
</section>
@endsection