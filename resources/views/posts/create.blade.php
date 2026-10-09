@extends('layouts.app')

@section('title', 'Tulis catatan')

@section('content')
  <h1 class="mb-8 font-display text-4xl font-bold">Tulis catatan baru</h1>

  {{-- REQ 7: @csrf wajib di semua form; enctype untuk upload gambar --}}
  <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" class="max-w-2xl">
    @csrf
    @include('posts._form')
  </form>
@endsection
