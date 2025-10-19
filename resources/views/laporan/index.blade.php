@extends('components.layouts.main-layout') {{-- atau: layouts.main-layout --}}
@section('title','Laporan')

@section('content')
<div class="space-y-6">

  {{-- Filter tanggal --}}
  <form method="GET" class="flex flex-wrap items-end gap-3">
    <div>
      <label class="block text-sm text-gray-600 mb-1">Dari</label>
      <input type="date" name="start" value="{{ $start }}" class="rounded-lg border-gray-300">
    </div>
    <div>
      <label class="block text-sm text-gray-600 mb-1">Sampai</label>
      <input type="date" name="end" value="{{ $end }}" class="rounded-lg border-gray-300">
    </div>
    <button class="px-4 py-2 rounded-lg bg-teal-600 text-white hover:bg-teal-700">Terapkan</button>
  </form>

  {{-- Kartu metrik (HORIZONTAL rail) --}}
  <div class="overflow-x-auto">
    <div class="flex gap-4 pr-2">
      <div class="shrink-0 w-64 rounded-lg bg-white border p-4">
        <div class="text-sm text-gray-500">Total Anak</div>
        <div class="text-2xl font-semibold">{{ number_format($metrics['total_anak']) }}</div>
      </div>
      <div class="shrink-0 w-64 rounded-lg bg-white border p-4">
        <div class="text-sm text-gray-500">Total Pemeriksaan</div>
        <div class="text-2xl font-semibold">{{ number_format($metrics['total_pemeriksaan']) }}</div>
      </div>
      <div class="shrink-0 w-64 rounded-lg bg-white border p-4">
        <div class="text-sm text-gray-500">Jenis Vitamin Terdata</div>
        <div class="text-2xl font-semibold">{{ number_format($metrics['total_jenis_vitamin']) }}</div>
      </div>

      @if(!empty($metrics['averages']))
        @isset($metrics['averages']['avg_berat_badan'])
          <div class="shrink-0 w-64 rounded-lg bg-white border p-4">
            <div class="text-sm text-gray-500">Rata-rata BB</div>
            <div class="text-2xl font-semibold">{{ $metrics['averages']['avg_berat_badan'] }} kg</div>
          </div>
        @endisset
        @isset($metrics['averages']['avg_tinggi_badan'])
          <div class="shrink-0 w-64 rounded-lg bg-white border p-4">
            <div class="text-sm text-gray-500">Rata-rata TB</div>
            <div class="text-2xl font-semibold">{{ $metrics['averages']['avg_tinggi_badan'] }} cm</div>
          </div>
        @endisset
      @endif
    </div>
  </div>

  {{-- Charts (HORIZONTAL rail) --}}
  <div class="overflow-x-auto">
    <div class="flex gap-6 pr-2">

      {{-- Tren per bulan --}}
      <div class="shrink-0 w-[520px] rounded-lg bg-white border p-4">
        <div class="font-medium mb-2">Tren Pemeriksaan / Bulan</div>
        <canvas id="chartPerBulan" height="140"></canvas>
      </div>

      {{-- Vitamin (hanya jika ada data) --}}
      @if($chart['vitamin'])
        <div class="shrink-0 w-[420px] rounded-lg bg-white border p-4">
          <div class="font-medium mb-2">Distribusi Vitamin</div>
          <canvas id="chartVitamin" height="140"></canvas>
        </div>
      @else
        <div class="shrink-0 w-[420px] rounded-lg bg-white border p-4">
          <div class="font-medium mb-2">Distribusi Vitamin</div>
          <div class="text-sm text-gray-500">Tidak ada data vitamin pada rentang tanggal ini.</div>
        </div>
      @endif

      {{-- Status gizi (opsional) --}}
      @if($chart['status_gizi'])
        <div class="shrink-0 w-[520px] rounded-lg bg-white border p-4">
          <div class="font-medium mb-2">Distribusi Status Gizi</div>
          <canvas id="chartStatusGizi" height="140"></canvas>
        </div>
      @endif

    </div>
  </div>

  {{-- Link ke listing detail --}}
  <div>
    <a href="{{ route('pemeriksaan.index') }}" class="text-teal-700 hover:underline">Lihat daftar pemeriksaan lengkap →</a>
  </div>

</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const perBulan   = @json($chart['per_bulan']);
  const vitamin    = @json($chart['vitamin']);
  const statusGizi = @json($chart['status_gizi']);

  new Chart(document.getElementById('chartPerBulan'), {
    type: 'line',
    data: { labels: perBulan.labels, datasets: [{ label: 'Pemeriksaan', data: perBulan.data, fill: false, tension: 0.25 }] }
  });

  if (vitamin) {
    new Chart(document.getElementById('chartVitamin'), {
      type: 'pie',
      data: { labels: vitamin.labels, datasets: [{ data: vitamin.data }] }
    });
  }

  if (statusGizi) {
    new Chart(document.getElementById('chartStatusGizi'), {
      type: 'doughnut',
      data: { labels: statusGizi.labels, datasets: [{ data: statusGizi.data }] }
    });
  }
</script>
@endpush
@endsection
