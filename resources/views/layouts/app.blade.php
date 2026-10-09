<!doctype html>
{{-- ==================================================================
     REQ 3: Blade layout master — halaman lain memakai @extends('layouts.app')
            dan mengisi @section('content').
     Tema "Catatan Web": kertas kotak-kotak, tinta biru tua, stabilo kuning.
     Styling: Tailwind CDN (tanpa build step) + sedikit CSS kustom.
     ================================================================== --}}
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Catatan') · Catatan Web</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Familjen+Grotesk:wght@500;600;700&family=Source+Serif+4:opsz,wght@8..60,400;8..60,600&display=swap" rel="stylesheet">

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class', // halaman ini hanya punya tema terang
      theme: {
        extend: {
          fontFamily: {
            display: ['"Familjen Grotesk"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            body: ['"Source Serif 4"', 'Georgia', 'Cambria', 'serif'],
          },
          colors: { ink: '#14213d', biro: '#2147d6', marker: '#ffe45c', muted: '#55627f' },
        },
      },
    }
  </script>
  <style>
    body {
      background-color: #eef2f9;
      background-image:
        linear-gradient(#dde4f2 1px, transparent 1px),
        linear-gradient(90deg, #dde4f2 1px, transparent 1px);
      background-size: 28px 28px;
    }
    /* stabilo: garis kuning di belakang teks saat disorot / halaman aktif */
    .marker {
      background-image: linear-gradient(transparent 58%, #ffe45c 58%);
      background-repeat: no-repeat;
      background-size: 0 100%;
      transition: background-size .2s ease;
      -webkit-box-decoration-break: clone;
      box-decoration-break: clone;
    }
    a:hover > .marker, .marker.is-active { background-size: 100% 100%; }
    /* tombol bergaya cetak: bergeser saat ditekan */
    .btn {
      border: 2px solid #14213d;
      box-shadow: 3px 3px 0 #14213d;
      transition: transform .12s ease, box-shadow .12s ease;
    }
    .btn:hover { transform: translate(2px, 2px); box-shadow: 1px 1px 0 #14213d; }
    :focus-visible { outline: 3px solid #2147d6; outline-offset: 2px; }
    @media (prefers-reduced-motion: reduce) { .marker, .btn { transition: none; } }
  </style>
</head>
<body class="min-h-screen font-body text-ink antialiased">
  <div class="mx-auto flex min-h-screen max-w-6xl flex-col gap-6 px-4 py-6 lg:flex-row lg:gap-10 lg:px-6 lg:py-10">

    <aside class="lg:sticky lg:top-10 lg:h-fit lg:w-60 lg:shrink-0">
      <a href="{{ route('posts.index') }}" class="font-display text-3xl font-bold leading-none">
        Catatan<span class="text-biro">Web</span>
      </a>
      <p class="mt-3 text-sm leading-relaxed text-muted">
        Catatan belajar pemrograman web: HTTP, HTML, CSS, JavaScript, dan Laravel.
      </p>

      <nav class="mt-5 flex flex-wrap gap-x-5 gap-y-2 font-display text-base font-semibold lg:flex-col lg:gap-2">
        <a href="{{ route('posts.index') }}"><span class="marker {{ request()->routeIs('posts.index', 'posts.show') ? 'is-active' : '' }}">Semua catatan</span></a>
        <a href="{{ route('posts.trash') }}"><span class="marker {{ request()->routeIs('posts.trash') ? 'is-active' : '' }}">Tempat sampah</span></a>
      </nav>

      <a href="{{ route('posts.create') }}"
         class="btn mt-5 inline-block rounded-md bg-biro px-4 py-2 font-display font-semibold text-white">
        Tulis catatan
      </a>

      <p class="mt-10 hidden text-xs text-muted lg:block">Tugas Rutin 10, Pemrograman Web</p>
    </aside>

    <main class="min-w-0 flex-1">
      <div class="border-2 border-ink bg-white p-5 shadow-[6px_6px_0_#14213d] sm:p-8">
        {{-- REQ 6: flash message sukses / gagal, ditampilkan lewat komponen <x-alert> --}}
        @if (session('success'))
          <x-alert type="success">{{ session('success') }}</x-alert>
        @endif
        @if (session('error'))
          <x-alert type="error">{{ session('error') }}</x-alert>
        @endif
        @if ($errors->any())
          <x-alert type="error">Periksa kembali isian form, ada {{ $errors->count() }} kesalahan.</x-alert>
        @endif

        @yield('content')
      </div>
    </main>
  </div>
</body>
</html>
