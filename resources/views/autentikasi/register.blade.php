<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Posyandu Mugi Lestari</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-teal-50 via-cyan-50 to-white relative overflow-hidden py-12">
    <div class="container mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center max-w-6xl mx-auto">
            <!-- Left Section -->
            <div class="hidden lg:block">
                <div class="bg-teal-500 rounded-3xl p-12 text-center shadow-2xl">
                    <img src="{{ asset('storage/logoposyandu.png') }}" alt="Logo" class="h-32 w-32 mx-auto mb-6">
                    <h2 class="text-4xl font-bold text-white mb-4">Selamat Datang di</h2>
                    <h3 class="text-2xl font-semibold text-white mb-4">POSYANDU MUGI LESTARI</h3>
                    <p class="text-white text-lg">Anak & Balita Sehat, Keluarga Bahagia</p>
                    <img src="{{ asset('storage/registerpict.jpg') }}" alt="Illustration" class="mt-8 w-full rounded-lg">
                </div>
            </div>

            <!-- Right Section - Register Form -->
            <div class="w-full">
                <div class="bg-white rounded-3xl shadow-2xl p-8 lg:p-12">
                    <div class="lg:hidden text-center mb-6">
                        <img src="{{ asset('logoposyandu.png') }}" alt="Logo" class="h-24 w-24 mx-auto mb-4">
                    </div>

                    <h2 class="text-3xl font-bold text-teal-600 mb-2 text-center lg:text-left">Form Pendaftaran</h2>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register.submit') }}" class="space-y-5">
                        @csrf
                        <div>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition"
                                   placeholder="Nama Lengkap">
                        </div>

                        <div>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition"
                                   placeholder="Email">
                        </div>

                        <div>
                            <input type="text" name="phone" value="{{ old('phone') }}" required
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition"
                                   placeholder="No. Handphone">
                        </div>

                        <div>
                            <input type="password" name="password" required
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition"
                                   placeholder="Password">
                        </div>

                        <div>
                            <input type="password" name="password_confirmation" required
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition"
                                   placeholder="Konfirmasi Password">
                        </div>

                        <div>
                            <select name="role" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition">
                                <option value="">-- Pilih Role --</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="kader" {{ old('role') == 'kader' ? 'selected' : '' }}>Kader</option>
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                        </div>

                        <button type="submit"
                                class="w-full bg-teal-500 text-white py-3 rounded-lg font-semibold text-lg hover:bg-teal-600 focus:ring-4 focus:ring-teal-300 transition duration-200 shadow-lg">
                            Register
                        </button>
                    </form>

                    <p class="text-center text-gray-600 mt-6">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-teal-600 font-semibold hover:text-teal-700">Login di sini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>
</html>
