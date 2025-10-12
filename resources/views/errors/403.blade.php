<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-red-50 to-white">
<div class="text-center">
    <h1 class="text-6xl font-bold text-red-600 mb-4">403</h1>
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Akses Ditolak</h2>
    <p class="text-gray-600 mb-8">{{ $exception->getMessage() ?: 'Anda tidak memiliki izin untuk mengakses halaman ini.' }}</p>
    <a href="{{ route('dashboard') }}"
       class="px-6 py-3 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition">
        Kembali ke Dashboard
    </a>
</div>
</body>
</html>
