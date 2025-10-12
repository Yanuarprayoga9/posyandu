@extends('components.layouts.main-layout')
@section('title', 'Data Imunisasi')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-teal-600">Data Imunisasi</h2>
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-200 text-gray-700 font-semibold">
                    ML
                </div>
                <span class="text-gray-700 font-medium">Mugi Lestari</span>
            </div>
        </div>

        <!-- Info Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6 p-4">
            <p class="text-gray-600">Daftar imunisasi dari riwayat kunjungan.</p>
        </div>

        <!-- Main Content Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <!-- Top Controls -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                    <form method="GET" action="{{ route('imunisasi.index') }}" class="flex items-center gap-2">
                        <span class="text-gray-700">Tampilkan</span>
                        <select name="per_page" onchange="this.form.submit()" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                        <span class="text-gray-700">entri</span>
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    </form>
                    <div class="flex gap-2">
                        <a href="{{ route('imunisasi.create') }}" class="inline-flex items-center px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white font-medium rounded-lg transition duration-150 ease-in-out">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah Imunisasi
                        </a>
                        <button class="inline-flex items-center px-4 py-2 border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium rounded-lg transition duration-150 ease-in-out">
                            Export CSV
                        </button>
                    </div>
                </div>

                <!-- Search Input -->
                <div class="mb-6">
                    <form method="GET" action="{{ route('imunisasi.index') }}">
                        <div class="relative">
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="w-full md:w-80 pl-10 pr-20 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                                placeholder="Cari NIK, nama anak, nama ibu, jenis imunisasi...">
                            <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            @if(request('search'))
                                <a href="{{ route('imunisasi.index') }}" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                        <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}">
                    </form>
                </div>

                @if(request('search'))
                    <div class="mb-4">
                        <div class="inline-flex items-center px-3 py-2 bg-teal-50 text-teal-700 rounded-lg text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Hasil pencarian untuk: <strong class="ml-1">"{{ request('search') }}"</strong>
                            <a href="{{ route('imunisasi.index') }}" class="ml-2 hover:text-teal-900">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endif

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                        <tr>
                            <th scope="col" class="px-4 py-3">No</th>
                            <th scope="col" class="px-4 py-3">NIK</th>
                            <th scope="col" class="px-4 py-3">Nama Anak</th>
                            <th scope="col" class="px-4 py-3">Tanggal Lahir</th>
                            <th scope="col" class="px-4 py-3">Jenis Kelamin</th>
                            <th scope="col" class="px-4 py-3">Nama Ibu</th>
                            <th scope="col" class="px-4 py-3">Tanggal Imunisasi</th>
                            <th scope="col" class="px-4 py-3">Usia</th>
                            <th scope="col" class="px-4 py-3">Jenis</th>
                            <th scope="col" class="px-4 py-3">Keterangan</th>
                            <th scope="col" class="px-4 py-3">Petugas</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        @forelse($imunisasis as $index => $imunisasi)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-4 py-3 text-gray-900">{{ $imunisasis->firstItem() + $index }}</td>
                                <td class="px-4 py-3 text-gray-900">{{ $imunisasi->anak->nik_anak }}</td>
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $imunisasi->anak->nama_anak }}</td>
                                <td class="px-4 py-3 text-gray-900">{{ $imunisasi->anak->tanggal_lahir_anak->format('Y-m-d') }}</td>
                                <td class="px-4 py-3">
                                    @if($imunisasi->anak->jenis_kelamin == 'P')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-pink-100 text-pink-800">
                                            ♀ Perempuan
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            ♂ Laki-laki
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-gray-900">{{ $imunisasi->anak->nama_ibu }}</td>
                                <td class="px-4 py-3 text-gray-900">{{ $imunisasi->tanggal_imunisasi->format('d M Y') }}</td>
                                <td class="px-4 py-3 text-gray-900">{{ $imunisasi->usia_saat_imunisasi_bulan }} Bulan</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-100 text-teal-800">
                                        {{ $imunisasi->jenisImunisasi->nama_imunisasi }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-gray-500">{{ $imunisasi->keterangan ?? '-' }}</td>
                                <td class="px-4 py-3 text-gray-900">{{ $imunisasi->petugas ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="px-4 py-8 text-center text-gray-500">
                                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                    @if(request('search'))
                                        <p class="font-medium">Tidak ada hasil untuk pencarian "{{ request('search') }}"</p>
                                        <a href="{{ route('imunisasi.index') }}" class="text-teal-600 hover:text-teal-700 mt-2 inline-block">Tampilkan semua data</a>
                                    @else
                                        Tidak ada data imunisasi
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($imunisasis->hasPages())
                    <div class="flex flex-col md:flex-row justify-between items-center mt-6 gap-4">
                        <div class="text-sm text-gray-700">
                            Menampilkan <span class="font-semibold">{{ $imunisasis->firstItem() ?? 0 }}</span> sampai <span class="font-semibold">{{ $imunisasis->lastItem() ?? 0 }}</span> dari <span class="font-semibold">{{ $imunisasis->total() }}</span> data
                        </div>
                        <div>
                            {{ $imunisasis->links() }}
                        </div>
                    </div>
                @else
                    @if($imunisasis->total() > 0)
                        <div class="mt-6 text-sm text-gray-700">
                            Menampilkan <span class="font-semibold">{{ $imunisasis->total() }}</span> data
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
