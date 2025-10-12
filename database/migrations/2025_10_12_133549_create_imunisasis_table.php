<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('imunisasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anak_id')->constrained('anaks')->onDelete('cascade');
            $table->foreignId('jenis_imunisasi_id')->constrained('jenis_imunisasis')->onDelete('restrict');
            $table->date('tanggal_imunisasi');
            $table->unsignedTinyInteger('usia_saat_imunisasi_bulan')->nullable();
            $table->string('jenis_vaksin', 100)->nullable();
            $table->text('keterangan')->nullable();
            $table->string('petugas')->nullable();
            $table->timestamps();

            $table->index(['anak_id', 'tanggal_imunisasi']);
            $table->index('tanggal_imunisasi');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('imunisasis');
    }
};
