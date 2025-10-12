<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemeriksaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anak_id')->constrained('anaks')->onDelete('cascade');
            $table->date('tanggal_pemeriksaan');
            $table->unsignedTinyInteger('usia_bulan')->nullable();
            $table->decimal('berat_badan', 5, 2)->nullable()->comment('dalam kg');
            $table->decimal('tinggi_badan', 5, 2)->nullable()->comment('dalam cm');
            $table->decimal('lingkar_kepala', 5, 2)->nullable()->comment('dalam cm');
            $table->decimal('lingkar_lengan_atas', 5, 2)->nullable()->comment('dalam cm');
            $table->decimal('suhu_tubuh', 4, 1)->nullable()->comment('dalam celsius');
            $table->text('vitamin_obat')->nullable()->comment('Vitamin/Obat yang diberikan');
            $table->text('tindakan')->nullable()->comment('Tindakan yang dilakukan');
            $table->enum('status_gizi', ['Normal', 'Kurang', 'Buruk', 'Lebih', 'Obesitas'])->nullable();
            $table->string('petugas')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->index(['anak_id', 'tanggal_pemeriksaan']);
            $table->index('tanggal_pemeriksaan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemeriksaans');
    }
};
