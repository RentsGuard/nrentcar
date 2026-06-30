<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE pengembalian MODIFY COLUMN status_pengembalian ENUM('tepat_waktu', 'telat', 'rusak', 'telat_dan_rusak', 'awal') NOT NULL DEFAULT 'tepat_waktu'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE pengembalian MODIFY COLUMN status_pengembalian ENUM('tepat_waktu', 'telat', 'rusak', 'telat_dan_rusak') NOT NULL DEFAULT 'tepat_waktu'");
    }
};
