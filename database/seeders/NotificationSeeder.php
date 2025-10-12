<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('notifications')->insert([
            [
                'id' => Str::uuid(),
                'title' => 'Sistem Update',
                'message' => 'Aplikasi akan maintenance malam ini.',
                'tipe' => 'info',
                'is_read' => false,
                'notification_route' => '/system/announcement',
                'user_id' => Str::uuid(),
                'created_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'title' => 'Tiket Baru',
                'message' => 'Anda memiliki tiket baru dengan ID #TK12345',
                'tipe' => 'ticket',
                'is_read' => false,
                'notification_route' => '/tickets/detail/TK12345',
                'user_id' => Str::uuid(),
                'created_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'title' => 'Komentar Baru',
                'message' => 'User lain berkomentar di postingan Anda.',
                'tipe' => 'comment',
                'is_read' => false,
                'notification_route' => '/forum/detail/POST123',
                'user_id' => Str::uuid(),
                'created_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'title' => 'Tiket Ditutup',
                'message' => 'Tiket Anda dengan ID #TK987 telah ditutup.',
                'tipe' => 'ticket',
                'is_read' => true,
                'notification_route' => '/tickets/detail/TK987',
                'user_id' => Str::uuid(),
                'created_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'title' => 'Pengingat',
                'message' => 'Jangan lupa submit laporan mingguan Anda.',
                'tipe' => 'reminder',
                'is_read' => false,
                'notification_route' => '/dashboard',
                'user_id' => Str::uuid(),
                'created_at' => now(),
            ],
        ]);
    }
}
