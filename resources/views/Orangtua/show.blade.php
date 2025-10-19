@extends('components.layouts.main-layout')
@section('title','Detail Orang Tua')

@section('content')
<h2 class="text-lg font-semibold mb-4">Detail Orang Tua</h2>

<div class="bg-white border rounded p-4 max-w-3xl">
  <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div><dt class="text-gray-500 text-sm">No KK</dt><dd class="font-medium">{{ $orangtua->no_kk }}</dd></div>
    <div><dt class="text-gray-500 text-sm">NIK Ibu</dt><dd class="font-medium">{{ $orangtua->nik_ibu }}</dd></div>
    <div><dt class="text-gray-500 text-sm">Nama Ibu</dt><dd class="font-medium">{{ $orangtua->nama_ibu }}</dd></div>
    <div><dt class="text-gray-500 text-sm">Tanggal Lahir Ibu</dt><dd class="font-medium">{{ \Carbon\Carbon::parse($orangtua->tanggal_lahir_ibu)->translatedFormat('d M Y') }}</dd></div>
    <div><dt class="text-gray-500 text-sm">Golongan Darah Ibu</dt><dd class="font-medium">{{ $orangtua->golongan_darah_ibu ?? '-' }}</dd></div>
    <div><dt class="text-gray-500 text-sm">NIK Ayah</dt><dd class="font-medium">{{ $orangtua->nik_ayah }}</dd></div>
    <div><dt class="text-gray-500 text-sm">Nama Ayah</dt><dd class="font-medium">{{ $orangtua->nama_ayah }}</dd></div>
    <div><dt class="text-gray-500 text-sm">No Telepon</dt><dd class="font-medium">{{ $orangtua->no_telepon ?? '-' }}</dd></div>
    <div class="md:col-span-2">
      <dt class="text-gray-500 text-sm">Alamat</dt>
      <dd class="font-medium">{{ $orangtua->alamat }}</dd>
    </div>
  </dl>

  <div class="mt-4 flex items-center gap-2">
    <a href="{{ route('orangtua.edit',$orangtua->id) }}" class="px-4 py-2 bg-amber-500 text-white rounded hover:bg-amber-600">Edit</a>
    <a href="{{ route('orangtua.index') }}" class="px-4 py-2 bg-gray-100 rounded hover:bg-gray-200">Kembali</a>
  </div>
</div>
@endsection
