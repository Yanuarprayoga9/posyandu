<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PemeriksaanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'anak_id' => 5,
                'tanggal_pemeriksaan' => '2025-02-22',
                'usia_bulan' => 31,
                'berat_badan' => 10.1,
                'tinggi_badan' => 80.4,
                'lingkar_kepala' => 45,
                'lingkar_lengan_atas' => 14.6,
                'suhu_tubuh' => 36.5,
                'vitamin_obat' => '—',
                'tindakan' => 'Edukasi MP-ASI',
                'status_gizi' => 'Normal',
                'petugas' => 'Kader Rina',
                'catatan' => 'Endang',
            ],
            [
                'anak_id' => 6,
                'tanggal_pemeriksaan' => '2025-02-20',
                'usia_bulan' => 47,
                'berat_badan' => 11.2,
                'tinggi_badan' => 86.3,
                'lingkar_kepala' => 46.2,
                'lingkar_lengan_atas' => 15,
                'suhu_tubuh' => 36.6,
                'vitamin_obat' => 'Biru (100.000 IU) • Fe sirup',
                'tindakan' => 'Pantau BB 2 minggu',
                'status_gizi' => 'Normal',
                'petugas' => 'Bidan Nur',
                'catatan' => null,
            ],
            [
                'anak_id' => 3,
                'tanggal_pemeriksaan' => '2025-02-18',
                'usia_bulan' => 77,
                'berat_badan' => 14.3,
                'tinggi_badan' => 101.5,
                'lingkar_kepala' => 49,
                'lingkar_lengan_atas' => 16.5,
                'suhu_tubuh' => 37,
                'vitamin_obat' => 'ORS',
                'tindakan' => 'Observasi hidrasi',
                'status_gizi' => 'Normal',
                'petugas' => 'Kader Rina',
                'catatan' => 'Rahmawati',
            ],
            [
                'anak_id' => 2,
                'tanggal_pemeriksaan' => '2025-02-14',
                'usia_bulan' => 69,
                'berat_badan' => 13.1,
                'tinggi_badan' => 96,
                'lingkar_kepala' => 48,
                'lingkar_lengan_atas' => 16.2,
                'suhu_tubuh' => 36.8,
                'vitamin_obat' => 'Merah (200.000 IU) • —',
                'tindakan' => 'Evaluasi pola makan',
                'status_gizi' => 'Kurang',
                'petugas' => 'Bidan Nur',
                'catatan' => 'Saniah',
            ],
            [
                'anak_id' => 1,
                'tanggal_pemeriksaan' => '2025-02-12',
                'usia_bulan' => 61,
                'berat_badan' => 12.4,
                'tinggi_badan' => 90.2,
                'lingkar_kepala' => 47.5,
                'lingkar_lengan_atas' => 15.8,
                'suhu_tubuh' => 36.7,
                'vitamin_obat' => 'Biru (100.000 IU) • Zinc 10mg',
                'tindakan' => 'Konseling gizi',
                'status_gizi' => 'Normal',
                'petugas' => 'Siti Aminah',
                'catatan' => null,
            ],
        ];

        foreach ($data as $item) {
            DB::table('pemeriksaans')->insert(array_merge($item, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }

        $this->command->info('✓ Seeder Pemeriksaan berhasil: 5 data');
    }
}
