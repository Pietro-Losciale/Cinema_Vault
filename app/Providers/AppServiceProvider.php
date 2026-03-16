<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {

        $response = Http::get('https://api.themoviedb.org/3/genre/movie/list', [
            'api_key' => config('services.tmdb.key')
        ]);

        $genres = $response->json()['genres'];

        $view->with('genres', $genres);
    });
    }
}
