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
        Schema::create('mobil', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mobil');
            $table->string('plat_mobil')->unique();
            $table->year('tahun_mobil');
            $table->string('tipe_mobil');
            $table->unsignedTinyInteger('kapasitas_mobil');
            $table->decimal('harga_mobil', 12, 2);
            $table->string('foto_mobil')->nullable();
            $table->string('bahan_bakar');
            $table->enum('status_mobil', ['tersedia', 'disewa', 'maintenance'])->default('tersedia')->index();
            $table->foreignId('managed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobil');
    }
};
