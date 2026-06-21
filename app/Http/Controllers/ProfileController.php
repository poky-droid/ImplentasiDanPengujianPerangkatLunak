<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        Auth::user()->update($request->only([
            'name', 'jenis_kelamin', 'tanggal_lahir',
            'pekerjaan', 'kota_asal', 'status', 'phone'
        ]));

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}