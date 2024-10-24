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
        Schema::create('p_diseminasi_sasaran', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('diseminasi_id')->unsigned();
            $table->bigInteger('sasaran_id')->unsigned();
            $table->timestamps();

            $table->foreign('diseminasi_id')->references('id')->on('diseminasi')->onDelete('cascade');
            $table->foreign('sasaran_id')->references('id')->on('m_sasaran')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_diseminasi_sasaran');
    }
};
