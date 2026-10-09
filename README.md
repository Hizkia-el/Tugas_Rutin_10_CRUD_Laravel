# Tugas Rutin 10 — Catatan Web (Blog CRUD Laravel, versi pemrograman web)

Mata kuliah **Pemrograman Web**. Versi lain dari `TugasWeb-P10-BlogCRUD` dengan dua perbedaan:

1. **Isi:** 18 catatan nyata berbahasa Indonesia tentang pemrograman web (HTTP, HTML, CSS, JavaScript,
   Laravel, keamanan, Git). Tidak ada lagi teks acak. Factory untuk test juga memakai kalimat bermakna.
2. **Tampilan:** tema baru *Catatan Web*. Kertas kotak-kotak, tinta biru tua, sorotan stabilo kuning,
   sidebar di kiri, daftar catatan berbentuk baris (bukan kartu), dan teks bacaan berhuruf serif.

Logika CRUD, route, validasi, dan test sama dengan P10, jadi semua requirement P10 tetap terpenuhi
(`Route::resource`, 7 method controller, layout master, komponen `alert` dan `card`, validasi + `old()`,
flash message, `@csrf` / `@method`, route model binding, pagination, pencarian, soft delete, upload gambar).

## Cara instalasi (Laragon)

Folder ini hanya berisi **file kustom**. Syarat: PHP 8.3 atau lebih baru (`php -v`), Composer, dan koneksi internet
(Tailwind CDN dan Google Fonts dimuat dari internet). **Tidak perlu `npm install` / `npm run build`.**

```bash
cd C:\laragon\www
composer create-project laravel/laravel TugasWeb-P10-BlogWebDev
```

1. **Salin isi folder ini** (`app`, `database`, `resources`, `routes`, `tests`, `.env.example`) ke
   `C:\laragon\www\TugasWeb-P10-BlogWebDev`. Pilih **Replace / timpa** untuk semua file yang bentrok.
2. Nyalakan Laragon (**Start All**), lalu buat database kosong `tugas10_blogwebdev` lewat HeidiSQL atau phpMyAdmin.

```bash
cd TugasWeb-P10-BlogWebDev
copy .env.example .env          # ketik Yes jika ditanya Overwrite
php artisan key:generate
php artisan migrate --seed      # membuat tabel + 18 catatan
php artisan storage:link        # agar gambar upload bisa diakses
php artisan serve
```

Buka <http://127.0.0.1:8000> (otomatis ke `/posts`). Dengan Auto Virtual Host Laragon, buka
`http://tugas10-blogwebdev.test` dan ubah `APP_URL` di `.env` sesuai alamat itu.

Mengulang dari awal: `php artisan migrate:fresh --seed` (seluruh data lama dihapus).

## Menjalankan test

```bash
php artisan test
```

Memakai SQLite in-memory (bawaan `phpunit.xml`), jadi database MySQL tidak tersentuh. Butuh ekstensi `pdo_sqlite` dan `gd`.

## Isi 18 catatan

HTTP dan alur membuka website, method dan kode status HTTP, HTML semantik, CSS box model, Flexbox vs Grid,
responsive mobile-first, dasar JavaScript, DOM, Fetch API, MVC, routing, Eloquent, migration dan seeder,
Blade, validasi form, CSRF, XSS, dan Git. Isinya ada di `database/seeders/DatabaseSeeder.php`;
ubah atau tambah di sana, lalu jalankan `php artisan migrate:fresh --seed`.

## Struktur folder (bagian yang dibuat / diubah)

```
app/Http/Controllers/PostController.php   ← sama seperti P10 (pesan flash memakai kata "catatan")
app/Http/Requests/PostRequest.php         ← aturan validasi
app/Models/Post.php
database/
├── migrations/..._create_posts_table.php
├── factories/PostFactory.php             ← data uji berbahasa Indonesia seputar web
└── seeders/DatabaseSeeder.php            ← 18 catatan asli
resources/views/
├── layouts/app.blade.php                 ← layout master + tema (Tailwind CDN + CSS kustom)
├── components/{alert,card}.blade.php
└── posts/{index,create,edit,show,trash,_form}.blade.php
routes/web.php
tests/Feature/{PostCrudTest,ExampleTest}.php
```

## Catatan

- Jika tampilan tidak bergaya (teks polos), berarti Tailwind CDN gagal dimuat. Periksa koneksi internet.
- Jangan commit file `.env` ke GitHub (sudah diabaikan oleh `.gitignore` bawaan Laravel).
