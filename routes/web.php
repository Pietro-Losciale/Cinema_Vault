<?php

use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;


Route::get('/', [PublicController::class, 'homepage'] )->name('home');

Route::get('/movie/{id}', [PublicController::class, 'movieDetail'])->name('movie.show');

//genres routes//

Route::get('/genres', [PublicController::class, 'genres'])->name('genres');
Route::get('/genre/{id}', [PublicController::class, 'genre'])->name('genre');

//search route//

Route::get('/search', [PublicController::class, 'search'])->name('search');

//reviews route//
Route::post('/reviews', [ReviewController::class, 'store'])
    ->middleware('auth')
    ->name('reviews.store');


// reviews deletion route//

    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])
    ->middleware('auth')
    ->name('reviews.destroy');


// reviews editing route//

    Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])
    ->name('reviews.edit');

    Route::put('/reviews/{review}', [ReviewController::class, 'update'])
    ->name('reviews.update');






// MY REVIEWS route//

    Route::middleware('auth')->group(function () {
    Route::get('/my-reviews', [ReviewController::class, 'myReviews'])->name('reviews.my');
    });