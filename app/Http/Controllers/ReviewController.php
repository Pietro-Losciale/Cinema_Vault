<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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

    return redirect()->back()->with('success', 'Review deleted successfully');
}




public function myReviews()
{
    $reviews = Review::where('user_id', Auth::id())
        ->latest()
        ->get();

    foreach ($reviews as $review) {

        $response = Http::get("https://api.themoviedb.org/3/movie/{$review->movie_id}", [
            'api_key' => env('TMDB_API_KEY'),
            'language' => 'en-US'
        ]);

        if ($response->successful()) {
            $movie = $response->json();

            
            $review->movie_title = $movie['title'];
            $review->poster_path = $movie['poster_path'];
        } else {
            
            $review->movie_title = 'Unknown movie';
            $review->poster_path = null;
        }
    }

    return view('reviews.my', compact('reviews'));
}



public function edit(Review $review)
{
    // sicurezza
    if ($review->user_id !== auth()->id()) {
        abort(403);
    }

    return view('reviews.edit', compact('review'));
}

public function update(Request $request, Review $review)
{
    // sicurezza
    if ($review->user_id !== auth()->id()) {
        abort(403);
    }

    // validazione
    $request->validate([
        'vote' => 'required|numeric|min:1|max:10',
        'content' => 'required|string|max:1000',
    ]);

    // update
    $review->update([
        'vote' => $request->vote,
        'content' => $request->content,
    ]);

    return redirect()->route('reviews.my')->with('success', 'Review updated successfully');
}



}





