@extends('layouts.app')

@section('title', 'Tempat sampah')

@section('content')
  <h1 class="font-display text-4xl font-bold">Tempat sampah</h1>
  <p class="mb-8 mt-1 text-sm text-muted">Catatan yang dihapus masih bisa dipulihkan dari sini.</p>

  <div class="space-y-4">
    @forelse ($posts as $post)
      <div class="flex flex-col gap-3 border-2 border-ink p-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="min-w-0">
          <p class="font-display text-lg font-bold leading-snug">{{ $post->title }}</p>
          <p class="text-xs text-muted">Dihapus {{ $post->deleted_at->diffForHumans() }}</p>
        </div>

        <div class="flex shrink-0 gap-3 font-display text-sm font-semibold">
          <form method="POST" action="{{ route('posts.restore', $post) }}">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn bg-marker px-3 py-1.5">Pulihkan</button>
          </form>

          <form method="POST" action="{{ route('posts.force-delete', $post) }}"
                onsubmit="return confirm('Hapus permanen? Tindakan ini tidak bisa dibatalkan.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn bg-white px-3 py-1.5 text-rose-700">Hapus permanen</button>
          </form>
        </div>
      </div>
    @empty
      <p class="border-2 border-dashed border-ink/30 p-10 text-center text-muted">
        Tempat sampah kosong.
      </p>
    @endforelse
  </div>

  <div class="mt-8">{{ $posts->links() }}</div>
@endsection
