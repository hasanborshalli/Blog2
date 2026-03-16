@extends('layouts.admin')

@section('title', 'Tags')
@section('page_title', 'Tags')
@section('page_subtitle', 'Manage blog tags')

@section('content')
<div class="page-actions" style="margin-bottom: 20px;">
    <a href="{{ route('admin.tags.create') }}" class="btn btn-primary">Create Tag</a>
</div>

<section class="panel-card">
    <div class="panel-card-header">
        <h2>All Tags</h2>
    </div>

    @if($tags->count())
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
                @foreach($tags as $tag)
                <tr>
                    <td>{{ $tag->name }}</td>
                    <td>{{ $tag->slug }}</td>
                    <td>{{ $tag->posts_count }}</td>
                    <td>{{ $tag->created_at->format('M d, Y') }}</td>
                    <td>
                        <div style="display:flex; gap:10px; flex-wrap:wrap;">
                            <a href="{{ route('admin.tags.edit', $tag) }}" class="btn btn-secondary">Edit</a>

                            <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this tag?')">
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
        {{ $tags->links() }}
    </div>
    @else
    <p class="empty-text">No tags found.</p>
    @endif
</section>
@endsection