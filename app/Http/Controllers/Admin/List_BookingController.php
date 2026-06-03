<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class List_BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'kamar'])->paginate(15);
        return view('admin.list-booking', compact('bookings'));
    }
}
