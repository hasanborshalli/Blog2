@extends('layouts.admin')

@section('title', 'Settings')
@section('page_title', 'Site Settings')
@section('page_subtitle', 'Manage branding, SEO defaults, and general site configuration')

@section('content')
<section class="panel-card">
    <div class="panel-card-header">
        <h2>General Settings</h2>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data"
        style="display:flex; flex-direction:column; gap:18px;">
        @csrf
        @method('PUT')

        <div class="profile-grid">
            <div class="form-group">
                <label for="site_name" class="form-label">Site Name</label>
                <input type="text" id="site_name" name="site_name" class="form-input"
                    value="{{ old('site_name', $settings['site_name'] ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="site_tagline" class="form-label">Site Tagline</label>
                <input type="text" id="site_tagline" name="site_tagline" class="form-input"
                    value="{{ old('site_tagline', $settings['site_tagline'] ?? '') }}">
            </div>

            <div class="form-group">
                <label for="contact_email" class="form-label">Contact Email</label>
                <input type="email" id="contact_email" name="contact_email" class="form-input"
                    value="{{ old('contact_email', $settings['contact_email'] ?? '') }}">
            </div>

            <div class="form-group">
                <label for="posts_per_page" class="form-label">Posts Per Page</label>
                <input type="number" id="posts_per_page" name="posts_per_page" class="form-input" min="1" max="50"
                    value="{{ old('posts_per_page', $settings['posts_per_page'] ?? 9) }}" required>
            </div>
        </div>

        <div class="profile-grid">
            <div class="form-group">
                <label for="site_logo" class="form-label">Site Logo</label>
                <input type="file" id="site_logo" name="site_logo" class="form-input"
                    accept=".jpg,.jpeg,.png,.webp,.svg">

                @if(!empty($settings['site_logo']))
                <div style="margin-top: 12px;">
                    <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="Site Logo"
                        style="max-width: 180px; max-height: 80px; object-fit: contain; border:1px solid var(--border); border-radius:12px; padding:8px; background:#fff;">
                </div>

                <label class="checkbox-label" style="margin-top: 10px;">
                    <input type="checkbox" name="remove_site_logo" value="1">
                    <span>Remove current logo</span>
                </label>
                @endif
            </div>

            <div class="form-group">
                <label for="site_favicon" class="form-label">Site Favicon</label>
                <input type="file" id="site_favicon" name="site_favicon" class="form-input"
                    accept=".jpg,.jpeg,.png,.webp,.ico">

                @if(!empty($settings['site_favicon']))
                <div style="margin-top: 12px;">
                    <img src="{{ asset('storage/' . $settings['site_favicon']) }}" alt="Site Favicon"
                        style="width: 48px; height: 48px; object-fit: contain; border:1px solid var(--border); border-radius:12px; padding:6px; background:#fff;">
                </div>

                <label class="checkbox-label" style="margin-top: 10px;">
                    <input type="checkbox" name="remove_site_favicon" value="1">
                    <span>Remove current favicon</span>
                </label>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="seo_meta_title" class="form-label">Default SEO Meta Title</label>
            <input type="text" id="seo_meta_title" name="seo_meta_title" class="form-input"
                value="{{ old('seo_meta_title', $settings['seo_meta_title'] ?? '') }}">
        </div>

        <div class="form-group">
            <label for="seo_meta_description" class="form-label">Default SEO Meta Description</label>
            <textarea id="seo_meta_description" name="seo_meta_description" class="form-textarea"
                rows="4">{{ old('seo_meta_description', $settings['seo_meta_description'] ?? '') }}</textarea>
        </div>

        <div class="form-group">
            <label for="footer_text" class="form-label">Footer Text</label>
            <textarea id="footer_text" name="footer_text" class="form-textarea"
                rows="4">{{ old('footer_text', $settings['footer_text'] ?? '') }}</textarea>
        </div>

        <div>
            <button type="submit" class="btn btn-primary">Save Settings</button>
        </div>
    </form>
</section>
@endsection