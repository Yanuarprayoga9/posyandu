@extends('components.layouts.main-layout')
@section('title', 'Formulir Pantau Gizi Anak')

@section('content')
    <div class="p-8 bg-gray-100 min-h-screen">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Pantau Gizi Anak (PGN)</h2>

            {{-- Error Alert --}}
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6" role="alert">
                    <strong class="font-bold">Terjadi Kesalahan!</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pantau-gizi.store') }}" method="POST">
                @csrf

                <!-- 1. Identitas & Pemeriksaan -->
                <div class="bg-mint-50 p-4 rounded-lg mb-6" style="background-color: #f0fdfa;">
                    <h3 class="font-bold text-lg mb-4 flex items-center text-teal-700">
                        <span class="mr-2">ℹ️</span> Identitas & Pemeriksaan
                    </h3>
                    <p class="text-sm text-gray-600 mb-4">Isi identitas anak dan tanggal pemeriksaan. Usia dihitung otomatis.</p>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium mb-2">Nama Anak <span class="text-red-500">*</span></label>
                            <select name="anak_id" id="anak_id" class="w-full px-3 py-2 border @error('anak_id') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" required>
                                <option value="">Pilih Anak</option>
                                @foreach($anaks as $anak)
                                    <option value="{{ $anak->id }}"
                                            data-nik="{{ $anak->nik_anak }}"
                                            data-tanggal-lahir="{{ $anak->tanggal_lahir_anak }}"
                                            data-jenis-kelamin="{{ $anak->jenis_kelamin }}"
                                        {{ old('anak_id') == $anak->id ? 'selected' : '' }}>
                                        {{ $anak->nama_anak }}
                                    </option>
                                @endforeach
                            </select>
                            @error('anak_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">NIK</label>
                            <input type="text" id="nik_anak" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100" readonly>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Tanggal Pemeriksaan <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_pemeriksaan" id="tanggal_pemeriksaan" value="{{ old('tanggal_pemeriksaan') }}" class="w-full px-3 py-2 border @error('tanggal_pemeriksaan') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" required>
                            @error('tanggal_pemeriksaan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Umur Anak (otomatis)</label>
                            <input type="text" id="usia_display" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100" readonly>
                            <input type="hidden" name="umur_bulan" id="umur_bulan">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Jenis Kelamin</label>
                            <input type="text" id="jenis_kelamin" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100" readonly>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Petugas / Kader</label>
                            <input type="text" name="petugas" value="{{ old('petugas') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" placeholder="Nama petugas">
                        </div>
                    </div>
                </div>

                <!-- 2. Data Antropometri -->
                <div class="mb-6">
                    <h3 class="font-bold text-lg mb-4 text-teal-700">📏 Data Antropometri (Pengukuran Fisik)</h3>

                    <div class="bg-white border border-gray-300 rounded-lg p-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-2">Berat Badan (kg)</label>
                                <input type="number" name="berat_badan" id="berat_badan" step="0.01" value="{{ old('berat_badan') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500" placeholder="0.00">
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">Tinggi / Panjang Badan (cm)</label>
                                <input type="number" name="tinggi_badan" id="tinggi_badan" step="0.01" value="{{ old('tinggi_badan') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500" placeholder="0.00">
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">Lingkar Kepala (cm)</label>
                                <input type="number" name="lingkar_kepala" step="0.01" value="{{ old('lingkar_kepala') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500" placeholder="0.00">
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">Lingkar Lengan Atas (cm)</label>
                                <input type="number" name="lingkar_lengan_atas" step="0.01" value="{{ old('lingkar_lengan_atas') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500" placeholder="0.00">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. Hasil Perhitungan Status Gizi -->
                <div class="mb-6">
                    <h3 class="font-bold text-lg mb-4 text-teal-700">📊 Hasil Perhitungan Status Gizi</h3>

                    <div class="bg-teal-50 border border-teal-200 rounded-lg p-4">
                        <p class="text-sm text-gray-600 mb-3">Status gizi dihitung otomatis berdasarkan data antropometri</p>

                        <div class="grid grid-cols-2 gap-4 mb-3">
                            <div class="bg-white p-3 rounded border border-gray-200">
                                <label class="block text-xs text-gray-500 mb-1">BB/U (Berat Badan per Umur)</label>
                                <input type="text" id="bb_u_display" class="w-full text-sm font-semibold" readonly placeholder="—">
                            </div>

                            <div class="bg-white p-3 rounded border border-gray-200">
                                <label class="block text-xs text-gray-500 mb-1">TB/U (Tinggi Badan per Umur)</label>
                                <input type="text" id="tb_u_display" class="w-full text-sm font-semibold" readonly placeholder="—">
                            </div>

                            <div class="bg-white p-3 rounded border border-gray-200">
                                <label class="block text-xs text-gray-500 mb-1">BB/TB (Berat per Tinggi)</label>
                                <input type="text" id="bb_tb_display" class="w-full text-sm font-semibold" readonly placeholder="—">
                            </div>

                            <div class="bg-white p-3 rounded border border-gray-200">
                                <label class="block text-xs text-gray-500 mb-1">IMT/U (IMT per Umur)</label>
                                <input type="text" id="imt_u_display" class="w-full text-sm font-semibold" readonly placeholder="—">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Kategori Gizi</label>
                            <select name="kategori_gizi" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500">
                                <option value="">Pilih Kategori</option>
                                <option value="Gizi Buruk" {{ old('kategori_gizi') == 'Gizi Buruk' ? 'selected' : '' }}>Gizi Buruk</option>
                                <option value="Gizi Kurang" {{ old('kategori_gizi') == 'Gizi Kurang' ? 'selected' : '' }}>Gizi Kurang</option>
                                <option value="Gizi Baik" {{ old('kategori_gizi') == 'Gizi Baik' ? 'selected' : '' }}>Gizi Baik</option>
                                <option value="Gizi Lebih" {{ old('kategori_gizi') == 'Gizi Lebih' ? 'selected' : '' }}>Gizi Lebih</option>
                                <option value="Obesitas" {{ old('kategori_gizi') == 'Obesitas' ? 'selected' : '' }}>Obesitas</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- 4. Riwayat & Pola Makan -->
                <div class="mb-6">
                    <h3 class="font-bold text-lg mb-4 text-teal-700">🍽️ Riwayat & Pola Makan Anak</h3>

                    <div class="bg-white border border-gray-300 rounded-lg p-4">
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium mb-2">Frekuensi makan per hari</label>
                                <input type="number" name="frekuensi_makan" value="{{ old('frekuensi_makan') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500" placeholder="3">
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">Frekuensi camilan per hari</label>
                                <input type="number" name="frekuensi_camilan" value="{{ old('frekuensi_camilan') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500" placeholder="2">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Jenis makanan pokok</label>
                            <input type="text" name="makanan_pokok" value="{{ old('makanan_pokok') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500" placeholder="Nasi, roti, kentang, dll">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Konsumsi protein hewani</label>
                            <div class="grid grid-cols-2 gap-2">
                                <label class="flex items-center p-2 border border-gray-200 rounded hover:bg-gray-50 cursor-pointer">
                                    <input type="checkbox" name="protein_hewani[]" value="telur" class="mr-2" {{ in_array('telur', old('protein_hewani', [])) ? 'checked' : '' }}>
                                    <span class="text-sm">🥚 Telur</span>
                                </label>
                                <label class="flex items-center p-2 border border-gray-200 rounded hover:bg-gray-50 cursor-pointer">
                                    <input type="checkbox" name="protein_hewani[]" value="ikan" class="mr-2" {{ in_array('ikan', old('protein_hewani', [])) ? 'checked' : '' }}>
                                    <span class="text-sm">🐟 Ikan</span>
                                </label>
                                <label class="flex items-center p-2 border border-gray-200 rounded hover:bg-gray-50 cursor-pointer">
                                    <input type="checkbox" name="protein_hewani[]" value="daging" class="mr-2" {{ in_array('daging', old('protein_hewani', [])) ? 'checked' : '' }}>
                                    <span class="text-sm">🍖 Daging</span>
                                </label>
                                <label class="flex items-center p-2 border border-gray-200 rounded hover:bg-gray-50 cursor-pointer">
                                    <input type="checkbox" name="protein_hewani[]" value="susu" class="mr-2" {{ in_array('susu', old('protein_hewani', [])) ? 'checked' : '' }}>
                                    <span class="text-sm">🥛 Susu</span>
                                </label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="flex items-center p-3 border border-gray-200 rounded hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="konsumsi_sayur_buah" class="mr-3" {{ old('konsumsi_sayur_buah') ? 'checked' : '' }}>
                                <span class="text-sm">🥗 Konsumsi sayur & buah rutin</span>
                            </label>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Asupan ASI</label>
                            <div class="flex gap-4">
                                <label class="flex items-center">
                                    <input type="radio" name="asupan_asi" value="eksklusif" class="mr-2" {{ old('asupan_asi') == 'eksklusif' ? 'checked' : '' }}>
                                    <span class="text-sm">Eksklusif</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="asupan_asi" value="campuran" class="mr-2" {{ old('asupan_asi') == 'campuran' ? 'checked' : '' }}>
                                    <span class="text-sm">Campuran</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="asupan_asi" value="tidak" class="mr-2" {{ old('asupan_asi') == 'tidak' ? 'checked' : '' }}>
                                    <span class="text-sm">Tidak</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 5. Catatan & Rekomendasi -->
                <div class="mb-6">
                    <h3 class="font-bold text-lg mb-4 text-teal-700">📝 Catatan & Rekomendasi Kader</h3>

                    <label class="block text-sm font-medium mb-2">Catatan</label>
                    <textarea name="catatan" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 mb-4" placeholder="Contoh: Anak perlu peningkatan konsumsi protein hewani, jadwalkan ulang penimbangan 1 bulan lagi.">{{ old('catatan') }}</textarea>

                    <label class="block text-sm font-medium mb-2">Rekomendasi</label>
                    <textarea name="rekomendasi" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500" placeholder="Rekomendasi tindak lanjut">{{ old('rekomendasi') }}</textarea>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="window.location.href='{{ route('pantau-gizi.index') }}'" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                    <button type="submit" class="px-6 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600">
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('anak_id').addEventListener('change', function () {
            const selected = this.options[this.selectedIndex];
            document.getElementById('nik_anak').value = selected.dataset.nik || '';
            document.getElementById('jenis_kelamin').value = selected.dataset.jenisKelamin === 'L' ? 'Laki-laki' : 'Perempuan';
            calculateAge();
        });

        document.getElementById('tanggal_pemeriksaan').addEventListener('change', calculateAge);
        document.getElementById('berat_badan').addEventListener('input', calculateStatusGizi);
        document.getElementById('tinggi_badan').addEventListener('input', calculateStatusGizi);

        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            if (!document.getElementById('tanggal_pemeriksaan').value) {
                document.getElementById('tanggal_pemeriksaan').value = today;
            }

            const anakSelect = document.getElementById('anak_id');
            if (anakSelect.value) {
                const selected = anakSelect.options[anakSelect.selectedIndex];
                document.getElementById('nik_anak').value = selected.dataset.nik || '';
                document.getElementById('jenis_kelamin').value = selected.dataset.jenisKelamin === 'L' ? 'Laki-laki' : 'Perempuan';
                calculateAge();
            }
        });

        function calculateAge() {
            const selected = document.getElementById('anak_id').options[document.getElementById('anak_id').selectedIndex];
            const birthDate = selected.dataset.tanggalLahir;
            const examDate = document.getElementById('tanggal_pemeriksaan').value || new Date().toISOString().split('T')[0];

            if (birthDate) {
                const birth = new Date(birthDate);
                const exam = new Date(examDate);

                let years = exam.getFullYear() - birth.getFullYear();
                let months = exam.getMonth() - birth.getMonth();

                let totalMonths = (years * 12) + months;

                if (exam.getDate() < birth.getDate()) {
                    totalMonths--;
                }

                document.getElementById('usia_display').value = totalMonths + ' bulan';
                document.getElementById('umur_bulan').value = totalMonths;

                calculateStatusGizi();
            }
        }

        function calculateStatusGizi() {
            const bb = parseFloat(document.getElementById('berat_badan').value);
            const tb = parseFloat(document.getElementById('tinggi_badan').value);
            const umur = parseInt(document.getElementById('umur_bulan').value);

            if (bb && tb && umur) {
                // Simplified calculation - in real app, use WHO growth charts
                const imt = (bb / ((tb/100) * (tb/100))).toFixed(2);

                document.getElementById('bb_u_display').value = bb.toFixed(2) + ' kg';
                document.getElementById('tb_u_display').value = tb.toFixed(2) + ' cm';
                document.getElementById('bb_tb_display').value = 'Normal'; // Simplified
                document.getElementById('imt_u_display').value = imt;
            }
        }
    </script>
@endsection

