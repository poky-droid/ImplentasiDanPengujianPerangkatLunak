<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use App\Models\OwnerNotification;
use Illuminate\Http\Request;

class PengajuanMitraController extends Controller
{
    public function index(Request $request)
    {
        // List kos pengajuan (submitted by owners)
        $query = Kos::with('owner');

        // If a status is provided, filter by it. If not provided, show all kos.
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pengajuans = $query->latest()->paginate(15);

        // Preserve the status query when paginating filtered results
        if ($request->filled('status')) {
            $pengajuans->appends(['status' => $request->status]);
        }

        // Stats are based on kos status
        $menunggu = Kos::where('status', 'pending')->count();
        $disetujui = Kos::where('status', 'aktif')->count();
        $ditolak = Kos::where('status', 'nonaktif')->count();

        return view('admin.pengajuan-mitra', compact('pengajuans', 'menunggu', 'disetujui', 'ditolak'));
    }

    public function setujui(Request $request, $id)
    {
        $kos = Kos::findOrFail($id);

        $kos->status = 'aktif';
        $kos->save();

        // Notify owner
        OwnerNotification::create([
            'owner_id' => $kos->owner_id,
            'judul'    => 'Kos Anda Disetujui',
            'isi'      => "Kos \"{$kos->nama}\" telah disetujui dan sekarang aktif di platform.",
            'tipe'     => 'sistem',
        ]);

        return redirect()->route('admin.pengajuan.index')->with('success', "Kos '{$kos->nama}' berhasil diaktifkan.");
    }

    public function tolak(Request $request, $id)
    {
        $kos = Kos::findOrFail($id);

        $kos->status = 'nonaktif';
        $kos->save();

        // Notify owner
        OwnerNotification::create([
            'owner_id' => $kos->owner_id,
            'judul'    => 'Kos Anda Ditolak',
            'isi'      => "Kos \"{$kos->nama}\" tidak disetujui admin dan telah dinonaktifkan.",
            'tipe'     => 'sistem',
        ]);

        return redirect()->route('admin.pengajuan.index')->with('success', "Kos '{$kos->nama}' telah ditolak dan dinonaktifkan.");
    }
}
