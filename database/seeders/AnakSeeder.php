<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnakSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nik_anak' => '230006483017',
                'nama_anak' => 'Chalondra Mia Ciara',
                'tempat_lahir_anak' => 'Gombong',
                'tanggal_lahir_anak' => '2020-02-14',
                'anak_ke' => 1,
                'golongan_darah' => 'A',
                'jenis_kelamin' => 'P',
                'nama_ibu' => 'Haisley Ciara',
            ],
            [
                'nik_anak' => '230006483018',
                'nama_anak' => 'Eliana Kalogera',
                'tempat_lahir_anak' => 'Kebumen',
                'tanggal_lahir_anak' => '2020-05-20',
                'anak_ke' => 1,
                'golongan_darah' => 'B',
                'jenis_kelamin' => 'P',
                'nama_ibu' => 'Demitra Kalogera',
            ],
            [
                'nik_anak' => '230006483019',
                'nama_anak' => 'Noah Rising',
                'tempat_lahir_anak' => 'Purworejo',
                'tanggal_lahir_anak' => '2020-09-17',
                'anak_ke' => 2,
                'golongan_darah' => 'O',
                'jenis_kelamin' => 'L',
                'nama_ibu' => 'Anna Joe',
            ],
            [
                'nik_anak' => '230006483020',
                'nama_anak' => 'Aurelia Putri',
                'tempat_lahir_anak' => 'Wonosobo',
                'tanggal_lahir_anak' => '2021-01-03',
                'anak_ke' => 1,
                'golongan_darah' => 'AB',
                'jenis_kelamin' => 'P',
                'nama_ibu' => 'Sinta Dewi',
            ],
            [
                'nik_anak' => '230006483021',
                'nama_anak' => 'Bima Pratama',
                'tempat_lahir_anak' => 'Purbalingga',
                'tanggal_lahir_anak' => '2019-11-22',
                'anak_ke' => 3,
                'golongan_darah' => 'B',
                'jenis_kelamin' => 'L',
                'nama_ibu' => 'Rani Pertiwi',
            ],
            [
                'nik_anak' => '230006483022',
                'nama_anak' => 'Alya Kirana',
                'tempat_lahir_anak' => 'Cilacap',
                'tanggal_lahir_anak' => '2021-03-15',
                'anak_ke' => 2,
                'golongan_darah' => 'A',
                'jenis_kelamin' => 'P',
                'nama_ibu' => 'Dewi Lestari',
            ],
            [
                'nik_anak' => '230006483023',
                'nama_anak' => 'Bima Aditya',
                'tempat_lahir_anak' => 'Banjarnegara',
                'tanggal_lahir_anak' => '2021-07-08',
                'anak_ke' => 1,
                'golongan_darah' => 'O',
                'jenis_kelamin' => 'L',
                'nama_ibu' => 'Rina Kartika',
            ],
        ];

        foreach ($data as $item) {
            DB::table('anaks')->insert(array_merge($item, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }

        $this->command->info('✓ Seeder Anak berhasil: 7 data');
    }
}
