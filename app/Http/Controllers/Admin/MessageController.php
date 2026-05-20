<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MessageController extends Controller
{
    public function index(): View
    {
        $messages = ContactMessage::query()
            ->latest()
            ->paginate(20);

        return view('admin.messages.index', [
            'messages' => $messages,
        ]);
    }

    public function show(ContactMessage $message): View
    {
        if (! $message->read_at) {
            $message->read_at = now();
            $message->save();
        }

        return view('admin.messages.show', [
            'message' => $message,
        ]);
    }

    public function markRead(Request $request, ContactMessage $message): RedirectResponse
    {
        if (! $message->read_at) {
            $message->read_at = now();
            $message->save();
        }

        return back()->with('status', 'Marked as read.');
    }

    public function markUnread(Request $request, ContactMessage $message): RedirectResponse
    {
        if ($message->read_at) {
            $message->read_at = null;
            $message->save();
        }

        return back()->with('status', 'Marked as unread.');
    }
}
