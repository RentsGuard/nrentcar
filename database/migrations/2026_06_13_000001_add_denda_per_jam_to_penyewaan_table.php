<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penyewaan', function (Blueprint $table) {
            $table->decimal('denda_per_jam', 12, 2)->nullable()->after('total_harga');
        });
    }

    public function down(): void
    {
        Schema::table('penyewaan', function (Blueprint $table) {
            $table->dropColumn('denda_per_jam');
        });
    }
};
