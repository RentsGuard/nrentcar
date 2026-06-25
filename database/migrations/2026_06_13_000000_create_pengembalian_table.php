<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penyewaan_id')->unique()->constrained('penyewaan')->restrictOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->restrictOnDelete();
            $table->dateTime('tanggal_pengembalian');
            $table->string('kondisi_mobil')->nullable();
            $table->unsignedInteger('telat_jam')->nullable();
            $table->decimal('denda_per_jam', 12, 2)->nullable();
            $table->decimal('denda_telat', 12, 2)->nullable();
            $table->decimal('denda_kerusakan', 12, 2)->nullable();
            $table->decimal('total_denda', 12, 2)->nullable();
            $table->enum('status_pengembalian', ['tepat_waktu', 'telat', 'rusak', 'telat_dan_rusak'])->default('tepat_waktu')->index();
            $table->text('catatan')->nullable();
            $table->string('foto_kondisi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengembalian');
    }
};
