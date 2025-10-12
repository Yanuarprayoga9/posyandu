@extends('components.layouts.main-layout')
@section('title', 'Tambah Data Pemeriksaan')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-teal-700">Pemeriksaan Anak & Balita</h2>
                <p class="text-gray-600 mt-1">Tambah data pemeriksaan baru</p>
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

            <form action="{{ route('pemeriksaan.store') }}" method="POST">
                @csrf

                <!-- Data Anak Card -->
                <div class="bg-white rounded-lg shadow-sm mb-4 overflow-hidden">
                    <div class="bg-gradient-to-r from-teal-600 to-teal-700 px-6 py-4">
                        <h6 class="text-white font-semibold text-lg flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Data Anak
                        </h6>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Anak <span class="text-red-500">*</span>
                                </label>
                                <select id="anak_id" name="anak_id" class="w-full px-3 py-2.5 border @error('anak_id') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition" required>
                                    <option value="">Pilih Anak</option>
                                    @foreach($anaks as $anak)
                                        <option value="{{ $anak->id }}"
                                                data-tanggal-lahir="{{ $anak->tanggal_lahir_anak }}"
                                                data-jenis-kelamin="{{ $anak->jenis_kelamin }}"
                                                data-nama-ibu="{{ $anak->nama_ibu }}"
                                            {{ old('anak_id') == $anak->id ? 'selected' : '' }}>
                                            {{ $anak->nama_anak }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('anak_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                                <input id="jenis_kelamin_display" type="text" class="w-full px-3 py-2.5 border border-gray-200 rounded-lg bg-gray-50 text-gray-600" placeholder="—" readonly>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                                <input id="tanggal_lahir_display" type="text" class="w-full px-3 py-2.5 border border-gray-200 rounded-lg bg-gray-50 text-gray-600" placeholder="dd/mm/yyyy" readonly>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Ibu</label>
                                <input id="nama_ibu_display" type="text" class="w-full px-3 py-2.5 border border-gray-200 rounded-lg bg-gray-50 text-gray-600" placeholder="—" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Pemeriksaan Card -->
                <div class="bg-white rounded-lg shadow-sm mb-4 overflow-hidden">
                    <div class="bg-gradient-to-r from-teal-600 to-teal-700 px-6 py-4">
                        <h6 class="text-white font-semibold text-lg flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            Data Pemeriksaan
                        </h6>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Tanggal Pemeriksaan <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="tanggal_pemeriksaan" value="{{ old('tanggal_pemeriksaan') }}" class="w-full px-3 py-2.5 border @error('tanggal_pemeriksaan') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition" required>
                                @error('tanggal_pemeriksaan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Usia</label>
                                <div class="relative">
                                    <input type="number" name="usia_bulan" value="{{ old('usia_bulan') }}" class="w-full px-3 py-2.5 pr-16 border @error('usia_bulan') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition" placeholder="0">
                                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">bulan</span>
                                </div>
                                @error('usia_bulan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Berat Badan</label>
                                <div class="relative">
                                    <input type="number" name="berat_badan" value="{{ old('berat_badan') }}" step="0.01" class="w-full px-3 py-2.5 pr-12 border @error('berat_badan') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition" placeholder="0.0">
                                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm font-medium">kg</span>
                                </div>
                                @error('berat_badan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tinggi Badan</label>
                                <div class="relative">
                                    <input type="number" name="tinggi_badan" value="{{ old('tinggi_badan') }}" step="0.01" class="w-full px-3 py-2.5 pr-12 border @error('tinggi_badan') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition" placeholder="0.0">
                                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm font-medium">cm</span>
                                </div>
                                @error('tinggi_badan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Lingkar Kepala</label>
                                <div class="relative">
                                    <input type="number" name="lingkar_kepala" value="{{ old('lingkar_kepala') }}" step="0.01" class="w-full px-3 py-2.5 pr-12 border @error('lingkar_kepala') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition" placeholder="0.0">
                                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm font-medium">cm</span>
                                </div>
                                @error('lingkar_kepala')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Lingkar Lengan Atas (LILA)</label>
                                <div class="relative">
                                    <input type="number" name="lingkar_lengan_atas" value="{{ old('lingkar_lengan_atas') }}" step="0.01" class="w-full px-3 py-2.5 pr-12 border @error('lingkar_lengan_atas') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition" placeholder="0.0">
                                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm font-medium">cm</span>
                                </div>
                                @error('lingkar_lengan_atas')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Suhu Tubuh</label>
                                <div class="relative">
                                    <input type="number" name="suhu_tubuh" value="{{ old('suhu_tubuh') }}" step="0.1" class="w-full px-3 py-2.5 pr-12 border @error('suhu_tubuh') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition" placeholder="36.5">
                                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm font-medium">°C</span>
                                </div>
                                @error('suhu_tubuh')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Status Gizi</label>
                                <select name="status_gizi" class="w-full px-3 py-2.5 border @error('status_gizi') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition">
                                    <option value="">Pilih Status</option>
                                    <option value="Buruk" {{ old('status_gizi') == 'Buruk' ? 'selected' : '' }}>Gizi Buruk</option>
                                    <option value="Kurang" {{ old('status_gizi') == 'Kurang' ? 'selected' : '' }}>Gizi Kurang</option>
                                    <option value="Normal" {{ old('status_gizi') == 'Normal' ? 'selected' : '' }}>Gizi Normal</option>
                                    <option value="Lebih" {{ old('status_gizi') == 'Lebih' ? 'selected' : '' }}>Gizi Lebih</option>
                                    <option value="Obesitas" {{ old('status_gizi') == 'Obesitas' ? 'selected' : '' }}>Obesitas</option>
                                </select>
                                @error('status_gizi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Petugas</label>
                                <input type="text" name="petugas" value="{{ old('petugas') }}" class="w-full px-3 py-2.5 border @error('petugas') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition" placeholder="Nama Petugas">
                                @error('petugas')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Vitamin & Tindakan Card -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="bg-gradient-to-r from-teal-600 to-teal-700 px-6 py-4">
                        <h6 class="text-white font-semibold text-lg flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                            </svg>
                            Pemberian Vitamin & Tindakan
                        </h6>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Pemberian Vitamin</label>
                                <div class="space-y-2">
                                    @foreach(\App\Models\JenisVitamin::all() as $vitamin)
                                        <label class="flex items-center p-3 border @error('vitamins') border-red-300 @else border-gray-200 @enderror rounded-lg hover:bg-gray-50 cursor-pointer transition">
                                            <input type="checkbox" name="vitamins[]" value="{{ $vitamin->id }}" class="w-4 h-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500" {{ in_array($vitamin->id, old('vitamins', [])) ? 'checked' : '' }}>
                                            <div class="ml-3 flex-1">
                                                <div class="font-medium text-gray-900">{{ $vitamin->nama_vitamin }}</div>
                                                @if($vitamin->deskripsi)
                                                    <div class="text-sm text-gray-500">{{ $vitamin->deskripsi }}</div>
                                                @endif
                                            </div>
                                            <span class="px-2.5 py-1 bg-teal-50 text-teal-700 text-xs font-medium rounded-full">
                                                {{ $vitamin->kode_vitamin }}
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                                @error('vitamins')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-2 text-sm text-gray-500">Pilih vitamin yang diberikan pada pemeriksaan ini</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tindakan</label>
                                <textarea name="tindakan" rows="3" class="w-full px-3 py-2.5 border @error('tindakan') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition resize-none" placeholder="Tindakan medis yang dilakukan (opsional)">{{ old('tindakan') }}</textarea>
                                @error('tindakan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                                <textarea name="catatan" rows="3" class="w-full px-3 py-2.5 border @error('catatan') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition resize-none" placeholder="Catatan tambahan (opsional)">{{ old('catatan') }}</textarea>
                                @error('catatan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 mt-6 pt-6 border-t border-gray-200">
                            <a href="{{ route('pemeriksaan.index') }}" class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Batal
                            </a>
                            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-teal-600 to-teal-700 text-white rounded-lg font-medium hover:from-teal-700 hover:to-teal-800 transition flex items-center gap-2 shadow-md hover:shadow-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Simpan Data
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const anakSelect = document.getElementById('anak_id');
            const tanggalLahirDisplay = document.getElementById('tanggal_lahir_display');
            const jenisKelaminDisplay = document.getElementById('jenis_kelamin_display');
            const namaIbuDisplay = document.getElementById('nama_ibu_display');

            // Function to update displays
            function updateAnakDisplay() {
                const selectedOption = anakSelect.options[anakSelect.selectedIndex];

                if (anakSelect.value) {
                    const tanggalLahirValue = selectedOption.dataset.tanggalLahir;
                    const jenisKelaminValue = selectedOption.dataset.jenisKelamin;
                    const namaIbuValue = selectedOption.dataset.namaIbu;

                    if (tanggalLahirValue) {
                        const date = new Date(tanggalLahirValue);
                        const formatted = date.toLocaleDateString('id-ID', {
                            day: '2-digit',
                            month: '2-digit',
                            year: 'numeric'
                        });
                        tanggalLahirDisplay.value = formatted;
                    } else {
                        tanggalLahirDisplay.value = '—';
                    }

                    jenisKelaminDisplay.value = jenisKelaminValue === 'L' ? 'Laki-laki' : jenisKelaminValue === 'P' ? 'Perempuan' : '—';
                    namaIbuDisplay.value = namaIbuValue || '—';
                } else {
                    tanggalLahirDisplay.value = '';
                    jenisKelaminDisplay.value = '';
                    namaIbuDisplay.value = '';
                }
            }

            // Update on change
            anakSelect.addEventListener('change', updateAnakDisplay);

            // Update on page load if old value exists
            if (anakSelect.value) {
                updateAnakDisplay();
            }
        });
    </script>

    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
@endsection
