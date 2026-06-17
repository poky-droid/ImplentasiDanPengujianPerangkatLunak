<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index()
    {
        // Placeholder: you can replace with real notifications logic
        return view('notifikasi.index');
    }

    public function show($id)
    {
        return redirect()->back();
    }

    public function store(Request $request)
    {
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        return redirect()->back();
    }

    public function destroy($id)
    {
        return redirect()->back();
    }
}
