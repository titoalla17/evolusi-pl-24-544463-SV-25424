<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;

Route::get('/', [FilmController::class, 'index'])->name('films.index');
Route::get('/cari', [FilmController::class, 'cari'])->name('films.cari');