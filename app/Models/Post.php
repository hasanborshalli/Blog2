<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
    'user_id',
    'category_id',
    'approved_by',
    'title',
    'slug',
    'excerpt',
    'content',
    'featured_image',
    'status',
    'rejection_reason',
    'published_at',
    'approved_at',
    'meta_title',
    'meta_description',
    'views_count',
];
protected $casts = [
    'published_at' => 'datetime',
    'approved_at' => 'datetime',
];
public function user()
{
    return $this->belongsTo(User::class);
}

public function category()
{
    return $this->belongsTo(Category::class);
}

public function approver()
{
    return $this->belongsTo(User::class, 'approved_by');
}

public function tags()
{
    return $this->belongsToMany(Tag::class);
}

public function comments()
{
    return $this->hasMany(Comment::class);
}
public function scopePublished($query)
{
    return $query->where('status', 'published')
        ->whereNotNull('published_at')
        ->where('published_at', '<=', now());
}
}