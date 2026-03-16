@extends('layouts.author')

@section('title', 'My Profile')
@section('page_title', 'My Profile')
@section('page_subtitle', 'Manage your account information, avatar, and social links')

@section('content')
<section class="panel-card" style="margin-bottom: 24px;">
    <div class="panel-card-header">
        <h2>Profile Information</h2>
    </div>

    <form action="{{ route('author.profile.update') }}" method="POST" enctype="multipart/form-data"
        style="display:flex; flex-direction:column; gap:18px;">
        @csrf
        @method('PUT')

        <div class="profile-avatar-section">
            <div class="profile-avatar-preview">
                @if($user->avatar)
                <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="profile-avatar-image">
                @else
                <div class="profile-avatar-placeholder">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                @endif
            </div>

            <div class="profile-avatar-actions">
                <div class="form-group">
                    <label for="avatar" class="form-label">Avatar</label>
                    <input type="file" id="avatar" name="avatar" class="form-input" accept=".jpg,.jpeg,.png,.webp">
                </div>

                @if($user->avatar)
                <label class="checkbox-label">
                    <input type="checkbox" name="remove_avatar" value="1">
                    <span>Remove current avatar</span>
                </label>
                @endif
            </div>
        </div>

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
                <label for="website" class="form-label">Website</label>
                <input type="url" id="website" name="website" class="form-input"
                    value="{{ old('website', $user->website) }}" placeholder="https://example.com">
            </div>

            <div class="form-group">
                <label for="facebook" class="form-label">Facebook</label>
                <input type="url" id="facebook" name="facebook" class="form-input"
                    value="{{ old('facebook', $user->facebook) }}" placeholder="https://facebook.com/username">
            </div>

            <div class="form-group">
                <label for="instagram" class="form-label">Instagram</label>
                <input type="url" id="instagram" name="instagram" class="form-input"
                    value="{{ old('instagram', $user->instagram) }}" placeholder="https://instagram.com/username">
            </div>

            <div class="form-group">
                <label for="linkedin" class="form-label">LinkedIn</label>
                <input type="url" id="linkedin" name="linkedin" class="form-input"
                    value="{{ old('linkedin', $user->linkedin) }}" placeholder="https://linkedin.com/in/username">
            </div>

            <div class="form-group">
                <label for="twitter" class="form-label">Twitter / X</label>
                <input type="url" id="twitter" name="twitter" class="form-input"
                    value="{{ old('twitter', $user->twitter) }}" placeholder="https://x.com/username">
            </div>
        </div>

        <div class="form-group">
            <label for="bio" class="form-label">Bio</label>
            <textarea id="bio" name="bio" class="form-textarea" rows="6"
                placeholder="Write a short author bio...">{{ old('bio', $user->bio) }}</textarea>
        </div>

        <div>
            <button type="submit" class="btn btn-primary">Save Profile</button>
        </div>
    </form>
</section>

<section class="panel-card">
    <div class="panel-card-header">
        <h2>Change Password</h2>
    </div>

    <form action="{{ route('author.profile.password.update') }}" method="POST"
        style="display:flex; flex-direction:column; gap:18px;">
        @csrf
        @method('PUT')

        <div class="profile-grid">
            <div class="form-group">
                <label for="current_password" class="form-label">Current Password</label>
                <input type="password" id="current_password" name="current_password" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">New Password</label>
                <input type="password" id="password" name="password" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-input"
                    required>
            </div>
        </div>

        <div>
            <button type="submit" class="btn btn-primary">Update Password</button>
        </div>
    </form>
</section>
@endsection