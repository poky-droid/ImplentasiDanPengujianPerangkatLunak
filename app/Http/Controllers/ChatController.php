<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Kos;
use App\Models\User;
use App\Models\OwnerNotification;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Halaman chat — dibuka dari tombol "Hubungi Pemilik" di detail kos.
     * URL: /chat/{kos_id}
     */
    public function index($kos_id)
    {
        $kos      = Kos::findOrFail($kos_id);
        $receiver = User::findOrFail($kos->owner_id);  // pemilik kos

        // Pemilik kos tidak boleh menghubungi kos miliknya sendiri
        if (Auth::id() === $kos->owner_id) {
            return redirect()->route('kos.show', $kos_id)
                ->with('error', 'Anda tidak dapat menghubungi kos yang Anda kelola sendiri.');
        }

        // Ambil semua pesan antara user login ↔ pemilik kos ini
        $messages = Chat::where('kos_id', $kos_id)
            ->where(function ($q) use ($receiver) {
                $q->where('sender_id',   Auth::id())
                  ->where('receiver_id', $receiver->id);
            })
            ->orWhere(function ($q) use ($receiver) {
                $q->where('sender_id',   $receiver->id)
                  ->where('receiver_id', Auth::id());
            })
            ->where('kos_id', $kos_id)
            ->orderBy('created_at', 'asc')
            ->get();

        // Tandai pesan masuk sebagai sudah dibaca
        Chat::where('kos_id',     $kos_id)
               ->where('sender_id',   $receiver->id)
               ->where('receiver_id', Auth::id())
               ->where('dibaca',      false)
               ->update(['dibaca' => true]);

        // Daftar konversasi (sidebar kiri)
        $conversations = Chat::where('sender_id', Auth::id())
            ->orWhere('receiver_id', Auth::id())
            ->with(['kos', 'sender', 'receiver'])
            ->latest()
            ->get()
            ->unique(fn($m) => $m->kos_id . '_' . min($m->sender_id, $m->receiver_id) . '_' . max($m->sender_id, $m->receiver_id));

        return view('chat', compact('kos', 'receiver', 'messages', 'conversations'));
    }

    /**
     * Kirim pesan baru (POST).
     */
    public function send(Request $request)
    {
        $request->validate([
            'kos_id'      => 'required|exists:kos,id',
            'receiver_id' => 'required|exists:users,id',
            'pesan'       => 'required|string|max:2000',
        ]);

        // Pemilik kos tidak boleh mengirim pesan ke kos miliknya sendiri
        $kos = Kos::findOrFail($request->kos_id);
        if (Auth::id() === $kos->owner_id) {
            return redirect()->route('kos.show', $request->kos_id)
                ->with('error', 'Anda tidak dapat menghubungi kos yang Anda kelola sendiri.');
        }

        Chat::create([
            'sender_id'   => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'kos_id'      => $request->kos_id,
            'pesan'       => $request->pesan,
            'dibaca'      => false,
        ]);

        // ── Kirim notifikasi chat ke owner kos ──────────────────
        // Hanya buat satu notifikasi per percakapan dalam 10 menit
        try {
            $recentNotif = OwnerNotification::where('owner_id', $kos->owner_id)
                ->where('tipe', 'chat')
                ->where('reference_id', $kos->id)
                ->where('created_at', '>=', now()->subMinutes(10))
                ->exists();

            if (!$recentNotif) {
                OwnerNotification::createChatNotif(
                    $kos->owner_id,
                    $kos->id,
                    Auth::user()->name ?? 'Penyewa',
                    $kos->nama
                );
            }
        } catch (\Throwable $e) {
            \Log::warning('Gagal membuat notifikasi chat: ' . $e->getMessage());
        }

        return redirect()->route('chat.index', $request->kos_id);
    }

    /**
     * Halaman inbox chat owner.
     * Menampilkan daftar semua percakapan terkait kos milik owner.
     */
    public function ownerInbox()
    {
        $ownerKosIds = Kos::where('owner_id', Auth::id())->pluck('id');

        // Daftar konversasi
        $conversations = Chat::whereIn('kos_id', $ownerKosIds)
            ->with(['kos', 'sender', 'receiver'])
            ->latest()
            ->get()
            ->unique(function ($m) {
                $lawanId = $m->sender_id === Auth::id() ? $m->receiver_id : $m->sender_id;
                return $m->kos_id . '_' . $lawanId;
            });

        // Hitung unread count untuk masing-masing percakapan
        foreach ($conversations as $conv) {
            $lawan = $conv->sender_id === Auth::id() ? $conv->receiver : $conv->sender;
            $conv->unread_count = Chat::where('kos_id', $conv->kos_id)
                ->where('sender_id', $lawan->id)
                ->where('receiver_id', Auth::id())
                ->where('dibaca', false)
                ->count();
        }

        // Default: ambil percakapan pertama jika ada, atau filter berdasarkan kos_id jika diminta
        $activeConv = null;
        if (request()->has('kos_id')) {
            $reqKosId = request()->get('kos_id');
            $activeConv = $conversations->where('kos_id', (int)$reqKosId)->first();
        }

        if (!$activeConv) {
            $activeConv = $conversations->first();
        }

        if ($activeConv) {
            $lawan = $activeConv->sender_id === Auth::id() ? $activeConv->receiver : $activeConv->sender;
            return redirect()->route('owner.messages.show', [$activeConv->kos_id, $lawan->id]);
        }

        // Jika belum ada percakapan sama sekali
        $kos = null;
        $receiver = null;
        $messages = collect([]);
        $isOwnerView = true;
        $unreadNotificationsCount = OwnerNotification::forOwner(Auth::id())->unread()->count();

        return view('chat', compact('kos', 'receiver', 'messages', 'conversations', 'isOwnerView', 'unreadNotificationsCount'));
    }

    /**
     * Tampilan chat detail untuk owner dengan user tertentu mengenai kos tertentu.
     */
    public function ownerChat($kos_id, $user_id)
    {
        $ownerKosIds = Kos::where('owner_id', Auth::id())->pluck('id');

        // Pastikan kos ini milik owner
        if (!$ownerKosIds->contains($kos_id)) {
            abort(403, 'Anda tidak memiliki akses ke kos ini.');
        }

        $kos = Kos::findOrFail($kos_id);
        $receiver = User::findOrFail($user_id); // ini adalah tenant/calon penyewa

        // Ambil semua pesan antara owner dan tenant untuk kos ini
        $messages = Chat::where('kos_id', $kos_id)
            ->where(function ($q) use ($user_id) {
                $q->where(function ($sub) use ($user_id) {
                    $sub->where('sender_id', Auth::id())
                        ->where('receiver_id', $user_id);
                })->orWhere(function ($sub) use ($user_id) {
                    $sub->where('sender_id', $user_id)
                        ->where('receiver_id', Auth::id());
                });
            })
            ->orderBy('created_at', 'asc')
            ->get();

        // Tandai pesan dari tenant ke owner sebagai sudah dibaca
        Chat::where('kos_id', $kos_id)
            ->where('sender_id', $user_id)
            ->where('receiver_id', Auth::id())
            ->where('dibaca', false)
            ->update(['dibaca' => true]);

        // Daftar konversasi untuk sidebar
        $conversations = Chat::whereIn('kos_id', $ownerKosIds)
            ->with(['kos', 'sender', 'receiver'])
            ->latest()
            ->get()
            ->unique(function ($m) {
                $lawanId = $m->sender_id === Auth::id() ? $m->receiver_id : $m->sender_id;
                return $m->kos_id . '_' . $lawanId;
            });

        // Hitung unread count untuk masing-masing percakapan
        foreach ($conversations as $conv) {
            $lawan = $conv->sender_id === Auth::id() ? $conv->receiver : $conv->sender;
            $conv->unread_count = Chat::where('kos_id', $conv->kos_id)
                ->where('sender_id', $lawan->id)
                ->where('receiver_id', Auth::id())
                ->where('dibaca', false)
                ->count();
        }

        $isOwnerView = true;
        $unreadNotificationsCount = OwnerNotification::forOwner(Auth::id())->unread()->count();

        return view('chat', compact('kos', 'receiver', 'messages', 'conversations', 'isOwnerView', 'unreadNotificationsCount'));
    }

    /**
     * Kirim pesan dari Owner.
     */
    public function ownerSend(Request $request)
    {
        $request->validate([
            'kos_id'      => 'required|exists:kos,id',
            'receiver_id' => 'required|exists:users,id',
            'pesan'       => 'required|string|max:2000',
        ]);

        $kos = Kos::findOrFail($request->kos_id);
        
        // Pastikan kos ini milik owner
        if (Auth::id() !== $kos->owner_id) {
            abort(403, 'Anda tidak memiliki akses ke kos ini.');
        }

        Chat::create([
            'sender_id'   => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'kos_id'      => $request->kos_id,
            'pesan'       => $request->pesan,
            'dibaca'      => false,
        ]);

        return redirect()->route('owner.messages.show', [$request->kos_id, $request->receiver_id]);
    }
}