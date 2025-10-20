@extends('components.layouts.main-layout')
@section('title','Data Orang Tua')

@section('content')
<div class="flex items-center justify-between mb-4">
  <h2 class="text-lg font-semibold">Data Orang Tua</h2>
  <a href="{{ route('orangtua.create') }}" class="px-4 py-2 bg-teal-600 text-white rounded hover:bg-teal-700">
    Tambah Data
  </a>
</div>

@if(session('success'))
  <div class="mb-3 p-3 bg-green-50 border border-green-200 text-sm text-green-800 rounded">{{ session('success') }}</div>
@endif
@if(session('error'))
  <div class="mb-3 p-3 bg-red-50 border border-red-200 text-sm text-red-800 rounded">{{ session('error') }}</div>
@endif

<div class="overflow-x-auto bg-white border rounded">
  <table class="min-w-full">
    <thead class="bg-gray-50">
      <tr>
        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">No KK</th>
        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Ibu</th>
        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Ayah</th>
        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Telepon</th>
        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Alamat</th>
        <th class="px-4 py-2 text-right text-sm font-medium text-gray-600">Aksi</th>
      </tr>
    </thead>
    <tbody class="divide-y">
      @forelse($orangtuas as $o)
      <tr>
        <td class="px-4 py-2">{{ $o->no_kk }}</td>
        <td class="px-4 py-2">
          <div class="font-medium">{{ $o->nama_ibu }}</div>
          <div class="text-xs text-gray-500">NIK: {{ $o->nik_ibu }}</div>
        </td>
        <td class="px-4 py-2">
          <div class="font-medium">{{ $o->nama_ayah }}</div>
          <div class="text-xs text-gray-500">NIK: {{ $o->nik_ayah }}</div>
        </td>
        <td class="px-4 py-2">{{ $o->no_telepon ?? '-' }}</td>
        <td class="px-4 py-2">{{ Str::limit($o->alamat, 40) }}</td>
        <td class="px-4 py-2 text-right space-x-2">
          <a href="{{ route('orangtua.show',$o->id) }}" class="px-3 py-1 text-sm bg-sky-600 text-white rounded hover:bg-sky-700">Detail</a>
          <a href="{{ route('orangtua.edit',$o->id) }}" class="px-3 py-1 text-sm bg-amber-500 text-white rounded hover:bg-amber-600">Edit</a>
          <form action="{{ route('orangtua.destroy',$o->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data ini?')">
            @csrf @method('DELETE')
            <button class="px-3 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
          </form>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="6" class="px-4 py-6 text-center text-gray-500">Belum ada data orang tua.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="mt-4">
  {{ $orangtuas->links() }}
</div>
@endsection
