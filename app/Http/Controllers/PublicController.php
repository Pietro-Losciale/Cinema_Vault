<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PublicController extends Controller
{

public function homepage(){

$response = Http::get('https://api.themoviedb.org/3/movie/popular', [
    'api_key' => config('services.tmdb.key')
]);

$movies = $response->json()['results'];

return view('home', compact('movies'));

// compact= ['movies' => $movies]

}


}


