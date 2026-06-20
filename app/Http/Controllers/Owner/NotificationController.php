<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\OwnerNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Tampilkan semua notifikasi milik owner yang sedang login.
     */
    public function index()
    {
        $ownerId = Auth::id();

        $notifications = OwnerNotification::forOwner($ownerId)
            ->orderByDesc('created_at')
            ->get();

        $unreadCount = OwnerNotification::forOwner($ownerId)
            ->unread()
            ->count();

        return view('owner.notifications', compact('notifications', 'unreadCount'));
    }

    /**
     * Tandai satu notifikasi sebagai sudah dibaca.
     */
    public function markRead(int $id)
    {
        $notification = OwnerNotification::where('owner_id', Auth::id())
            ->findOrFail($id);

        $notification->update(['is_read' => true]);

        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('owner.notifications')
            ->with('success', 'Notifikasi ditandai sudah dibaca.');
    }

    /**
     * Tandai semua notifikasi owner sebagai sudah dibaca.
     */
    public function markAllRead()
    {
        OwnerNotification::forOwner(Auth::id())
            ->unread()
            ->update(['is_read' => true]);

        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('owner.notifications')
            ->with('success', 'Semua notifikasi telah ditandai sudah dibaca.');
    }
}
