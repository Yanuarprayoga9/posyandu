@extends('components.layouts.main-layout')
@section('title', 'Dashboard')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Header Section -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Selamat Datang</h2>
                    <p class="text-gray-600 mt-1">Ringkasan data dan insight Posyandu Mugi Lestari.</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500">Terakhir diperbarui: hari ini</p>
                    <p class="text-xs text-gray-400">{{ now()->format('d M Y, H:i') }} WIB</p>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <!-- Total Anak -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Total Anak</p>
                        <h3 class="text-3xl font-bold text-gray-800">{{ $totalAnak }}</h3>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Laki-laki -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Laki-laki</p>
                        <h3 class="text-3xl font-bold text-blue-600">{{ $lakiLaki }}</h3>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Perempuan -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Perempuan</p>
                        <h3 class="text-3xl font-bold text-pink-600">{{ $perempuan }}</h3>
                    </div>
                    <div class="bg-pink-100 p-3 rounded-full">
                        <svg class="w-8 h-8 text-pink-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Stunting -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Stunting</p>
                        <h3 class="text-3xl font-bold text-orange-600">{{ $stunting }}</h3>
                    </div>
                    <div class="bg-orange-100 p-3 rounded-full">
                        <svg class="w-8 h-8 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Status Gizi Chart -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Status Gizi (12 bln terakhir)</h3>
                <div class="h-[300px]">
                    <canvas id="statusGiziChart"></canvas>
                </div>
            </div>

            <!-- Komposisi Jenis Kelamin -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Komposisi Jenis Kelamin</h3>
                <div class="h-[300px]">
                    <canvas id="jenisKelaminChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Event Terdekat -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="bg-gradient-to-r from-teal-600 to-teal-700 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-white font-semibold text-lg">Event Terdekat</h3>
                    <a href="{{ route('events.index') }}" class="text-white text-sm hover:underline">Lihat semua</a>
                </div>
                <div class="p-6">
                    @forelse($upcomingEvents as $event)
                        <div class="flex items-start gap-4 pb-4 mb-4 border-b border-gray-100 last:border-0">
                            <div class="bg-teal-100 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-800">{{ $event->nama_kegiatan }}</h4>
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ $event->tanggal_kegiatan->format('d M Y') }}
                                    @if($event->jam_kegiatan)
                                        • {{ \Carbon\Carbon::parse($event->jam_kegiatan)->format('H:i') }} WIB
                                    @endif
                                </p>
                                <p class="text-sm text-gray-500 mt-1">{{ $event->lokasi_kegiatan }}</p>
                            </div>
                            <span class="px-2 py-1 bg-orange-100 text-orange-700 text-xs font-medium rounded">Penyuluhan</span>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Tidak ada event terdekat</p>
                    @endforelse
                </div>
            </div>

            <!-- Analisis & Rekomendasi -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="bg-gradient-to-r from-teal-600 to-teal-700 px-6 py-4">
                    <h3 class="text-white font-semibold text-lg">Analisis & Rekomendasi</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-orange-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600 mb-1">Prevalensi Stunting</p>
                            <h4 class="text-2xl font-bold text-orange-600">{{ $prevalensiStunting }}%</h4>
                            <p class="text-xs text-gray-500 mt-1">Stabil 3 bulan terakhir</p>
                        </div>
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600 mb-1">Usia Rentan</p>
                            <h4 class="text-2xl font-bold text-blue-600">18-24 bln</h4>
                            <p class="text-xs text-gray-500 mt-1">Perlu PMT & monitoring</p>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600 mb-1">Cakupan Timbang</p>
                            <h4 class="text-2xl font-bold text-green-600">{{ $cakupanTimbang }}%</h4>
                            <p class="text-xs text-gray-500 mt-1">Target ≥95% bulan depan</p>
                        </div>
                        <div class="bg-purple-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600 mb-1">Imunisasi Lengkap</p>
                            <h4 class="text-2xl font-bold text-purple-600">88%</h4>
                            <p class="text-xs text-gray-500 mt-1">Dorong sweeping RT 03-04</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Status Gizi Chart
        const statusGiziCtx = document.getElementById('statusGiziChart').getContext('2d');
        new Chart(statusGiziCtx, {
            type: 'line',
            data: {
                labels: @json($chartData['labels']),
                datasets: [
                    {
                        label: 'Gizi Kurang',
                        data: @json($chartData['giziKurang']),
                        borderColor: 'rgb(251, 146, 60)',
                        backgroundColor: 'rgba(251, 146, 60, 0.1)',
                        tension: 0.4
                    },
                    {
                        label: 'Normal',
                        data: @json($chartData['normal']),
                        borderColor: 'rgb(34, 197, 94)',
                        backgroundColor: 'rgba(34, 197, 94, 0.1)',
                        tension: 0.4
                    },
                    {
                        label: 'Stunting',
                        data: @json($chartData['stunting']),
                        borderColor: 'rgb(239, 68, 68)',
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 15
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 5
                        }
                    }
                }
            }
        });

        // Jenis Kelamin Chart
        const jenisKelaminCtx = document.getElementById('jenisKelaminChart').getContext('2d');
        new Chart(jenisKelaminCtx, {
            type: 'doughnut',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    data: [{{ $lakiLaki }}, {{ $perempuan }}],
                    backgroundColor: [
                        'rgb(59, 130, 246)',
                        'rgb(236, 72, 153)'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 15
                        }
                    }
                }
            }
        });
    </script>
@endsection
