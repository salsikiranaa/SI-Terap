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
        Schema::create('p_identifikasi_sasaran', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('identifikasi_id')->unsigned();
            $table->bigInteger('sasaran_id')->unsigned();
            $table->timestamps();

            $table->foreign('identifikasi_id')->references('id')->on('identifikasi')->onDelete('cascade');
            $table->foreign('sasaran_id')->references('id')->on('m_sasaran')->onDelete('cascade');

            $table->unique(['identifikasi_id', 'sasaran_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_identifikasi_sasaran');
    }
};
