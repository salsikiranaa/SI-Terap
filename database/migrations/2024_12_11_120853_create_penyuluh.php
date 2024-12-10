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
        Schema::create('penyuluh', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kecamatan_id');
            $table->unsignedBigInteger('fungsional_id');
            $table->string('name')->unique();
            $table->string('contact')->unique();
            $table->timestamps();

            $table->foreign('kecamatan_id')->references('id')->on('m_kecamatan');
            $table->foreign('fungsional_id')->references('id')->on('m_fungsional');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyuluh');
    }
};
