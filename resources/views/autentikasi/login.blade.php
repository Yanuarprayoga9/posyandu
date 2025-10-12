<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Posyandu Mugi Lestari</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-teal-50 via-cyan-50 to-white relative overflow-hidden">
<!-- Decorative elements -->
<div class="absolute inset-0 z-0">
    <img src="{{ asset('storage/loginpict.jpg') }}" alt="Background" class="w-full h-full object-cover opacity-20">
</div>

<div class="container mx-auto px-6 py-12 relative z-10">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center max-w-6xl mx-auto">
        <!-- Left Section - Welcome -->
        <div class="hidden lg:block">
            <div class="bg-teal-500 rounded-3xl p-12 text-center shadow-2xl">
                <img src="{{ asset('storage/logoposyandu.png') }}" alt="Logo" class="h-32 w-32 mx-auto mb-6">
                <h2 class="text-4xl font-bold text-white mb-4">Selamat Datang</h2>
                <h3 class="text-2xl font-semibold text-white mb-4">Posyandu Mugi Lestari</h3>
                <p class="text-white text-lg">Sistem Informasi Anak & Balita</p>
            </div>
        </div>

        <!-- Right Section - Login Form -->
        <div class="w-full">
            <div class="bg-white rounded-3xl shadow-2xl p-8 lg:p-12">
                <div class="lg:hidden text-center mb-6">
                    <img src="{{ asset('logoposyandu.png') }}" alt="Logo" class="h-24 w-24 mx-auto mb-4">
                    <h2 class="text-2xl font-bold text-teal-600 mb-2">Posyandu Mugi Lestari</h2>
                </div>

                <h2 class="text-3xl font-bold text-teal-600 mb-2 text-center lg:text-left">Selamat Datang</h2>
                <p class="text-gray-600 mb-8 text-center lg:text-left">Silakan masuk ke akun Anda</p>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.submit') }}" class="space-y-6">
                    @csrf
                    <div>
                        <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                                    <svg class="w-5 h-5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                    </svg>
                                </span>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                   class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition"
                                   placeholder="Email">
                        </div>
                    </div>

                    <div>
                        <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                                    <svg class="w-5 h-5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </span>
                            <input type="password" name="password" required
                                   class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition"
                                   placeholder="Kata Sandi">
                        </div>
                    </div>

                    <button type="submit"
                            class="w-full bg-teal-500 text-white py-3 rounded-lg font-semibold text-lg hover:bg-teal-600 focus:ring-4 focus:ring-teal-300 transition duration-200 shadow-lg">
                        Masuk
                    </button>
                </form>

                <p class="text-center text-gray-600 mt-6">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-teal-600 font-semibold hover:text-teal-700">Daftar di sini</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>
</html>
