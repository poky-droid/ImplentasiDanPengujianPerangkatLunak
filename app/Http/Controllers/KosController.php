<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KosController extends Controller
{
    public function index()
    {
        return view('kos-listing');
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        // nanti bisa difilter dari DB:
        // $kos = Kos::where('nama', 'like', "%$query%")->paginate(8);
        return view('kos-search', compact('query'));
    }
}
