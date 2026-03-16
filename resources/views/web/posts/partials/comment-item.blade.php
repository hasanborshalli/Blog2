<div class="comment-item {{ !empty($isReply) ? 'comment-reply' : '' }}">
    <div class="comment-item-header">
        <div>
            <strong>{{ $comment->user?->name ?? 'User' }}</strong>
        </div>
        <div class="comment-date">
            {{ $comment->created_at->format('M d, Y h:i A') }}
        </div>
    </div>

    <div class="comment-item-body">
        {{ $comment->content }}
    </div>

    @auth
    <div class="comment-actions">
        <button type="button" class="btn btn-secondary btn-sm"
            onclick="toggleReplyForm('reply-form-{{ $comment->id }}')">
            Reply
        </button>
    </div>

    <form id="reply-form-{{ $comment->id }}" action="{{ route('comments.store') }}" method="POST" class="reply-form"
        style="display: none; margin-top: 12px;">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <input type="hidden" name="parent_id" value="{{ $comment->id }}">

        <div class="form-group">
            <textarea name="content" class="form-textarea" rows="3" placeholder="Write your reply..."
                required>{{ old('parent_id') == $comment->id ? old('content') : '' }}</textarea>
        </div>

        <div style="margin-top: 10px;">
            <button type="submit" class="btn btn-primary">Submit Reply</button>
        </div>
    </form>
    @endauth

    @if($comment->replies->count())
    <div class="comment-replies">
        @foreach($comment->replies as $reply)
        @include('web.posts.partials.comment-item', [
        'comment' => $reply,
        'post' => $post,
        'isReply' => true
        ])
        @endforeach
    </div>
    @endif
</div>