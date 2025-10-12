@extends('components.layouts.main-layout')
@section('title', 'Tambah Imunisasi')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-teal-600">Tambah Imunisasi</h2>
{{--            <div class="flex items-center gap-2">--}}
{{--                <span class="inline-flex items-center justify-center w-8 h-8 bg-gray-200 rounded-full text-sm font-semibold text-gray-700">ML</span>--}}
{{--                <span class="text-gray-700">Mugi Lestari</span>--}}
{{--            </div>--}}
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-6">Data Imunisasi Anak & Balita</h3>

                <form action="{{ route('imunisasi.store') }}" method="POST" id="imunisasiForm">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- NIK -->


                        <!-- Nama Anak -->
                        <div>
                            <label for="anak_id" class="block mb-2 text-sm font-semibold text-gray-700">
                                Nama Anak <span class="text-red-500">*</span>
                            </label>
                            <select id="anak_id"
                                    name="anak_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5"
                                    required>
                                <option value="">Nama lengkap anak</option>
                                @foreach($anaks as $anak)
                                    <option value="{{ $anak->id }}"
                                            data-nik="{{ $anak->nik_anak }}"
                                            data-tanggal-lahir="{{ $anak->tanggal_lahir_anak }}"
                                            data-jenis-kelamin="{{ $anak->jenis_kelamin }}"
                                            data-nama-ibu="{{ $anak->nama_ibu }}">
                                        {{ $anak->nama_anak }}
                                    </option>
                                @endforeach
                            </select>
                            @error('anak_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Lahir -->
                        <div>
                            <label for="tanggal_lahir" class="block mb-2 text-sm font-semibold text-gray-700">Tanggal Lahir</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </div>
                                <input type="text"
                                       id="tanggal_lahir"
                                       class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full ps-10 p-2.5"
                                       placeholder="dd/mm/yyyy"
                                       readonly>
                            </div>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label for="jenis_kelamin" class="block mb-2 text-sm font-semibold text-gray-700">Jenis Kelamin</label>
                            <select id="jenis_kelamin"
                                    class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    disabled>
                                <option>Pilih</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        <!-- Nama Ibu -->
                        <div class="md:col-span-2">
                            <label for="nama_ibu" class="block mb-2 text-sm font-semibold text-gray-700">Nama Ibu</label>
                            <input type="text"
                                   id="nama_ibu"
                                   class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                   placeholder="Opsional"
                                   readonly>
                        </div>

                        <!-- Tanggal Imunisasi -->
                        <div>
                            <label for="tanggal_imunisasi" class="block mb-2 text-sm font-semibold text-gray-700">
                                Tanggal Imunisasi <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </div>
                                <input type="date"
                                       id="tanggal_imunisasi"
                                       name="tanggal_imunisasi"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full ps-10 p-2.5"
                                       required>
                            </div>
                            @error('tanggal_imunisasi')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Usia -->
                        <div>
                            <label for="usia_saat_imunisasi_bulan" class="block mb-2 text-sm font-semibold text-gray-700">Usia (contoh: 6 Bulan)</label>
                            <input type="number"
                                   id="usia_saat_imunisasi_bulan"
                                   name="usia_saat_imunisasi_bulan"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5"
                                   placeholder="6 Bulan / 1 Tahun"
                                   min="0">
                            @error('usia_saat_imunisasi_bulan')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jenis Imunisasi -->
                        <div>
                            <label for="jenis_imunisasi_id" class="block mb-2 text-sm font-semibold text-gray-700">
                                Jenis Imunisasi <span class="text-red-500">*</span>
                            </label>
                            <select id="jenis_imunisasi_id"
                                    name="jenis_imunisasi_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5"
                                    required>
                                <option value="">Pilih Jenis</option>
                                @foreach($jenisImunisasis as $jenis)
                                    <option value="{{ $jenis->id }}">
                                        {{ $jenis->nama_imunisasi }} ({{ $jenis->usia_target_bulan }} bulan)
                                    </option>
                                @endforeach
                            </select>
                            @error('jenis_imunisasi_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Keterangan -->
                        <div>
                            <label for="keterangan" class="block mb-2 text-sm font-semibold text-gray-700">Keterangan</label>
                            <input type="text"
                                   id="keterangan"
                                   name="keterangan"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5"
                                   placeholder="Opsional">
                        </div>

                        <!-- Petugas -->
                        <div class="md:col-span-2">
                            <label for="petugas" class="block mb-2 text-sm font-semibold text-gray-700">Petugas</label>
                            <input type="text"
                                   id="petugas"
                                   name="petugas"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5"
                                   placeholder="Nama petugas (opsional)">
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end gap-3 mt-8">
                        <a href="{{ route('imunisasi.index') }}"
                           class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-5 py-2.5 text-sm font-medium text-white bg-teal-600 rounded-lg hover:bg-teal-700 focus:ring-4 focus:outline-none focus:ring-teal-300">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const anakSelect = document.getElementById('anak_id');
            const nikSearch = document.getElementById('nik_search');
            const tanggalLahir = document.getElementById('tanggal_lahir');
            const jenisKelamin = document.getElementById('jenis_kelamin');
            const namaIbu = document.getElementById('nama_ibu');

            // Auto-fill data when anak selected
            anakSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];

                if (this.value) {
                    const tanggalLahirValue = selectedOption.dataset.tanggalLahir;
                    const jenisKelaminValue = selectedOption.dataset.jenisKelamin;
                    const namaIbuValue = selectedOption.dataset.namaIbu;

                    // Format tanggal lahir
                    if (tanggalLahirValue) {
                        const date = new Date(tanggalLahirValue);
                        const formatted = date.toLocaleDateString('id-ID', {
                            day: '2-digit',
                            month: '2-digit',
                            year: 'numeric'
                        });
                        tanggalLahir.value = formatted;
                    }

                    jenisKelamin.value = jenisKelaminValue === 'L' ? 'L' : 'P';
                    namaIbu.value = namaIbuValue || '';
                } else {
                    tanggalLahir.value = '';
                    jenisKelamin.value = '';
                    namaIbu.value = '';
                }
            });

            // NIK search functionality
            nikSearch.addEventListener('input', function() {
                const searchValue = this.value.toLowerCase();

                for (let i = 0; i < anakSelect.options.length; i++) {
                    const option = anakSelect.options[i];
                    const nik = option.dataset.nik;

                    if (nik && nik.toLowerCase().includes(searchValue)) {
                        anakSelect.value = option.value;
                        anakSelect.dispatchEvent(new Event('change'));
                        break;
                    }
                }
            });

            // Form validation
            const form = document.getElementById('imunisasiForm');
            form.addEventListener('submit', function(e) {
                const anakId = document.getElementById('anak_id').value;
                const tanggalImunisasi = document.getElementById('tanggal_imunisasi').value;
                const jenisImunisasiId = document.getElementById('jenis_imunisasi_id').value;

                if (!anakId || !tanggalImunisasi || !jenisImunisasiId) {
                    e.preventDefault();

                    // Show error message
                    if (!anakId) {
                        showError('anak_id', 'Nama anak harus dipilih');
                    }
                    if (!tanggalImunisasi) {
                        showError('tanggal_imunisasi', 'Tanggal imunisasi harus diisi');
                    }
                    if (!jenisImunisasiId) {
                        showError('jenis_imunisasi_id', 'Jenis imunisasi harus dipilih');
                    }
                }
            });

            function showError(fieldId, message) {
                const field = document.getElementById(fieldId);
                field.classList.add('border-red-500');

                // Remove existing error message if any
                const existingError = field.parentElement.querySelector('.text-red-600');
                if (existingError) {
                    existingError.remove();
                }

                // Add new error message
                const errorMsg = document.createElement('p');
                errorMsg.className = 'mt-2 text-sm text-red-600';
                errorMsg.textContent = message;
                field.parentElement.appendChild(errorMsg);

                // Remove error on input
                field.addEventListener('input', function() {
                    this.classList.remove('border-red-500');
                    const error = this.parentElement.querySelector('.text-red-600');
                    if (error) error.remove();
                }, { once: true });
            }
        });
    </script>

    <style>
        .text-teal-600 { color: #0d9488; }
        .bg-teal-600 { background-color: #0d9488; }
        .bg-teal-700 { background-color: #0f766e; }
        .hover\:bg-teal-700:hover { background-color: #0f766e; }
        .focus\:ring-teal-300:focus {
            --tw-ring-color: rgb(94 234 212 / 0.5);
        }
        .focus\:border-teal-500:focus {
            --tw-border-opacity: 1;
            border-color: rgb(20 184 166 / var(--tw-border-opacity));
        }
        .focus\:ring-teal-500:focus {
            --tw-ring-color: rgb(20 184 166 / 0.5);
        }
    </style>
@endsection
