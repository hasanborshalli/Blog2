@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page_title', 'Admin Dashboard')
@section('page_subtitle', 'Manage users, posts, and platform settings')

@section('content')
    <section class="stats-grid">
        <div class="stat-card">
            <h3>Total Users</h3>
            <p>{{ $totalUsers }}</p>
        </div>

        <div class="stat-card">
            <h3>Active Users</h3>
            <p>{{ $activeUsers }}</p>
        </div>

        <div class="stat-card">
            <h3>Disabled Users</h3>
            <p>{{ $disabledUsers }}</p>
        </div>

        <div class="stat-card">
            <h3>Total Posts</h3>
            <p>{{ $totalPosts }}</p>
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

        <div class="stat-card">
            <h3>Pending Comments</h3>
            <p>{{ $pendingComments }}</p>
        </div>

        <div class="stat-card">
            <h3>Unread Messages</h3>
            <p>{{ $unreadMessages }}</p>
        </div>
    </section>
@endsection