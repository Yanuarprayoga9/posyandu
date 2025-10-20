@extends('components.layouts.main-layout')
@section('title', 'Tambah Event')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-teal-700">Event Posyandu Mugi Lestari</h2>
                <p class="text-gray-600 mt-1">Tambah event baru</p>
            </div>

            <!-- Alert Error -->
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-red-500 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <div class="flex-1">
                            <h3 class="text-red-800 font-semibold mb-2">Terdapat kesalahan pada input:</h3>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach($errors->all() as $error)
                                    <li class="text-red-700 text-sm">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Informasi Event Card -->
                <div class="bg-white rounded-lg shadow-sm mb-4 overflow-hidden">
                    <div class="bg-gradient-to-r from-teal-600 to-teal-700 px-6 py-4">
                        <h6 class="text-white font-semibold text-lg flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Informasi Event
                        </h6>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Kegiatan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}" class="w-full px-3 py-2.5 border @error('nama_kegiatan') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition" placeholder="Contoh: Pemeriksaan Rutin Balita" required>
                                @error('nama_kegiatan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Tanggal Kegiatan <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan') }}" class="w-full px-3 py-2.5 border @error('tanggal_kegiatan') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition" required>
                                @error('tanggal_kegiatan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jam Kegiatan</label>
                                <input type="time" name="jam_kegiatan" value="{{ old('jam_kegiatan') }}" class="w-full px-3 py-2.5 border @error('jam_kegiatan') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition">
                                @error('jam_kegiatan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Lokasi Kegiatan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="lokasi_kegiatan" value="{{ old('lokasi_kegiatan') }}" class="w-full px-3 py-2.5 border @error('lokasi_kegiatan') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition" placeholder="Contoh: Balai RW 05" required>
                                @error('lokasi_kegiatan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Sasaran Kegiatan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="sasaran_kegiatan" value="{{ old('sasaran_kegiatan') }}" class="w-full px-3 py-2.5 border @error('sasaran_kegiatan') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition" placeholder="Contoh: Balita 0-5 tahun" required>
                                @error('sasaran_kegiatan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Penanggung Jawab <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="penanggung_jawab" value="{{ old('penanggung_jawab') }}" class="w-full px-3 py-2.5 border @error('penanggung_jawab') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition" placeholder="Nama Penanggung Jawab" required>
                                @error('penanggung_jawab')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Status <span class="text-red-500">*</span>
                                </label>
                                <select name="status" class="w-full px-3 py-2.5 border @error('status') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition" required>
                                    <option value="">Pilih Status</option>
                                    <option value="upcoming" {{ old('status') === 'upcoming' ? 'selected' : '' }}>Akan Datang</option>
                                    <option value="ongoing" {{ old('status') === 'ongoing' ? 'selected' : '' }}>Sedang Berlangsung</option>
                                    <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
                                </select>
                                @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                                <textarea name="deskripsi" rows="4" class="w-full px-3 py-2.5 border @error('deskripsi') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition resize-none" placeholder="Deskripsi kegiatan (opsional)">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dokumentasi Card -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="bg-gradient-to-r from-teal-600 to-teal-700 px-6 py-4">
                        <h6 class="text-white font-semibold text-lg flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Dokumentasi
                        </h6>
                    </div>

                    <div class="p-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Upload Dokumentasi</label>
                            <div class="flex items-center gap-4">
                                <input type="file" name="dokumentasi" id="dokumentasi" accept="image/*" class="hidden">
                                <label for="dokumentasi" class="px-4 py-2.5 bg-gray-100 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-200 cursor-pointer transition flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                    Pilih File
                                </label>
                                <span id="file-name" class="text-sm text-gray-500">Tidak ada file yang dipilih</span>
                            </div>
                            @error('dokumentasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-sm text-gray-500">Format: JPG, JPEG, PNG (Maks. 2MB)</p>
                        </div>

                        <div class="flex justify-end gap-3 mt-6 pt-6 border-t border-gray-200">
                            <a href="{{ route('events.index') }}" class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Batal
                            </a>
                            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-teal-600 to-teal-700 text-white rounded-lg font-medium hover:from-teal-700 hover:to-teal-800 transition flex items-center gap-2 shadow-md hover:shadow-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Simpan Event
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('dokumentasi');
            const fileNameDisplay = document.getElementById('file-name');

            fileInput.addEventListener('change', function(e) {
                if (e.target.files.length > 0) {
                    fileNameDisplay.textContent = e.target.files[0].name;
                } else {
                    fileNameDisplay.textContent = 'Tidak ada file yang dipilih';
                }
            });
        });
    </script>
@endsection
