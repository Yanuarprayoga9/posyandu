@extends('components.layouts.main-layout')
@section('title','Tambah Orang Tua')

@section('content')
<h2 class="text-lg font-semibold mb-4">Tambah Data Orang Tua</h2>

<form action="{{ route('orangtua.store') }}" method="POST" class="space-y-4 max-w-3xl">
  @csrf
  @include('orangtua._form')

  <div class="pt-2">
    <button class="px-4 py-2 bg-teal-600 text-white rounded hover:bg-teal-700">Simpan</button>
    <a href="{{ route('orangtua.index') }}" class="ml-2 px-4 py-2 bg-gray-100 rounded hover:bg-gray-200">Batal</a>
  </div>
</form>
@endsection
