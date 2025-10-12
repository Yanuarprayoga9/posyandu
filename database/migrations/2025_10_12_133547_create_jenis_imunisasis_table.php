<?php

// database/migrations/2024_01_01_000001_create_jenis_imunisasis_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jenis_imunisasis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_imunisasi', 20)->unique();
            $table->string('nama_imunisasi', 100);
            $table->text('deskripsi')->nullable();
            $table->integer('usia_target_bulan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_imunisasis');
    }
};
