<?php

// database/seeders/ImunisasiSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ImunisasiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'anak_id' => 1,
                'jenis_imunisasi_id' => 2, // BCG
                'tanggal_imunisasi' => '2025-08-12',
                'usia_saat_imunisasi_bulan' => 6,
                'jenis_vaksin' => 'BCG',
                'keterangan' => null,
                'petugas' => 'Endang',
            ],
            [
                'anak_id' => 2,
                'jenis_imunisasi_id' => 4, // DPT-HB
                'tanggal_imunisasi' => '2025-08-12',
                'usia_saat_imunisasi_bulan' => 4,
                'jenis_vaksin' => 'DPT-HB',
                'keterangan' => null,
                'petugas' => 'Saniah',
            ],
            [
                'anak_id' => 3,
                'jenis_imunisasi_id' => 3, // Polio
                'tanggal_imunisasi' => '2025-08-12',
                'usia_saat_imunisasi_bulan' => 2,
                'jenis_vaksin' => 'Polio',
                'keterangan' => null,
                'petugas' => 'Rahmawati',
            ],
            [
                'anak_id' => 4,
                'jenis_imunisasi_id' => 11, // Campak
                'tanggal_imunisasi' => '2025-07-03',
                'usia_saat_imunisasi_bulan' => 9,
                'jenis_vaksin' => 'Campak',
                'keterangan' => null,
                'petugas' => 'Sulastri',
            ],
            [
                'anak_id' => 5,
                'jenis_imunisasi_id' => 1, // Hepatitis B
                'tanggal_imunisasi' => '2025-06-20',
                'usia_saat_imunisasi_bulan' => 12,
                'jenis_vaksin' => 'Hepatitis B',
                'keterangan' => null,
                'petugas' => 'Rahmat',
            ],
        ];

        foreach ($data as $item) {
            DB::table('imunisasis')->insert(array_merge($item, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }

        $this->command->info('✓ Seeder Imunisasi berhasil: 5 data');
    }
}
