<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Review;

class PublicController extends Controller
{

public function homepage(){

$response = Http::get('https://api.themoviedb.org/3/movie/popular', [
    'api_key' => config('services.tmdb.key')
]);



$movies = $response->json()['results'];

foreach ($movies as &$movie) {
    $movie['cv_average'] = Review::where('movie_id', $movie['id'])->avg('vote');
}

$genresResponse = Http::get('https://api.themoviedb.org/3/genre/movie/list', [
    'api_key' => config('services.tmdb.key')
]);     

$genres = $genresResponse->json()['genres'];

return view('home', compact('movies', 'genres'));

// compact= ['movies' => $movies, 'genres' => $genres]



}


public function movieDetail($id){

    $response = Http::get("https://api.themoviedb.org/3/movie/$id", [
        'api_key' => config('services.tmdb.key')
    ]);

    $movie = $response->json();

    $genresResponse = Http::get('https://api.themoviedb.org/3/genre/movie/list', [
    'api_key' => config('services.tmdb.key')
    ]);

    $genres = $genresResponse->json()['genres'];
    $reviews = Review::where('movie_id', $id)
    ->with('user')
    ->latest()
    ->get();

    // media delle recensioni

    $averageVote = Review::where('movie_id', $id)->avg('vote');

    // numero di recensioni per film

    $reviewsCount = Review::where('movie_id', $id)->count();






    
    $userReview = null;

    if (auth()->check()) {
        $userReview = Review::where('movie_id', $id)
            ->where('user_id', auth()->id())
            ->first();
    }


     
    return view('detail', compact('movie','genres', 'reviews','userReview', 'averageVote', 'reviewsCount'));

    
   
}



public function genres(){

    $response = Http::get('https://api.themoviedb.org/3/genre/movie/list', [
        'api_key' => config('services.tmdb.key')
    ]);

    $genres = $response->json()['genres'];

    return view('genres', compact('genres'));
}


public function genre($id){

    $response = Http::get('https://api.themoviedb.org/3/discover/movie', [
    'api_key' => config('services.tmdb.key'),
    'with_genres' => $id
   ]);

    $movies = $response->json()['results'];

    $genresResponse = Http::get('https://api.themoviedb.org/3/genre/movie/list', [
        'api_key' => config('services.tmdb.key')
    ]);

    $genres = $genresResponse->json()['genres'];


    // trovare il nome del genere
    $genreName = collect($genres)->firstWhere('id', $id)['name'];

    return view('home', compact('movies','genres','genreName'));  
}





// funzione ricerca film dalla navbar//



public function search(Request $request){

    $query = $request->input('query');

    $response = Http::get('https://api.themoviedb.org/3/search/movie', [
        'api_key' => config('services.tmdb.key'),
        'query' => $query
    ]);

    $movies = $response->json()['results'];

    return view('home', compact('movies', 'query'));
}



}


