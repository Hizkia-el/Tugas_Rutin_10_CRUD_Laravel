@extends('layouts.app')

@section('title', $post->title)

@section('content')
  <a href="{{ route('posts.index') }}" class="font-display text-sm font-semibold text-biro hover:underline">&larr; Semua catatan</a>

  <article class="mt-5 max-w-2xl">
    <h1 class="font-display text-4xl font-bold leading-tight sm:text-5xl">{{ $post->title }}</h1>
    <p class="mt-3 text-sm text-muted">
      Diterbitkan {{ $post->created_at->translatedFormat('l, d F Y') }}.
      @if ($post->updated_at->gt($post->created_at))
        Diperbarui {{ $post->updated_at->diffForHumans() }}.
      @endif
    </p>

    @if ($post->image_url)
      <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="mt-6 max-h-96 w-full border-2 border-ink object-cover">
    @endif

    {{-- {{ }} otomatis di-escape (anti XSS); nl2br + e() menjaga baris baru tetap aman --}}
    <div class="mt-8 text-lg leading-[1.85] text-ink/90">{!! nl2br(e($post->content)) !!}</div>

    <div class="mt-12 flex flex-wrap gap-3 border-t-2 border-ink/15 pt-6">
      <a href="{{ route('posts.edit', $post) }}"
         class="btn bg-white px-4 py-2 font-display text-sm font-semibold">Edit catatan</a>

      <form method="POST" action="{{ route('posts.destroy', $post) }}"
            onsubmit="return confirm('Pindahkan catatan ini ke tempat sampah?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn bg-white px-4 py-2 font-display text-sm font-semibold text-rose-700">
          Hapus
        </button>
      </form>
    </div>
  </article>
@endsection
