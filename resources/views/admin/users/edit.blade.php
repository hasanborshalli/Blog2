@extends('layouts.admin')

@section('title', 'Edit User')
@section('page_title', 'Edit User')
@section('page_subtitle', 'Update account details, role, and status')

@section('content')
<section class="panel-card">
    <div class="panel-card-header">
        <h2>Edit User</h2>
    </div>

    <form action="{{ route('admin.users.update', $user) }}" method="POST"
        style="display:flex; flex-direction:column; gap:18px;">
        @csrf
        @method('PUT')

        <div class="profile-grid">
            <div class="form-group">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $user->name) }}"
                    required>
            </div>

            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-input"
                    value="{{ old('username', $user->username) }}" required>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" name="email" class="form-input" value="{{ old('email', $user->email) }}"
                    required>
            </div>

            <div class="form-group">
                <label for="role" class="form-label">Role</label>
                <select id="role" name="role" class="form-select" required>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="author" {{ old('role', $user->role) === 'author' ? 'selected' : '' }}>Author</option>
                </select>
            </div>

            <div class="form-group">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-select" required>
                    <option value="active" {{ old('status', $user->status) === 'active' ? 'selected' : '' }}>Active
                    </option>
                    <option value="disabled" {{ old('status', $user->status) === 'disabled' ? 'selected' : ''
                        }}>Disabled</option>
                </select>
            </div>

            <div class="form-group">
                <label for="website" class="form-label">Website</label>
                <input type="url" id="website" name="website" class="form-input"
                    value="{{ old('website', $user->website) }}" placeholder="https://example.com">
            </div>

            <div class="form-group">
                <label for="facebook" class="form-label">Facebook</label>
                <input type="url" id="facebook" name="facebook" class="form-input"
                    value="{{ old('facebook', $user->facebook) }}">
            </div>

            <div class="form-group">
                <label for="instagram" class="form-label">Instagram</label>
                <input type="url" id="instagram" name="instagram" class="form-input"
                    value="{{ old('instagram', $user->instagram) }}">
            </div>

            <div class="form-group">
                <label for="linkedin" class="form-label">LinkedIn</label>
                <input type="url" id="linkedin" name="linkedin" class="form-input"
                    value="{{ old('linkedin', $user->linkedin) }}">
            </div>

            <div class="form-group">
                <label for="twitter" class="form-label">Twitter / X</label>
                <input type="url" id="twitter" name="twitter" class="form-input"
                    value="{{ old('twitter', $user->twitter) }}">
            </div>
        </div>

        <div class="form-group">
            <label for="bio" class="form-label">Bio</label>
            <textarea id="bio" name="bio" class="form-textarea" rows="6">{{ old('bio', $user->bio) }}</textarea>
        </div>

        @if(auth()->id() === $user->id)
        <div class="alert alert-error">
            You are editing your own account. You cannot disable yourself or remove your own admin role.
        </div>
        @endif

        <div style="display:flex; gap:12px; flex-wrap:wrap;">
            <button type="submit" class="btn btn-primary">Save User</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</section>
@endsection