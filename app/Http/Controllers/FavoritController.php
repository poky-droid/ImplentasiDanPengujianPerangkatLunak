<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorit;

class FavoritController extends Controller
{
    /**
     * Toggle favorit: tambah jika belum ada, hapus jika sudah ada.
     * Hanya untuk user yang sudah login (middleware auth di route).
     */
    public function toggle(Request $request, $kos_id)
    {
        $user_id = auth()->id();

        $existing = Favorit::where('user_id', $user_id)
                            ->where('kos_id', $kos_id)
                            ->first();

        if ($existing) {
            $existing->delete();
            $favorited = false;
        } else {
            Favorit::create([
                'user_id' => $user_id,
                'kos_id'  => $kos_id,
            ]);
            $favorited = true;
        }

        return response()->json([
            'favorited' => $favorited,
            'message'   => $favorited ? 'Ditambahkan ke favorit' : 'Dihapus dari favorit',
        ]);
    }

    /**
     * Tampilkan semua kos favorit milik user yang sedang login.
     */
    public function index()
    {
        $favorit = Favorit::with('kos')
                          ->where('user_id', auth()->id())
                          ->latest()
                          ->get()
                          ->pluck('kos');

        return view('favorit', compact('favorit'));
    }
}
