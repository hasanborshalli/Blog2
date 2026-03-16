<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(15);

        return view('admin.messages.index', compact('messages'));
    }

    public function show(ContactMessage $message)
    {
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('admin.messages.show', compact('message'));
    }

    public function markRead(ContactMessage $message)
    {
        $message->update(['is_read' => true]);

        return redirect()
            ->route('admin.messages.index')
            ->with('success', 'Message marked as read.');
    }

    public function markUnread(ContactMessage $message)
    {
        $message->update(['is_read' => false]);

        return redirect()
            ->route('admin.messages.index')
            ->with('success', 'Message marked as unread.');
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return redirect()
            ->route('admin.messages.index')
            ->with('success', 'Message deleted successfully.');
    }
}