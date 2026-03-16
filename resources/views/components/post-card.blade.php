<article class="post-card">
    <a href="{{ route('posts.show', $post->slug) }}" class="post-card-image-wrap">
        @if($post->featured_image)
        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="post-card-image">
        @else
        <div class="post-card-image post-card-image-placeholder">No Image</div>
        @endif
    </a>

    <div class="post-card-content">
        @if($post->category)
        <a href="{{ route('categories.show', $post->category->slug) }}" class="post-card-category">
            {{ $post->category->name }}
        </a>
        @endif

        <h3 class="post-card-title">
            <a href="{{ route('posts.show', $post->slug) }}">
                {{ $post->title }}
            </a>
        </h3>

        @if($post->excerpt)
        <p class="post-card-excerpt">
            {{ \Illuminate\Support\Str::limit($post->excerpt, 140) }}
        </p>
        @endif

        <div class="post-card-meta">
            <span>
                By
                <a href="{{ route('authors.show', $post->user->username) }}" class="text-link">
                    {{ $post->user->name }}
                </a>
            </span>
            <span>{{ $post->published_at?->format('M d, Y') }}</span>
        </div>

        @if($post->tags->count())
        <div class="post-card-tags">
            @foreach($post->tags->take(3) as $tag)
            <a href="{{ route('tags.show', $tag->slug) }}" class="post-tag-chip">
                {{ $tag->name }}
            </a>
            @endforeach
        </div>
        @endif
    </div>
</article>