{{-- REQ 4: komponen #2 — <x-card :title="..." :href="..." :image="..." :date="...">isi</x-card>
     Tampil sebagai satu baris catatan: tanggal di kiri, judul + ringkasan di tengah, gambar kecil di kanan. --}}
@props(['title', 'href' => null, 'image' => null, 'date' => null])

<article {{ $attributes->class(['flex gap-5 border-t-2 border-ink/15 py-6 first:border-t-0 first:pt-0']) }}>
  @if ($date)
    <p class="hidden w-20 shrink-0 pt-1 font-display text-sm font-semibold leading-snug text-muted sm:block">{{ $date }}</p>
  @endif

  <div class="min-w-0 flex-1">
    <h2 class="font-display text-xl font-bold leading-snug sm:text-2xl">
      @if ($href)
        <a href="{{ $href }}"><span class="marker">{{ $title }}</span></a>
      @else
        {{ $title }}
      @endif
    </h2>

    {{ $slot }}
  </div>

  @if ($image)
    <img src="{{ $image }}" alt="{{ $title }}" class="hidden h-24 w-32 shrink-0 border-2 border-ink object-cover sm:block">
  @endif
</article>
