<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use App\Models\Kos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index()
    {
        $owners = Owner::paginate(15);
        return view('admin.list-owner', compact('owners'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:owners,email',
            'phone' => 'nullable|string|max:30',
            'password' => 'required|string|min:8',
            'status' => 'nullable|in:aktif,nonaktif,pending,disetujui,ditolak'
        ]);

        // Map to correct column names in owners table
        $owner = Owner::create([
            'nama' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'status' => $data['status'] ?? 'pending',
        ]);

        return redirect()->route('admin.owners.index')->with('success', 'Owner berhasil ditambahkan.');
    }

    public function update(Request $request, Owner $owner)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:owners,email,' . $owner->id,
            'phone' => 'nullable|string|max:30',
            'status' => 'nullable|in:aktif,nonaktif,pending,disetujui,ditolak'
        ]);

        $owner->update([
            'nama' => $data['name'],
            'email' => $data['email'],
            'status' => $data['status'] ?? $owner->status,
        ]);

        return redirect()->route('admin.owners.index')->with('success', 'Owner berhasil diupdate.');
    }

    public function destroy(Owner $owner)
    {
        $owner->delete();
        return redirect()->route('admin.owners.index');
    }

    public function dashboard()
    {
        $kosList = Kos::where('owner_id', Auth::id())
            ->latest()
            ->take(8)
            ->get();

        return view('owner.dashboard', compact('kosList'));
    }
}
