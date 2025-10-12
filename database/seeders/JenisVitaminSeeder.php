<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JenisVitaminSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kode_vitamin' => 'VIT-A-BIRU',
                'nama_vitamin' => 'Vitamin A Biru',
                'deskripsi' => 'Vitamin A kapsul biru (100.000 IU) untuk usia 6-11 bulan'
            ],
            [
                'kode_vitamin' => 'VIT-A-MERAH',
                'nama_vitamin' => 'Vitamin A Merah',
                'deskripsi' => 'Vitamin A kapsul merah (200.000 IU) untuk usia 12-59 bulan'
            ],
            [
                'kode_vitamin' => 'FE-SIRUP',
                'nama_vitamin' => 'Tablet Fe/Sirup Besi',
                'deskripsi' => 'Suplemen zat besi untuk mencegah anemia'
            ],
            [
                'kode_vitamin' => 'ZINC',
                'nama_vitamin' => 'Zinc',
                'deskripsi' => 'Suplemen Zinc untuk diare dan pertumbuhan'
            ],
            [
                'kode_vitamin' => 'ZINC-10MG',
                'nama_vitamin' => 'Zinc 10mg',
                'deskripsi' => 'Tablet Zinc 10mg untuk terapi diare'
            ],
            [
                'kode_vitamin' => 'ORALIT',
                'nama_vitamin' => 'Oralit',
                'deskripsi' => 'Larutan elektrolit untuk mencegah dehidrasi'
            ],
            [
                'kode_vitamin' => 'OBAT-CACING',
                'nama_vitamin' => 'Obat Cacing',
                'deskripsi' => 'Obat cacing untuk anak usia di atas 2 tahun'
            ],
            [
                'kode_vitamin' => 'PARASETAMOL',
                'nama_vitamin' => 'Paracetamol/Parasetamol',
                'deskripsi' => 'Obat penurun panas'
            ],
            [
                'kode_vitamin' => 'SALEP',
                'nama_vitamin' => 'Salep',
                'deskripsi' => 'Salep untuk perawatan kulit'
            ],
        ];

        foreach ($data as $item) {
            DB::table('jenis_vitamins')->insert(array_merge($item, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }

        $this->command->info('✓ Seeder JenisVitamin berhasil: 9 data');
    }
}
