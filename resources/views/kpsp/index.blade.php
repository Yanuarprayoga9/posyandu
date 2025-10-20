@extends('components.layouts.main-layout')
@section('title', 'Data KPSP')

@section('content')
    <div class="p-8 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Data KPSP</h2>
                <p class="text-gray-600">Daftar hasil Kuesioner Pra Skrining Perkembangan (KPSP) anak.</p>
            </div>

            <!-- Success Alert -->
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center justify-between" role="alert">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            @endif

            <!-- Card Container -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <!-- Action Bar -->
                <div class="flex justify-between items-center mb-6">
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-gray-600">Tampilkan</span>
                            <select id="entriesSelect" onchange="changeEntries(this.value)" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-teal-500">
                                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                            </select>
                            <span class="text-sm text-gray-600">entri</span>
                        </div>

                        <form action="{{ route('kpsp.index') }}" method="GET" class="relative">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari NIK, nama anak..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-teal-500 w-64">
                            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            @if(request('per_page'))
                                <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                            @endif
                            @if(request('search'))
                                <a href="{{ route('kpsp.index') }}" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            @endif
                        </form>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('kpsp.create') }}" class="px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah KPSP
                        </a>
                        <button onclick="exportCSV()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Export CSV
                        </button>
                    </div>
                </div>

                <!-- Search Results Info -->
                @if(request('search'))
                    <div class="mb-4 text-sm text-gray-600">
                        Hasil pencarian untuk: <strong>"{{ request('search') }}"</strong>
                        <span class="ml-2">({{ $kpsps->total() }} data ditemukan)</span>
                    </div>
                @endif

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                        <tr class="border-b border-gray-200 bg-gray-50">
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">NO</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">NIK</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">NAMA ANAK</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">TANGGAL LAHIR</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">JENIS KELAMIN</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">TANGGAL PEMERIKSAAN</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">USIA</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">SKOR</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">KETERANGAN</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">PETUGAS</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($kpsps as $index => $kpsp)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $kpsps->firstItem() + $index }}</td>
                                <td class="px-4 py-3">{{ $kpsp->anak->nik_anak }}</td>
                                <td class="px-4 py-3 font-medium text-gray-800">{{ $kpsp->anak->nama_anak }}</td>
                                <td class="px-4 py-3">{{ $kpsp->anak->tanggal_lahir_anak->format('Y-m-d') }}</td>
                                <td class="px-4 py-3">
                                    @if($kpsp->anak->jenis_kelamin == 'P')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-pink-100 text-pink-800">
                                                ♀ Perempuan
                                            </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                ♂ Laki-laki
                                            </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($kpsp->tanggal_pemeriksaan)->format('d M Y') }}</td>
                                <td class="px-4 py-3">{{ $kpsp->usia_bulan }} Bulan</td>
                                <td class="px-4 py-3">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-100 text-teal-800">
                                            {{ $kpsp->total_skor }}/10
                                        </span>
                                </td>
                                <td class="px-4 py-3">
                                    @if($kpsp->total_skor >= 9)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Sesuai
                                            </span>
                                    @elseif($kpsp->total_skor >= 7)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Meragukan
                                            </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Penyimpangan
                                            </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">{{ $kpsp->petugas }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="px-4 py-8 text-center text-gray-500">
                                    @if(request('search'))
                                        Tidak ada data yang cocok dengan pencarian "{{ request('search') }}".
                                    @else
                                        Belum ada data KPSP. Klik tombol "Tambah KPSP" untuk menambahkan data.
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6 flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        Menampilkan {{ $kpsps->firstItem() ?? 0 }} sampai {{ $kpsps->lastItem() ?? 0 }} dari {{ $kpsps->total() }} data
                    </div>
                    <div>
                        {{ $kpsps->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function changeEntries(perPage) {
            const url = new URL(window.location.href);
            url.searchParams.set('per_page', perPage);
            url.searchParams.set('page', '1');
            window.location.href = url.toString();
        }

        function exportCSV() {
            const table = document.querySelector('table');
            let csv = [];
            const rows = table.querySelectorAll('tr');

            for (let i = 0; i < rows.length; i++) {
                const row = [], cols = rows[i].querySelectorAll('td, th');

                for (let j = 0; j < cols.length; j++) {
                    let data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, '').replace(/(\s\s)/gm, ' ').replace(/"/g, '""');
                    row.push('"' + data + '"');
                }
                csv.push(row.join(','));
            }

            const csvFile = new Blob([csv.join('\n')], { type: 'text/csv' });
            const downloadLink = document.createElement('a');
            downloadLink.download = 'data-kpsp-' + new Date().toISOString().split('T')[0] + '.csv';
            downloadLink.href = window.URL.createObjectURL(csvFile);
            downloadLink.style.display = 'none';
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
        }

        // Auto-hide success message after 5 seconds
        setTimeout(() => {
            const alert = document.querySelector('[role="alert"]');
            if (alert) {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }
        }, 5000);
    </script>
@endsection
