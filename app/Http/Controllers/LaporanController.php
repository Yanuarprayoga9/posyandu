<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use App\Models\Anak;
use App\Models\JenisVitamin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Range tanggal (default: 12 bulan terakhir)
        $end   = $request->filled('end')   ? Carbon::parse($request->end)->endOfDay()   : now()->endOfDay();
        $start = $request->filled('start') ? Carbon::parse($request->start)->startOfDay() : (clone $end)->subMonths(11)->startOfMonth();

        $pemeriksaanTable = (new Pemeriksaan)->getTable();

        // ---- METRIK UTAMA ----
        $metrics = [
            'total_anak'          => Anak::count(),
            'total_pemeriksaan'   => Pemeriksaan::count(),
            'total_jenis_vitamin' => Schema::hasTable('jenis_vitamins') ? JenisVitamin::count() : 0,
        ];

        // Rata-rata opsional (cek kolom dulu)
        $averages = [];
        if (Schema::hasColumn($pemeriksaanTable, 'berat_badan')) {
            $averages['avg_berat_badan'] = round((float) Pemeriksaan::avg('berat_badan'), 2);
        }
        if (Schema::hasColumn($pemeriksaanTable, 'tinggi_badan')) {
            $averages['avg_tinggi_badan'] = round((float) Pemeriksaan::avg('tinggi_badan'), 2);
        }
        $metrics['averages'] = $averages;

        // ---- TREN PEMERIKSAAN / BULAN ----
        $perBulanRaw = Pemeriksaan::selectRaw('DATE_FORMAT(tanggal_pemeriksaan, "%Y-%m") as ym, COUNT(*) as total')
            ->whereBetween('tanggal_pemeriksaan', [$start, $end])
            ->groupBy('ym')->orderBy('ym')
            ->pluck('total', 'ym');

        $period = CarbonPeriod::create($start->copy()->startOfMonth(), '1 month', $end->copy()->startOfMonth());
        $labelsBulan = [];
        $dataBulan   = [];
        foreach ($period as $month) {
            $ym = $month->format('Y-m');
            $labelsBulan[] = $month->translatedFormat('M Y');
            $dataBulan[]   = (int) ($perBulanRaw[$ym] ?? 0);
        }

        // ---- DISTRIBUSI VITAMIN (pivot / kolom / teks) ----
        $vitaminChart = null;

        // 1) Jika ada tabel pivot pemeriksaan_vitamin
        if (Schema::hasTable('pemeriksaan_vitamin')
            && Schema::hasColumn('pemeriksaan_vitamin', 'jenis_vitamin_id')
            && Schema::hasColumn('pemeriksaan_vitamin', 'pemeriksaan_id'))
        {
            $vitaminCounts = DB::table('pemeriksaan_vitamin as pv')
                ->join($pemeriksaanTable.' as p', 'p.id', '=', 'pv.pemeriksaan_id')
                ->whereBetween('p.tanggal_pemeriksaan', [$start, $end])
                ->selectRaw('pv.jenis_vitamin_id as col, COUNT(*) as total')
                ->groupBy('col')
                ->pluck('total', 'col');

            if ($vitaminCounts->isNotEmpty()) {
                $ids = $vitaminCounts->keys();
                $names = Schema::hasTable('jenis_vitamins')
                    ? JenisVitamin::whereIn('id', $ids)->pluck('nama', 'id')
                    : collect();
                $labels = $ids->map(fn($id) => $names[$id] ?? "ID $id")->values();
                $vitaminChart = ['labels' => $labels, 'data' => $vitaminCounts->values()];
            }
        }
        else {
            // 2) Cari kolom yang mungkin ada di tabel pemeriksaans
            $candidateCols = ['jenis_vitamin_id', 'vitamin_id', 'id_jenis_vitamin', 'jenis_vitamin', 'vitamin'];
            $vitaminCol = collect($candidateCols)->first(fn($c) => Schema::hasColumn($pemeriksaanTable, $c));

            if ($vitaminCol) {
                $vitaminCounts = Pemeriksaan::whereBetween('tanggal_pemeriksaan', [$start, $end])
                    ->selectRaw("$vitaminCol as col, COUNT(*) as total")
                    ->groupBy('col')
                    ->pluck('total', 'col');

                if ($vitaminCounts->isNotEmpty()) {
                    if (Str::endsWith($vitaminCol, '_id')) {
                        $ids   = $vitaminCounts->keys();
                        $names = Schema::hasTable('jenis_vitamins')
                            ? JenisVitamin::whereIn('id', $ids)->pluck('nama', 'id')
                            : collect();
                        $labels = $ids->map(fn($id) => $names[$id] ?? "ID $id")->values();
                    } else {
                        // Kolom teks langsung (mis. 'vitamin')
                        $labels = $vitaminCounts->keys()->values();
                    }
                    $vitaminChart  = ['labels' => $labels, 'data' => $vitaminCounts->values()];
                }
            }
        }

        // ---- Status Gizi (opsional) ----
        $statusGizi = null;
        if (Schema::hasColumn($pemeriksaanTable, 'status_gizi')) {
            $sg = Pemeriksaan::whereBetween('tanggal_pemeriksaan', [$start, $end])
                ->selectRaw('status_gizi, COUNT(*) as total')
                ->groupBy('status_gizi')
                ->pluck('total', 'status_gizi');

            if ($sg->isNotEmpty()) {
                $statusGizi = [
                    'labels' => $sg->keys()->values(),
                    'data'   => $sg->values(),
                ];
            }
        }

        // Kirim ke view
        return view('laporan.index', [
            'start'  => $start->toDateString(),
            'end'    => $end->toDateString(),
            'metrics'=> $metrics,
            'chart'  => [
                'per_bulan'   => ['labels' => $labelsBulan, 'data' => $dataBulan],
                'vitamin'     => $vitaminChart,   // bisa null
                'status_gizi' => $statusGizi,     // bisa null
            ],
        ]);
    }
}
