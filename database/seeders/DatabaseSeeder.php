<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

/**
 * 18 catatan nyata tentang pemrograman web (bahasa Indonesia),
 * supaya pagination (6 per halaman) langsung terlihat: 3 halaman penuh.
 * Aman dijalankan berulang: judul yang sudah ada dilewati.
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->posts() as $i => [$title, $content]) {
            if (Post::withTrashed()->where('title', $title)->exists()) {
                continue;
            }

            // Catatan pertama di daftar = paling baru.
            $date = now()->subDays($i * 2)->subHours($i % 5);

            (new Post)->forceFill([
                'title'      => $title,
                'content'    => $content,
                'image'      => null,
                'created_at' => $date,
                'updated_at' => $date,
            ])->save();
        }
    }

    /** @return array<int, array{0: string, 1: string}> */
    private function posts(): array
    {
        return [
            [
                'Apa yang Terjadi Saat Kamu Membuka Sebuah Website?',
                "Saat kamu mengetik alamat di browser, browser pertama-tama menanyakan ke DNS untuk mendapatkan alamat IP server yang menyimpan website itu. Setelah alamat IP ditemukan, browser membuka koneksi ke server dan mengirim sebuah HTTP request.\n\nServer menerima request tersebut, menjalankan programnya (misalnya PHP atau Laravel), mengambil data dari database bila perlu, lalu mengirim HTTP response berisi HTML. Browser membaca HTML itu, meminta file CSS, JavaScript, dan gambar yang disebutkan di dalamnya, lalu menampilkannya sebagai halaman yang bisa kamu lihat.",
            ],
            [
                'Mengenal HTTP: Method dan Kode Status yang Wajib Dihafal',
                "Setiap request HTTP membawa sebuah method yang menjelaskan maksudnya. GET dipakai untuk mengambil data, POST untuk mengirim data baru, PUT atau PATCH untuk mengubah data, dan DELETE untuk menghapus data.\n\nResponse dari server membawa kode status. 200 berarti berhasil, 201 berarti data berhasil dibuat, 301 dan 302 berarti pengalihan, 403 berarti akses dilarang, 404 berarti halaman tidak ditemukan, 419 adalah halaman kedaluwarsa karena token CSRF tidak valid di Laravel, dan 500 berarti terjadi error di sisi server. Hafal kode-kode ini akan sangat mempercepat saat mencari sumber masalah.",
            ],
            [
                'HTML Semantik: Pakai Tag yang Sesuai dengan Maknanya',
                "HTML semantik berarti memilih tag berdasarkan fungsi isinya, bukan hanya tampilannya. Gunakan header untuk kepala halaman, nav untuk menu navigasi, main untuk isi utama, article untuk konten yang berdiri sendiri, aside untuk informasi pendamping, dan footer untuk bagian penutup.\n\nManfaatnya nyata: pembaca layar membantu pengguna tunanetra berpindah antarbagian halaman, mesin pencari lebih mudah memahami struktur konten, dan kodemu lebih gampang dibaca orang lain. Hindari memakai div untuk semuanya, dan gunakan heading secara berurutan dari h1 hingga h6.",
            ],
            [
                'CSS Box Model: Content, Padding, Border, dan Margin',
                "Di CSS, setiap elemen dianggap sebagai kotak yang tersusun dari empat lapis: content di tengah, lalu padding, border, dan margin di bagian terluar. Padding adalah ruang di dalam border, sedangkan margin adalah jarak ke elemen lain.\n\nSecara bawaan, width hanya menghitung content sehingga padding dan border menambah ukuran total kotak. Tulis box-sizing: border-box agar width sudah mencakup padding dan border, sehingga hitungan layout jadi lebih mudah ditebak. Ingat juga bahwa margin vertikal antar elemen bisa menyatu, bukan saling menjumlah.",
            ],
            [
                'Flexbox atau Grid? Panduan Memilih untuk Layout',
                "Flexbox mengatur elemen dalam satu dimensi, yaitu satu baris atau satu kolom. Ia cocok untuk menu navigasi, deretan tombol, atau kartu yang perlu rata tengah. Grid mengatur dua dimensi sekaligus, baris dan kolom, sehingga cocok untuk kerangka halaman dan galeri.\n\nKeduanya tidak saling menggantikan. Pola yang umum adalah memakai Grid untuk kerangka besar halaman (header, konten, sidebar, footer), lalu memakai Flexbox untuk menyusun isi di dalam tiap bagian.",
            ],
            [
                'Responsive Design dengan Pendekatan Mobile-First',
                "Mobile-first berarti kamu menulis CSS dasar untuk layar kecil terlebih dahulu, lalu menambah aturan untuk layar yang lebih lebar memakai media query min-width. Pendekatan ini membuat tampilan ponsel selalu ringan dan rapi, karena aturan tambahan hanya dibaca saat layarnya memang besar.\n\nPastikan tag meta viewport ada di head, gunakan satuan relatif seperti rem, persen, dan fr, serta hindari lebar tetap dalam piksel untuk wadah utama. Uji hasilnya dengan mode perangkat di DevTools browser sebelum menyimpulkan layoutmu sudah responsif.",
            ],
            [
                'Dasar JavaScript: Variabel, Fungsi, dan Event',
                "JavaScript membuat halaman web menjadi interaktif. Deklarasikan variabel dengan const bila nilainya tidak akan diganti, dan let bila nilainya akan berubah. Fungsi membungkus langkah-langkah yang bisa dipanggil berulang kali.\n\nEvent adalah kejadian yang dipicu pengguna, seperti klik, mengetik, atau mengirim form. Dengan addEventListener, kamu mendaftarkan fungsi yang dijalankan saat kejadian itu muncul. Contoh paling sederhana: saat tombol diklik, teks di halaman berubah.",
            ],
            [
                'DOM: Cara JavaScript Mengubah Halaman Web',
                "DOM adalah representasi pohon dari dokumen HTML yang dibuat browser. Lewat DOM, JavaScript bisa menemukan elemen dengan querySelector, mengubah teksnya, menambah atau menghapus class dengan classList, bahkan membuat elemen baru.\n\nUntuk menampilkan teks yang berasal dari pengguna, pakai textContent, bukan innerHTML. innerHTML menafsirkan teks sebagai HTML sehingga bisa dimanfaatkan untuk menyisipkan skrip berbahaya, sedangkan textContent selalu memperlakukannya sebagai teks biasa.",
            ],
            [
                'Fetch API: Mengambil Data dari Server Tanpa Reload Halaman',
                "Fetch API memungkinkan JavaScript meminta data ke server tanpa memuat ulang seluruh halaman. Fungsi fetch mengembalikan Promise, dan cara paling rapi menanganinya adalah dengan async dan await.\n\nSetelah mendapat response, periksa dulu properti ok sebelum memakai datanya, karena kode status 404 atau 500 tetap dianggap response yang berhasil diterima oleh fetch. Ubah isinya dengan response.json(), lalu bungkus semuanya dalam try dan catch agar kegagalan jaringan bisa ditangani dengan pesan yang jelas.",
            ],
            [
                'Mengenal Pola MVC di Laravel',
                "MVC memisahkan aplikasi menjadi tiga peran. Model mengurus data dan aturan bisnis, dan di Laravel tugas ini dipegang Eloquent. View mengurus tampilan, yaitu template Blade. Controller menerima request, memanggil model, lalu mengembalikan view atau redirect.\n\nRoute berada di depan semuanya: ia hanya memetakan URL ke controller. Dengan pembagian ini, mengubah tampilan tidak menyentuh logika, dan mengubah logika tidak merusak tampilan, sehingga aplikasi lebih mudah dirawat dan diuji.",
            ],
            [
                'Routing Laravel: Dari URL Menuju Controller',
                "Semua route aplikasi web ditulis di routes/web.php. Route::get menghubungkan sebuah URL dengan fungsi atau method controller. Beri nama pada route dengan ->name(), lalu panggil lewat helper route() agar kamu tidak perlu menulis URL secara manual di banyak tempat.\n\nUntuk CRUD, Route::resource langsung membuat tujuh route sekaligus: index, create, store, show, edit, update, dan destroy. Route Model Binding membuat parameter seperti {post} otomatis diubah menjadi objek model, dan menampilkan 404 bila datanya tidak ada.",
            ],
            [
                'Eloquent ORM: Bekerja dengan Database lewat Model',
                "Eloquent mewakili satu tabel database dengan satu class model. Dengan model Post, kamu bisa membuat data lewat Post::create, mencari lewat find, mengubah lewat update, dan menghapus lewat delete tanpa menulis SQL mentah.\n\nProperti fillable membatasi kolom apa saja yang boleh diisi secara massal, sehingga pengguna tidak bisa menyelipkan kolom yang tidak seharusnya. Query yang sering dipakai bisa dibungkus sebagai scope, dan hubungan antartabel dinyatakan dengan relasi seperti hasMany dan belongsTo.",
            ],
            [
                'Migration dan Seeder: Kontrol Versi untuk Database',
                "Migration adalah file PHP yang mendefinisikan struktur tabel. Karena strukturnya tertulis sebagai kode, seluruh anggota tim bisa memiliki skema database yang sama hanya dengan menjalankan php artisan migrate, dan perubahannya tercatat bersama kode lain di Git.\n\nSeeder mengisi tabel dengan data contoh agar aplikasi langsung bisa dicoba. Perintah php artisan migrate:fresh --seed menghapus semua tabel, membuatnya ulang, lalu mengisinya kembali. Gunakan hanya di lingkungan pengembangan, karena seluruh data yang ada akan hilang.",
            ],
            [
                'Blade Template: Layout dan Komponen yang Bisa Dipakai Ulang',
                "Blade adalah mesin template bawaan Laravel. Dengan @extends dan @section, setiap halaman cukup mengisi bagian isinya, sementara kerangka seperti navigasi dan footer ditulis sekali di layout. @include menyisipkan potongan view, misalnya form yang dipakai bersama oleh halaman tambah dan edit.\n\nKomponen seperti x-alert dan x-card membungkus potongan tampilan beserta propertinya. Tanda kurung kurawal ganda otomatis meng-escape keluaran, jadi pakai tanda seru ganda hanya untuk konten yang benar-benar sudah kamu amankan.",
            ],
            [
                'Validasi Form di Laravel: Jangan Percaya Input Pengguna',
                "Validasi di sisi browser membantu pengguna, tetapi mudah dilewati, sehingga validasi di server tetap wajib. Laravel menyediakan Form Request untuk memindahkan aturan validasi keluar dari controller sehingga controller tetap ramping.\n\nSaat validasi gagal, Laravel mengembalikan pengguna ke form beserta daftar kesalahan. Tampilkan pesan per field dengan @error, dan isi ulang kolom dengan old() supaya pengguna tidak perlu mengetik ulang. Tulis pesan yang spesifik, misalnya judul minimal 3 karakter, bukan sekadar input tidak valid.",
            ],
            [
                'CSRF: Mengapa Setiap Form Membutuhkan Token',
                "CSRF adalah serangan ketika situs lain membuat browser korban mengirim request ke aplikasimu, dan browser ikut membawa cookie login milik korban. Tanpa perlindungan, request palsu itu dianggap sah.\n\nLaravel membuat token rahasia untuk setiap sesi, dan form harus menyertakannya lewat directive @csrf. Request tanpa token yang cocok ditolak dengan kode 419. Karena alasan ini pula, perubahan data tidak boleh dilakukan lewat method GET, melainkan POST, PUT, PATCH, atau DELETE.",
            ],
            [
                'XSS: Mengapa Semua Keluaran Harus Di-escape',
                "XSS terjadi ketika penyerang berhasil menyisipkan skrip lewat input, lalu skrip itu ikut ditampilkan dan dijalankan di browser pengguna lain. Akibatnya bisa berupa pencurian sesi atau pengalihan ke situs palsu.\n\nPertahanannya adalah escape: karakter khusus HTML diubah menjadi entitas sehingga tampil sebagai teks biasa. Blade melakukannya otomatis untuk tanda kurung kurawal ganda. Berhati-hatilah dengan sintaks tanpa escape di Blade dan dengan innerHTML di JavaScript, dan jangan pernah memakainya untuk data yang berasal dari pengguna.",
            ],
            [
                'Git untuk Pemula: Commit, Branch, dan Push ke GitHub',
                "Git mencatat riwayat perubahan kodemu. Alurnya: git init membuat repositori, git add memilih file, dan git commit menyimpan perubahan itu sebagai satu titik riwayat dengan pesan yang menjelaskan apa yang berubah. Buat commit kecil dan sering, bukan satu commit raksasa di akhir.\n\nBranch memungkinkan kamu mencoba fitur baru tanpa mengganggu kode utama. Untuk mengunggah, hubungkan repositori dengan git remote add origin lalu jalankan git push. Pastikan file .gitignore memuat .env dan folder vendor, karena .env berisi kunci dan kata sandi yang tidak boleh sampai ke repositori publik.",
            ],
        ];
    }
}
