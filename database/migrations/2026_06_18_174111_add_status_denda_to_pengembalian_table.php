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
        Schema::table('pengembalian', function (Blueprint $table) {
            $table->enum('status_denda', ['belum_dibayar', 'lunas'])->default('belum_dibayar')->after('status_pengembalian');
            $table->timestamp('denda_lunas_at')->nullable()->after('status_denda');
            $table->foreignId('denda_lunas_by')->nullable()->constrained('users')->after('denda_lunas_at');
        });
    }

    public function down(): void
    {
        Schema::table('pengembalian', function (Blueprint $table) {
            $table->dropConstrainedForeignId('denda_lunas_by');
            $table->dropColumn(['status_denda', 'denda_lunas_at']);
        });
    }
};
