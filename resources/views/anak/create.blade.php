@extends('components.layouts.main-layout')
@section('title', 'Data Anak & Balita')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-5xl mx-auto">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Tambah Data Anak</h2>
                    <p class="text-gray-600 mt-1">Isi form di bawah untuk menambahkan data anak</p>
                </div>

                <form action="{{ route('anak.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- NIK Anak -->
                        <div>
                            <label for="nik_anak" class="block text-sm font-medium text-gray-700 mb-1">
                                NIK Anak <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nik_anak" id="nik_anak"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 @error('nik_anak') border-red-500 @enderror"
                                   value="{{ old('nik_anak') }}" required>
                            @error('nik_anak')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Anak -->
                        <div>
                            <label for="nama_anak" class="block text-sm font-medium text-gray-700 mb-1">
                                Nama Anak <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_anak" id="nama_anak"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 @error('nama_anak') border-red-500 @enderror"
                                   value="{{ old('nama_anak') }}" required>
                            @error('nama_anak')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tempat Lahir -->
                        <div>
                            <label for="tempat_lahir_anak" class="block text-sm font-medium text-gray-700 mb-1">
                                Tempat Lahir
                            </label>
                            <input type="text" name="tempat_lahir_anak" id="tempat_lahir_anak"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500"
                                   value="{{ old('tempat_lahir_anak') }}">
                        </div>

                        <!-- Tanggal Lahir -->
                        <div>
                            <label for="tanggal_lahir_anak" class="block text-sm font-medium text-gray-700 mb-1">
                                Tanggal Lahir
                            </label>
                            <input type="date" name="tanggal_lahir_anak" id="tanggal_lahir_anak"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500"
                                   value="{{ old('tanggal_lahir_anak') }}">
                        </div>

                        <!-- Anak Ke -->
                        <div>
                            <label for="anak_ke" class="block text-sm font-medium text-gray-700 mb-1">
                                Anak Ke
                            </label>
                            <input type="number" name="anak_ke" id="anak_ke" min="1" max="255"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500"
                                   value="{{ old('anak_ke') }}">
                        </div>

                        <!-- Golongan Darah -->
                        <div>
                            <label for="golongan_darah" class="block text-sm font-medium text-gray-700 mb-1">
                                Golongan Darah
                            </label>
                            <select name="golongan_darah" id="golongan_darah"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500">
                                <option value="">Pilih Golongan Darah</option>
                                <option value="A" {{ old('golongan_darah') == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ old('golongan_darah') == 'B' ? 'selected' : '' }}>B</option>
                                <option value="AB" {{ old('golongan_darah') == 'AB' ? 'selected' : '' }}>AB</option>
                                <option value="O" {{ old('golongan_darah') == 'O' ? 'selected' : '' }}>O</option>
                            </select>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Jenis Kelamin
                            </label>
                            <div class="flex gap-4 mt-2">
                                <label class="flex items-center">
                                    <input type="radio" name="jenis_kelamin" value="L"
                                           class="mr-2 focus:ring-teal-500" {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }}>
                                    <span class="text-sm text-gray-700">Laki-laki</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="jenis_kelamin" value="P"
                                           class="mr-2 focus:ring-teal-500" {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }}>
                                    <span class="text-sm text-gray-700">Perempuan</span>
                                </label>
                            </div>
                        </div>

                        <!-- Nama Ibu -->
                        <div>
                            <label for="nama_ibu" class="block text-sm font-medium text-gray-700 mb-1">
                                Nama Ibu
                            </label>
                            <input type="text" name="nama_ibu" id="nama_ibu"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500"
                                   value="{{ old('nama_ibu') }}">
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end gap-3 mt-6 pt-6 border-t">
                        <a href="{{ route('anak.index') }}"
                           class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-4 py-2 bg-teal-700 text-white rounded-md hover:bg-teal-800 transition">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
