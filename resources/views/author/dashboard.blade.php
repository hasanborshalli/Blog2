@extends('layouts.author')

@section('title', 'Author Dashboard')
@section('page_title', 'Author Dashboard')
@section('page_subtitle', 'Manage your articles and profile')

@section('content')
    <section class="stats-grid">
        <div class="stat-card">
            <h3>Total Posts</h3>
            <p>{{ $totalPosts }}</p>
        </div>

        <div class="stat-card">
            <h3>Draft Posts</h3>
            <p>{{ $draftPosts }}</p>
        </div>

        <div class="stat-card">
            <h3>Pending Posts</h3>
            <p>{{ $pendingPosts }}</p>
        </div>

        <div class="stat-card">
            <h3>Published Posts</h3>
            <p>{{ $publishedPosts }}</p>
        </div>

        <div class="stat-card">
            <h3>Rejected Posts</h3>
            <p>{{ $rejectedPosts }}</p>
        </div>
    </section>

    <section class="panel-card">
        <div class="panel-card-header">
            <h2>Latest Posts</h2>
        </div>

        @if($latestPosts->count())
            <div class="table-wrap">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latestPosts as $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td>
                                    <span class="status-badge status-{{ $post->status }}">
                                        {{ ucfirst($post->status) }}
                                    </span>
                                </td>
                                <td>{{ $post->created_at->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="empty-text">No posts yet.</p>
        @endif
    </section>
@endsection