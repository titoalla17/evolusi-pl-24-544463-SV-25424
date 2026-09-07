<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Film TMDB</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen p-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-center text-blue-600 mb-8">Cari Film via TMDB</h1>
        
        <form action="{{ route('films.cari') }}" method="GET" class="flex gap-4 mb-8">
            <input type="text" name="judul" value="{{ request('judul') }}" placeholder="Masukkan judul film..." required
                class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">Cari</button>
        </form>

        @if($hasil !== null)
            @if(count($hasil) > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($hasil as $film)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <img src="{{ !empty($film['poster_path']) ? 'https://image.tmdb.org/t/p/w500' . $film['poster_path'] : 'https://via.placeholder.com/300x450' }}" alt="Poster" class="w-full h-64 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-lg mb-1 truncate">{{ $film['title'] ?? 'Tanpa Judul' }}</h3>
                                <p class="text-gray-600">{{ !empty($film['release_date']) ? substr($film['release_date'], 0, 4) : '-' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-red-500 font-semibold">Film tidak ditemukan.</p>
            @endif
        @endif
    </div>
</body>
</html>