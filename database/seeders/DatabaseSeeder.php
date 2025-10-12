<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Master Data
            JenisImunisasiSeeder::class,
            JenisVitaminSeeder::class,

            // Transaction Data
            AnakSeeder::class,
            ImunisasiSeeder::class,
            PemeriksaanSeeder::class,
            PemberianVitaminSeeder::class,
        ]);

        $this->command->info('');
        $this->command->info('====================================');
        $this->command->info('✓ SEMUA SEEDER BERHASIL DIJALANKAN!');
        $this->command->info('====================================');
        $this->command->info('');
    }
}
