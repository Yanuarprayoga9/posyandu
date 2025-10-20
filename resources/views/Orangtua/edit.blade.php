@extends('components.layouts.main-layout')
@section('title','Edit Orang Tua')

@section('content')
<h2 class="text-lg font-semibold mb-4">Edit Data Orang Tua</h2>

<form action="{{ route('orangtua.update',$orangtua->id) }}" method="POST" class="space-y-4 max-w-3xl">
  @csrf @method('PUT')
  @include('orangtua._form', ['orangtua' => $orangtua])

  <div class="pt-2">
    <button class="px-4 py-2 bg-teal-600 text-white rounded hover:bg-teal-700">Update</button>
    <a href="{{ route('orangtua.index') }}" class="ml-2 px-4 py-2 bg-gray-100 rounded hover:bg-gray-200">Batal</a>
  </div>
</form>
@endsection
