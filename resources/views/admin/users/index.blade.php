@extends('layouts.admin')

@section('title', 'Users')
@section('page_title', 'Users Management')
@section('page_subtitle', 'Manage authors and administrators')

@section('content')
<section class="panel-card" style="margin-bottom: 20px;">
    <div class="panel-card-header">
        <h2>Filter Users</h2>
    </div>

    <form method="GET" action="{{ route('admin.users.index') }}"
        style="display:flex; gap:12px; flex-wrap:wrap; align-items:end;">
        <div class="form-group" style="min-width: 240px;">
            <label for="q" class="form-label">Search</label>
            <input type="text" id="q" name="q" class="form-input" value="{{ request('q') }}"
                placeholder="Name, username, or email">
        </div>

        <div class="form-group" style="min-width: 180px;">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-select">
                <option value="">All Roles</option>
                <option value="admin" {{ request('role')==='admin' ? 'selected' : '' }}>Admin</option>
                <option value="author" {{ request('role')==='author' ? 'selected' : '' }}>Author</option>
            </select>
        </div>

        <div class="form-group" style="min-width: 180px;">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="">All Statuses</option>
                <option value="active" {{ request('status')==='active' ? 'selected' : '' }}>Active</option>
                <option value="disabled" {{ request('status')==='disabled' ? 'selected' : '' }}>Disabled</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Apply Filter</button>

        @if(request('q') || request('role') || request('status'))
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Clear</a>
        @endif
    </form>
</section>

<section class="panel-card">
    <div class="panel-card-header">
        <h2>All Users</h2>
    </div>

    @if($users->count())
    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Joined</th>
                    <th style="width: 340px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                        <div style="display:flex; align-items:center; gap:12px;">
                            @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}"
                                style="width:42px; height:42px; border-radius:50%; object-fit:cover;">
                            @else
                            <div
                                style="width:42px; height:42px; border-radius:50%; background:#dbeafe; color:#1e3a8a; display:flex; align-items:center; justify-content:center; font-weight:700;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            @endif

                            <div>
                                <div style="font-weight:600;">{{ $user->name }}</div>
                                <div class="empty-text">{{ '@' . $user->username }}</div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="status-badge" style="background:#eef2ff; color:#3730a3;">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td>
                        <span class="status-badge status-{{ $user->status === 'active' ? 'published' : 'rejected' }}">
                            {{ ucfirst($user->status) }}
                        </span>
                    </td>
                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                    <td>
                        <div style="display:flex; gap:8px; flex-wrap:wrap;">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-secondary">Edit</a>

                            @if($user->status === 'active')
                            <form action="{{ route('admin.users.disable', $user) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to disable this user?')">
                                @csrf
                                <button type="submit" class="btn btn-danger-outline" {{ auth()->id() === $user->id ?
                                    'disabled' : '' }}>
                                    Disable
                                </button>
                            </form>
                            @else
                            <form action="{{ route('admin.users.enable', $user) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Enable</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        {{ $users->links() }}
    </div>
    @else
    <p class="empty-text">No users found.</p>
    @endif
</section>
@endsection