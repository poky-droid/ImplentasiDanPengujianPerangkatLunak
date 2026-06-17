<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kos;

class HomeController extends Controller
{
    public function index()
    {
        $kosList = Kos::tersedia()->latest()->take(8)->get();
        return view('home', compact('kosList'));
    }
}
