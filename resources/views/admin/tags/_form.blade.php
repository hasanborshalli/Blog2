<div class="form-group">
    <label for="name" class="form-label">Name</label>
    <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $tag->name ?? '') }}" required>
</div>

<div class="form-group">
    <label for="slug" class="form-label">Slug</label>
    <input type="text" id="slug" name="slug" class="form-input" value="{{ old('slug', $tag->slug ?? '') }}"
        placeholder="Leave empty to auto-generate">
</div>

<div style="display:flex; gap:12px; flex-wrap:wrap;">
    <button type="submit" class="btn btn-primary">Save Tag</button>
    <a href="{{ route('admin.tags.index') }}" class="btn btn-secondary">Cancel</a>
</div>