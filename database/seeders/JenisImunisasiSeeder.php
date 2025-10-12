<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JenisImunisasiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kode_imunisasi' => 'HB0',
                'nama_imunisasi' => 'Hepatitis B 0',
                'deskripsi' => 'Imunisasi Hepatitis B dosis pertama (HB0)',
                'usia_target_bulan' => 0
            ],
            [
                'kode_imunisasi' => 'BCG',
                'nama_imunisasi' => 'BCG',
                'deskripsi' => 'Imunisasi BCG untuk mencegah tuberkulosis',
                'usia_target_bulan' => 1
            ],
            [
                'kode_imunisasi' => 'POLIO1',
                'nama_imunisasi' => 'Polio 1',
                'deskripsi' => 'Imunisasi Polio dosis pertama',
                'usia_target_bulan' => 1
            ],
            [
                'kode_imunisasi' => 'DPT-HB-HIB1',
                'nama_imunisasi' => 'DPT-HB-Hib 1',
                'deskripsi' => 'Imunisasi DPT-HB-Hib dosis pertama',
                'usia_target_bulan' => 2
            ],
            [
                'kode_imunisasi' => 'POLIO2',
                'nama_imunisasi' => 'Polio 2',
                'deskripsi' => 'Imunisasi Polio dosis kedua',
                'usia_target_bulan' => 2
            ],
            [
                'kode_imunisasi' => 'DPT-HB-HIB2',
                'nama_imunisasi' => 'DPT-HB-Hib 2',
                'deskripsi' => 'Imunisasi DPT-HB-Hib dosis kedua',
                'usia_target_bulan' => 3
            ],
            [
                'kode_imunisasi' => 'POLIO3',
                'nama_imunisasi' => 'Polio 3',
                'deskripsi' => 'Imunisasi Polio dosis ketiga',
                'usia_target_bulan' => 3
            ],
            [
                'kode_imunisasi' => 'DPT-HB-HIB3',
                'nama_imunisasi' => 'DPT-HB-Hib 3',
                'deskripsi' => 'Imunisasi DPT-HB-Hib dosis ketiga',
                'usia_target_bulan' => 4
            ],
            [
                'kode_imunisasi' => 'POLIO4',
                'nama_imunisasi' => 'Polio 4',
                'deskripsi' => 'Imunisasi Polio dosis keempat',
                'usia_target_bulan' => 4
            ],
            [
                'kode_imunisasi' => 'IPV',
                'nama_imunisasi' => 'IPV',
                'deskripsi' => 'Imunisasi Polio Injeksi (IPV)',
                'usia_target_bulan' => 4
            ],
            [
                'kode_imunisasi' => 'CAMPAK',
                'nama_imunisasi' => 'Campak/MR',
                'deskripsi' => 'Imunisasi Campak atau MR',
                'usia_target_bulan' => 9
            ],
            [
                'kode_imunisasi' => 'DPT-HB-HIB-BOOSTER',
                'nama_imunisasi' => 'DPT-HB-Hib Booster',
                'deskripsi' => 'Imunisasi DPT-HB-Hib booster',
                'usia_target_bulan' => 18
            ],
            [
                'kode_imunisasi' => 'CAMPAK-BOOSTER',
                'nama_imunisasi' => 'Campak/MR Booster',
                'deskripsi' => 'Imunisasi Campak/MR booster',
                'usia_target_bulan' => 18
            ],
        ];

        foreach ($data as $item) {
            DB::table('jenis_imunisasis')->insert(array_merge($item, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }

        $this->command->info('✓ Seeder JenisImunisasi berhasil: 13 data');
    }
}
