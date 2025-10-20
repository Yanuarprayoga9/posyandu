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
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-bold text-lg">{{ $event->nama_kegiatan }}</h3>
                            @if($event->status === 'upcoming')
                                <span class="bg-blue-500 text-xs px-2 py-1 rounded">Akan Datang</span>
                            @elseif($event->status === 'ongoing')
                                <span class="bg-green-500 text-xs px-2 py-1 rounded">Berlangsung</span>
                            @else
                                <span class="bg-gray-500 text-xs px-2 py-1 rounded">Selesai</span>
                            @endif
                        </div>
                        <div class="text-sm space-y-1 mb-3">
                            <p><strong>Tanggal:</strong> {{ $event->tanggal_kegiatan->format('d M Y') }}</p>
                            @if($event->jam_kegiatan)
                                <p><strong>Jam:</strong> {{ \Carbon\Carbon::parse($event->jam_kegiatan)->format('H:i') }} WIB</p>
                            @endif
                            <p><strong>Lokasi:</strong> {{ $event->lokasi_kegiatan }}</p>
                            <p><strong>Sasaran:</strong> {{ $event->sasaran_kegiatan }}</p>
                            <p><strong>PJ:</strong> {{ $event->penanggung_jawab }}</p>
                        </div>
                        @if($event->deskripsi)
                            <div class="text-sm mb-3 border-t border-teal-500 pt-2">
                                <p class="text-teal-100">{{ Str::limit($event->deskripsi, 100) }}</p>
                            </div>
                        @endif
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
