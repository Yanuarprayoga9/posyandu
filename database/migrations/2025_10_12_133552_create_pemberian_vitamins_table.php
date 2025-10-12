<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemberian_vitamins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemeriksaan_id')->constrained('pemeriksaans')->onDelete('cascade');
            $table->foreignId('jenis_vitamin_id')->constrained('jenis_vitamins')->onDelete('restrict');
            $table->string('jumlah', 50)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->index('pemeriksaan_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemberian_vitamins');
    }
};
