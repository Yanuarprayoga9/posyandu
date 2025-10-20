<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posyandu Mugi Lestari</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-gradient-to-br from-teal-50 via-cyan-50 to-white min-h-screen flex flex-col">
<!-- Header -->
<header class="bg-white shadow-md">
    <div class="container mx-auto px-6 py-4 flex items-center justify-between">
        <div class="flex items-center">
            <img src="{{ asset('storage/logoposyandu.png') }}" alt="Logo Posyandu" class="h-14 w-14 mr-4">
            <h1 class="text-2xl font-bold text-teal-700">Posyandu Mugi Lestari</h1>
        </div>

        @auth
            <div class="flex items-center gap-4">
                <span class="text-gray-700 font-medium">Halo, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                            class="px-6 py-2 text-sm font-semibold text-white bg-red-500 rounded-lg hover:bg-red-600 focus:ring-4 focus:ring-red-300 transition duration-200">
                        Logout
                    </button>
                </form>
            </div>
        @endauth
    </div>
</header>

<!-- Main Content -->
<main class="flex-1">
    <!-- Hero Section -->
    <div class="container mx-auto px-6 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left Section -->
            <div class="space-y-6">
                <h2 class="text-4xl md:text-5xl font-bold text-teal-700 leading-tight">
                    Sistem Manajemen<br>Posyandu Anak & Balita
                </h2>
                <p class="text-lg text-gray-700 leading-relaxed">
                    Platform modern untuk membantu kader Posyandu dalam mencatat data anak & balita,
                    memantau pertumbuhan, mengatur jadwal imunisasi, serta menyusun laporan dengan efisien.
                </p>
                <div class="flex gap-4 pt-4">
                    @auth
                        <a href="{{ route('dashboard') }}"
                           class="px-8 py-3 text-lg font-semibold text-white bg-teal-600 rounded-lg shadow-lg hover:bg-teal-700 focus:ring-4 focus:ring-teal-300 transition duration-200">
                            Dashboard
                        </a>
                    @else
                        <a href="/login"
                           class="px-8 py-3 text-lg font-semibold text-teal-700 bg-white border-2 border-teal-600 rounded-lg hover:bg-teal-50 focus:ring-4 focus:ring-teal-200 transition duration-200">
                            Login
                        </a>
                        <a href="/register"
                           class="px-8 py-3 text-lg font-semibold text-white bg-teal-600 rounded-lg shadow-lg hover:bg-teal-700 focus:ring-4 focus:ring-teal-300 transition duration-200">
                            Register
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Right Section -->
            <div class="flex justify-center lg:justify-end">
                <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-xl">
                    <img src="{{ asset('storage/logoposyandu.png') }}"
                         alt="Ilustrasi Posyandu"
                         class="w-full h-auto">
                </div>
            </div>
        </div>
    </div>

    <!-- Events Section -->
    <div class="bg-white py-16">
        <div class="container mx-auto px-6">
            <div class="text-center mb-10">
                <h2 class="text-3xl md:text-4xl font-bold text-teal-700 mb-3">Kegiatan Posyandu</h2>
                <p class="text-gray-600 text-lg">Lihat kegiatan dan event terbaru kami</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($events as $event)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition duration-300">
                        @if($event->dokumentasi)
                            <img src="{{ asset('storage/' . $event->dokumentasi) }}"
                                 alt="{{ $event->nama_kegiatan }}"
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-teal-100 to-cyan-100 flex items-center justify-center">
                                <svg class="w-16 h-16 text-teal-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                        <div class="p-5">
                            <h3 class="font-bold text-xl text-gray-800 mb-3">{{ $event->nama_kegiatan }}</h3>

                            <div class="space-y-2 text-sm text-gray-600">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-teal-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>{{ $event->tanggal_kegiatan->format('d M Y') }}</span>
                                </div>

                                @if($event->jam_kegiatan)
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-teal-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>{{ \Carbon\Carbon::parse($event->jam_kegiatan)->format('H:i') }} WIB</span>
                                    </div>
                                @endif

                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-teal-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>{{ $event->lokasi_kegiatan }}</span>
                                </div>

                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-teal-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    <span>{{ $event->sasaran_kegiatan }}</span>
                                </div>
                            </div>

                            @if($event->status)
                                <div class="mt-4">
                                    @if($event->status === 'upcoming')
                                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">Akan Datang</span>
                                    @elseif($event->status === 'ongoing')
                                        <span class="inline-block px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Sedang Berlangsung</span>
                                    @else
                                        <span class="inline-block px-3 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded-full">Selesai</span>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-gray-500 text-lg">Belum ada kegiatan yang terjadwal</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="bg-white border-t border-gray-200">
    <div class="container mx-auto px-6 py-4 text-center">
        <p class="text-sm text-gray-600">
            &copy; 2025 Posyandu Mugi Lestari &mdash; Sistem Informasi Kesehatan Ibu & Anak
        </p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>
</html>
