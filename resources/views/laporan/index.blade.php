@extends('components.layouts.main-layout')
@section('title', 'Laporan Kesehatan Anak')

@section('content')
    <div class="p-8 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Laporan Kesehatan Anak</h2>
                <p class="text-gray-600">Data statistik dan riwayat pemeriksaan kesehatan anak balita.</p>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-2 md:grid-cols-6 gap-4 mb-6">
                <!-- Total Kunjungan -->
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs text-gray-600 mb-1">Total Kunjungan</p>
                            <p class="text-xs text-gray-500">Balita</p>
                            <p class="text-2xl font-bold text-gray-800 mt-2">{{ $totalKunjungan }}</p>
                        </div>
                        <div class="w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Laki-laki -->
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs text-gray-600 mb-1">Laki-laki</p>
                            <p class="text-2xl font-bold text-blue-600 mt-2">{{ $lakiLaki }}</p>
                        </div>
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <span class="text-blue-600 text-xl font-bold">♂</span>
                        </div>
                    </div>
                </div>

                <!-- Perempuan -->
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs text-gray-600 mb-1">Perempuan</p>
                            <p class="text-2xl font-bold text-pink-600 mt-2">{{ $perempuan }}</p>
                        </div>
                        <div class="w-10 h-10 bg-pink-100 rounded-lg flex items-center justify-center">
                            <span class="text-pink-600 text-xl font-bold">♀</span>
                        </div>
                    </div>
                </div>

                <!-- Stunting -->
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs text-gray-600 mb-1">Stunting</p>
                            <p class="text-2xl font-bold text-yellow-600 mt-2">{{ $stunting }}</p>
                        </div>
                        <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Gizi Kurang/Lebih -->
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs text-gray-600 mb-1">Gizi Kurang/Lebih</p>
                            <p class="text-2xl font-bold text-orange-600 mt-2">{{ $giziKurang + $giziLebih }}</p>
                        </div>
                        <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Riwayat Perkembangan -->
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs text-gray-600 mb-1">Riwayat Perkembangan</p>
                            <p class="text-2xl font-bold text-purple-600 mt-2">{{ $riwayatPerkembangan }}</p>
                        </div>
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Distribusi Status Gizi (Pie Chart) -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Distribusi Status Gizi</h3>
                    <div class="relative h-64">
                        <canvas id="statusGiziChart"></canvas>
                    </div>
                    <div class="mt-4 grid grid-cols-2 gap-2 text-xs">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 bg-green-500 rounded"></span>
                            <span class="text-gray-600">Normal: <strong>{{ $normal }}</strong></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 bg-yellow-500 rounded"></span>
                            <span class="text-gray-600">Gizi Kurang: <strong>{{ $giziKurang }}</strong></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 bg-blue-500 rounded"></span>
                            <span class="text-gray-600">Gizi Lebih: <strong>{{ $giziLebih }}</strong></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 bg-red-500 rounded"></span>
                            <span class="text-gray-600">Stunting: <strong>{{ $stunting }}</strong></span>
                        </div>
                    </div>
                </div>

                <!-- Kurva Tinggi Badan WHO (Line Chart) -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Kurva Tinggi Badan per Usia (TB/U) ±2SD (WHO)</h3>
                    <div class="relative h-64">
                        <canvas id="tinggiChart"></canvas>
                    </div>
                    <div class="mt-4 flex justify-center gap-4 text-xs">
                        <div class="flex items-center gap-2">
                            <span class="w-8 h-0.5 bg-teal-500"></span>
                            <span class="text-gray-600">Median (WHO)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-8 h-0.5 bg-blue-500 border-dashed border-t-2 border-blue-500"></span>
                            <span class="text-gray-600">+2 SD</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-8 h-0.5 bg-red-500 border-dashed border-t-2 border-red-500"></span>
                            <span class="text-gray-600">-2 SD</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-gray-700 rounded-full"></span>
                            <span class="text-gray-600">Data Anak</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter & Table -->
            <div class="bg-white rounded-lg shadow p-6">
                <!-- Filter Form -->
                <form action="{{ route('laporan.index') }}" method="GET" class="mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Dari Tanggal</label>
                            <input type="date" name="dari_tanggal" value="{{ request('dari_tanggal') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Sampai Tanggal</label>
                            <input type="date" name="sampai_tanggal" value="{{ request('sampai_tanggal') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                <option value="">Semua</option>
                                <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status Gizi</label>
                            <select name="status_gizi" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                <option value="">Semua</option>
                                <option value="Normal" {{ request('status_gizi') == 'Normal' ? 'selected' : '' }}>Normal</option>
                                <option value="Kurang" {{ request('status_gizi') == 'Kurang' ? 'selected' : '' }}>Gizi Kurang</option>
                                <option value="Lebih" {{ request('status_gizi') == 'Lebih' ? 'selected' : '' }}>Gizi Lebih</option>
                                <option value="Stunting" {{ request('status_gizi') == 'Stunting' ? 'selected' : '' }}>Stunting</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Cari</label>
                            <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Nama / NIK / Catatan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                        </div>
                    </div>
                    <div class="flex gap-2 mt-4">
                        <button type="submit" class="px-6 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition">Terapkan</button>
                        <a href="{{ route('laporan.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">Reset</a>
                    </div>
                </form>

                <!-- Export Buttons -->
                <div class="flex gap-2 mb-4">
                    <button onclick="exportCSV()" class="px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-2 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Unduh CSV
                    </button>
                    <button onclick="window.print()" class="px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-2 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Cetak PDF
                    </button>
                    <button onclick="exportExcel()" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center gap-2 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Export Excel
                    </button>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Tgl Periksa</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">NIK</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Nama Anak</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">JK</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Usia (bln)</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">BB (kg)</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">TB (cm)</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status Gizi</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Catatan</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($anaks as $anak)
                            @foreach($anak->pemeriksaans as $pemeriksaan)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 text-gray-800">{{ $pemeriksaan->tanggal_pemeriksaan->format('Y-m-d') }}</td>
                                    <td class="px-4 py-3 text-gray-800">{{ $anak->nik_anak }}</td>
                                    <td class="px-4 py-3 text-gray-800 font-medium">{{ $anak->nama_anak }}</td>
                                    <td class="px-4 py-3">
                                        @if($anak->jenis_kelamin == 'L')
                                            <span class="text-blue-600 font-semibold">L</span>
                                        @else
                                            <span class="text-pink-600 font-semibold">P</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-gray-800">{{ $pemeriksaan->usia_bulan ?? '-' }}</td>
                                    <td class="px-4 py-3 text-gray-800">{{ $pemeriksaan->berat_badan ?? '-' }}</td>
                                    <td class="px-4 py-3 text-gray-800">{{ $pemeriksaan->tinggi_badan ?? '-' }}</td>
                                    <td class="px-4 py-3">
                                        @if($pemeriksaan->status_gizi == 'Normal')
                                            <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">Normal</span>
                                        @elseif($pemeriksaan->status_gizi == 'Kurang')
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs rounded-full">Gizi Kurang</span>
                                        @elseif($pemeriksaan->status_gizi == 'Lebih')
                                            <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded-full">Gizi Lebih</span>
                                        @elseif($pemeriksaan->status_gizi == 'Stunting')
                                            <span class="px-2 py-1 bg-red-100 text-red-700 text-xs rounded-full">Stunting</span>
                                        @else
                                            <span class="text-gray-500">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-gray-600 text-xs">{{ Str::limit($pemeriksaan->catatan ?? '-', 30) }}</td>
                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="9" class="px-4 py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center gap-2">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <p class="text-sm font-medium">Tidak ada data yang ditemukan</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $anaks->links() }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Pie Chart - Status Gizi
        const ctxPie = document.getElementById('statusGiziChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'doughnut',
            data: {
                labels: ['Normal', 'Gizi Kurang', 'Gizi Lebih', 'Stunting'],
                datasets: [{
                    data: [{{ $normal }}, {{ $giziKurang }}, {{ $giziLebih }}, {{ $stunting }}],
                    backgroundColor: [
                        '#10B981', // green
                        '#F59E0B', // yellow
                        '#3B82F6', // blue
                        '#EF4444'  // red
                    ],
                    borderWidth: 3,
                    borderColor: '#fff',
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                aspectRatio: 1.5,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        titleFont: { size: 14, weight: 'bold' },
                        bodyFont: { size: 13 },
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((context.parsed / total) * 100).toFixed(1);
                                return context.label + ': ' + context.parsed + ' (' + percentage + '%)';
                            }
                        }
                    }
                }
            }
        });

        // Line Chart - WHO Growth Chart
        const ctxLine = document.getElementById('tinggiChart').getContext('2d');
        const whoMedian = [50, 55, 60, 64, 67, 70, 72, 74, 76, 78, 80, 81, 82, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95];
        const whoPlus2SD = [52, 57, 62, 66, 69, 72, 75, 77, 79, 81, 83, 85, 86, 88, 89, 90, 92, 93, 94, 95, 96, 97, 98, 99, 100];
        const whoMinus2SD = [48, 53, 58, 62, 65, 68, 70, 72, 74, 76, 77, 79, 80, 81, 82, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93];

        new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: Array.from({length: 25}, (_, i) => i),
                datasets: [
                    {
                        label: 'Median (WHO)',
                        data: whoMedian,
                        borderColor: '#14B8A6',
                        backgroundColor: 'rgba(20, 184, 166, 0.1)',
                        tension: 0.4,
                        borderWidth: 2.5,
                        pointRadius: 0,
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: '#14B8A6',
                        fill: false
                    },
                    {
                        label: '+2 SD',
                        data: whoPlus2SD,
                        borderColor: '#3B82F6',
                        borderDash: [8, 4],
                        backgroundColor: 'transparent',
                        tension: 0.4,
                        borderWidth: 2,
                        pointRadius: 0,
                        pointHoverRadius: 5
                    },
                    {
                        label: '-2 SD',
                        data: whoMinus2SD,
                        borderColor: '#EF4444',
                        borderDash: [8, 4],
                        backgroundColor: 'transparent',
                        tension: 0.4,
                        borderWidth: 2,
                        pointRadius: 0,
                        pointHoverRadius: 5
                    },
                    {
                        label: 'Data Anak',
                        data: [
                            {x: 2, y: 60},
                            {x: 6, y: 68},
                            {x: 12, y: 76},
                            {x: 18, y: 82},
                            {x: 24, y: 88}
                        ],
                        borderColor: '#1F2937',
                        backgroundColor: '#1F2937',
                        pointRadius: 5,
                        pointHoverRadius: 8,
                        showLine: false,
                        pointStyle: 'circle'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                aspectRatio: 1.8,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        min: 45,
                        max: 105,
                        title: {
                            display: true,
                            text: 'Tinggi (cm)',
                            font: { size: 12, weight: 'bold' },
                            color: '#374151'
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#6B7280',
                            font: { size: 11 }
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Usia (bulan)',
                            font: { size: 12, weight: 'bold' },
                            color: '#374151'
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#6B7280',
                            font: { size: 11 },
                            stepSize: 5
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        titleFont: { size: 13, weight: 'bold' },
                        bodyFont: { size: 12 },
                        displayColors: true,
                        callbacks: {
                            title: function(context) {
                                return 'Usia: ' + context[0].label + ' bulan';
                            },
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y.toFixed(1) + ' cm';
                            }
                        }
                    }
                }
            }
        });

        function exportCSV() {
            const params = new URLSearchParams(window.location.search);
            window.location.href = '{{ route("laporan.export.csv") }}?' + params.toString();
        }

        function exportExcel() {
            const params = new URLSearchParams(window.location.search);
            window.location.href = '{{ route("laporan.export.excel") }}?' + params.toString();
        }
    </script>
@endsection
