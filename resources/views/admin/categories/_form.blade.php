<div class="form-group">
    <label for="name" class="form-label">Name</label>
    <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $category->name ?? '') }}"
        required>
</div>

<div class="form-group">
    <label for="slug" class="form-label">Slug</label>
    <input type="text" id="slug" name="slug" class="form-input" value="{{ old('slug', $category->slug ?? '') }}"
        placeholder="Leave empty to auto-generate">
</div>

<div class="form-group">
    <label for="description" class="form-label">Description</label>
    <textarea id="description" name="description" class="form-textarea"
        rows="5">{{ old('description', $category->description ?? '') }}</textarea>
</div>

<div style="display:flex; gap:12px; flex-wrap:wrap;">
    <button type="submit" class="btn btn-primary">Save Category</button>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
</div>