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
<main class="flex-1 flex items-center">
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
