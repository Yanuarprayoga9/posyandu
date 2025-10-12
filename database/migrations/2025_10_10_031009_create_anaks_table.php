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
        Schema::create('anaks', function (Blueprint $table) {
            $table->id();
            $table->string('nik_anak')->unique();
            $table->string('nama_anak');
            $table->string('tempat_lahir_anak')->nullable();
            $table->date('tanggal_lahir_anak')->nullable();
            $table->unsignedTinyInteger('anak_ke')->nullable();
            $table->string('golongan_darah', 2)->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable(); // L = Laki-laki, P = Perempuan
            $table->string('nama_ibu')->nullable(); // disimpan langsung sebagai string
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anaks');
    }
};
