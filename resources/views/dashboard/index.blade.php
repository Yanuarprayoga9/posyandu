@extends('components.layouts.main-layout')
@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header Section -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-teal-700">Selamat Datang</h2>
                <p class="text-gray-600 mt-1">Ringkasan data dan insight Posyandu Mugi Lestari.</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-500">Terakhir diperbarui</p>
                <p class="text-sm font-semibold text-teal-600">{{ now()->format('d M Y, H:i') }}</p>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Total Anak -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Anak</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalAnak ?? 245 }}</p>
                </div>
                <div class="w-12 h-12 bg-teal-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Laki-laki -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Laki-laki</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $lakiLaki ?? 120 }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Perempuan -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Perempuan</p>
                    <p class="text-3xl font-bold text-pink-600">{{ $perempuan ?? 125 }}</p>
                </div>
                <div class="w-12 h-12 bg-pink-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-pink-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Stunting -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Stunting</p>
                    <p class="text-3xl font-bold text-orange-600">{{ $stunting ?? 7 }}</p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Status Gizi Chart -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Status Gizi (12 bln)</h3>
            <div class="h-64 flex items-center justify-center text-gray-400">
                <p class="text-sm">Chart akan ditampilkan dengan library JavaScript (Chart.js/ApexCharts)</p>
            </div>
        </div>

        <!-- Komposisi Jenis Kelamin -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Komposisi Jenis Kelamin (12 bln)</h3>
            <div class="h-64 flex items-center justify-center text-gray-400">
                <p class="text-sm">Chart akan ditampilkan dengan library JavaScript (Chart.js/ApexCharts)</p>
            </div>
        </div>
    </div>

    <!-- Bottom Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Event Terdekat -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="bg-gradient-to-r from-teal-600 to-teal-700 px-6 py-4 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-white">Event Terdekat</h3>
                <a href="{{ route('events.index') }}" class="text-sm text-white hover:underline">Lihat semua</a>
            </div>
            <div class="p-6">
                @forelse($upcomingEvents ?? [] as $event)
                <div class="flex items-start gap-4 mb-4 pb-4 border-b last:border-0">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-800">{{ $event->nama_kegiatan }}</h4>
                        <p class="text-sm text-gray-600 mt-1">
                            {{ $event->tanggal_kegiatan->format('d M Y') }}
                            @if($event->jam_kegiatan)
                            • {{ \Carbon\Carbon::parse($event->jam_kegiatan)->format('H:i') }}
                            @endif
                            • {{ $event->lokasi_kegiatan }}
                        </p>
                        <span class="inline-block mt-2 px-2 py-1 bg-orange-100 text-orange-700 text-xs rounded">Penyuluhan</span>
                    </div>
                </div>
                @empty
                <p class="text-center text-gray-500 py-8">Tidak ada event terjadwal</p>
                @endforelse
            </div>
        </div>

        <!-- Analisis & Rekomendasi -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="bg-gradient-to-r from-teal-600 to-teal-700 px-6 py-4">
                <h3 class="text-lg font-semibold text-white">Analisis & Rekomendasi</h3>
            </div>
            <div class="p-6">
                <!-- Prevalensi Stunting -->
                <div class="mb-6 pb-6 border-b">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <h4 class="font-semibold text-gray-800">Prevalensi Stunting</h4>
                            <p class="text-sm text-gray-600">Stabil 3 bulan terakhir</p>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-teal-600">2.9%</p>
                        </div>
                    </div>
                </div>

                <!-- Usia Rentan -->
                <div class="mb-6 pb-6 border-b">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <h4 class="font-semibold text-gray-800">Usia Rentan</h4>
                            <p class="text-sm text-gray-600">Perlu PMT & monitoring</p>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-orange-600">18-24 bln</p>
                        </div>
                    </div>
                </div>

                <!-- Cakupan Timbang -->
                <div class="mb-6 pb-6 border-b">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <h4 class="font-semibold text-gray-800">Cakupan Timbang</h4>
                            <p class="text-sm text-gray-600">Target ≥95% bulan depan</p>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-green-600">92%</p>
                        </div>
                    </div>
                </div>

                <!-- Imunisasi Lengkap -->
                <div>
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <h4 class="font-semibold text-gray-800">Imunisasi Lengkap</h4>
                            <p class="text-sm text-gray-600">Dorong sweeping RT 03-04</p>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-blue-600">88%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

