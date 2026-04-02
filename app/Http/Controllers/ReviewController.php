<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
{
    Review::create([
        'user_id' => auth()->id(),
        'movie_id' => $request->movie_id,
        'vote' => $request->vote,
        'content' => $request->content,
    ]);

    return back();
}


public function destroy(Review $review)
{
    // sicurezza: solo il proprietario può eliminare
    if ($review->user_id !== auth()->id()) {
        abort(403);
    }

    $review->delete();

    return back()->with('success', 'Review deleted successfully.');
}
}



