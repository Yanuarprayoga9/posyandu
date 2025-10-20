<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // add jam_kegiatan
        if (!Schema::hasColumn('events', 'jam_kegiatan')) {
            Schema::table('events', function (Blueprint $table) {
                $table->time('jam_kegiatan')->nullable()->after('tanggal_kegiatan');
            });
        }

        // add deskripsi
        if (!Schema::hasColumn('events', 'deskripsi')) {
            Schema::table('events', function (Blueprint $table) {
                $table->text('deskripsi')->nullable()->after('penanggung_jawab');
            });
        }

        // add or convert status to enum
        if (!Schema::hasColumn('events', 'status')) {
            // Use raw statement to create enum (works for MySQL)
            DB::statement("ALTER TABLE `events` ADD `status` ENUM('upcoming','ongoing','completed') NOT NULL DEFAULT 'upcoming' AFTER `dokumentasi`");
        } else {
            // If status exists but not the desired enum, attempt to modify it
            // This will convert existing column to the enum type (MySQL)
            DB::statement("ALTER TABLE `events` MODIFY `status` ENUM('upcoming','ongoing','completed') NOT NULL DEFAULT 'upcoming'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // drop status
        if (Schema::hasColumn('events', 'status')) {
            Schema::table('events', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }

        // drop deskripsi
        if (Schema::hasColumn('events', 'deskripsi')) {
            Schema::table('events', function (Blueprint $table) {
                $table->dropColumn('deskripsi');
            });
        }

        // drop jam_kegiatan
        if (Schema::hasColumn('events', 'jam_kegiatan')) {
            Schema::table('events', function (Blueprint $table) {
                $table->dropColumn('jam_kegiatan');
            });
        }
    }
};
