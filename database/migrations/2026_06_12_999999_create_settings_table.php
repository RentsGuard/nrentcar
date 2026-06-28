<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        DB::table('settings')->insert([
            ['key' => 'app_name', 'value' => 'RentSCar'],
            ['key' => 'app_description', 'value' => 'Premium Car Rental Management System'],
            ['key' => 'app_theme', 'value' => 'dark'],
            ['key' => 'app_accent_color', 'value' => '#C1121F'],
            ['key' => 'rental_denda_per_hari', 'value' => '50000'],
            ['key' => 'notifikasi_email', 'value' => 'true'],
            ['key' => 'notifikasi_sistem', 'value' => 'true'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
