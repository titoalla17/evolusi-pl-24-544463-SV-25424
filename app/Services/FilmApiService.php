<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FilmApiService
{
    public function cariFilm(string $judul): array
    {
        $response = Http::get('https://api.themoviedb.org/3/search/movie', [
            'api_key' => config('services.tmdb.key'),
            'query' => $judul,
            'language' => 'id-ID' // Format bahasa Indonesia
        ]);

        if ($response->successful() && isset($response->json()['results'])) {
            return $response->json()['results'];
        }

        return [];
    }
}