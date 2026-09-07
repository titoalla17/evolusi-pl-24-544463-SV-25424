<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FilmApiService;

class FilmController extends Controller
{
    protected $filmApiService;

    public function __construct(FilmApiService $filmApiService)
    {
        $this->filmApiService = $filmApiService;
    }

    public function index()
    {
        return view('films.index', ['hasil' => null]);
    }

    public function cari(Request $request)
    {
        $request->validate(['judul' => 'required|string|min:2']);
        $hasil = $this->filmApiService->cariFilm($request->judul);
        return view('films.index', compact('hasil'));
    }
}