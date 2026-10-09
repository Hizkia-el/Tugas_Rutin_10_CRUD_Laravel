<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Data uji berbahasa Indonesia seputar pemrograman web (bukan teks acak/lorem ipsum).
 * Dipakai oleh test; data tampilan aplikasi berasal dari DatabaseSeeder.
 */
class PostFactory extends Factory
{
    private const TITLES = [
        'Catatan Belajar HTML dan CSS',
        'Memahami Alur Request dan Response',
        'Tips Merapikan Kode JavaScript',
        'Latihan Membuat Form yang Aman',
        'Cara Membaca Pesan Error dengan Tenang',
        'Kebiasaan Baik Saat Menulis Query Database',
        'Mengapa Penamaan Variabel Itu Penting',
        'Rangkuman Praktik Debugging di Browser',
    ];

    private const PARAGRAPHS = [
        'Mulailah dari struktur HTML yang benar, baru tambahkan gaya CSS sedikit demi sedikit sambil memeriksa hasilnya di browser.',
        'Setiap request ke server menghasilkan response, dan membaca kode statusnya adalah langkah pertama untuk mencari sumber masalah.',
        'Pisahkan tanggung jawab kode: route memetakan URL, controller mengatur alur, dan view hanya menampilkan data.',
        'Jangan percaya input pengguna. Validasi di server, lalu tampilkan pesan kesalahan yang jelas untuk setiap kolom.',
        'Gunakan DevTools untuk memeriksa elemen, melihat request jaringan, dan membaca pesan error di console sebelum mengubah kode.',
        'Commit kecil dengan pesan yang jelas membuat riwayat perubahan mudah ditelusuri saat ada bagian yang perlu dikembalikan.',
        'Beri nama variabel dan fungsi sesuai tujuannya agar kode tetap terbaca beberapa minggu kemudian.',
        'Uji tampilan di layar kecil lebih dulu, lalu perlebar secara bertahap menggunakan media query.',
    ];

    public function definition(): array
    {
        return [
            'title'   => fake()->randomElement(self::TITLES),
            'content' => implode("\n\n", fake()->randomElements(self::PARAGRAPHS, rand(2, 3))),
            'image'   => null,
        ];
    }
}
