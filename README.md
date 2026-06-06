# Movie Recommender

Movie Recommender adalah aplikasi web berbasis Laravel untuk mencari rekomendasi film berdasarkan judul film yang dimasukkan pengguna. Aplikasi ini mengirim permintaan ke service rekomendasi Python di `http://127.0.0.1:5000/recommend`, lalu menampilkan hasil rekomendasi di halaman web.

## Fitur

- Form pencarian judul film
- Integrasi Laravel dengan service rekomendasi Python
- Tampilan hasil rekomendasi langsung di halaman utama
- Dataset film sebagai sumber referensi rekomendasi

## Teknologi yang Digunakan

- Laravel 12
- PHP 8.2+
- Vite
- Tailwind CSS 4
- Python service untuk proses rekomendasi

## Struktur Singkat

- `app/Http/Controllers/MovieController.php` - controller utama untuk halaman dan request rekomendasi
- `resources/views/movies/index.blade.php` - tampilan utama aplikasi
- `routes/web.php` - routing halaman dan endpoint rekomendasi
- `imdb_movies_data.csv` - dataset film
- `api_recommender.py` - service rekomendasi Python

## Cara Menjalankan

### 1. Clone repository

```bash
git clone https://github.com/username/movie-recommender.git
cd movie-recommender
```

### 2. Install dependency PHP

```bash
composer install
```

### 3. Install dependency frontend

```bash
npm install
```

### 4. Atur environment

Salin file `.env.example` menjadi `.env`, lalu sesuaikan konfigurasi database jika diperlukan.

```bash
php artisan key:generate
```

### 5. Jalankan migrasi

```bash
php artisan migrate
```

### 6. Jalankan service rekomendasi Python

Pastikan service Python berjalan di:

```bash
http://127.0.0.1:5000
```

### 7. Jalankan aplikasi Laravel

```bash
php artisan serve
```

### 8. Jalankan Vite jika dibutuhkan

```bash
npm run dev
```

## Alur Penggunaan

1. Buka halaman utama aplikasi.
2. Masukkan judul film pada form pencarian.
3. Kirim form.
4. Aplikasi akan meminta rekomendasi ke service Python.
5. Hasil rekomendasi ditampilkan di halaman yang sama.

## Catatan

- Pastikan service Python sudah aktif sebelum melakukan pencarian rekomendasi.
- Jika endpoint `http://127.0.0.1:5000/recommend` tidak aktif, hasil rekomendasi tidak akan muncul.
- File dataset berukuran cukup besar, jadi pastikan repository dan environment kamu siap untuk file tersebut jika ingin dipindahkan ke GitHub.

## Lisensi

Proyek ini menggunakan lisensi MIT.
