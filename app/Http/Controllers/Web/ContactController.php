<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\StoreContactMessageRequest;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function index()
    {
        return view('web.contact');
    }

    public function store(StoreContactMessageRequest $request)
    {
        $validated = $request->validated();

        ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'] ?? null,
            'message' => $validated['message'],
            'is_read' => false,
        ]);

        return redirect()
            ->route('contact')
            ->with('success', 'Your message has been sent successfully.');
    }
}