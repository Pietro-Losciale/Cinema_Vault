<?php

use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'homepage'] )->name('home');

Route::get('/movie/{id}', [PublicController::class, 'movieDetail']);

//genres routes//

Route::get('/genres', [PublicController::class, 'genres'])->name('genres');
Route::get('/genre/{id}', [PublicController::class, 'genre'])->name('genre');

//search route//

Route::get('/search', [PublicController::class, 'search'])->name('search');