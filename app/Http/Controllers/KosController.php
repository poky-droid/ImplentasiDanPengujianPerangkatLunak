<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KosController extends Controller
{
    public function index()
    {
        return view('kos-listing');
    }
}
