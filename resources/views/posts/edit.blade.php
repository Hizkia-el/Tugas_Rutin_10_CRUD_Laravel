@extends('layouts.app')

@section('title', 'Edit catatan')

@section('content')
  <h1 class="mb-8 font-display text-4xl font-bold">Edit catatan</h1>

  {{-- REQ 7: @csrf + @method('PUT'). Route Model Binding: $post otomatis dari URL --}}
  <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data" class="max-w-2xl">
    @csrf
    @method('PUT')
    @include('posts._form')
  </form>
@endsection
