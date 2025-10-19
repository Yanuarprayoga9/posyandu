<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Pemeriksaan;
use App\Models\Imunisasi;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        // ===== KPI (tanpa stunting) =====
        $kpi = Cache::remember('dashboard.kpi', 20, function () {
            return [
                'total'     => Anak::count(),
                'laki'      => Anak::where('jenis_kelamin','L')->count(),
                'perempuan' => Anak::where('jenis_kelamin','P')->count(),
            ];
        });

        // ===== Label & range 12 bulan =====
        [$labels, $monthBoundaries] = $this->monthRange12();

        // ===== Pemeriksaan: deteksi kolom tanggal =====
        $pemeriksaanTable = (new Pemeriksaan)->getTable();
        $periksaDateCol = $this->detectDateColumn($pemeriksaanTable, [
            'tanggal_periksa','tanggal','tgl','created_at','updated_at'
        ]);

        // Seri status gizi (tanpa stunting)
        $giziKurang=[]; $giziNormal=[];
        foreach ($monthBoundaries as [$start, $end]) {
            $giziKurang[] = Pemeriksaan::whereBetween($periksaDateCol, [$start, $end])
                ->where('status_gizi','kurang')->count();

            $giziNormal[] = Pemeriksaan::whereBetween($periksaDateCol, [$start, $end])
                ->where('status_gizi','normal')->count();
        }
        $gizi = ['kurang'=>$giziKurang,'normal'=>$giziNormal];

        // ===== Imunisasi: deteksi kolom tanggal =====
        $imunisasiTable = (new Imunisasi)->getTable();
        $imunDateCol = $this->detectDateColumn($imunisasiTable, [
            'tanggal_imunisasi','tgl_imunisasi','tanggal','tgl','created_at','updated_at'
        ]);

        $startMonth = now()->startOfMonth();
        $endMonth   = now()->endOfMonth();

        $anakImunBulanIni = Imunisasi::whereBetween($imunDateCol, [$startMonth, $endMonth])
            ->distinct('anak_id')->count('anak_id');

        $cakupanImunisasi = $kpi['total'] ? round(($anakImunBulanIni / $kpi['total']) * 100) : 0;

        // ===== Events: deteksi kolom tanggal & pakai field nama/lokasi yang benar =====
        $eventTable = (new Event)->getTable();
        // prioritas sesuai skema kamu: 'tanggal_kegiatan'
        $eventDateCol = $this->detectDateColumn($eventTable, [
            'tanggal_kegiatan','waktu_mulai','tanggal','tgl','created_at','updated_at'
        ]);

        $events = Event::where($eventDateCol, '>=', now())
            ->orderBy($eventDateCol, 'asc')
            ->limit(5)
            ->get();

        $genderPie = ['L'=>$kpi['laki'],'P'=>$kpi['perempuan']];

        return view('dashboard', [
            'total'     => $kpi['total'],
            'laki'      => $kpi['laki'],
            'perempuan' => $kpi['perempuan'],

            'months'    => $labels,
            'gizi'      => $gizi,
            'genderPie' => $genderPie,

            'cakupan_imunisasi' => $cakupanImunisasi,

            'events'         => $events,
            'eventDateField' => $eventDateCol, // dikirim ke view biar gampang format tanggal
        ]);
    }

    private function monthRange12(): array
    {
        Carbon::setLocale('id');
        $labels=[]; $ranges=[];
        for ($i=11; $i>=0; $i--) {
            $start = now()->startOfMonth()->subMonths($i);
            $end   = (clone $start)->endOfMonth();
            $labels[] = $start->translatedFormat('M');
            $ranges[] = [$start, $end];
        }
        return [$labels, $ranges];
    }

    /**
     * Deteksi kolom tanggal yang tersedia pada tabel.
     * Mengembalikan kandidat pertama yang ada; fallback ke created_at jika tersedia; kalau tidak, pakai updated_at.
     */
    private function detectDateColumn(string $table, array $candidates): string
    {
        foreach ($candidates as $c) {
            if (Schema::hasColumn($table, $c)) {
                return $c;
            }
        }
        // fallback terakhir aman
        if (Schema::hasColumn($table, 'created_at')) return 'created_at';
        if (Schema::hasColumn($table, 'updated_at')) return 'updated_at';

        // jika benar-benar tidak ada kolom tanggal, tetap kembalikan string agar query tidak crash
        // (nanti akan error lain, tapi minimal jelas)
        return $candidates[0] ?? 'created_at';
    }
}
<?php
