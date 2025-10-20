<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pantau_gizi_anaks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anak_id')->constrained('anaks')->onDelete('cascade');
            $table->date('tanggal_pemeriksaan');
            $table->integer('umur_bulan')->nullable();
            $table->string('petugas')->nullable();

            // Data Antropometri
            $table->decimal('berat_badan', 5, 2)->nullable();
            $table->decimal('tinggi_badan', 5, 2)->nullable();
            $table->decimal('lingkar_kepala', 5, 2)->nullable();
            $table->decimal('lingkar_lengan_atas', 5, 2)->nullable();

            // Hasil Perhitungan Status Gizi
            $table->string('bb_u')->nullable(); // Berat Badan per Umur
            $table->string('tb_u')->nullable(); // Tinggi Badan per Umur
            $table->string('bb_tb')->nullable(); // Berat Badan per Tinggi Badan
            $table->string('imt_u')->nullable(); // IMT per Umur
            $table->string('kategori_gizi')->nullable();

            // Riwayat & Pola Makan
            $table->integer('frekuensi_makan')->nullable();
            $table->integer('frekuensi_camilan')->nullable();
            $table->string('makanan_pokok')->nullable();
            $table->json('protein_hewani')->nullable(); // checkbox array
            $table->boolean('konsumsi_sayur_buah')->default(false);
            $table->string('asupan_asi')->nullable(); // eksklusif/campuran/tidak

            // Catatan
            $table->text('catatan')->nullable();
            $table->text('rekomendasi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pantau_gizi_anaks');
    }
};

