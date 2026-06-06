<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Rekomendasi Film</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 15px 20px;
        }

        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header-section {
            text-align: center;
            color: white;
            margin-bottom: 20px;
        }

        .header-section h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 3px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .header-section p {
            font-size: 0.85rem;
            opacity: 0.9;
        }

        .search-box {
            background: white;
            padding: 18px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            margin-bottom: 20px;
        }

        .search-box label {
            font-weight: 600;
            color: #333;
            margin-bottom: 6px;
            display: block;
            font-size: 0.9rem;
        }

        .search-box input {
            width: 100%;
            padding: 9px;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            font-size: 0.9rem;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 10px rgba(102, 126, 234, 0.3);
        }

        .search-box button {
            width: 100%;
            padding: 9px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(102, 126, 234, 0.3);
        }

        .search-box button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }

        .search-box button:active {
            transform: translateY(0);
        }

        .results-section {
            background: transparent;
            padding: 0;
            border-radius: 0;
            box-shadow: none;
        }

        .results-section h2 {
            color: white;
            margin-bottom: 15px;
            font-weight: 700;
            padding-bottom: 8px;
            border-bottom: 2px solid white;
            font-size: 1.3rem;
        }

        .movies-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 12px;
            margin-top: 30px;
        }

        .movie-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
            transition: all 0.3s ease;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            padding: 15px;
            position: relative;
        }

        .movie-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        }

        .movie-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(102, 126, 234, 0.3);
        }

        .movie-poster {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            position: relative;
        }

        .movie-poster img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .movie-poster.no-image {
            font-size: 2.5rem;
        }

        .movie-icon {
            font-size: 2rem;
            text-align: center;
            margin-bottom: 20px;
            color: #667eea;
        }

        .movie-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .movie-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 35px;
        }

        .movie-similarity {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 7px 11px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.85rem;
            text-align: center;
        }

        .movie-number {
            display: none;
        }

        .movie-info {
            display: none;
        }

        .similarity-text {
            display: none;
        }

        .no-results {
            text-align: center;
            padding: 60px 40px;
            color: #999;
        }

        .no-results i {
            font-size: 3rem;
            color: #ddd;
            margin-bottom: 20px;
        }

        .no-results p {
            font-size: 1.2rem;
            color: #666;
        }

        @media (max-width: 1024px) {
            .movies-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (max-width: 768px) {
            .header-section h1 {
                font-size: 1.5rem;
            }

            .search-box {
                padding: 15px;
            }

            .movie-card {
                padding: 12px;
            }

            .movie-icon {
                font-size: 1.8rem;
                margin-bottom: 8px;
            }

            .movie-title {
                font-size: 0.9rem;
                min-height: 35px;
            }

            .movie-similarity {
                font-size: 0.8rem;
                padding: 6px 10px;
            }

            .movies-grid {
                gap: 10px;
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 10px 8px;
            }

            .header-section h1 {
                font-size: 1.3rem;
            }

            .header-section p {
                font-size: 0.75rem;
            }

            .search-box {
                padding: 12px;
                margin-bottom: 12px;
            }

            .search-box label {
                margin-bottom: 4px;
                font-size: 0.85rem;
            }

            .search-box input,
            .search-box button {
                padding: 8px;
                font-size: 0.85rem;
                margin-bottom: 8px;
            }

            .results-section h2 {
                font-size: 1.1rem;
                margin-bottom: 10px;
            }

            .movie-card {
                padding: 10px;
            }

            .movie-icon {
                font-size: 1.6rem;
                margin-bottom: 6px;
            }

            .movie-title {
                font-size: 0.8rem;
                min-height: 32px;
                margin-bottom: 8px;
            }

            .movie-similarity {
                font-size: 0.75rem;
                padding: 5px 8px;
            }

            .movies-grid {
                gap: 10px;
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>

<body>

    <div class="container-custom">
        <!-- Header -->
        <div class="header-section">
            <h1>🎬 Cari Film Favorit</h1>
            <p>Sistem Rekomendasi Film Berbasis Sentence-BERT</p>
        </div>

        <!-- Search Box -->
        <div class="search-box">
            <form method="POST" action="{{ route('recommend') }}">
                @csrf
                <label for="title"><i class="fas fa-search"></i> Masukkan Judul Film:</label>
                <input type="text" id="title" name="title" placeholder="Cth: Inception, The Dark Knight..." value="{{ isset($title) ? $title : '' }}" required>
                <button type="submit"><i class="fas fa-search"></i> Cari Rekomendasi</button>
            </form>
        </div>

        <!-- Results -->
        @if(isset($results))
        <div class="results-section">
            <h2><i class="fas fa-film"></i> Rekomendasi untuk "{{ $title }}"</h2>

            @if(count($results) > 0)
            <div class="movies-grid">
                @foreach($results as $i => $movie)
                <div class="movie-card">
                    @php
                    $sanitizedTitle = str_replace([':', '/', '\\', '|', '<', '>' , '?' , '*' ], '-' , $movie['title']);
                        $imagePath='images/movies/' . strtolower($sanitizedTitle) . '.jpg' ;
                        $fullImagePath=public_path($imagePath);
                        $imageExists=file_exists($fullImagePath);
                        @endphp
                        <div class="movie-poster {{ !$imageExists ? 'no-image' : '' }}">
                        @if($imageExists)
                        <img src="{{ asset($imagePath) }}" alt="{{ $movie['title'] }}">
                        @else
                        🎬
                        @endif
                </div>
                <div class="movie-content">
                    <h3 class="movie-title">{{ $movie['title'] }}</h3>
                    <div class="movie-similarity">{{ round($movie['similarity'] * 100, 1) }}% Mirip</div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="no-results">
            <i class="fas fa-search"></i>
            <p>Film "<strong>{{ $title }}</strong>" tidak ditemukan dalam database kami.</p>
            <p style="font-size: 0.95rem; margin-top: 15px;">Coba cari dengan judul film yang berbeda.</p>
        </div>
        @endif
    </div>
    @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>