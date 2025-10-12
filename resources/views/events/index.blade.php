@extends('components.layouts.main-layout')
@section('title', 'Tambah Event')

@section('content')
    <div class="p-8 bg-gray-100 min-h-screen">
        <div class="mb-6 flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">Event Posyandu Mugi Lestari</h2>
            <a href="{{ route('events.create') }}"
               class="bg-teal-500 text-white px-6 py-2 rounded-md hover:bg-teal-600">
                Tambah Event
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($events as $event)
                <div class="bg-teal-600 rounded-lg shadow-lg overflow-hidden">
                    @if($event->dokumentasi)
                        <img src="{{ asset('storage/' . $event->dokumentasi) }}" alt="{{ $event->nama_kegiatan }}"
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-300 flex items-center justify-center">
                            <span class="text-gray-500">No Image</span>
                        </div>
                    @endif
                    <div class="p-4 text-white">
                        <h3 class="font-bold text-lg mb-2">{{ $event->nama_kegiatan }}</h3>
                        <div class="text-sm space-y-1">
                            <p><strong>Tanggal:</strong> {{ $event->tanggal_kegiatan->format('d M Y') }}</p>
                            <p><strong>Lokasi:</strong> {{ $event->lokasi_kegiatan }}</p>
                            <p><strong>Sasaran:</strong> {{ $event->sasaran_kegiatan }}</p>
                            <p><strong>PJ:</strong> {{ $event->penanggung_jawab }}</p>
                        </div>
                        <div class="mt-4 flex gap-2">
                            <a href="{{ route('events.edit', $event) }}"
                               class="bg-blue-500 text-white px-4 py-2 rounded text-sm hover:bg-blue-600">Edit</a>
                            <form action="{{ route('events.destroy', $event) }}" method="POST"
                                  onsubmit="return confirm('Hapus event ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 text-white px-4 py-2 rounded text-sm hover:bg-red-600">Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-500 text-lg">Belum ada event yang tersimpan</p>
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $events->links() }}
        </div>
    </div>
@endsection
