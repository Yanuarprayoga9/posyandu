<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nik_anak' => '3276011506220001',
                'nama_anak' => 'Ahmad Fadhil',
                'tempat_lahir_anak' => 'Bandung',
                'tanggal_lahir_anak' => '2022-06-15',
                'anak_ke' => 1,
                'golongan_darah' => 'A',
                'jenis_kelamin' => 'L',
                'nama_ibu' => 'Siti Aminah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik_anak' => '3276012008220002',
                'nama_anak' => 'Nadia Zahra',
                'tempat_lahir_anak' => 'Jakarta',
                'tanggal_lahir_anak' => '2022-08-20',
                'anak_ke' => 2,
                'golongan_darah' => 'B',
                'jenis_kelamin' => 'P',
                'nama_ibu' => 'Nur Aisyah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik_anak' => '3276010504210003',
                'nama_anak' => 'Rafi Pratama',
                'tempat_lahir_anak' => 'Yogyakarta',
                'tanggal_lahir_anak' => '2021-04-05',
                'anak_ke' => 3,
                'golongan_darah' => 'O',
                'jenis_kelamin' => 'L',
                'nama_ibu' => 'Dewi Kartika',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('anaks')->insert($data);
    }
}
