<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Anak::with(['pemeriksaans' => function($q) use ($request) {
            if ($request->dari_tanggal && $request->sampai_tanggal) {
                $q->whereBetween('tanggal_pemeriksaan', [
                    $request->dari_tanggal,
                    $request->sampai_tanggal
                ]);
            }
            $q->latest('tanggal_pemeriksaan');
        }]);

        // Filter Jenis Kelamin
        if ($request->jenis_kelamin && $request->jenis_kelamin != 'Semua') {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        // Filter Status Gizi
        if ($request->status_gizi && $request->status_gizi != 'Semua') {
            $query->whereHas('pemeriksaans', function($q) use ($request) {
                $q->where('status_gizi', $request->status_gizi);
                if ($request->dari_tanggal && $request->sampai_tanggal) {
                    $q->whereBetween('tanggal_pemeriksaan', [
                        $request->dari_tanggal,
                        $request->sampai_tanggal
                    ]);
                }
            });
        }

        // Search
        if ($request->cari) {
            $query->where(function($q) use ($request) {
                $q->where('nama_anak', 'like', "%{$request->cari}%")
                    ->orWhere('nik_anak', 'like', "%{$request->cari}%");
            });
        }

        $anaks = $query->paginate(10);

        // Statistics
        $totalKunjungan = Pemeriksaan::when($request->dari_tanggal && $request->sampai_tanggal, function($q) use ($request) {
            $q->whereBetween('tanggal_pemeriksaan', [$request->dari_tanggal, $request->sampai_tanggal]);
        })->count();

        $lakiLaki = Anak::where('jenis_kelamin', 'L')
            ->when($request->dari_tanggal && $request->sampai_tanggal, function($q) use ($request) {
                $q->whereHas('pemeriksaans', function($query) use ($request) {
                    $query->whereBetween('tanggal_pemeriksaan', [$request->dari_tanggal, $request->sampai_tanggal]);
                });
            })->count();

        $perempuan = Anak::where('jenis_kelamin', 'P')
            ->when($request->dari_tanggal && $request->sampai_tanggal, function($q) use ($request) {
                $q->whereHas('pemeriksaans', function($query) use ($request) {
                    $query->whereBetween('tanggal_pemeriksaan', [$request->dari_tanggal, $request->sampai_tanggal]);
                });
            })->count();

        // Status Gizi Distribution
        $giziBuruk = Pemeriksaan::where('status_gizi', 'Gizi Buruk')
            ->when($request->dari_tanggal && $request->sampai_tanggal, function($q) use ($request) {
                $q->whereBetween('tanggal_pemeriksaan', [$request->dari_tanggal, $request->sampai_tanggal]);
            })->count();

        $giziKurang = Pemeriksaan::where('status_gizi', 'Gizi Kurang')
            ->when($request->dari_tanggal && $request->sampai_tanggal, function($q) use ($request) {
                $q->whereBetween('tanggal_pemeriksaan', [$request->dari_tanggal, $request->sampai_tanggal]);
            })->count();

        $giziLebih = Pemeriksaan::where('status_gizi', 'Gizi Lebih')
            ->when($request->dari_tanggal && $request->sampai_tanggal, function($q) use ($request) {
                $q->whereBetween('tanggal_pemeriksaan', [$request->dari_tanggal, $request->sampai_tanggal]);
            })->count();

        $stunting = Pemeriksaan::where('status_gizi', 'Stunting')
            ->when($request->dari_tanggal && $request->sampai_tanggal, function($q) use ($request) {
                $q->whereBetween('tanggal_pemeriksaan', [$request->dari_tanggal, $request->sampai_tanggal]);
            })->count();

        $normal = Pemeriksaan::where('status_gizi', 'Normal')
            ->when($request->dari_tanggal && $request->sampai_tanggal, function($q) use ($request) {
                $q->whereBetween('tanggal_pemeriksaan', [$request->dari_tanggal, $request->sampai_tanggal]);
            })->count();

        $riwayatPerkembangan = Pemeriksaan::where('status_gizi', 'Riwayat Perkembangan')
            ->when($request->dari_tanggal && $request->sampai_tanggal, function($q) use ($request) {
                $q->whereBetween('tanggal_pemeriksaan', [$request->dari_tanggal, $request->sampai_tanggal]);
            })->count();

        return view('laporan.index', compact(
            'anaks',
            'totalKunjungan',
            'lakiLaki',
            'perempuan',
            'giziBuruk',
            'giziKurang',
            'giziLebih',
            'stunting',
            'normal',
            'riwayatPerkembangan'
        ));
    }

    public function exportExcel(Request $request)
    {
        // Export Excel logic
    }

    public function exportPDF(Request $request)
    {
        // Export PDF logic
    }

    public function exportCSV(Request $request)
    {
        // Export CSV logic
    }
}
