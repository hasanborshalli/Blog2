@extends('layouts.admin')

@section('title', 'Messages')
@section('page_title', 'Contact Messages')
@section('page_subtitle', 'Review inquiries sent from the contact form')

@section('content')
<section class="panel-card">
    <div class="panel-card-header">
        <h2>Inbox</h2>
    </div>

    @if($messages->count())
    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Received</th>
                    <th style="width: 320px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $message)
                <tr>
                    <td>
                        @if($message->is_read)
                        <span class="status-badge status-published">Read</span>
                        @else
                        <span class="status-badge status-pending">Unread</span>
                        @endif
                    </td>
                    <td>{{ $message->name }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ $message->subject ?: '—' }}</td>
                    <td>{{ $message->created_at->format('M d, Y h:i A') }}</td>
                    <td>
                        <div style="display:flex; gap:8px; flex-wrap:wrap;">
                            <a href="{{ route('admin.messages.show', $message) }}" class="btn btn-secondary">View</a>

                            @if(!$message->is_read)
                            <form action="{{ route('admin.messages.read', $message) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Mark Read</button>
                            </form>
                            @else
                            <form action="{{ route('admin.messages.unread', $message) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-secondary">Mark Unread</button>
                            </form>
                            @endif

                            <form action="{{ route('admin.messages.destroy', $message) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this message?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger-outline">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        {{ $messages->links() }}
    </div>
    @else
    <p class="empty-text">No messages found.</p>
    @endif
</section>
@endsection