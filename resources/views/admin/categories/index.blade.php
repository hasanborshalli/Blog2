@extends('layouts.admin')

@section('title', 'Categories')
@section('page_title', 'Categories')
@section('page_subtitle', 'Manage blog categories')

@section('content')
<div class="page-actions" style="margin-bottom: 20px;">
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Create Category</a>
</div>

<section class="panel-card">
    <div class="panel-card-header">
        <h2>All Categories</h2>
    </div>

    @if($categories->count())
    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Posts Count</th>
                    <th>Created</th>
                    <th style="width: 220px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>{{ $category->posts_count }}</td>
                    <td>{{ $category->created_at->format('M d, Y') }}</td>
                    <td>
                        <div style="display:flex; gap:10px; flex-wrap:wrap;">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-secondary">Edit</a>

                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger-outline">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        {{ $categories->links() }}
    </div>
    @else
    <p class="empty-text">No categories found.</p>
    @endif
</section>
@endsection