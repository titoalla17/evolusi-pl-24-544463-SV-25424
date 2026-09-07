<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class FilmControllerTest extends TestCase
{
    public function test_halaman_utama_bisa_diakses()
    {
        $response = $this->get(route('films.index'));
        $response->assertStatus(200);
        $response->assertSee('Cari Film via TMDB');
    }

    public function test_pencarian_film_berhasil_menampilkan_hasil_dari_tmdb()
    {
        // 1. Mocking: Cegah Laravel memanggil API TMDB sungguhan
        Http::fake([
            'api.themoviedb.org/3/search/movie*' => Http::response([
                'page' => 1,
                'results' => [
                    [
                        'title' => 'Inception Mock',
                        'release_date' => '2010-07-15',
                        'poster_path' => '/mockposter123.jpg'
                    ]
                ],
                'total_pages' => 1,
                'total_results' => 1
            ], 200),
        ]);

        // 2. Action: Panggil route pencarian
        $response = $this->get(route('films.cari', ['judul' => 'Inception']));

        // 3. Assert: Pastikan hasilnya sesuai dengan data palsu (mock) kita
        $response->assertStatus(200);
        $response->assertSee('Inception Mock');
        $response->assertSee('2010'); // Tahun yang diekstrak dari tanggal
    }
}