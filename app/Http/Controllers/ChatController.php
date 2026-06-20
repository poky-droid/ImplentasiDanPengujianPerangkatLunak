<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Kos;
use App\Models\User;
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

        return redirect()->route('chat.index', $request->kos_id);
    }
}