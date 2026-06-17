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
        Schema::create('penyewaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->restrictOnDelete();
            $table->foreignId('mobil_id')->constrained('mobil')->restrictOnDelete();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->date('tanggal_sewa')->index();
            $table->date('tanggal_kembali')->index();
            $table->unsignedInteger('lama_sewa');
            $table->decimal('total_harga', 12, 2);
            $table->decimal('denda_per_jam', 12, 2)->nullable();
            $table->enum('status', ['aktif', 'selesai', 'dibatalkan'])->default('aktif')->index();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyewaan');
    }
};
