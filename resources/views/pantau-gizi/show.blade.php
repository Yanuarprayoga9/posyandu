@extends('components.layouts.main-layout')
@section('title', 'Detail Pantau Gizi Anak')

@section('content')
    <div class="p-8 bg-gray-100 min-h-screen">
        <div class="max-w-5xl mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Detail Pantau Gizi Anak</h2>
                    <p class="text-sm text-gray-600 mt-1">Data pemeriksaan gizi tanggal {{ $pantauGizi->tanggal_pemeriksaan->format('d F Y') }}</p>
                </div>
                <a href="{{ route('pantau-gizi.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Identitas Anak -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h3 class="font-bold text-lg mb-4 flex items-center text-teal-700">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Identitas Anak
                        </h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs text-gray-500">Nama Anak</label>
                                <p class="font-semibold text-gray-900">{{ $pantauGizi->anak->nama_anak }}</p>
                            </div>
                            <div>
                                <label class="text-xs text-gray-500">NIK</label>
                                <p class="font-semibold text-gray-900">{{ $pantauGizi->anak->nik_anak }}</p>
                            </div>
                            <div>
                                <label class="text-xs text-gray-500">Tanggal Lahir</label>
                                <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($pantauGizi->anak->tanggal_lahir_anak)->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                <label class="text-xs text-gray-500">Jenis Kelamin</label>
                                <p class="font-semibold text-gray-900">{{ $pantauGizi->anak->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                            </div>
                            <div>
                                <label class="text-xs text-gray-500">Umur Saat Pemeriksaan</label>
                                <p class="font-semibold text-gray-900">{{ $pantauGizi->umur_bulan ?? '-' }} bulan</p>
                            </div>
                            <div>
                                <label class="text-xs text-gray-500">Petugas / Kader</label>
                                <p class="font-semibold text-gray-900">{{ $pantauGizi->petugas ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Data Antropometri -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h3 class="font-bold text-lg mb-4 flex items-center text-teal-700">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            Data Antropometri
                        </h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                                <label class="text-xs text-blue-600 font-medium">Berat Badan</label>
                                <p class="text-2xl font-bold text-blue-700">{{ $pantauGizi->berat_badan ? number_format($pantauGizi->berat_badan, 2) : '-' }} <span class="text-sm">kg</span></p>
                            </div>
                            <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                                <label class="text-xs text-green-600 font-medium">Tinggi Badan</label>
                                <p class="text-2xl font-bold text-green-700">{{ $pantauGizi->tinggi_badan ? number_format($pantauGizi->tinggi_badan, 2) : '-' }} <span class="text-sm">cm</span></p>
                            </div>
                            <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
                                <label class="text-xs text-purple-600 font-medium">Lingkar Kepala</label>
                                <p class="text-2xl font-bold text-purple-700">{{ $pantauGizi->lingkar_kepala ? number_format($pantauGizi->lingkar_kepala, 2) : '-' }} <span class="text-sm">cm</span></p>
                            </div>
                            <div class="bg-orange-50 p-4 rounded-lg border border-orange-200">
                                <label class="text-xs text-orange-600 font-medium">Lingkar Lengan Atas</label>
                                <p class="text-2xl font-bold text-orange-700">{{ $pantauGizi->lingkar_lengan_atas ? number_format($pantauGizi->lingkar_lengan_atas, 2) : '-' }} <span class="text-sm">cm</span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Pola Makan -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h3 class="font-bold text-lg mb-4 flex items-center text-teal-700">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Riwayat & Pola Makan
                        </h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm text-gray-600">Frekuensi makan per hari</span>
                                <span class="font-semibold text-gray-900">{{ $pantauGizi->frekuensi_makan ?? '-' }} kali</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm text-gray-600">Frekuensi camilan per hari</span>
                                <span class="font-semibold text-gray-900">{{ $pantauGizi->frekuensi_camilan ?? '-' }} kali</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm text-gray-600">Makanan pokok</span>
                                <span class="font-semibold text-gray-900">{{ $pantauGizi->makanan_pokok ?? '-' }}</span>
                            </div>
                            <div class="py-2 border-b border-gray-100">
                                <span class="text-sm text-gray-600 block mb-2">Konsumsi protein hewani</span>
                                @if($pantauGizi->protein_hewani && is_array($pantauGizi->protein_hewani) && count($pantauGizi->protein_hewani) > 0)
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($pantauGizi->protein_hewani as $protein)
                                            <span class="px-3 py-1 bg-teal-100 text-teal-700 text-xs rounded-full border border-teal-200">
                                                {{ ucfirst($protein) }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-gray-400 text-sm">Tidak ada data</span>
                                @endif
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm text-gray-600">Konsumsi sayur & buah</span>
                                <span class="font-semibold {{ $pantauGizi->konsumsi_sayur_buah ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $pantauGizi->konsumsi_sayur_buah ? 'Ya' : 'Tidak' }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-sm text-gray-600">Asupan ASI</span>
                                <span class="font-semibold text-gray-900">{{ ucfirst($pantauGizi->asupan_asi ?? '-') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Catatan & Rekomendasi -->
                    @if($pantauGizi->catatan || $pantauGizi->rekomendasi)
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                            <h3 class="font-bold text-lg mb-4 flex items-center text-teal-700">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Catatan & Rekomendasi
                            </h3>
                            @if($pantauGizi->catatan)
                                <div class="mb-4">
                                    <label class="text-xs text-gray-500 font-medium uppercase">Catatan</label>
                                    <p class="mt-1 text-sm text-gray-700 bg-gray-50 p-3 rounded border border-gray-200">{{ $pantauGizi->catatan }}</p>
                                </div>
                            @endif
                            @if($pantauGizi->rekomendasi)
                                <div>
                                    <label class="text-xs text-gray-500 font-medium uppercase">Rekomendasi</label>
                                    <p class="mt-1 text-sm text-gray-700 bg-gray-50 p-3 rounded border border-gray-200">{{ $pantauGizi->rekomendasi }}</p>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Status Gizi Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h3 class="font-bold text-lg mb-4 flex items-center text-teal-700">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            Status Gizi
                        </h3>
                        <div class="space-y-3">
                            <div class="bg-gray-50 p-3 rounded border border-gray-200">
                                <label class="text-xs text-gray-500">BB/U</label>
                                <p class="font-semibold text-gray-900">{{ $pantauGizi->bb_u ?? '-' }}</p>
                            </div>
                            <div class="bg-gray-50 p-3 rounded border border-gray-200">
                                <label class="text-xs text-gray-500">TB/U</label>
                                <p class="font-semibold text-gray-900">{{ $pantauGizi->tb_u ?? '-' }}</p>
                            </div>
                            <div class="bg-gray-50 p-3 rounded border border-gray-200">
                                <label class="text-xs text-gray-500">BB/TB</label>
                                <p class="font-semibold text-gray-900">{{ $pantauGizi->bb_tb ?? '-' }}</p>
                            </div>
                            <div class="bg-gray-50 p-3 rounded border border-gray-200">
                                <label class="text-xs text-gray-500">IMT/U</label>
                                <p class="font-semibold text-gray-900">{{ $pantauGizi->imt_u ?? '-' }}</p>
                            </div>
                        </div>

                        @if($pantauGizi->kategori_gizi)
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <label class="text-xs text-gray-500 mb-2 block">Kategori Gizi</label>
                                @php
                                    $colors = [
                                        'Gizi Buruk' => 'bg-red-100 text-red-800 border-red-200',
                                        'Gizi Kurang' => 'bg-orange-100 text-orange-800 border-orange-200',
                                        'Gizi Baik' => 'bg-green-100 text-green-800 border-green-200',
                                        'Gizi Lebih' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                        'Obesitas' => 'bg-purple-100 text-purple-800 border-purple-200',
                                    ];
                                    $colorClass = $colors[$pantauGizi->kategori_gizi] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                                @endphp
                                <div class="text-center p-3 rounded-lg border-2 {{ $colorClass }}">
                                    <p class="font-bold text-lg">{{ $pantauGizi->kategori_gizi }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Riwayat Pemeriksaan -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h3 class="font-bold text-lg mb-4 flex items-center text-teal-700">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Riwayat Pemeriksaan
                        </h3>
                        <div class="space-y-3 max-h-96 overflow-y-auto">
                            @forelse($riwayat as $item)
                                <div class="border-l-4 {{ $item->id == $pantauGizi->id ? 'border-teal-500 bg-teal-50' : 'border-gray-300 bg-gray-50' }} pl-4 py-3 rounded-r">
                                    <div class="flex justify-between items-start mb-1">
                                        <span class="text-xs font-semibold text-gray-900">{{ $item->tanggal_pemeriksaan->format('d/m/Y') }}</span>
                                        @if($item->id == $pantauGizi->id)
                                            <span class="text-xs bg-teal-500 text-white px-2 py-0.5 rounded-full">Saat ini</span>
                                        @endif
                                    </div>
                                    <div class="text-xs text-gray-600 space-y-1">
                                        <div>BB: <span class="font-semibold">{{ $item->berat_badan ? number_format($item->berat_badan, 2) . ' kg' : '-' }}</span></div>
                                        <div>TB: <span class="font-semibold">{{ $item->tinggi_badan ? number_format($item->tinggi_badan, 2) . ' cm' : '-' }}</span></div>
                                        @if($item->kategori_gizi)
                                            <div class="mt-2">
                                                <span class="text-xs px-2 py-1 rounded {{ $colors[$item->kategori_gizi] ?? 'bg-gray-100 text-gray-800' }}">
                                                    {{ $item->kategori_gizi }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                    @if($item->id != $pantauGizi->id)
                                        <a href="{{ route('pantau-gizi.show', $item->id) }}" class="text-xs text-teal-600 hover:text-teal-800 mt-2 inline-block">
                                            Lihat detail →
                                        </a>
                                    @endif
                                </div>
                            @empty
                                <p class="text-sm text-gray-500 text-center py-4">Belum ada riwayat pemeriksaan</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

