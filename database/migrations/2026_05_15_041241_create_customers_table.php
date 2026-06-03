<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('nik'); 
            $table->string('nama');
            $table->string('email');
            $table->string('alamat');
            $table->string('no_hp');
            $table->string('foto')->nullable();
            $table->string('status');
            $table->timestamps();
        });
            }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
};