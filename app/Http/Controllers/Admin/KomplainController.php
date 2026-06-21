<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class KomplainController extends Controller
{
    public function index()
    {
        $komplains = Review::with('user')->paginate(15);
        return view('admin.komplain', compact('komplains'));
    }

    public function selesai(Request $request, $id)
    {
        // Complete complaint logic
        $review = Review::findOrFail($id);
        $review->update(['status' => 'selesai']);
        return redirect()->route('admin.komplain.index');
    }
}
