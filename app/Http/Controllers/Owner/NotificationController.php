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
     * Support filter berdasarkan tipe via query param ?filter=booking|pembayaran|chat|maintenance|sistem
     */
    public function index(Request $request)
    {
        $ownerId = Auth::id();
        $filter  = $request->get('filter'); // null = semua

        $query = OwnerNotification::forOwner($ownerId)->orderByDesc('created_at');

        if ($filter && in_array($filter, ['booking', 'pembayaran', 'chat', 'maintenance', 'review', 'sistem'])) {
            $query->ofType($filter);
        }

        $notifications = $query->get();

        // Selalu hitung dari semua notifikasi (bukan yang terfilter)
        $unreadCount = OwnerNotification::forOwner($ownerId)->unread()->count();
        $totalCount  = OwnerNotification::forOwner($ownerId)->count();
        $readCount   = $totalCount - $unreadCount;

        return view('owner.notifications', compact('notifications', 'unreadCount', 'totalCount', 'readCount', 'filter'));
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
