@extends('components.layouts.main-layout')
@section('title', 'Tambah Event')

@section('content')
    <div class="p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-1">Form Event Posyandu</h2>
        <h3 class="text-xl font-bold text-gray-800 mb-6">Mugi Lestari</h3>
        <div class="bg-teal-400 rounded-lg shadow-lg border-2 border-blue-400 p-8">
{{--            <form method="POST" action="" enctype="multipart/form-data">--}}
            <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4 flex items-center">
                    <label class="w-1/3 text-white font-medium">Nama Kegiatan</label>
                    <input type="text" name="nama_kegiatan" class="w-2/3 rounded-md bg-gray-200 px-4 py-2" value="{{ old('nama_kegiatan') }}" required>
                    @error('nama_kegiatan')
                    <span class="text-red-200 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4 flex items-center">
                    <label class="w-1/3 text-white font-medium">Tanggal Kegiatan</label>
                    <input type="date" name="tanggal_kegiatan" class="w-2/3 rounded-md bg-gray-200 px-4 py-2" value="{{ old('tanggal_kegiatan') }}" required>
                    @error('tanggal_kegiatan')
                    <span class="text-red-200 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4 flex items-center">
                    <label class="w-1/3 text-white font-medium">Lokasi Kegiatan</label>
                    <input type="text" name="lokasi_kegiatan" class="w-2/3 rounded-md bg-gray-200 px-4 py-2" value="{{ old('lokasi_kegiatan') }}" required>
                    @error('lokasi_kegiatan')
                    <span class="text-red-200 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4 flex items-center">
                    <label class="w-1/3 text-white font-medium">Sasaran Kegiatan</label>
                    <input type="text" name="sasaran_kegiatan" class="w-2/3 rounded-md bg-gray-200 px-4 py-2" value="{{ old('sasaran_kegiatan') }}" required>
                    @error('sasaran_kegiatan')
                    <span class="text-red-200 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4 flex items-center">
                    <label class="w-1/3 text-white font-medium">Penanggung Jawab</label>
                    <input type="text" name="penanggung_jawab" class="w-2/3 rounded-md bg-gray-200 px-4 py-2" value="{{ old('penanggung_jawab') }}" required>
                    @error('penanggung_jawab')
                    <span class="text-red-200 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-6 flex items-center">
                    <label class="w-1/3 text-white font-medium">Upload Dokumentasi</label>
                    <div class="w-2/3 bg-gray-300 rounded-md px-4 py-2 flex items-center shadow">
                        <input type="file" name="dokumentasi" class="hidden" id="dokumentasi" accept="image/*">
                        <label for="dokumentasi" class="bg-gray-700 text-white px-4 py-2 rounded cursor-pointer mr-4">Pilih File</label>
                        <span id="file-name" class="text-gray-500">Tidak ada file yang dipilih</span>
                    </div>
                    @error('dokumentasi')
                    <span class="text-red-200 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex justify-end gap-4">
{{--                    <a href="" class="bg-gray-700 text-white px-8 py-2 rounded-md font-semibold hover:bg-gray-600">Batal</a>--}}
                    <a href="{{ route('events.index') }}" class="bg-gray-700 text-white px-8 py-2 rounded-md font-semibold hover:bg-gray-600">Batal</a>
                    <button type="submit" class="bg-gray-700 text-white px-8 py-2 rounded-md font-semibold hover:bg-gray-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('dokumentasi').addEventListener('change', function(e) {
            document.getElementById('file-name').textContent = e.target.files.length ? e.target.files[0].name : 'Tidak ada file yang dipilih';
        });
    </script>
@endsection
