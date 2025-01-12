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
        Schema::create('detail_pemanfaatan_sip', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemanfaatan_sip_id');
            $table->year('tahun');
            $table->unsignedDouble('luas');
            $table->timestamps();

            $table->foreign('pemanfaatan_sip_id')->references('id')->on('pemanfaatan_sip')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pemanfaatan_sip');
    }
};
