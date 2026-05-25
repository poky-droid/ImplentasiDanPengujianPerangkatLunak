<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Http\Request;

class PengajuanMitraController extends Controller
{
    public function index(Request $request)
    {
        $query = Owner::with('propertis');
        
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        $pengajuans = $query->paginate(15)->through(function ($owner) {
            $owner->properti = $owner->propertis->first()?->nama ?? '-';
            return $owner;
        });
        
        $menunggu = Owner::where('status', 'pending')->count();
        $disetujui = Owner::where('status', 'disetujui')->count();
        $ditolak = Owner::where('status', 'ditolak')->count();
        
        return view('admin.pengajuan-mitra', compact('pengajuans', 'menunggu', 'disetujui', 'ditolak'));
    }

    public function setujui(Request $request, $id)
    {
        // Approve application logic
        return redirect()->route('admin.pengajuan.index');
    }

    public function tolak(Request $request, $id)
    {
        // Reject application logic
        return redirect()->route('admin.pengajuan.index');
    }
}
