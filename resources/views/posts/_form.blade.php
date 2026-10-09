{{-- Field form yang dipakai bersama oleh create & edit.
     REQ 5: pesan error per field (@error) + old input (old()). --}}
@php($editing = isset($post))

<div class="mb-6">
  <label for="title" class="mb-1 block font-display text-sm font-semibold">Judul</label>
  <input type="text" id="title" name="title" value="{{ old('title', $post->title ?? '') }}"
         class="w-full border-2 bg-white px-3 py-2 text-lg
                @error('title') border-rose-600 @else border-ink @enderror">
  @error('title')
    <p class="mt-1 font-display text-sm font-medium text-rose-700">{{ $message }}</p>
  @enderror
</div>

<div class="mb-6">
  <label for="content" class="mb-1 block font-display text-sm font-semibold">Isi catatan</label>
  <textarea id="content" name="content" rows="12"
            class="w-full border-2 bg-white px-3 py-2 text-base leading-relaxed
                   @error('content') border-rose-600 @else border-ink @enderror">{{ old('content', $post->content ?? '') }}</textarea>
  @error('content')
    <p class="mt-1 font-display text-sm font-medium text-rose-700">{{ $message }}</p>
  @enderror
</div>

<div class="mb-8">
  <label for="image" class="mb-1 block font-display text-sm font-semibold">
    Gambar <span class="font-normal text-muted">(opsional, jpg/png/webp, maks. 2 MB)</span>
  </label>

  @if ($editing && $post->image_url)
    <img src="{{ $post->image_url }}" alt="Gambar saat ini" class="mb-3 h-32 border-2 border-ink object-cover">
    <p class="mb-2 text-xs text-muted">Pilih file baru untuk mengganti gambar di atas.</p>
  @endif

  <input type="file" id="image" name="image" accept="image/*"
         class="block w-full text-sm file:mr-4 file:border-2 file:border-ink file:bg-marker file:px-4 file:py-2 file:font-display file:font-semibold">
  @error('image')
    <p class="mt-1 font-display text-sm font-medium text-rose-700">{{ $message }}</p>
  @enderror
</div>

<div class="flex flex-wrap gap-3">
  <button type="submit" class="btn bg-biro px-5 py-2 font-display font-semibold text-white">
    {{ $editing ? 'Simpan perubahan' : 'Terbitkan catatan' }}
  </button>
  <a href="{{ $editing ? route('posts.show', $post) : route('posts.index') }}"
     class="btn bg-white px-5 py-2 font-display font-semibold">Batal</a>
</div>
