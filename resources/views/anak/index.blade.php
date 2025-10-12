@extends('components.layouts.main-layout')

@section('title', 'Data Anak & Balita')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-2xl font-bold text-gray-700 mb-6">Data Anak & Balita</h2>

            <!-- Button Tambah Data -->
            <div class="mb-4">
                <a href="{{ route('anak.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Data Anak
                </a>
            </div>

            <!-- Filter and Search -->
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center">
                    <label class="mr-2 text-gray-600">Show</label>
                    <form method="GET" action="{{ route('anak.index') }}" class="inline">
                        <select name="per_page" onchange="this.form.submit()"
                                class="border border-gray-300 rounded px-3 py-1 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        </select>
                    </form>
                    <span class="ml-2 text-gray-600">entries</span>
                </div>

                <div class="flex items-center">
                    <form method="GET" action="{{ route('anak.index') }}" class="flex">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Search"
                               class="border border-gray-300 rounded-l px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                        <button type="submit"
                                class="bg-gray-200 border border-l-0 border-gray-300 rounded-r px-4 py-2 hover:bg-gray-300">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b">No</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b">NIK</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b">Nama Lengkap</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b">Jenis Kelamin</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b">Nama Ibu</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700 border-b">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($anak as $index => $item)
                        <tr class="hover:bg-gray-50 border-b">
                            <td class="px-4 py-3 text-sm text-gray-700">
                                {{ $anak->firstItem() + $index }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $item->nik_anak }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $item->nama_anak }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                {{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $item->nama_ibu }}</td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex justify-center space-x-2">
                                    <!-- Detail Button -->
                                    <a href="{{ route('anak.show', $item->id) }}"
                                       class="bg-yellow-400 hover:bg-yellow-500 text-white p-2 rounded">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                            <path fill-rule="evenodd"
                                                  d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </a>

                                    <!-- Edit Button -->
                                    <a href="{{ route('anak.edit', $item->id) }}"
                                       class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                        </svg>
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('anak.destroy', $item->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white p-2 rounded">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                      d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                                Tidak ada data yang tersedia
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4 flex justify-between items-center">
                <div class="text-sm text-gray-600">
                    Showing {{ $anak->firstItem() ?? 0 }} to {{ $anak->lastItem() ?? 0 }}
                    of {{ $anak->total() }} entries
                </div>

                <div class="flex space-x-2">
                    {{ $anak->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
