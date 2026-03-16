@php
$selectedTags = old('tags', isset($post) ? $post->tags->pluck('id')->toArray() : []);
@endphp

<div class="form-group">
    <label for="title" class="form-label">Title</label>
    <input type="text" id="title" name="title" class="form-input" value="{{ old('title', $post->title ?? '') }}"
        required>
</div>

<div class="form-group">
    <label for="slug" class="form-label">Slug</label>
    <input type="text" id="slug" name="slug" class="form-input" value="{{ old('slug', $post->slug ?? '') }}"
        placeholder="Leave empty to auto-generate from title">
</div>

<div class="form-group">
    <label for="excerpt" class="form-label">Excerpt</label>
    <textarea id="excerpt" name="excerpt" class="form-textarea" rows="4"
        placeholder="Short summary of the article">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
</div>

<div class="form-group">
    <label for="content" class="form-label">Content</label>
    <textarea id="content" name="content" class="form-textarea" rows="12"
        required>{{ old('content', $post->content ?? '') }}</textarea>
</div>

<div class="form-group">
    <label for="category_id" class="form-label">Category</label>
    <select id="category_id" name="category_id" class="form-select" required>
        <option value="">Select Category</option>
        @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ (string) old('category_id', $post->category_id ?? '') === (string)
            $category->id ? 'selected' : '' }}
            >
            {{ $category->name }}
        </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="tags" class="form-label">Tags</label>
    <select id="tags" name="tags[]" class="form-select" multiple style="min-height: 160px;">
        @foreach($tags as $tag)
        <option value="{{ $tag->id }}" {{ in_array($tag->id, $selectedTags) ? 'selected' : '' }}
            >
            {{ $tag->name }}
        </option>
        @endforeach
    </select>
    <small class="empty-text">Hold Ctrl (or Cmd on Mac) to select multiple tags.</small>
</div>

<div class="form-group">
    <label for="featured_image" class="form-label">Featured Image</label>
    <input type="file" id="featured_image" name="featured_image" class="form-input" accept=".jpg,.jpeg,.png,.webp">
</div>

@if(isset($post) && $post->featured_image)
<div class="form-group">
    <label class="form-label">Current Featured Image</label>
    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
        style="width: 180px; height: 120px; object-fit: cover; border-radius: 14px; border:1px solid var(--border);">

    <label class="checkbox-label" style="margin-top: 10px;">
        <input type="checkbox" name="remove_featured_image" value="1">
        <span>Remove current image</span>
    </label>
</div>
@endif

<div class="form-group">
    <label for="meta_title" class="form-label">Meta Title</label>
    <input type="text" id="meta_title" name="meta_title" class="form-input"
        value="{{ old('meta_title', $post->meta_title ?? '') }}">
</div>

<div class="form-group">
    <label for="meta_description" class="form-label">Meta Description</label>
    <textarea id="meta_description" name="meta_description" class="form-textarea"
        rows="4">{{ old('meta_description', $post->meta_description ?? '') }}</textarea>
</div>

<div style="display:flex; gap:12px; flex-wrap:wrap; margin-top: 10px;">
    <button type="submit" name="submit_action" value="draft" class="btn btn-secondary">
        Save as Draft
    </button>

    <button type="submit" name="submit_action" value="pending" class="btn btn-primary">
        Submit for Review
    </button>
</div>