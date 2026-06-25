<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('status_verifikasi', 20)->nullable()->index()->after('foto_ktp');
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete()->after('status_verifikasi');
            $table->datetime('tanggal_verifikasi')->nullable()->after('verified_by');
            $table->text('catatan_verifikasi')->nullable()->after('tanggal_verifikasi');
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign(['verified_by']);
            $table->dropColumn(['status_verifikasi', 'verified_by', 'tanggal_verifikasi', 'catatan_verifikasi']);
        });
    }
};
