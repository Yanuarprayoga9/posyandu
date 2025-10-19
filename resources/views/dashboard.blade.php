@extends('components.layouts.main-layout')
@section('title', 'Dashboard Posyandu Anak')

@section('content')
<div class="space-y-6">

  {{-- Kartu KPI --}}
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    <div class="rounded-lg border border-teal-100 bg-white p-5 shadow-sm">
      <div class="flex items-center justify-between">
        <span class="text-sm text-gray-500">Total Anak</span>
        <span class="inline-flex items-center justify-center w-7 h-7 rounded bg-teal-50 text-teal-700">👶</span>
      </div>
      <div id="kpi-total" class="mt-2 text-3xl font-bold text-gray-900">{{ $total ?? 0 }}</div>
    </div>

    <div class="rounded-lg border border-teal-100 bg-white p-5 shadow-sm">
      <div class="flex items-center justify-between">
        <span class="text-sm text-gray-500">Laki-laki</span>
        <span class="inline-flex items-center justify-center w-7 h-7 rounded bg-teal-50 text-teal-700">🧒</span>
      </div>
      <div id="kpi-l" class="mt-2 text-3xl font-bold text-gray-900">{{ $laki ?? 0 }}</div>
    </div>

    <div class="rounded-lg border border-teal-100 bg-white p-5 shadow-sm">
      <div class="flex items-center justify-between">
        <span class="text-sm text-gray-500">Perempuan</span>
        <span class="inline-flex items-center justify-center w-7 h-7 rounded bg-teal-50 text-teal-700">👧</span>
      </div>
      <div id="kpi-p" class="mt-2 text-3xl font-bold text-gray-900">{{ $perempuan ?? 0 }}</div>
    </div>
  </div>

  {{-- Chart & Ringkasan --}}
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
    {{-- Status Gizi 12 bln (2 seri: Kurang & Normal) --}}
    <div class="rounded-lg border bg-white p-5 shadow-sm">
      <div class="flex items-center justify-between mb-3">
        <h3 class="font-semibold text-gray-800">Status Gizi (12 bln)</h3>
        <a href="{{ route('pemeriksaan.index') }}" class="text-sm text-teal-700 hover:underline">Lihat data</a>
      </div>
      <canvas id="giziLine"></canvas>
      <p class="text-xs text-gray-500 mt-3">Kategori: Gizi Kurang & Normal.</p>
    </div>

    {{-- Komposisi Jenis Kelamin (Pie) --}}
    <div class="rounded-lg border bg-white p-5 shadow-sm">
      <div class="flex items-center justify-between mb-3">
        <h3 class="font-semibold text-gray-800">Komposisi Jenis Kelamin</h3>
        <a href="{{ route('anak.index') }}" class="text-sm text-teal-700 hover:underline">Kelola data</a>
      </div>
      <canvas id="genderPie"></canvas>
      <div class="mt-3 grid grid-cols-2 gap-2 text-sm">
        <div class="rounded border p-3">
          <div class="text-gray-500">Laki-laki</div>
          <div class="font-semibold">{{ $laki ?? 0 }}</div>
        </div>
        <div class="rounded border p-3">
          <div class="text-gray-500">Perempuan</div>
          <div class="font-semibold">{{ $perempuan ?? 0 }}</div>
        </div>
      </div>
    </div>
  </div>

  {{-- Event Terdekat --}}
  <div class="rounded-lg border bg-white p-5 shadow-sm">
    <div class="flex items-center justify-between mb-3">
      <h3 class="font-semibold text-gray-800">Event Terdekat</h3>
      <a href="{{ route('event.index') }}" class="text-sm text-teal-700 hover:underline">Lihat semua</a>
    </div>

    @if(!empty($events) && $events->count())
      <ul class="divide-y">
        @foreach($events as $ev)
          <li class="py-3">
            <div class="font-medium text-gray-900">{{ $ev->nama_kegiatan ?? 'Event' }}</div>
            <div class="text-sm text-gray-600">
              @php $tgl = $eventDateField ?? 'tanggal_kegiatan'; @endphp
              {{ \Carbon\Carbon::parse($ev->$tgl)->translatedFormat('d M Y') }}
              @if(!empty($ev->lokasi_kegiatan)) • {{ $ev->lokasi_kegiatan }} @endif
            </div>
          </li>
        @endforeach
      </ul>
    @else
      <p class="text-sm text-gray-500">Belum ada event terjadwal.</p>
    @endif
  </div>

  {{-- Analisis Cepat --}}
  <div class="rounded-lg border bg-white p-5 shadow-sm">
    <h3 class="font-semibold text-gray-800 mb-3">Analisis Cepat</h3>
    <div class="grid grid-cols-2 gap-3 text-sm">
      <div class="rounded border p-3">
        <div class="text-gray-500">Cakupan Imunisasi (bulan ini)</div>
        <div class="text-xl font-bold">{{ number_format($cakupan_imunisasi ?? 0, 0) }}%</div>
      </div>
      <div class="rounded border p-3">
        <div class="text-gray-500">Usia Rentan</div>
        <div class="text-xl font-bold">18–24 bln</div>
      </div>
      <div class="rounded border p-3 col-span-2">
        <div class="text-gray-500">Catatan</div>
        <p class="mt-1 text-gray-700">
          Fokus pemantauan anak usia 18–24 bulan; tindak lanjut hasil penimbangan berikutnya.
        </p>
      </div>
    </div>
  </div>

</div>

@php
  $months = $months ?? ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
  $gizi   = $gizi   ?? [
              'kurang'  => [3,2,2,3,4,3,2,3,2,2,3,2],
              'normal'  => [18,19,20,21,22,23,22,21,22,23,22,23],
            ];
  $gender = $genderPie ?? ['L' => ($laki ?? 0), 'P' => ($perempuan ?? 0)];
@endphp

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Line Status Gizi (2 seri)
  const ctxGizi = document.getElementById('giziLine');
  if (ctxGizi) {
    new Chart(ctxGizi, {
      type: 'line',
      data: {
        labels: @json($months),
        datasets: [
          { label: 'Gizi Kurang', data: @json($gizi['kurang']), fill: true, tension: .35 },
          { label: 'Normal',      data: @json($gizi['normal']), fill: true, tension: .35 },
        ]
      },
      options: {
        responsive: true,
        interaction: { mode: 'index', intersect: false },
        stacked: true,
        plugins: { legend: { position: 'bottom' } },
        scales: { y: { beginAtZero: true }, x: { grid: { display: false } } }
      }
    });
  }

  // Pie Jenis Kelamin
  const ctxPie = document.getElementById('genderPie');
  if (ctxPie) {
    new Chart(ctxPie, {
      type: 'pie',
      data: {
        labels: ['Laki-laki','Perempuan'],
        datasets: [{ data: [{{ $gender['L'] ?? 0 }}, {{ $gender['P'] ?? 0 }}] }]
      },
      options: { plugins: { legend: { position: 'bottom' } } }
    });
  }
</script>
@endsection
