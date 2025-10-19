<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orangtuas', function (Blueprint $table) {
            $table->id();
            $table->string('no_kk', 16);
            $table->string('nik_ibu', 16);
            $table->string('nama_ibu', 100);
            $table->date('tanggal_lahir_ibu');
            $table->string('golongan_darah_ibu', 3)->nullable();
            $table->string('nik_ayah', 16);
            $table->string('nama_ayah', 100);
            $table->string('no_telepon', 15)->nullable();
            $table->text('alamat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orangtuas');
    }
};
