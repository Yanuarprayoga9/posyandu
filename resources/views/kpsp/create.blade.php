@extends('components.layouts.main-layout')
@section('title', 'Formulir KPSP')

@section('content')
    <div class="p-8 bg-gray-100 min-h-screen">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Kuesioner Pra Skrining Perkembangan (KPSP)</h2>

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

            <form action="{{ route('kpsp.store') }}" method="POST">
                @csrf

                <!-- Identitas & Pemeriksaan -->
                <div class="bg-blue-50 p-4 rounded-lg mb-6">
                    <h3 class="font-bold text-lg mb-4 flex items-center">
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
                                            data-jenis-kelamin="{{ $anak->jenis_kelamin_lengkap }}"
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
                            <label class="block text-sm font-medium mb-2">Tanggal Lahir</label>
                            <input type="text" id="tanggal_lahir" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100" readonly>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Tanggal Pemeriksaan <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_pemeriksaan" id="tanggal_pemeriksaan" value="{{ old('tanggal_pemeriksaan') }}" class="w-full px-3 py-2 border @error('tanggal_pemeriksaan') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" required>
                            @error('tanggal_pemeriksaan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Usia (otomatis)</label>
                            <input type="text" id="usia_display" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100" readonly>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Jenis Kelamin</label>
                            <input type="text" id="jenis_kelamin" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100" readonly>
                        </div>
                    </div>
                </div>

                <!-- KPSP Questions -->
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-bold text-lg">Kuesioner Pra Skrining Perkembangan (KPSP)</h3>
                        <span class="text-sm bg-teal-100 px-3 py-1 rounded">12 bulan</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">Checklist 10 item sesuai pada usia: Ya = 1 Tidak = 0.</p>

                    <!-- Motorik Kasar -->
                    <div class="bg-white border border-gray-300 rounded-lg p-4 mb-4">
                        <h4 class="font-semibold text-teal-600 mb-3">Motorik Kasar</h4>
                        <label class="flex items-start mb-3">
                            <input type="checkbox" name="berdiri_berpegangan" class="mt-1 mr-3" {{ old('berdiri_berpegangan') ? 'checked' : '' }}>
                            <span class="text-sm">Berdiri berpegangan</span>
                        </label>
                        <label class="flex items-start">
                            <input type="checkbox" name="berjalan_bantuan" class="mt-1 mr-3" {{ old('berjalan_bantuan') ? 'checked' : '' }}>
                            <span class="text-sm">Berjalan beberapa langkah dengan bantuan</span>
                        </label>
                    </div>

                    <!-- Motorik Halus -->
                    <div class="bg-white border border-gray-300 rounded-lg p-4 mb-4">
                        <h4 class="font-semibold text-teal-600 mb-3">Motorik Halus</h4>
                        <label class="flex items-start mb-3">
                            <input type="checkbox" name="mengambil_benda_tangan" class="mt-1 mr-3" {{ old('mengambil_benda_tangan') ? 'checked' : '' }}>
                            <span class="text-sm">Mengambil benda dengan tangan/bermain</span>
                        </label>
                        <label class="flex items-start">
                            <input type="checkbox" name="mengambil_benda_kecil" class="mt-1 mr-3" {{ old('mengambil_benda_kecil') ? 'checked' : '' }}>
                            <span class="text-sm">Mengambil benda kecil dengan dua jari</span>
                        </label>
                    </div>

                    <!-- Bahasa/Komunikasi -->
                    <div class="bg-white border border-gray-300 rounded-lg p-4 mb-4">
                        <h4 class="font-semibold text-teal-600 mb-3">Bahasa / Komunikasi</h4>
                        <label class="flex items-start mb-3">
                            <input type="checkbox" name="mengucap_suku_kata" class="mt-1 mr-3" {{ old('mengucap_suku_kata') ? 'checked' : '' }}>
                            <span class="text-sm">Mengucap suku kata berulang (ma/ba)</span>
                        </label>
                        <label class="flex items-start">
                            <input type="checkbox" name="merespon_saat_dipanggil" class="mt-1 mr-3" {{ old('merespon_saat_dipanggil') ? 'checked' : '' }}>
                            <span class="text-sm">Merespon saat dipanggil namanya</span>
                        </label>
                    </div>

                    <!-- Sosial/Emosional & Kognitif -->
                    <div class="bg-white border border-gray-300 rounded-lg p-4 mb-4">
                        <h4 class="font-semibold text-teal-600 mb-3">Sosial / Emosional & Kognitif</h4>
                        <label class="flex items-start mb-3">
                            <input type="checkbox" name="melepas_tangan" class="mt-1 mr-3" {{ old('melepas_tangan') ? 'checked' : '' }}>
                            <span class="text-sm">Melepas tangan/bermain cilukba</span>
                        </label>
                        <label class="flex items-start mb-3">
                            <input type="checkbox" name="menirukan_bunyi" class="mt-1 mr-3" {{ old('menirukan_bunyi') ? 'checked' : '' }}>
                            <span class="text-sm">Menirukan bunyi/gerakan sederhana</span>
                        </label>
                        <label class="flex items-start mb-3">
                            <input type="checkbox" name="menunjuk_benda" class="mt-1 mr-3" {{ old('menunjuk_benda') ? 'checked' : '' }}>
                            <span class="text-sm">Menunjuk benda dikenal</span>
                        </label>
                        <label class="flex items-start">
                            <input type="checkbox" name="minum_cangkir" class="mt-1 mr-3" {{ old('minum_cangkir') ? 'checked' : '' }}>
                            <span class="text-sm">Minum dari cangkir dibantu</span>
                        </label>
                    </div>
                </div>

                <!-- Catatan & Rekomendasi -->
                <div class="mb-6">
                    <h3 class="font-bold text-lg mb-4">Catatan & Rekomendasi Kader</h3>
                    <label class="block text-sm font-medium mb-2">Catatan</label>
                    <textarea name="catatan" rows="3" class="w-full px-3 py-2 border @error('catatan') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 mb-4" placeholder="Contoh: Perlu stimulasi bahasa harian (membaca buku), ulang KPSP 2 minggu.">{{ old('catatan') }}</textarea>
                    @error('catatan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <label class="block text-sm font-medium mb-2">Rekomendasi</label>
                    <textarea name="rekomendasi" rows="3" class="w-full px-3 py-2 border @error('rekomendasi') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">{{ old('rekomendasi') }}</textarea>
                    @error('rekomendasi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="document.querySelector('form').reset(); resetFields();" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Reset</button>
                    <button type="submit" class="px-6 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600">
                        Simpan Kunjungan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('anak_id').addEventListener('change', function () {
            const selected = this.options[this.selectedIndex];
            document.getElementById('nik_anak').value = selected.dataset.nik || '';
            document.getElementById('tanggal_lahir').value = selected.dataset.tanggalLahir || '';
            document.getElementById('jenis_kelamin').value = selected.dataset.jenisKelamin || '';
            calculateAge();
        });

        document.getElementById('tanggal_pemeriksaan').addEventListener('change', calculateAge);

        // Set tanggal pemeriksaan ke hari ini saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            if (!document.getElementById('tanggal_pemeriksaan').value) {
                document.getElementById('tanggal_pemeriksaan').value = today;
            }

            // Jika ada old value untuk anak_id, trigger auto-fill
            const anakSelect = document.getElementById('anak_id');
            if (anakSelect.value) {
                const selected = anakSelect.options[anakSelect.selectedIndex];
                document.getElementById('nik_anak').value = selected.dataset.nik || '';
                document.getElementById('tanggal_lahir').value = selected.dataset.tanggalLahir || '';
                document.getElementById('jenis_kelamin').value = selected.dataset.jenisKelamin || '';
                calculateAge();
            }
        });

        function calculateAge() {
            const birthDate = document.getElementById('tanggal_lahir').value;
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
            }
        }

        function resetFields() {
            document.getElementById('nik_anak').value = '';
            document.getElementById('tanggal_lahir').value = '';
            document.getElementById('jenis_kelamin').value = '';
            document.getElementById('usia_display').value = '';
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('tanggal_pemeriksaan').value = today;
        }
    </script>
@endsection
