<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kpsps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anak_id')->constrained('anaks')->onDelete('cascade');
            $table->date('tanggal_pemeriksaan');

            // Motorik Kasar
            $table->boolean('berdiri_berpegangan')->default(false);
            $table->boolean('berjalan_bantuan')->default(false);

            // Motorik Halus
            $table->boolean('mengambil_benda_tangan')->default(false);
            $table->boolean('mengambil_benda_kecil')->default(false);

            // Bahasa/Komunikasi
            $table->boolean('mengucap_suku_kata')->default(false);
            $table->boolean('merespon_saat_dipanggil')->default(false);

            // Sosial/Emosional & Kognitif
            $table->boolean('melepas_tangan')->default(false);
            $table->boolean('menirukan_bunyi')->default(false);
            $table->boolean('menunjuk_benda')->default(false);
            $table->boolean('minum_cangkir')->default(false);

            $table->text('catatan')->nullable();
            $table->text('rekomendasi')->nullable();
            $table->string('petugas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kpsps');
    }
};
