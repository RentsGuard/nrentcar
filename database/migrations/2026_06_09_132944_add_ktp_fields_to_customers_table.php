<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->string('golongan_darah', 3)->nullable();
            $table->string('rt_rw', 10)->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kota_kabupaten')->nullable();
            $table->string('provinsi')->nullable();
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'])->nullable();
            $table->enum('status_perkawinan', ['Kawin', 'Belum Kawin', 'Cerai'])->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('kewarganegaraan', 10)->default('WNI');
            $table->date('berlaku_hingga')->nullable();
            $table->string('foto_ktp')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn([
                'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin',
                'golongan_darah', 'rt_rw', 'kelurahan', 'kecamatan',
                'kota_kabupaten', 'provinsi', 'agama', 'status_perkawinan',
                'pekerjaan', 'kewarganegaraan', 'berlaku_hingga', 'foto_ktp',
            ]);
        });
    }
};
