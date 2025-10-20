<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Event;
use App\Models\Pemeriksaan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAnak = Anak::count();
        $lakiLaki = Anak::where('jenis_kelamin', 'L')->count();
        $perempuan = Anak::where('jenis_kelamin', 'P')->count();

        // Hitung stunting dari data pemeriksaan
        $stunting = Pemeriksaan::where('status_gizi', 'Buruk')
            ->orWhere('status_gizi', 'Kurang')
            ->distinct('anak_id')
            ->count();

        $upcomingEvents = Event::where('status', 'upcoming')
            ->orderBy('tanggal_kegiatan', 'asc')
            ->limit(3)
            ->get();

        // Data untuk grafik status gizi (12 bulan terakhir)
        $statusGiziData = Pemeriksaan::select(
            DB::raw('MONTH(tanggal_pemeriksaan) as bulan'),
            'status_gizi',
            DB::raw('COUNT(*) as total')
        )
            ->where('tanggal_pemeriksaan', '>=', now()->subMonths(12))
            ->groupBy('bulan', 'status_gizi')
            ->orderBy('bulan')
            ->get();

        // Format data untuk chart
        $chartData = $this->formatChartData($statusGiziData);

        // Hitung prevalensi stunting
        $totalPemeriksaan = Pemeriksaan::whereDate('tanggal_pemeriksaan', '>=', now()->subMonths(3))->count();
        $prevalensiStunting = $totalPemeriksaan > 0
            ? round(($stunting / $totalPemeriksaan) * 100, 1)
            : 0;

        // Cakupan timbang (anak yang ditimbang dalam 30 hari terakhir)
        $anakDitimbang = Pemeriksaan::whereDate('tanggal_pemeriksaan', '>=', now()->subDays(30))
            ->distinct('anak_id')
            ->count();
        $cakupanTimbang = $totalAnak > 0
            ? round(($anakDitimbang / $totalAnak) * 100)
            : 0;

        return view('dashboard.index', compact(
            'totalAnak',
            'lakiLaki',
            'perempuan',
            'stunting',
            'upcomingEvents',
            'chartData',
            'prevalensiStunting',
            'cakupanTimbang'
        ));
    }

    private function formatChartData($statusGiziData)
    {
        $bulanNama = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $months = [];
        $giziKurang = [];
        $normal = [];
        $stunting = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $bulan = $date->month;
            $months[] = $bulanNama[$bulan - 1];

            $dataForMonth = $statusGiziData->where('bulan', $bulan);

            $giziKurang[] = $dataForMonth->where('status_gizi', 'Kurang')->sum('total');
            $normal[] = $dataForMonth->where('status_gizi', 'Normal')->sum('total');
            $stunting[] = $dataForMonth->whereIn('status_gizi', ['Buruk', 'Kurang'])->sum('total');
        }

        return [
            'labels' => $months,
            'giziKurang' => $giziKurang,
            'normal' => $normal,
            'stunting' => $stunting
        ];
    }
}
