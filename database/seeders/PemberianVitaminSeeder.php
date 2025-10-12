<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PemberianVitaminSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // Pemeriksaan ID 2: Alya Kirana
            [
                'pemeriksaan_id' => 2,
                'jenis_vitamin_id' => 1, // Vitamin A Biru
                'jumlah' => '1 kapsul',
                'keterangan' => '100.000 IU',
            ],
            [
                'pemeriksaan_id' => 2,
                'jenis_vitamin_id' => 3, // Fe Sirup
                'jumlah' => '5 ml',
                'keterangan' => 'Diminum 1x sehari',
            ],
            // Pemeriksaan ID 3: Noah Rising
            [
                'pemeriksaan_id' => 3,
                'jenis_vitamin_id' => 6, // Oralit
                'jumlah' => '2 sachet',
                'keterangan' => 'Untuk terapi diare',
            ],
            // Pemeriksaan ID 4: Eliana Kalogera
            [
                'pemeriksaan_id' => 4,
                'jenis_vitamin_id' => 2, // Vitamin A Merah
                'jumlah' => '1 kapsul',
                'keterangan' => '200.000 IU',
            ],
            // Pemeriksaan ID 5: Chalondra Mia Ciara
            [
                'pemeriksaan_id' => 5,
                'jenis_vitamin_id' => 1, // Vitamin A Biru
                'jumlah' => '1 kapsul',
                'keterangan' => '100.000 IU',
            ],
            [
                'pemeriksaan_id' => 5,
                'jenis_vitamin_id' => 5, // Zinc 10mg
                'jumlah' => '10 tablet',
                'keterangan' => 'Diminum 1x sehari selama 10 hari',
            ],
        ];

        foreach ($data as $item) {
            DB::table('pemberian_vitamins')->insert(array_merge($item, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }

        $this->command->info('✓ Seeder PemberianVitamin berhasil: 6 data');
    }
}
