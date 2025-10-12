@extends('components.layouts.main-layout')
@section('title', 'Data Pemeriksaan')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-teal-600">Data Pemeriksaan</h2>
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-200 text-gray-700 font-semibold">
                    AP
                </div>
                <span class="text-gray-700 font-medium">Admin Posyandu</span>
            </div>
        </div>

        <!-- Info Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6 p-4">
            <p class="text-gray-600">Data pemeriksaan dan penimbangan anak & balita.</p>
        </div>

        <!-- Filter Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6 p-6">
            <h6 class="font-semibold text-gray-800 mb-4">Filter Pemeriksaan</h6>
            <form method="GET" action="{{ route('pemeriksaan.index') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pencarian</label>
                    <input type="text" name="search" value="{{ request('search') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" placeholder="NIK / Nama / Petugas...">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Vitamin</label>
                    <select name="vitamin" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                        <option value="">Semua Vitamin</option>
                        @foreach(\App\Models\JenisVitamin::all() as $jenis)
                            <option value="{{ $jenis->kode_vitamin }}" {{ request('vitamin') == $jenis->kode_vitamin ? 'selected' : '' }}>
                                {{ $jenis->nama_vitamin }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                    <select name="urutan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                        <option value="desc" {{ request('urutan') == 'desc' ? 'selected' : '' }}>Terbaru</option>
                        <option value="asc" {{ request('urutan') == 'asc' ? 'selected' : '' }}>Terlama</option>
                    </select>
                </div>
                <div class="lg:col-span-4 flex gap-2">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white font-medium rounded-lg transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                        Filter
                    </button>
                    <a href="{{ route('pemeriksaan.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium rounded-lg transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Main Content Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <!-- Top Controls -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                    <form method="GET" action="{{ route('pemeriksaan.index') }}" class="flex items-center gap-2">
                        <span class="text-gray-700">Tampilkan</span>
                        <select name="per_page" onchange="this.form.submit()" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                        <span class="text-gray-700">entri</span>
                        @foreach(request()->except('per_page') as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                    </form>
                    <div class="flex gap-2">
                        <a href="{{ route('pemeriksaan.create') }}" class="inline-flex items-center px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white font-medium rounded-lg transition duration-150 ease-in-out">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah Pemeriksaan
                        </a>
                        <button class="inline-flex items-center px-4 py-2 border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium rounded-lg transition duration-150 ease-in-out">
                            Export CSV
                        </button>
                    </div>
                </div>

                @if(request()->hasAny(['search', 'tanggal', 'vitamin']))
                    <div class="mb-4">
                        <div class="inline-flex items-center px-3 py-2 bg-teal-50 text-teal-700 rounded-lg text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Filter aktif
                            <a href="{{ route('pemeriksaan.index') }}" class="ml-2 hover:text-teal-900">
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
                            <th scope="col" class="px-4 py-3">Tanggal</th>
                            <th scope="col" class="px-4 py-3">NIK</th>
                            <th scope="col" class="px-4 py-3">Nama Anak</th>
                            <th scope="col" class="px-4 py-3">Usia</th>
                            <th scope="col" class="px-4 py-3">BB (kg)</th>
                            <th scope="col" class="px-4 py-3">TB (cm)</th>
                            <th scope="col" class="px-4 py-3">LK (cm)</th>
                            <th scope="col" class="px-4 py-3">LILA (cm)</th>
                            <th scope="col" class="px-4 py-3">Suhu (°C)</th>
                            <th scope="col" class="px-4 py-3">Vitamin</th>
                            <th scope="col" class="px-4 py-3">Tindakan</th>
                            <th scope="col" class="px-4 py-3">Petugas</th>
                            <th scope="col" class="px-4 py-3">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        @forelse($pemeriksaans as $index => $pemeriksaan)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-4 py-3 text-gray-900">{{ $pemeriksaans->firstItem() + $index }}</td>
                                <td class="px-4 py-3 text-gray-900">{{ $pemeriksaan->tanggal_pemeriksaan->format('d M Y') }}</td>
                                <td class="px-4 py-3 text-gray-900">{{ $pemeriksaan->anak->nik_anak }}</td>
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $pemeriksaan->anak->nama_anak }}</td>
                                <td class="px-4 py-3 text-gray-900">{{ $pemeriksaan->usia_bulan ?? '-' }} Bulan</td>
                                <td class="px-4 py-3 text-gray-900">{{ $pemeriksaan->berat_badan ?? '-' }}</td>
                                <td class="px-4 py-3 text-gray-900">{{ $pemeriksaan->tinggi_badan ?? '-' }}</td>
                                <td class="px-4 py-3 text-gray-900">{{ $pemeriksaan->lingkar_kepala ?? '-' }}</td>
                                <td class="px-4 py-3 text-gray-900">{{ $pemeriksaan->lingkar_lengan_atas ?? '-' }}</td>
                                <td class="px-4 py-3 text-gray-900">{{ $pemeriksaan->suhu_tubuh ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    @if($pemeriksaan->pemberianVitamins->count() > 0)
                                        @foreach($pemeriksaan->pemberianVitamins as $pemberian)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-100 text-teal-800 mb-1 mr-1">
                                                {{ $pemberian->jenisVitamin->nama_vitamin }}
                                            </span>
                                        @endforeach
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-gray-500">{{ $pemeriksaan->tindakan ?? '-' }}</td>
                                <td class="px-4 py-3 text-gray-900">{{ $pemeriksaan->petugas ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex gap-2">
                                        <a href="{{ route('pemeriksaan.edit', $pemeriksaan) }}" class="text-blue-600 hover:text-blue-900">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('pemeriksaan.destroy', $pemeriksaan) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="14" class="px-4 py-8 text-center text-gray-500">
                                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                    @if(request()->hasAny(['search', 'tanggal', 'vitamin']))
                                        <p class="font-medium">Tidak ada hasil yang sesuai dengan filter</p>
                                        <a href="{{ route('pemeriksaan.index') }}" class="text-teal-600 hover:text-teal-700 mt-2 inline-block">Tampilkan semua data</a>
                                    @else
                                        Tidak ada data pemeriksaan
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($pemeriksaans->hasPages())
                    <div class="flex flex-col md:flex-row justify-between items-center mt-6 gap-4">
                        <div class="text-sm text-gray-700">
                            Menampilkan <span class="font-semibold">{{ $pemeriksaans->firstItem() ?? 0 }}</span> sampai <span class="font-semibold">{{ $pemeriksaans->lastItem() ?? 0 }}</span> dari <span class="font-semibold">{{ $pemeriksaans->total() }}</span> data
                        </div>
                        <div>
                            {{ $pemeriksaans->links() }}
                        </div>
                    </div>
                @else
                    @if($pemeriksaans->total() > 0)
                        <div class="mt-6 text-sm text-gray-700">
                            Menampilkan <span class="font-semibold">{{ $pemeriksaans->total() }}</span> data
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
