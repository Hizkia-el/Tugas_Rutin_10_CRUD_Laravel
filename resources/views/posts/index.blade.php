@extends('layouts.app')

@section('title', 'Semua catatan')

@section('content')
  <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
    <div>
      <h1 class="font-display text-4xl font-bold leading-tight">Semua catatan</h1>
      <p class="mt-1 text-sm text-muted">
        {{ $posts->total() }} catatan{{ request('q') ? ' cocok dengan "'.request('q').'"' : ' tersimpan' }}
      </p>
    </div>

    {{-- BONUS: pencarian (GET, jadi tidak perlu @csrf) --}}
    <form method="GET" action="{{ route('posts.index') }}" class="flex gap-2">
      <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari, mis. CSRF atau Flexbox"
             class="w-full min-w-0 border-2 border-ink bg-white px-3 py-2 text-sm placeholder:text-muted/70 sm:w-64">
      <button class="btn bg-marker px-4 py-2 font-display text-sm font-semibold">Cari</button>
    </form>
  </div>

  <div>
    @forelse ($posts as $post)
      <x-card :title="$post->title" :href="route('posts.show', $post)" :image="$post->image_url"
              :date="$post->created_at->translatedFormat('d M Y')">
        <p class="mt-2 text-base leading-relaxed text-ink/80">{{ $post->excerpt }}</p>

        <div class="mt-3 flex items-center gap-5 font-display text-sm font-semibold">
          <span class="text-muted sm:hidden">{{ $post->created_at->translatedFormat('d M Y') }}</span>
          <a href="{{ route('posts.edit', $post) }}" class="text-biro hover:underline">Edit</a>

          {{-- REQ 7: @csrf + @method('DELETE') --}}
          <form method="POST" action="{{ route('posts.destroy', $post) }}"
                onsubmit="return confirm('Pindahkan catatan ini ke tempat sampah?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-rose-700 hover:underline">Hapus</button>
          </form>
        </div>
      </x-card>
    @empty
      <p class="border-2 border-dashed border-ink/30 p-10 text-center text-muted">
        Belum ada catatan{{ request('q') ? ' yang cocok dengan "'.request('q').'"' : '' }}.
        <a href="{{ route('posts.create') }}" class="font-semibold text-biro underline">Tulis catatan pertama</a>.
      </p>
    @endforelse
  </div>

  {{-- REQ 8: pagination --}}
  <div class="mt-8">
    {{ $posts->links() }}
  </div>
@endsection
