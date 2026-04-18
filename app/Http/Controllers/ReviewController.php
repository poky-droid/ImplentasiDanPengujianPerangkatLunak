<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function beriReview(Request $request): bool
    {
        Review::create([
            'user_id' => auth()->id(),
            'kamar_id' => $request->kamar_id,
            'isi_review' => $request->isi_review,
            'rating' => $request->rating
        ]);

        return true;
    }
}