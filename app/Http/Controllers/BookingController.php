<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
   public function store(Request $request)
    {
        Booking::create([
            'user_id' => auth()->id(),
            'kamar_id' => $request->kamar_id,
            'tanggal_sewa' => $request->tanggal,
            'status' => 'pending'
        ]);
    }
}
