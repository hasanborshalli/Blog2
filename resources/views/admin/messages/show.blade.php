@extends('layouts.admin')

@section('title', 'Message Details')
@section('page_title', 'Message Details')
@section('page_subtitle', 'Read the full contact inquiry')

@section('content')
<section class="panel-card">
    <div class="panel-card-header">
        <h2>{{ $message->subject ?: 'No Subject' }}</h2>
    </div>

    <div class="details-grid-2" style="margin-bottom: 18px;">
        <div>
            <strong>Name:</strong> {{ $message->name }}
        </div>
        <div>
            <strong>Email:</strong> {{ $message->email }}
        </div>
        <div>
            <strong>Status:</strong>
            @if($message->is_read)
            <span class="status-badge status-published">Read</span>
            @else
            <span class="status-badge status-pending">Unread</span>
            @endif
        </div>
        <div>
            <strong>Received:</strong> {{ $message->created_at->format('M d, Y h:i A') }}
        </div>
    </div>

    <div>
        <strong>Message:</strong>
        <div
            style="margin-top:10px; padding:18px; border:1px solid var(--border); border-radius:16px; background:#fff; line-height:1.8;">
            {!! nl2br(e($message->message)) !!}
        </div>
    </div>

    <div style="display:flex; gap:10px; flex-wrap:wrap; margin-top:20px;">
        <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">Back to Inbox</a>

        @if(!$message->is_read)
        <form action="{{ route('admin.messages.read', $message) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Mark as Read</button>
        </form>
        @else
        <form action="{{ route('admin.messages.unread', $message) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-secondary">Mark as Unread</button>
        </form>
        @endif
    </div>
</section>
@endsection