{{-- REQ 4: komponen #1 — <x-alert type="success|error">Pesan</x-alert> --}}
@props(['type' => 'success'])

@php
  $styles = [
    'success' => 'border-emerald-600 bg-emerald-50 text-emerald-900',
    'error'   => 'border-rose-600 bg-rose-50 text-rose-900',
  ];
@endphp

<div role="alert" {{ $attributes->class(['mb-6 border-l-4 px-4 py-3 font-display text-sm font-medium', $styles[$type] ?? $styles['success']]) }}>
  {{ $slot }}
</div>
