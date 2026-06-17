<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kos;

class HomeController extends Controller
{
    public function index()
    {
        // If user is authenticated, redirect based on role
        if (Auth::check()) {
            $user = Auth::user();
            if (isset($user->role) && $user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            if (isset($user->role) && $user->role === 'owner') {
                return redirect()->route('owner.dashboard');
            }
        }

        $kosList = Kos::tersedia()->latest()->take(8)->get();
        return view('home', compact('kosList'));
    }
}
